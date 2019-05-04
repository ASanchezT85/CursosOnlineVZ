<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'                  => 'PHP',
            'slug'                  => 'php',
            'picture'               => 'php.png'
        ]);
        Category::create([
            'name'                  => 'Laravel',
            'slug'                  => 'laravel',
            'picture'               => 'laravel.png'
        ]);
        Category::create([
            'name'                  => 'JavaScript',
            'slug'                  => 'javascript',
            'picture'               => 'javascript.png'
        ]);
        Category::create([
            'name'                  => 'MySQL',
            'slug'                  => 'mysql',
            'picture'               => 'mysql.png'
        ]);
        Category::create([
            'name'                  => 'Angular',
            'slug'                  => 'angular',
            'picture'               => 'angular.png'
        ]);
        Category::create([
            'name'                  => 'JQuery',
            'slug'                  => 'jquery',
            'picture'               => 'jquery.png'
        ]);
    }
}
