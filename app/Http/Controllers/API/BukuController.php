<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Buku;

class BukuController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $DATA = Buku::all();
        return response()->json([
            'pesan' => 'Data Berhasil ditemukan',
            'data' => $DATA
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validasi = Validator::make($request->all(), [
            "judul_buku" => "required",
            "penulis_buku" => "required",
            "penerbit_buku" => "required",
            "tahun_terbit" => "required",
            "stok" => "required",

        ]);

        if ($validasi->passes()) {
            $data = Buku::create($request->all());

            return response()->json([
                'pesan' => 'Data Berhasil di Tambahkan',
                'data' => $data

            ], 200);
        }
        return response()->json([
            'pesan' => 'Data gagal disimpan',
            'data' => $validasi->errors()->all()
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Buku::where('id', $id)->first();
        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
        return response()->json([
            'pesan' => 'Data Berhasil ditemukan',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = Buku::where('id', $id)->first();
        if (!empty($data)) {
            //    return $data;
            $validasi = Validator::make($request->all(), [
                "judul_buku" => "required",
                "penulis_buku" => "required",
                "penerbit_buku" => "required",
                "tahun_terbit" => "required",
                "stok" => "required",

            ]);
            if ($validasi->passes()) {
                $data->update($request->all());

                return response()->json([
                    'pesan' => 'Data Berhasil di Update',
                    'data' => $data

                ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Data gagal di Update',
                    'data' => $validasi->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Tidak Ditemukan'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Buku::where('id', $id)->first();
        if (empty($data)) {
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
        $data->delete();
        return response()->json([
            'pesan' => 'Data Berhasil DiHapus',
            'data' => $data

        ], 200);
    }
}
