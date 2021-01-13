<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->trash === 'true') {
            $barangs = Barang::onlyTrashed()->get();
        } else {
            $barangs = Barang::all();
        }

        $categories = Category::all();
        return view('barang.index', compact('barangs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$categories = Category::all();
        return view('barang.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required'
        ]);

        $barang = Barang::create($request->all());
        
        return redirect()->route('barang.index')->with(['message' => 'Berhasil Menambah Data!', 'type' => 'success', 'title' => 'Berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return response()->json($barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request, [
		'category_id' => 'required',
		'name' => 'required'
	]);

	$barang->update($request->all());

	return redirect()->back()->with('message', 'Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

	return redirect()->back()->with(['message' => 'Berhasil Dihapus!', 'type' => 'success', 'title' => 'Berhasil']);;
    }

    public function restore($barang)
    {
        Barang::withTrashed()->find($barang)->restore();

        return redirect()->back()->with(['message' => 'Berhasil Di-restore!', 'type' => 'success', 'title' => 'Berhasil']);
    }

    public function forceDelete($barang)
    {
        Barang::withTrashed()->find($barang)->forceDelete();

        return redirect()->back()->with(['message' => 'Berhasil Dihapus permanen!', 'type' => 'success', 'title' => 'Berhasil']);
    }
}
