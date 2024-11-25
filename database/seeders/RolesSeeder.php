<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Membuat role admin dan siswa
        Role::create(['name' => 'admin-industri']);
        Role::create(['name' => 'admin-sekolah']);
        Role::create(['name' => 'siswa']);
    }
}
