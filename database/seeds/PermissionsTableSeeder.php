<?php

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role
        Permission::create([
            'name'          => 'List Roles', 
            'slug'          => 'roles.index', 
            'description'   => 'List all system roles', 
            'category'      => 'Roles'
        ]);

        Permission::create([
            'name'          => 'See Role', 
            'slug'          => 'roles.show', 
            'description'   => 'Details of a system role', 
            'category'      => 'Roles'
        ]);

        Permission::create([
            'name'          => 'Create role', 
            'slug'          => 'roles.create', 
            'description'   => 'Create a role', 
            'category'      => 'Roles'
        ]);

        Permission::create([
            'name'          => 'Edit role', 
            'slug'          => 'roles.edit', 
            'description'   => 'Edit information and permissions of a role', 
            'category'      => 'Roles'
        ]);

        Permission::create([
            'name'          => 'Update Role', 
            'slug'          => 'roles.update', 
            'description'   => 'Edit information and permissions of a role', 
            'category'      => 'Roles'
        ]);

        Permission::create([
            'name'          => 'Remove Roles', 
            'slug'          => 'roles.destroy', 
            'description'   => 'Remove role from the system', 
            'category'      => 'Roles'
        ]);

        //User
        Permission::create([
            'name'          => 'List Users',
            'slug'          => 'users.index',
            'description'   => 'List all system users',
            'category'      => 'Users'
        ]);

        Permission::create([
            'name'          => 'See user',
            'slug'          => 'users.show',
            'description'   => 'Details of a system user',
            'category'      => 'Users'
        ]);

        Permission::create([
            'name'          => 'Edit user',
            'slug'          => 'users.edit',
            'description'   => 'Enter the user edit form',
            'category'      => 'Users'
        ]);

        Permission::create([
            'name'          => 'Update user',
            'slug'          => 'users.update',
            'description'   => 'Update user information',
            'category'      => 'Users'
        ]);

        Permission::create([
            'name'          => 'Remove Users',
            'slug'          => 'users.destroy',
            'description'   => 'Remove system users',
            'category'      => 'Users'
        ]);

        //Interface
        Permission::create([
            'name'          => 'Settings', 
            'slug'          => 'settings', 
            'description'   => 'System configurations', 
            'category'      => 'Views'
        ]);

        Permission::create([
            'name'          => 'Teacher', 
            'slug'          => 'teacher', 
            'description'   => 'Teachers section', 
            'category'      => 'Views'
        ]);

        Permission::create([
            'name'          => 'Students', 
            'slug'          => 'students', 
            'description'   => 'Students section', 
            'category'      => 'Views'
        ]);

        //Cursos
        Permission::create([
            'name'          => 'List courses', 
            'slug'          => 'courses.index', 
            'description'   => 'List all system courses', 
            'category'      => 'Courses'
        ]);

        Permission::create([
            'name'          => 'See course', 
            'slug'          => 'courses.show', 
            'description'   => 'Details of a system course', 
            'category'      => 'Courses'
        ]);

        Permission::create([
            'name'          => 'Create course', 
            'slug'          => 'courses.create', 
            'description'   => 'Create a course', 
            'category'      => 'Courses'
        ]);

        Permission::create([
            'name'          => 'Edit course', 
            'slug'          => 'courses.edit', 
            'description'   => 'Edit information and permissions of a course', 
            'category'      => 'Courses'
        ]);

        Permission::create([
            'name'          => 'Update course', 
            'slug'          => 'courses.update', 
            'description'   => 'Edit information and permissions of a course', 
            'category'      => 'Courses'
        ]);

        Permission::create([
            'name'          => 'Remove courses', 
            'slug'          => 'courses.destroy', 
            'description'   => 'Remove course from the system', 
            'category'      => 'courses'
        ]);

    }
}
