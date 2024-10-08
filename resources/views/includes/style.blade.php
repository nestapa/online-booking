<!-- General CSS Files -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.cs') }}s">

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/components.css') }}">

<!-- Custom CSS -->
<style type="text/css">
    :root {
        /* Colors */
        --colors: #000;
        --shadow: #eee;
        --text: #ccff33;
    }

    .text-text {
        color: var(--text) !important;
    }

    .bg-text {
        background-color: var(--text);
    }

    a:hover {
        color: var(--text);
        text-decoration: underline;
    }

    .navbar .dropdown-item.has-icon i {
        line-height: inherit;
    }

    .table td,
    .table th {
        vertical-align: middle !important;
    }

    img[alt="avatar"] {
        aspect-ratio: 1/1;
        object-fit: cover;
    }

    img.icon {
        width: 250px;
        height: 200px;
    }
</style>
