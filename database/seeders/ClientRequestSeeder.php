<?php

namespace Database\Seeders;

use App\Models\ClientRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientRequest::factory()   // refers to postfactory.php class
        ->count(10)
        ->create();
    }
}
