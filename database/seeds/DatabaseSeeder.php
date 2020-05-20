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
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class,1)->create();
        factory(App\supplier::class,10)->create();
        factory(App\category::class,10)->create();
        factory(App\product::class,10)->create();
        factory(App\role::class,1)->create();
        factory(App\Client::class,5)->create();
        factory(App\Nhasanxuat::class,10)->create();
    }
}
