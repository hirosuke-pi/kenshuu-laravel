<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Packages\Infrastructure\Factories\TagTestFactory;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagTestFactory::initializeTable();
    }
}
