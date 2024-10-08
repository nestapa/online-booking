@extends('layouts.client')
<style>
    .banner {
        width: 100%;
        height: 350px;
        border-radius: 10px;
        background-color: black
    }

    .card-text p {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    a.card-link {
        text-decoration: none;
        color: inherit;
    }

    a.card-link:hover {
        color: inherit;
        /* Mencegah perubahan warna saat hover */
        text-decoration: none;
        /* Tetap tanpa underline */
    }
</style>

@section('content')
    <section>
        <div class="banner"></div>
        <div class="col-md-12 d-flex justify-content-between my-4 w-100">
            <p class="" style="font-size: 32px">Rekomendasi</p>
            <a href="" style="text-decoration: none">
                <p>Lihat Semua</p>
            </a>
        </div>
        <div class="row d-flex justify-content-around  ">
            @foreach ($products as $product)
                <a href="{{ route('detail-product', $product->id) }}" class="card-link">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" style="height: 250px; object-fit: cover" src="{{ asset('storage/' . $product->gambar) }}">
                        <div class="card-body">
                            <div class="card-title">{{ $product->nama_produk }}</div>
                            <div class="card-text">
                                <p>{{ $product->deskripsi }}</p>
                                <div class="d-flex justify-content-between">
                                    <p class="text-text">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                                    <p>Rate {{ $product->rate }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
