<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Magie',
            'Spade',
            'Spadoni',
            'Armi ad asta',
            'Bastoni',
            'Arco'
        ];
       
        foreach($categories as $category_title){
           $new_category = new Category();
           $new_category->name = $category_title;
           $new_category->slug = Str::slug($category_title, '-');
           $new_category->save();
        }
    }
}
