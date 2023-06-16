<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = new Tag();

        $tag->create(['id' => '1',  'tag_name' => 'テクノロジー']);
        $tag->create(['id' => '2',  'tag_name' => 'モバイル']);
        $tag->create(['id' => '3',  'tag_name' => 'アプリ']);
        $tag->create(['id' => '4',  'tag_name' => 'エンタメ']);
        $tag->create(['id' => '5',  'tag_name' => 'ビューティー']);
        $tag->create(['id' => '6',  'tag_name' => 'ファッション']);
        $tag->create(['id' => '7',  'tag_name' => 'ライフスタイル']);
        $tag->create(['id' => '8',  'tag_name' => 'ビジネス']);
        $tag->create(['id' => '9',  'tag_name' => 'グルメ']);
        $tag->create(['id' => '10', 'tag_name' => 'スポーツ']);
    }
}
