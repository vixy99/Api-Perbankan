<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiTransfer;
use App\Models\RekeningAdmin;
use Carbon\Carbon;

class TransaksiTransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function transfer(Request $request) {

        $cek_transaksi = TransaksiTransfer::whereDate('created_at',Carbon::today())->orderBy('created_at', 'DESC')->first();
        $rekening_admin = RekeningAdmin::where('nama_bank',$request->bank_pengirim)->first()->nomor_rekening;
        $expired_transfer = Carbon::now()->add(2, 'day');

        $data = new TransaksiTransfer;
        $data->nilai_transfer = $request->nilai_transfer;
        $data->kode_unik = mt_rand(100,999);
        $data->biaya_admin = 0;
        $data->total_transfer = $data->nilai_transfer+$data->kode_unik+$data->biaya_admin;
        $data->bank_tujuan = $request->bank_tujuan;
        $data->rekening_tujuan = $request->rekening_tujuan;
        $data->atasnama_tujuan = $request->atasnama_tujuan;
        $data->bank_perantara = $request->bank_pengirim;
        $data->rekening_perantara = $rekening_admin;
        $data->berlaku_hingga = $expired_transfer;
        if($cek_transaksi == null){
            $counter = '00001';
            $data->id_transaksi = 'TF'.date('ymd').$counter;
            $data->save();
            
            return response()->json([
                "id_transaksi" => $data->id_transaksi,
                "nilai_transfer" => $data->nilai_transfer,
                "kode_unik" => $data->kode_unik,
                "biaya_admin" => $data->biaya_admin,
                "total_transfer" => $data->total_transfer,
                "bank_perantara" => $data->bank_perantara,
                "rekening_perantara" => $data->rekening_perantara,
                "berlaku_hingga" => $data->berlaku_hingga,
            ]);
        }

        $last_number = sprintf("%'.05d",intval(substr($cek_transaksi->id_transaksi,-5))+1);
        $data->id_transaksi = 'TF'.date('ymd').$last_number;
        $data->save();

        return response()->json([
            "id_transaksi" => $data->id_transaksi,
            "nilai_transfer" => $data->nilai_transfer,
            "kode_unik" => $data->kode_unik,
            "biaya_admin" => $data->biaya_admin,
            "total_transfer" => $data->total_transfer,
            "bank_perantara" => $data->bank_perantara,
            "rekening_perantara" => $data->rekening_perantara,
            "berlaku_hingga" => $data->berlaku_hingga,
        ]);
    }
}
