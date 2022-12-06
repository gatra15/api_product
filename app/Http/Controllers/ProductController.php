<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {

        if(request('name'))
        {
            $data = DB::table('mproducts')->where('name', 'LIKE', '%'.strtolower(request('name')).'%')->get();
        } else {
            $data = DB::table('mproducts')->get();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Berhasil',
            'data' => $data
        ]);
    }

    public function brand($brand)
    {
        if(request('name'))
        {
            $data = DB::table('mproducts')->where('name', 'LIKE', '%'.strtolower(request('name')).'%')->get();
        } else {
            $data = DB::table('mproducts')->where('brand', strtolower($brand))->get();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Berhasil',
            'data' => $data
        ]);
    }

    public function store()
    {
        $postdata = request()->all();
        $postdata['created_at'] = now();

        try {
            $data = DB::table('mproducts')->insert($postdata);

            return response()->json([
                'status' => 1,
                'message' => 'Berhasil'
            ]);
        } catch (\Throwable $e)
        {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal menambahkan data.',
                'error_message' => $e->getMessage()
            ]);
        }
    }

    public function update($id)
    {
        $postdata = request()->all();
        $postdata['updated_at'] = now();

        try {
            $data = DB::table('mproducts')->where('id', $id)->update($postdata);

            return response()->json([
                'status' => 1,
                'message' => 'Berhasil'
            ]);
        } catch (\Throwable $e)
        {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal mengubah data.',
                'error_message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $data = DB::table('mproducts')->where('id', $id)->delete();

        if(!$data)
        {
            return response()->json([
                'status' => 0,
                'message' => 'Gagal menghapus data.'
            ]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Berhasil menghapus data.'
        ]);

    }


}
