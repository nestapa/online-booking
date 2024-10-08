<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::get();
            return DataTables::of($query)->make();
        }

        return view('pages.products.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'rate' => 'required',
            'jangka_waktu' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'rate' => $request->rate,
            'jangka_waktu' => $request->jangka_waktu,
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar', 'public');
        }

        Product::create($data);

        return redirect('products')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::findOrFail($id);

        return view('pages.products.edit', [
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = [
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'rate' => $request->rate,
            'jangka_waktu' => $request->jangka_waktu,
        ];

        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $path = "gambar/";
            $oldfile = $path . basename($product->gambar);
            Storage::disk('public')->delete($oldfile);
            $data['gambar'] = Storage::disk('public')->put($path, $request->file('gambar'));
        }

        $product->update($data);

        return redirect('products')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
