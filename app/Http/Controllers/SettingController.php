<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function data(Request $request)
    {
        $tentang = Tentang::all();

        return datatables($tentang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($tentang) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('setting.show', $tentang->id) . '`)" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button onclick="deleteData(`' . route('setting.destroy', $tentang->id) . '`, `' . $tentang->name . '`)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>

                </div>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting.index');
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
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Tidak dapat menyimpan data.'], 422);
        }

        $tentang = new Tentang;
        $tentang->title = $request->title;
        $tentang->description = $request->description;
        $tentang->save();

        return response()->json(['data' => $tentang, 'message' => 'Data ' . $tentang->name . ' berhasil tersimpan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tentang = Tentang::findOrfail($id);
        return response()->json(['data' => $tentang]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Tidak dapat menyimpan data.'], 422);
        }

        $tentang = Tentang::findOrfail($id);
        $tentang->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['data' => $tentang, 'message' => 'Data ' . $tentang->name . ' berhasil tersimpan.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tentang = Tentang::findOrfail($id);

        $tentang->delete();

        return response()->json(['data' => $tentang, 'message' => 'Data ' . $tentang->name . ' berhasil dihapus.']);
    }
}
