<?php

use Illuminate\Database\Seeder;

use App\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Status::class, 1)->create([
            'name' => 'PUBLISHED',
            'slug' => 'published'
        ]);
       factory(Status::class, 1)->create([
            'name' => 'PENDING',
            'slug' => 'pending'
        ]); 
       factory(Status::class, 1)->create([
            'name' => 'REJECTED',
            'slug' => 'rejected'
        ]); 
    }
}
