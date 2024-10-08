@extends('layouts.app')

@section('title', 'Buat Voucher')
@section('desc', ' Dihalaman ini anda bisa membuat voucher. ')

@section('content')
<form action="{{ route('voucher.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Voucher</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_voucher" class="col-sm-3 col-form-label">Nama Voucher</label>
                        <div class="col-sm-9">
                            <input value="{{ old('nama_voucher') }}" type="text"
                                class="form-control @error('nama_voucher') is-invalid @enderror" name="nama_voucher" id="nama_voucher"
                                placeholder="Nama Voucher">
                            @error('nama_voucher')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_diskon" class="col-sm-3 col-form-label">Total Diskon</label>
                        <div class="col-sm-9">
                            <input value="{{ old('total_diskon') }}" type="number" step="0.01"
                                class="form-control @error('total_diskon') is-invalid @enderror" name="total_diskon"
                                id="total_diskon" placeholder="Total Diskon">
                            @error('total_diskon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="poin_diperlukan" class="col-sm-3 col-form-label">Poin Diperlukan</label>
                        <div class="col-sm-9">
                            <input value="{{ old('poin_diperlukan') }}" type="text"
                                class="form-control @error('poin_diperlukan') is-invalid @enderror" name="poin_diperlukan"
                                id="poin_diperlukan" placeholder="Poin Diperlukan">
                            @error('poin_diperlukan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Gambar</h4>
                </div>
                <div class="card-body">
                    <img alt="avatar" src="{{ asset('/assets/img/avatar/avatar-1.png') }}"
                        class="rounded-circle w-100 mb-3">
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
