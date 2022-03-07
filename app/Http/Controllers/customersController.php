<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customers;
use Illuminate\Support\Facades\Validator;

class customersController extends Controller
{
    public function show()
    {
        return customers::all();   
    }
    public function detail($id)
    {
        if(customers::where('id_pelanggan', $id)->exists()) {
        $data = DB::table('customers')->where('customers.id_pelanggan','=',$id)->get();
        }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'nama_pelanggan' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
                'username' => 'required',
                'password' => 'required'
            ]
        );
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $simpan = customers::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => $request->password
        ]);
        if($simpan)
        {
            return Response()->json(['status' => 1]);
        }
        else
        {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id,Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'nama_pelanggan' => 'required',
                'alamat' => 'required',
                'telp' => 'required',
                'username' => 'required',
                'password' => 'required'
            ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $ubah = customers::where('id_pelanggan',$id)->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => $request->password
        ]);
        if($ubah)
        {
            return Response()->json(['status' => 1]);
        }
        else
        {
            return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id)
    {
        $hapus = customers::where('id_pelanggan', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}
