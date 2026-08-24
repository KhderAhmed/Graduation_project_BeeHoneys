<?
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. التأكد من وجود الأقسام في جدول categories أولاً
        $cat1 = DB::table('categories')->where('id', 1)->first();
        if (!$cat1) {
            DB::table('categories')->insert([
                ['id' => 1, 'name_ar' => 'عسل طبيعي', 'name_en' => 'Natural Honey', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'name_ar' => 'منتجات الخلية', 'name_en' => 'Beehive Products', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // 2. إدراج المنتجات
        DB::table('products')->insert([
            [
                'title_ar' => 'عسل سدر ملكي فاخر',
                'title_en' => 'Royal Sidr Honey',
                'description_ar' => 'عسل سدر طبيعي 100% مستخرج من مناحلنا، يتميز بطعمه الغني وقيمته الغذائية العالية.',
                'description_en' => '100% pure natural Sidr honey harvested from our apiaries, rich in taste and nutrition.',
                'price' => 25.00,
                'status' => 1,
                'image' => 'products/sidr-honey.png',
                'catgory_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'عسل جبلي جاف',
                'title_en' => 'Raw Mountain Honey',
                'description_ar' => 'عسل أعشاب جبلية نقي مفيد جداً للمناعة والجهاز التنفسي.',
                'description_en' => 'Pure mountain wildflower honey, excellent for immunity and respiratory health.',
                'price' => 20.00,
                'status' => 1,
                'image' => 'products/mountain-honey.png',
                'catgory_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'عسل زهور الموالح (حمضيات)',
                'title_en' => 'Citrus Blossom Honey',
                'description_ar' => 'عسل خفيف ومثالي للأطفال، خالي من أي إضافات اصطناعية.',
                'description_en' => 'Light and refreshing citrus honey, perfect for children and daily use.',
                'price' => 15.00,
                'status' => 1,
                'image' => 'products/citrus-honey.png',
                'catgory_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'قرص شمع عسل طبيعي',
                'title_en' => 'Natural Honeycomb',
                'description_ar' => 'شمع عسل طبيعي طازج بجميع أنزيماته وفوائده الكاملة.',
                'description_en' => 'Fresh natural honeycomb packed with all its raw nutrients and enzymes.',
                'price' => 18.50,
                'status' => 1,
                'image' => 'products/wax.png',
                'catgory_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_ar' => 'صمغ النحل (البروبوليس) خام',
                'title_en' => 'Raw Bee Propolis',
                'description_ar' => 'عكبر نحل طبيعي عالي النقاوة يعتبر مضاد حيوي طبيعي قوي.',
                'description_en' => 'High-purity raw bee propolis, a powerful natural antioxidant.',
                'price' => 12.00,
                'status' => 1,
                'image' => 'products/propolis.png',
                'catgory_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}