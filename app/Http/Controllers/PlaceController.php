<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                return '
                <div class="btn-group">
                    <a href="' . route('place.detail', $places->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> Detail</a>
                    <button onclick="editForm(`' . route('place.show', $places->id) . '`)" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button onclick="deleteData(`' . route('place.destroy', $places->id) . '`, `' . $places->name . '`)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>

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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'categories' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
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
        $place->open = $request->open;
        $place->close = $request->close;
        $place->image = upload('place', $fileImage, 'place');
        $place->district = $request->district;
        $place->village = $request->village;
        $place->address = $request->address;
        $place->phone = $request->phone;
        $place->website = $request->website;
        $place->save();

        return response()->json(['data' => $place, 'message' => 'Data ' . $place->name . ' berhasil tersimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        return response()->json(['data' => $place]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detail($id)
    {
        $place = Place::findOrfail($id);
        return view('place.detail', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'categories' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Tidak dapat menyimpan data.'], 422);
        }

        $data = $request->except('image');

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->categories,
            'description' => $request->description,
            'location' => $request->location,
            'latitude' => substr($request->location, 0, strpos($request->location, ',')),
            'longitude' => explode(",", $request->location)[1],
            'price' => 0,
            'open' => $request->open,
            'close' => $request->close,
            'image' => upload('place', $request->file('image'), 'place'),
            'district' => $request->district,
            'village' => $request->village,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
        ];

        $place->update($data);

        return response()->json(['data' => $place, 'message' => 'Data ' . $place->name . ' berhasil tersimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return response()->json(['data' => $place, 'message' => 'Data ' . $place->name . ' berhasil dihapus.']);
    }
}
