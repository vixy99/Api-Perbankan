<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RekeningAdmin;
use Carbon\Carbon;

class RekeningAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_bank' => 'BCA', 'nomor_rekening' => '1234567890', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()],
            ['nama_bank' => 'Mandiri', 'nomor_rekening' => '17835495873503985', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()],
            ['nama_bank' => 'BNI', 'nomor_rekening' => '6795874', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()],
            ['nama_bank' => 'BRI', 'nomor_rekening' => '0092457024857987245', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()]
        ];
        RekeningAdmin::insert($data);
    }
}
