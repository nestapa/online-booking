<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\UserPoin;
use App\Models\UserVoucher;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ClientController extends Controller
{
    function index(){
        $products = Product::get();
        return view('pages.client.beranda', compact('products'));
    }

    function product(){
        $products = Product::all();
        return view('pages.client.client_product.product', compact('products'));
    }

    function detail_product(string $id){
        $product = Product::find($id);
        return view('pages.client.client_product.detail', compact('product'));
    }

    function client_voucher(){
        $user_poin = UserPoin::where('user_id', auth()->user()->id)->first();
        $vouchers = Voucher::all();
        return view('pages.client.client_voucher.index', compact('vouchers','user_poin'));
    }

    function hubungi(){
        echo 'tester';
    }

    function profile_client(){
        $user = User::where('id', auth()->user()->id)->get();
        return view('pages.client.client_profile', compact('user'));
    }

    function tukar_voucher(Request $request) {
        $request->validate([
            'voucher_id' => 'required'
        ]);

        $data = [
            'user_id' => auth()->user()->id,
            'voucher_id' => $request->voucher_id,
        ];


        $user_poin = UserPoin::where('user_id', $data['user_id'])->first();
        $voucher = Voucher::where('id', $request->voucher_id)->first();

        if (!$user_poin || !$voucher) {
            return redirect()->back()->with('toast', 'showToast("Data tidak ditemukan")');
        }

        if ($user_poin->total_poin < $voucher->poin_diperlukan) {
            return redirect()->back()->with('toast', 'showToast("Maaf Poin Anda Tidak Mencukupi")');
        } else {
            $poin_update = $user_poin->total_poin - $voucher->poin_diperlukan;
            $user_poin->update(['total_poin' => $poin_update]);
            UserVoucher::create($data);

            return redirect()->back()->with('toast', 'showToast("Voucher Berhasil Ditukarkan")');
        }
    }

    function pembayaran(string $id){
        $product = Product::find($id);

        $waktu = Carbon::now('Asia/Jakarta');
        $waktu_plus_one = $waktu->copy()->addDay($product->jangka_waktu);
        $estimasi_selesai = $waktu_plus_one->translatedFormat('d F Y');

        $product = Product::find($id);
        $user_vouchers = UserVoucher::where('user_id', auth()->user()->id)
        ->where('is_active', true)
        ->get();

        $metode_pembayaran = MetodePembayaran::get();
        return view('pages.client.pembayaran', compact('product','metode_pembayaran','estimasi_selesai','user_vouchers'));
    }



    function transaksi(Request $request) {
        $product = Product::find($request->id_product);

        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        $waktu = Carbon::now('Asia/Jakarta');
        $waktu_plus_one = $waktu->copy()->addDays($product->jangka_waktu);
        $estimasi_selesai = $waktu_plus_one;

        // Validasi
        $request->validate([
            'id_metode' => 'required',
            'id_product' => 'required',
            'id_user_voucher' => 'nullable|exists:user_vouchers,id', // Pastikan voucher valid
            'berat_laundry' => 'required|numeric',
            'total_harga' => 'required|numeric',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Siapkan data transaksi
        $data = [
            'id_user' => auth()->user()->id,
            'id_metode' => $request->id_metode,
            'id_product' => $request->id_product,
            'id_user_voucher' => $request->id_user_voucher,
            'berat_laundry' => $request->berat_laundry,
            'tanggal_masuk' => $waktu,
            'tanggal_selesai' => $estimasi_selesai,
        ];

        // Menghandle file bukti pembayaran
        if ($request->hasFile('bukti_pembayaran')) {
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        // Menghitung poin berdasarkan total harga
        if ($request->total_harga > 500000) {
            $data['poin_masuk'] = floor($request->total_harga / 500000) * 50;
        } else {
            $data['poin_masuk'] = 0;
        }

        // Mengupdate poin pengguna
        $user_poin = UserPoin::where('user_id', auth()->user()->id)->first();

        if ($user_poin) {
            $user_poin->update([
                'total_poin' => $user_poin->total_poin + $data['poin_masuk'],
            ]);
        } else {
            UserPoin::create([
                'user_id' => auth()->user()->id,
                'total_poin' => $data['poin_masuk'],
            ]);
        }

        // Mengatur status transaksi
        if ($waktu->lessThan($estimasi_selesai)) {
            $data['status'] = 'Di Proses';
        } else {
            $data['status'] = 'Selesai';
        }

        if ($request->id_user_voucher != null) {
            $voucher = UserVoucher::find($request->id_user_voucher);

            if ($voucher) {
                // Mengurangi total harga dengan diskon (contoh: diskon 50% = 0.50)
                $diskon = $voucher->voucher->total_diskon; // Diskon berbentuk desimal, misal 0.50 untuk 50%
                $data['total_harga'] = $request->total_harga * (1 - $diskon);

                // Menandai voucher sebagai tidak aktif
                $voucher->is_active = false; // Atur status menjadi tidak aktif
                $voucher->save(); // Simpan perubahan
            } else {
                $data['total_harga'] = $request->total_harga; // Jika tidak ada voucher, total tetap
            }
        } else {
            $data['total_harga'] = $request->total_harga;
        }

        // Menyimpan transaksi
        $transaksi = Transaksi::create($data);



        return redirect()->back()->with('toast', 'showToast("Transaksi Berhasil")');
    }




}
