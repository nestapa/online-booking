@extends('layouts.app')

@section('title', 'Dashboard')
@section('desc', 'Halaman Dashboard. ')

@section('content')
{{--  dashboard superadmin --}}
{{--  @can('superadmin')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total User</h4>
                </div>
                <div class="card-body">
                    {{ App\Models\User::whereNot('role','admin')->count() }}
</div>
</div>
</div>
</div>
</div>
@endcan --}}
{{--  dashboard admin   --}}
@can('admin')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total User</h4>
                </div>
                <div class="card-body">
                    {{ App\Models\User::whereNot('role','admin')->count() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
{{--  dashboard user  --}}
@can('user')
//
@endcan
@endsection