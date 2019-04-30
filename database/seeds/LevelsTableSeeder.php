<?php

use Illuminate\Database\Seeder;

use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Level::class, 1)->create([
            'name' => 'Beginner',
            'slug' => 'beginner'
        ]);
        factory(Level::class, 1)->create([
            'name' => 'Intermediate',
            'slug' => 'intermediate'
        ]);
        factory(Level::class, 1)->create([
            'name' => 'Advanced',
            'slug' => 'advanced'
        ]);
    }
}
