<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi');
            $table->integer('nilai_transfer');
            $table->integer('kode_unik');
            $table->integer('biaya_admin');
            $table->integer('total_transfer');
            $table->string('bank_tujuan');
            $table->string('rekening_tujuan');
            $table->string('atasnama_tujuan');
            $table->string('bank_perantara');
            $table->string('rekening_perantara');
            $table->timestamp('berlaku_hingga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_transfers');
    }
}


