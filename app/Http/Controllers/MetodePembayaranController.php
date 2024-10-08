<?php

namespace App\Http\Controllers;

use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MetodePembayaran::get();
            return DataTables::of($query)->make();
        }

        return view('pages.metode_pembayaran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.metode_pembayaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_metode' => 'required',
            'nomer' => 'required',
        ]);

        MetodePembayaran::create($request->all());

        return redirect('metode')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(MetodePembayaran $metodePembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = MetodePembayaran::findOrFail($id);

        return view('pages.metode_pembayaran.edit', [
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $metodePembayaran = MetodePembayaran::find($id);

        $request->validate([
            'nama_metode' => 'required',
            'nomer' => 'required',
        ]);

        $metodePembayaran->update($request->all());

        return redirect('metode')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $metode = MetodePembayaran::findOrFail($id);
        $metode->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
