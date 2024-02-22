<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    {{-- digunakan untuk menampilkan alert --}}
    @if (session('success'))
        <div id="alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- //memanggil fungsi javascript --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- membuat fungsi durasi alert tertampilkan hanya 5detik --}}
    <script>
        $(document).ready(function() {
            // Menutup pesan alert setelah 5 detik
            setTimeout(function() {
                $('#alert').fadeOut('slow');
            }, 5000); // Waktu dalam milidetik (5 detik)
        });
    </script>

    <div class="mt-4 ms-5">
        <h1>Halo Ini Ani</h1>
        <p>sekarang kita akan mencoba membuat tampilan form input</p>
        
        <div class="row">
            <div class="col-md-3">
                <h2 class="mb-4">Form Input</h2>
                <form action="/aksi-tambah" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_produk"
                            placeholder="Masukkan nama Barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_barang" class="form-label">Masukan Harga Barang</label>
                        <input type="number" class="form-control" id="harga_barang" name="harga_produk"
                            placeholder="Masukkan Harga barang" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Masukan Gambar Barang</label>
                        <input type="file" class="form-control" id="gambar" name="gambar"
                            placeholder="Masukkan Gambar barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok_barang" class="form-label">Masukan stok barang</label>
                        <input type="number" class="form-control" id="stok_barang" name="stok"
                            placeholder="Masukkan Stok Barang" min="0" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
