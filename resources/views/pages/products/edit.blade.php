@extends('layouts.app')

@section('title', 'Edit Products')
@section('desc', ' Dihalaman ini anda bisa edit products. ')

@section('content')
<form action="{{ route('products.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Products</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Product</label>
                        <div class="col-sm-9">
                            <input value="{{ old('nama_produk', $item->nama_produk) }}" type="text"
                                class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" id="nama_produk"
                                placeholder="Nama Product">
                            @error('nama_produk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      name="deskripsi" id="deskripsi"
                                      placeholder="Deskripsi">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input value="{{ old('harga', $item->harga) }}" type="text"
                                class="form-control @error('harga') is-invalid @enderror" name="harga"
                                id="harga" placeholder="Harga">
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rate" class="col-sm-3 col-form-label">Rate</label>
                        <div class="col-sm-9">
                            <input value="{{ old('rate', $item->rate) }}" type="text"
                                class="form-control @error('rate') is-invalid @enderror" name="rate"
                                id="rate" placeholder="Rate">
                            @error('rate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jangka_waktu" class="col-sm-3 col-form-label">Jangka Waktu</label>
                        <div class="col-sm-9">
                            <input value="{{ old('jangka_waktu', $item->jangka_waktu) }}" type="text"
                                class="form-control @error('jangka_waktu') is-invalid @enderror" name="jangka_waktu"
                                id="jangka_waktu" placeholder="Jangka waktu">
                            @error('jangka_waktu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Gambar</h4>
                </div>
                <div class="card-body">
                    @if($item->gambar)
                    <img alt="gambar" src="{{ asset('storage/' . $item->gambar) }}"
                        class="rounded-circle w-100 mb-3">
                    @else
                    <img alt="gambar" src="{{ asset('/assets/img/avatar/avatar-1.png') }}"
                        class="rounded-circle w-100 mb-3">
                    @endif
                    <div class="clearfix"></div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                        <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
