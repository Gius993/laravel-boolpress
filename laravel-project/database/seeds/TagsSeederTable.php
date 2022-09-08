<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;
class TagsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Arma ad una mano',
            'Arma pesante',
            'Arma magica',
            'Incantesimo',
            'Arma a distanza',
            'Armi ad asta'
        ];

        foreach ($tags as $tag){
            $new_tag = new Tag();
            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($new_tag->title, '-');
            $new_tag->save();
        }
    }
}
