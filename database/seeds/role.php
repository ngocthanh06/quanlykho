<?php

use Illuminate\Database\Seeder;

class role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['name_role' => 'QLNS'],['name_role' => 'Nhân viên'],
        ];
        DB::table('role')->insert($data);
    }
}
