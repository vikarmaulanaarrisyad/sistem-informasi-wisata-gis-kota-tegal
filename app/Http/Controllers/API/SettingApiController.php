<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;

class SettingApiController extends Controller
{
    public function index()
    {
        $tentang = Tentang::all();

        return response()->json(['tentang' => $tentang]);
    }
}
