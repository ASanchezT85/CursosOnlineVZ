<?php

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //System administrator
        Role::create([
            'name'          => 'Administrator',
            'slug'          => 'administrator',
            'description'   => 'System administrator',
            'special'       => 'all-access',
        ]);

        //System administrator
        Role::create([
            'name'          => 'Teacher',
            'slug'          => 'teacher',
            'description'   => 'Professor of the platform',
        ])->permissions()->sync(
            ['7', '8', '13', '15', '16', '17', '18', '19', '20']
        );

        //System administrator
        Role::create([
            'name'          => 'Student',
            'slug'          => 'student',
            'description'   => 'Student of the platform',
        ])->permissions()->sync(
            ['14']
        );
        
    }
}
