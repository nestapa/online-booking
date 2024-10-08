@extends('layouts.client')

<style>
    .btn-register:hover {
        color: white;
    }
</style>

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="row align-content-center" style="height: 90vh;">
        <div class="col-md-6 d-flex align-items-center h-100">
            <div class="m-5">
                <h4>Detail Transaksi</h4>
                <div class="my-3">
                    <h5>{{ $product->nama_produk }}</h5>
                    <p>Rate {{ $product->rate }}</p>
                </div>
                <p>{{ $product->deskripsi }}</p>
                <p>Rp. {{ number_format($product->harga, 0, ',', '.') }} / Kg</p>
                <p>Estimasi Selesai {{ $estimasi_selesai }}</p>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <form action="{{ route('transaksi') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ALERT ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row m-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Transaksi</h4>
                            </div>
                            <input type="hidden" name="id_product" value="{{ $product->id }}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="berat_laundry" class="col-sm-3 col-form-label">Berat Laundry</label>
                                    <div class="col-sm-9">
                                        <input value="{{ old('berat_laundry') }}" type="number"
                                            class="form-control @error('berat_laundry') is-invalid @enderror"
                                            name="berat_laundry" id="berat_laundry" placeholder="Berat Laundry">
                                        @error('berat_laundry')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_metode" class="col-sm-3 col-form-label">Metode Pembayaran</label>
                                    <div class="col-sm-9">
                                        <select name="id_metode" id="id_metode"
                                            class="form-control text-capitalize @error('id_metode') is-invalid @enderror">
                                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                            @foreach ($metode_pembayaran as $mp)
                                                <option value="{{ $mp->id }}" data-rekening="{{ $mp->nomer }}">
                                                    {{ $mp->nama_metode }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_metode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="id_user_voucher" class="col-sm-3 col-form-label">Voucher</label>
                                    <div class="col-sm-9">
                                        <select name="id_user_voucher" id="id_user_voucher"
                                            class="form-control text-capitalize @error('id_user_voucher') is-invalid @enderror">
                                            <option value="" disabled selected>Pilih Voucher</option>
                                            @foreach ($user_vouchers as $uv)
                                                <option value="{{ $uv->id }}">
                                                    {{ $uv->voucher->nama_voucher }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_user_voucher')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nomer_rekening" class="col-sm-3 col-form-label">Nomor Rekening</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nomer_rekening" id="nomer_rekening"
                                            placeholder="Nomor Rekening" disabled>
                                    </div>
                                </div>

                                {{-- Total Harga (sebelum diskon) --}}
                                <div class="form-group row">
                                    <label for="total_harga_display" class="col-sm-3 col-form-label">Total Harga</label>
                                    <div class="col-sm-9">
                                        {{-- Display total harga formatted --}}
                                        <input type="text" readonly class="form-control" id="total_harga_display"
                                            placeholder="Total Harga (Rupiah)">
                                    </div>
                                </div>

                                {{-- Total Harga Setelah Diskon --}}
                                <div class="form-group row">
                                    <label for="total_harga_setelah_diskon_display" class="col-sm-3 col-form-label">Total
                                        Setelah Diskon</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control"
                                            id="total_harga_setelah_diskon_display"
                                            placeholder="Total Setelah Diskon (Rupiah)">
                                    </div>
                                </div>

                                {{-- Input tersembunyi untuk total harga dalam angka --}}
                                <input type="hidden" name="total_harga" id="total_harga">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="bukti_pembayaran"
                                        name="bukti_pembayaran">
                                    <label class="custom-file-label" for="bukti_pembayaran">Bukti Pembayaran</label>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const beratLaundryInput = document.getElementById('berat_laundry');
            const totalHargaDisplay = document.getElementById('total_harga_display');
            const totalHargaSetelahDiskonDisplay = document.getElementById('total_harga_setelah_diskon_display');
            const totalHargaInput = document.getElementById('total_harga');
            const hargaPerKg = {{ $product->harga }};

            const voucherSelect = document.getElementById('id_user_voucher');
            const voucherData = @json($user_vouchers);

            const metodeSelect = document.getElementById('id_metode');
            const rekeningInput = document.getElementById(
                'nomer_rekening'); // Input untuk menampilkan nomor rekening

            // Fungsi untuk memperbarui total harga berdasarkan berat laundry
            function updateTotalHarga() {
                const berat = parseFloat(beratLaundryInput.value) || 0;
                const totalHarga = berat * hargaPerKg;
                totalHargaDisplay.value = totalHarga.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
                totalHargaInput.value = totalHarga;
                applyVoucherDiscount();
            }

            // Fungsi untuk menghitung harga setelah diskon jika ada voucher
            function applyVoucherDiscount() {
                const berat = parseFloat(beratLaundryInput.value) || 0;
                const totalHarga = berat * hargaPerKg;
                let totalSetelahDiskon = totalHarga;

                const selectedVoucherId = voucherSelect.value;
                if (selectedVoucherId) {
                    const selectedVoucher = voucherData.find(voucher => voucher.id == selectedVoucherId);
                    if (selectedVoucher) {
                        const diskon = selectedVoucher.voucher.total_diskon;
                        totalSetelahDiskon = totalHarga * (1 - diskon);
                    }
                }

                totalHargaSetelahDiskonDisplay.value = totalSetelahDiskon.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });
            }

            // Fungsi untuk memperbarui nomor rekening ketika metode pembayaran dipilih
            function updateNomerRekening() {
                const selectedOption = metodeSelect.options[metodeSelect.selectedIndex];
                const nomerRekening = selectedOption.getAttribute('data-rekening');
                rekeningInput.value = nomerRekening || ''; // Tampilkan nomor rekening, atau kosong jika tidak ada
            }

            // Event listener untuk perubahan berat laundry dan voucher
            beratLaundryInput.addEventListener('input', updateTotalHarga);
            voucherSelect.addEventListener('change', applyVoucherDiscount);

            // Event listener untuk perubahan metode pembayaran
            metodeSelect.addEventListener('change', updateNomerRekening);

            // Inisialisasi awal
            updateTotalHarga();
            updateNomerRekening(); // Set nomor rekening saat halaman pertama kali dimuat
        });
    </script>
@endsection
