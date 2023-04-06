<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('place.index', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     */
    public function data(Request $request)
    {
        $places = Place::with('category')->get();

        return datatables($places)
            ->addIndexColumn()
            ->addColumn('category', function ($places) {
                return $places->category->name;
            })
            ->addColumn('aksi', function ($places) {
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'categories' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048|min:100',
        ]);

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

        $place = new Place;
        $place->name = $request->name;
        $place->slug = Str::slug($request->name);
        $place->category_id = $request->categories;
        $place->description = $request->description;
        $place->location = $request->location;
        $place->latitude = substr($request->location, 0, strpos($request->location, ','));
        $place->longitude = explode(",", $request->location)[1];
        $place->price = 0;
        $place->open = 'Senin-Minggu';
        $place->close = 'Senin-Minggu';
        $place->image = upload('place', $fileImage, 'place');
        $place->save();

        return response()->json(['data' => $place, 'message' => 'Data ' . $place->name . ' berhasil tersimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
