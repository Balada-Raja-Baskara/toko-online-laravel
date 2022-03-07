<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detail_transaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class detail_transaksiController extends Controller
{
    public function show() {
        $data = DB::table('detail_transaksi')
            ->join('transaksi', 'detail_transaksi.id_transaksi', '=', 'transaksi.id_transaksi')
            ->join('produk', 'detail_transaksi.id_produk', '=', 'produk.id_produk')
            ->select('detail_transaksi.id_transaksi', 'detail_transaksi.id_produk', 'detail_transaksi.qty','detail_transaksi.subtotal')
            ->get();
        return Response()->json($data);
    }

    public function detail($id) {
        if (detail_transaksi::where('id_pelanggan',$id)->exists()) {
            $data_trs = transaksi::join('customers', 'customers.id_pelanggan', 'transaksi.id_pelanggan')
                                    ->where('transaksi.id_pelanggan','=',$id)
                                    ->get();

            return Response()->json($data_trs);
        } else {
            return Response()->json(['message' => 'tidak ditemukan']);
        }
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'id_transaksi' => 'required',
            'id_produk' => 'required',
            'qty' => 'required'
        ]);

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        
        $id_produk = $request->id_produk;
        $qty = $request->qty;
        $harga = DB::table('produk')->where('id_produk', $id_produk)->value('harga');
        $subtotal = $harga * $qty;

        $simpan = detail_transaksi::create([
            'id_transaksi' => $request->id_transaksi,
            'id_produk' => $id_produk,
            'qty' => $qty,
            'subtotal' => $subtotal
        ]);

        if($simpan) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
    public function update($id,Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'id_transaksi' => 'required',
            'id_produk' => 'required',
            'qty' => 'required'
        ]);

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        
        $id_produk = $request->id_produk;
        $qty = $request->qty;
        $harga = DB::table('produk')->where('id_produk', $id_produk)->value('harga');
        $subtotal = $harga * $qty;

        $ubah = detail_transaksi::where('id_detail_transaksi',$id)->update([
            'id_transaksi' => $request->id_transaksi,
            'id_produk' => $id_produk,
            'qty' => $qty,
            'subtotal' => $subtotal
        ]);

        if($ubah) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
    public function destroy($id)
    {
        $hapus = detail_transaksi::where('id_detail_transaksi', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
}
