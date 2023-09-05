<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<style>
    td.badge-danger,
    td.badge-success {
        text-transform: capitalize;
    }

    .dataTables_filter input {
        appearance: none;
        border: none;
        outline: none;
        border-bottom: .2em solid blue;
        background: rgba(blue, .2);
        border-radius: .2em .2em 0 0;
        padding: .4em;
        color: blue;
    }

    .dataTables_length select {
        appearance: none;
        border: none;
        outline: none;
        border-bottom: .2em solid blue;
        background: rgba(blue, .2);
        border-radius: .2em .2em 0 0;
        padding: .4em;
        color: blue;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Pendaftaran TKI Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dash.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Verifikasi Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tambah_user.php">Tambah Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" onclick="return yakin()">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function yakin() {
            return confirm("Apa Anda Yakin Ingin Keluar?");
        }
</script>