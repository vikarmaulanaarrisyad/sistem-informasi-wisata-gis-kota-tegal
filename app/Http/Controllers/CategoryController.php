<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            ->addColumn('aksi', function ($category) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('category.show', $category->id) . '`)" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button onclick="deleteData(`' . route('category.destroy', $category->id) . '`, `' . $category->name  . '`)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </div>
                ';
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

        return response()->json(['data' => $category, 'message' => 'Data ' . $category->name . ' berhasil tersimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json(['data' => $category]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
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

        $data = $request->except('image');

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $data['image'] = upload('category', $request->file('image'), 'category');
        }

        $category->update($data);

        return response()->json(['data' => $data, 'message' => 'Data ' . $request->name . ' berhasil tersimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if (Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        return response()->json(['message' => 'Data ' . $category->name . ' berhasil dihapus.']);
    }
}
