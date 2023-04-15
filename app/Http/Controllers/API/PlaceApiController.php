<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceApiController extends Controller
{
    public function index()
    {
        $result = Place::all();
        foreach ($result as $key => $value) {
            # code...
            $value->image = Storage::url($value->image);
        }
        return response()->json($result);
    }

    public function getPlaceByCategory(Request $request, $id)
    {
        $place = Place::where('category_id', $id)->get();
        foreach ($place as $key => $value) {
            # code...
            $value->image = Storage::url($value->image);
        }
        return response()->json(['result' => $place]);
    }
}
