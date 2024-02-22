<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang= Barang::all();
        $data =[
            'data'=>$barang, 
        ];
        return view('barang.list-barang',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $barang = Barang::find()->first();
       

        return view('barang.index');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Barang $barang)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
            'stok'=>'required|numeric',
        ]);
    
        $imageName = time() . '.' . $request->gambar->extension();
    
        // Simpan gambar ke direktori 'public/images'
        $request->gambar->move(public_path('images'), $imageName);
    
        // Buat data barang baru dengan menyertakan nama file gambar
        $barang->create([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'gambar' => $imageName, // Ubah $request->$imageName menjadi $imageName
            'stok'=>$request->stok,
        ]);
    
        // Redirect ke halaman yang sesuai
        return redirect('/form-barang')->with('success', 'Barang berhasil ditambahkan.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_produk)
{
    // Cari barang berdasarkan ID
    $barang = Barang::findOrFail($id_produk);

    // Kirim data barang ke tampilan
    return view('barang.detail', compact('barang'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1', // Pastikan kuantitas adalah bilangan bulat positif
        ]);
    
        // Ambil barang dari database berdasarkan id_produk
        // ini backendnya mintanya id_produk, tapi yang dikasih quantity

        // //nggk tau ay aku dari AI, tapi ini bukannya buat manggil barang dengan id yang tertera kan?
        // Barang::find($request->id_produk) query ini bakalan nyari data barang berdasarkan id barang
        // jadi karna primary key nya id_produk, find() ini dah otomatis mencari data berdaasarkan primary key yang sudah ditentukan di model
        $barang = Barang::find($request->id_produk);
    //terus gimana?
        // Periksa apakah barang ditemukan
        if (!$barang) {
            // error ini ada soale nggak nemuin data berdasarkan id_produk, sedangkan ini butuh id_produk
            return response()->json(['error' => 'Barang tidak ditemukan.'], 404);
        }
    
        // Perbarui stok barang
        // nah disini baru dia minta quantity, jadi intinnya id_produk sama quantity harus ad
        // kenapa nambah terus? karna ini stok yang sudah ada di databasenya kamu tambahin sama quantitiy yang di input dari form
    // mksudnya ketika udh ngisi kan otomatis inpunya langsung  kembali ke 0, nah aku mau jumlahnya juga langsung terbaru gitu
        //--------------------------------
        $barang->stok += $request->quantity;
        // --------------------------------
        $barang->save();
    
        return response()->json(['message' => 'Barang berhasil ditambahkan ke keranjang.']);
    }
    

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
