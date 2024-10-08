@extends('layouts.client')


@section('content')
    <section class="mt-5">
        <div class="row my-3" style="font-size: 16px">
            <span class="bg-text py-2 px-3" style="border-radius: 200px; color: white; font-weight: 600">
                Poin anda : <span style="color: black">{{ $user_poin->total_poin }}</span>
            </span>
        </div>
        <div class="row d-flex justify-content-between">
            @foreach ($vouchers as $voucher)
                <div class="card p-2">
                    <div class="row no-gutters">
                        <div class="col-md-12" style="height: 200px;">
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="card-img" alt="Card image cap"
                                style="object-fit: cover; object-position: center; height: 100%;">
                        </div>
                        <div class="col-md-12 py-2">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $voucher->nama_voucher }}</h5>
                                <p class="card-text">Potongan {{ $voucher->total_diskon * 100 }}%</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="card-text"><small class="text-muted">Poin Diperlukan :
                                        {{ $voucher->poin_diperlukan }} Poin</small></p>
                                <form action="{{ route('tukar_voucher') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
                                    <button type="submit" class="btn btn-primary" style="height: 35px">
                                        <i class="fa fa-plus"></i>
                                        Tukar
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
