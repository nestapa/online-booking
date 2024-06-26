@extends('layouts.app')

@section('title', 'Dashboard')
@section('desc', 'Halaman Dashboard. ')

@section('content')
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
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Penyakit</h4>
                </div>
                <div class="card-body">
                    {{ App\Models\Penyakit::count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Gejala</h4>
                </div>
                <div class="card-body">
                    {{ App\Models\Gejala::count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-cubes"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Rule</h4>
                </div>
                <div class="card-body">
                    {{ App\Models\Rule::count() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@can('user')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Diagnosa Gejala</h4>
                </div>
                <div class="card-body">
                    {{ App\Models\PenyakitKeGejala::where('user_id',auth()->user()->id)->count() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-arrow-right"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Diagnosa Penyakit</h4>
                </div>
                <div class="card-body">
                    {{ App\Models\gejalaKePenyakit::where('user_id',auth()->user()->id)->count() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection