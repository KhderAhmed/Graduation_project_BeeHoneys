<?php

namespace Database\Seeders;

use App\Models\ClientRequest;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** php artisan db:seed --class=ProductSeeder
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClientRequestSeeder::class,  //define
        ]);

    }
}
