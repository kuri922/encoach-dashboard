<?php

use Illuminate\Database\Seeder;
use App\models\MajorCategory;

class MajorCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_category_names = [
             'プログラミング', 'Webマーケティング', '語学'
            ];
            
        foreach ($major_category_names as $major_category_name) {
                MajorCategory::create([
                  'name' => $major_category_name,
                   ]);
        }
    }
}
