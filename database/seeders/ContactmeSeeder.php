<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactmeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contactmes')->insert([
            [
                'status' => 1,
                'name_ar' => 'أحمد السوري',
                'name_en' => 'Ahmed Al-Souri',
                'email' => 'ahmed.bee@example.com',
                'phone' => '+963944123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 1,
                'name_ar' => 'سامر العلي',
                'name_en' => 'Samer Al-Ali',
                'email' => 'samer.apiary@example.com',
                'phone' => '+963933234567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 1,
                'name_ar' => 'محمود النحال',
                'name_en' => 'Mahmoud Al-Nahal',
                'email' => 'mahmoud.honey@example.com',
                'phone' => '+963955345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 1,
                'name_ar' => 'خالد الشيخ',
                'name_en' => 'Khaled Al-Sheikh',
                'email' => 'khaled.bees@example.com',
                'phone' => '+963988456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}