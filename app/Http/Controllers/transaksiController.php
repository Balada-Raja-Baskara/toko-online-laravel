<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class transaksiController extends Controller
{
    public function show() {
        $data = DB::table('transaksi')
            ->join('customers', 'customers.id_pelanggan', '=', 'transaksi.id_pelanggan')
            ->join('petugas', 'petugas.id_petugas', '=', 'transaksi.id_petugas')
            ->select('transaksi.id_transaksi', 'transaksi.id_petugas', 'transaksi.id_pelanggan', 'transaksi.tgl_transaksi')
            ->get();
        return Response()->json($data);
    }

    public function detail($id) {
        if (Transaksi::where('id_pelanggan',$id)->exists()) {
            $data_trs = transaksi::join('customers', 'customers.id_pelanggan', 'transaksi.id_pelanggan')->where('transaksi.id_pelanggan','=',$id)->get();

            return Response()->json($data_trs);
        } else {
            return Response()->json(['message' => 'tidak ditemukan']);
        }
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'id_petugas' => 'required',
                'id_pelanggan' => 'required'
            ]
        );
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $simpan = Transaksi::create([
            'id_petugas' => $request->id_petugas,
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_transaksi' => date('Y-m-d')
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
                'id_petugas' => 'required',
                'id_pelanggan' => 'required'
            ]
        );
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
        $ubah = Transaksi::where('id_transaksi',$id)->update([
            'id_petugas' => $request->id_petugas,
            'id_pelanggan' => $request->id_pelanggan,
            'tgl_transaksi' => date('Y-m-d')
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
        $hapus = transaksi::where('id_transaksi', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}
