<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;
use Carbon\Carbon;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'BCA', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()],
            ['name' => 'Mandiri', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()],
            ['name' => 'BNI', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()],
            ['name' => 'BRI', 'created_at'=> Carbon::now(), 'updated_at'=> Carbon::now()],
        ];
        Bank::insert($data);
    }
}

