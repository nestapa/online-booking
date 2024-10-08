@extends('layouts.app')

@section('title', 'Edit Ulasan')
@section('desc', ' Dihalaman ini anda bisa edit ulasan. ')

@section('content')
<form action="{{ route('ulasan.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Ulasan</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-3 col-form-label">User</label>
                        <div class="col-sm-9">
                            <select name="user_id" id="user_id"
                                class="form-control  @error('user_id') is-invalid @enderror">
                                <option value="">Pilih User</option>
                                @foreach (App\Models\User::whereNot('role','admin')->get() as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $item->user_id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ulasan" class="col-sm-3 col-form-label">Ulasan</label>
                        <div class="col-sm-9">
                            <input value="{{ old('ulasan', $item->ulasan) }}" type="text"
                                class="form-control @error('ulasan') is-invalid @enderror" name="ulasan" id="ulasan"
                                placeholder="Ulasan">
                            @error('ulasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="balasan" class="col-sm-3 col-form-label">Balasan</label>
                        <div class="col-sm-9">
                            <input value="{{ old('balasan', $item->balasan) }}" type="text"
                                class="form-control @error('balasan') is-invalid @enderror" name="balasan" id="balasan"
                                placeholder="Balasan">
                            @error('balasan')
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
    </div>
</form>
@endsection