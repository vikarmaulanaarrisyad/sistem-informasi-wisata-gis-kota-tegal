<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryApiController extends Controller
{
    public function index()
    {
        $data = Category::all();
        foreach ($data as $key => $value) {
            # code...
            $value->image = Storage::url($value->image);
        }

        return response()->json(['result' => $data]);
    }
}
