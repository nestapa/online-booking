<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Voucher::get();
            return DataTables::of($query)->make();
        }

        return view('pages.voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_voucher' => 'required',
            'total_diskon' => 'required',
            'poin_diperlukan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama_voucher' => $request->nama_voucher,
            'total_diskon' => $request->total_diskon,
            'poin_diperlukan' => $request->poin_diperlukan,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar', 'public');
        }

        Voucher::create($data);

        return redirect('voucher')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Voucher::findOrFail($id);

        return view('pages.voucher.edit', [
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voucher = Voucher::findOrFail($id);

        $data = [
            'nama_voucher' => $request->nama_voucher,
            'total_diskon' => $request->total_diskon,
            'poin_diperlukan' => $request->poin_diperlukan,
        ];

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $path = "gambar/";
            $oldfile = $path . basename($voucher->gambar);
            Storage::disk('public')->delete($oldfile);
            $data['gambar'] = Storage::disk('public')->put($path, $request->file('gambar'));
        }

        $voucher->update($data);

        return redirect('voucher')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
