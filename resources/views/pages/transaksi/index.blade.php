@extends('layouts.app')

@section('title', 'Kelola Voucher')
@section('desc', ' Dihalaman ini anda bisa kelola voucher. ')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>List Voucher</h4>
        <div class="card-header-action">
            <a href="{{ route('voucher.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Tambah
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped w-100" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bukti Pembayaran</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Metode Pembayaran</th>
                        <th>Voucher</th>
                        <th>Berat Laundry</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Selesai</th>
                        <th>Poin Masuk</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        var datatable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: "{!! url()->current() !!}"
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'ALL']
            ],
            responsive: true,
            order: [
                [0, 'desc'],
            ],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'bukti_pembayaran', name: 'bukti_pembayaran'},
                {data: 'id_user', name: 'id_user'},
                {data: 'id_product', name: 'id_product'},
                {data: 'id_metode', name: 'id_metode'},
                {data: 'id_user_voucher', name: 'id_user_voucher'},
                {data: 'berat_laundry', name: 'berat_laundry'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'tanggal_selesai', name: 'tanggal_selesai'},
                {data: 'poin_masuk', name: 'poin_masuk'},
                {data: 'total_harga', name: 'total_harga'},
                {data: 'status', name: 'status'},
                {data: 'aksi', name: 'aksi'},
            ],
            columnDefs: [{
                "targets": 1,
                "render": function(data, type, row, meta) {
                    let img = `assets/img/avatar/avatar-1.png`;
                    if(data) {
                        img = `storage/${data}`;
                    }

                    return `<img alt="avatar" src="{{ asset('/') }}${img}" class="rounded-circle" width="35">`;
                }
            },{
                "targets": -1,
                "render": function(data, type, row, meta) {
                    return `
                        <form action="{{ url('/transaksi') }}/${row.id}" method="POST" class="d-flex">
                            @method('DELETE')
                            @csrf
                            <a
                                href="{{ url('/transaksi') }}/${row.id}/edit"
                                class="btn btn-sm btn-warning mr-2"
                            >
                                Edit
                            </a>
                            <button
                                type="submit"
                                class="btn-delete btn btn-sm btn-danger"
                            >
                                Delete
                            </button>
                        </form>
                    `;
                }
            },{
                "targets": -2,
                "render": function(data, type, row, meta) {
                    if(data){
                        return `<div class="badge badge-success">verifikasi</div>`;
                    } else {
                        return `<div class="badge badge-danger">Belum verifikasi</div>`;
                    }
                }
            }],
            rowId: function(a) {
                return a;
            },
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            },
        });
    });
</script>
@endpush()
