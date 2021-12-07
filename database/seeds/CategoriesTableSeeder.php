<?php

use Illuminate\Database\Seeder;
use App\models\Category;
use App\models\MajorCategory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // major_kategoryのDBから情報を取る
        $major_categories = MajorCategory::pluck('name', 'id');

        $programming_categories = [
            'HTML/CSS' , 'javaScript' , 'PHP' , 'Ruby' , 'python' , 'java'
        ];

        $webmarketing_categories = [
            'ブロク' , 'SNS運用' , 'アフィリエイト' , 'SEO対策' , 'ライティング' , 'youtube'
        ];

        $language_categories = [
            '英語' , '中国語' , '韓国語' , 'スペイン語' , 'フランス語'
        ];

        foreach ( $major_categories as $major_category_id => $major_category_name)  {
            if ($major_category_name == 'プログラミング') {
                foreach( $programming_categories as $programming_category) {
                        Category :: create ([
                            'name' => $programming_category,
                            'description' => $programming_category,
                            'major_category_name' => $major_category_name,
                            'major_category_id' => $major_category_id
                        ]);
                }
            }

            if ($major_category_name == 'Webマーケティング') {
                foreach($webmarketing_categories as $webmarketing_category) {
                    Category :: create ([
                        'name' => $webmarketing_category,
                        'description' => $webmarketing_category,
                        'major_category_name' => $major_category_name,
                        'major_category_id' => $major_category_id
                    ]);
                }
            }

            if ($major_category_name == '語学') {
                foreach($language_categories as $language_category) {
                    Category :: create ([
                        'name' => $language_category,
                        'description' => $language_category,
                        'major_category_name' => $major_category_name,
                            'major_category_id' => $major_category_id
                    ]);
                }
            }
        }
    }
}
