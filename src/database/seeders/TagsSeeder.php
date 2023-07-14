<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Packages\Infrastructure\Factories\TagMockFactory;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagMockFactory::createDefaultTags();
    }
}
