<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_master_cashflow')->insert([
            'nama' => 'PEMASUKAN',
            'keterangan' => 'FROM RENT CAR',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
