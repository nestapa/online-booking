@extends('layouts.client')

<style>
    .btn-register:hover {
        color: white;
    }
</style>
@section('content')
    <section class="row align-content-center" style="height: 90vh;">
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $product->gambar) }}" alt="" style="border-radius: 10px; object-fit: cover; width: 100%; object-position: center; height: 90%;">
        </div>
        <div class="col-md-6 m-5">
            <div>
                <h4>{{ $product->nama_produk }}</h4>
                <p>Rate {{$product->rate}}</p>
            </div>
            <p style="text-align: justify">{{ $product->deskripsi }}</p>
            <ul>
                <li>Rp. {{ number_format($product->harga, 0, ',', '.') }} / Kg</li>
                <li>Estimasi Selesai {{ $product->jangka_waktu }} Hari</li>
                <li>Cuci - Gosok - Lipat</li>
            </ul>
            <div>
                <a href="{{route('pembayaran', $product->id)}}" class="btn btn-primary">Pesan Sekarang</a>
                <a href="{{ url()->previous() }}" class="btn btn-register" style="color: #ccff33; background-color: black">
                    Kembali
                </a>
            </div>
        </div>
    </section>
@endsection
