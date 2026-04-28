<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name'       => 'Super Admin',
            'email'      => 'superadmin@inventaris.com',
            'password'   => Hash::make('SuperAdmin@123'),
            'role'       => 'super_admin',
            'is_active'  => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('lokasi')->insert([
            ['nama' => 'Lab Komputer 1',   'jenis' => 'lab',     'keterangan' => 'Lantai 1, Gedung A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Lab Komputer 2',   'jenis' => 'lab',     'keterangan' => 'Lantai 2, Gedung A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Ruang Dosen',      'jenis' => 'ruangan', 'keterangan' => 'Lantai 3, Gedung B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Ruang Kelas 101',  'jenis' => 'ruangan', 'keterangan' => 'Lantai 1, Gedung B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Ruang Kelas 102',  'jenis' => 'ruangan', 'keterangan' => 'Lantai 1, Gedung B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Gudang Peralatan', 'jenis' => 'gudang',  'keterangan' => 'Basement, Gedung A', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}