<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Ulasan::with('users')->get();
            return DataTables::of($query)
                ->addColumn("user_id", function ($row) {
                    return $row->users->name;
                })
                ->make();
        }

        return view('pages.ulasan.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.ulasan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'ulasan' => 'required',
            'balasan' => 'nullable',
        ]);

        $data = [
            'user_id' => $request->user_id,
            'ulasan' => $request->ulasan,
            'balasan' => $request->balasan,
        ];

        Ulasan::create($data);

        return redirect('ulasan')->with('toast', 'showToast("Data berhasil disimpan")');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ulasan $ulasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Ulasan::findOrFail($id);

        return view('pages.ulasan.edit', [
            'item'  =>  $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ulasan = Ulasan::findOrFail($id);

        $request->validate([
            'user_id' => 'required',
            'ulasan' => 'required',
            'balasan' => 'nullable',
        ]);

        $data = [
            'user_id' => $request->user_id,
            'ulasan' => $request->ulasan,
            'balasan' => $request->balasan,
        ];

        $ulasan->update($data);

        return redirect('ulasan')->with('toast', 'showToast("Data berhasil diupdate")');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->back()->with('toast', 'showToast("Data berhasil dihapus")');
    }
}
