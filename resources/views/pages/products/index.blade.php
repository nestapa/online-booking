@extends('layouts.app')

@section('title', 'Kelola Products')
@section('desc', ' Dihalaman ini anda bisa kelola products. ')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>List Products</h4>
        <div class="card-header-action">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
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
                        <th>Gambar</th>
                        <th>Nama Product</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Rate</th>
                        <th>Jangka Waktu</th>
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
                {data: 'gambar', name: 'gambar'},
                {data: 'nama_produk', name: 'nama_produk'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'harga', name: 'harga'},
                {data: 'rate', name: 'rate'},
                {data: 'jangka_waktu', name: 'jangka_waktu'},
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
                        <form action="{{ url('/products') }}/${row.id}" method="POST" class="d-flex">
                            @method('DELETE')
                            @csrf
                            <a
                                href="{{ url('/products') }}/${row.id}/edit"
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
