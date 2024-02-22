<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Meta tag CSRF token -->
    <title>Detail Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS untuk styling tambahan */
        .product-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $barang->gambar) }}" class="card-img-top" width="60px" height="350px">
            </div>
            <div class="col-md-6">
                <h2>Detail Barang</h2>
                <p>{{ $barang->nama_produk }}</p>
                <p>Rp {{ $barang->harga_produk }}</p>

                {{-- sini, ini tuh gabisa jadi 0 lagi karna kamu ambil dari nilai stok yang sekarang --}}
                {{-- maksudnya biar sesuaiin ama database gituu loh stoknya bukan 0 --}}

                {{-- berarti nanti ketika masukin data itu nggak langsung 0 gitu yahh  --}}
                {{-- gini ay,, kan ini ada bagian nampilan stok dari barang yang ambil dari database, nah
                ketika di tambahkna kekeranjang itu langsung otomatis terupdate
                bisa nggnk
                sampai sini paham nggk maksudku? --}}
                <p>STOK : {{ $barang->stok }}
                {{-- <p /p> --}}
                <div class="form-group">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" id="quantity" class="form-control" min="" name="stok">
                </div>
                <button class="btn btn-primary" id="addToCartBtn">Tambah ke Keranjang</button>
                <p id="cartMessage"></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('addToCartBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah perilaku bawaan tombol submit

            var inputQty = document.getElementById('quantity');



            var quantity = inputQty.value;
            console.log("Jumlah yang diambil:",
                quantity); // Mencetak nilai variabel quantity untuk memeriksa apakah diambil dengan benar

            // Mendapatkan token CSRF dari meta tag dalam HTML
            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            // Kirim permintaan AJAX dengan metode POST dan sertakan token CSRF
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/add-to-cart', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            // xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken); // Sertakan token CSRF dalam header permintaan
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        var cartMessage = document.getElementById('cartMessage');
                        cartMessage.textContent = response.message;

                        // set nilai input qty menjadi 0
                        inputQty.value = 0;

                        // hilangkan pesan cart setelah 3 detik
                        setInterval(() => {
                            cartMessage.textContent.textContent = ""
                        }, 3000);

                        // refresh halamannya
                        location.reload();

                    } else {
                        console.error(xhr.responseText);
                        console.error('Permintaan gagal:', xhr.status, xhr.responseText);
                    }
                }
            };
            // jadi disini kamu harus kirim quantity sama id produk
            xhr.send(JSON.stringify({
                quantity: quantity,
                id_produk: "{{ $barang->id_produk }}"
            }));
        });
    </script>

</body>

</html>
