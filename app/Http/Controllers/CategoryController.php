<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index');
    }

    /**
     * Display a listing of the datatables yajra.
     */
    public function data()
    {
        $category = Category::all();

        return datatables($category)
            ->addIndexColumn()
            ->addColumn('aksi', function () {
                return '';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'required|mimes:png,jpg,jpeg|max:2048',
                'name' => 'required'
            ],
            [
                'image.required' => 'Gambar wajib diisi.',
                'image.mimes' => 'Gambar harus bertipe jpg, jpeg, png.',
                'image.max' => 'Gambar tidak boleh melebihi 2 MB.',
                'name.required' => 'Nama kategori wajib disi.'
            ]
        );


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Tidak dapat menyimpan data.'], 422);
        }

        if (!$request->hasFile('image')) {
            return response()->json(['message' => 'File tidak boleh kosong!.'], 422);
        }

        $fileImage = $request->file('image');

        if (!$fileImage->isValid()) {
            return response()->json(['message' => 'Upload file gagal!.'], 422);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->image = upload('category', $fileImage, 'category');
        $category->save();

        return response()->json(['data' => $category, 'message' => 'Data berhasil disimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
