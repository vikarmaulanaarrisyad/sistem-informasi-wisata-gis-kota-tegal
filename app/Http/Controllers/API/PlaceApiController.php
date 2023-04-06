<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceApiController extends Controller
{
    public function getPlaceByCategory(Request $request, $id)
    {
        $place = Place::findOrfail($id);

        return response()->json(['result' => $place]);
    }
}
