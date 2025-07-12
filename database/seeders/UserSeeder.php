<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_id' => Str::uuid(),
                'name' => 'Admin Simkos',
                'email' => 'admin@simkos.test',
                'no_ktp' => '3201010101010001',
                'npwp' => 123456789012000,
                'gender' => 'laki laki',
                'tgl_lahir' => '1990-01-01',
                'address' => 'Jl. Admin Raya No.1',
                'status' => 'belum menikah',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone_number' => '081234567890',
                'profile_picture' => null,
                'ktp_picture' => null,
                'ktp_picture_person' => null,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid(),
                'name' => 'Pemilik Kos',
                'email' => 'pemilik@simkos.test',
                'no_ktp' => '3201010101010002',
                'npwp' => 223456789012000,
                'gender' => 'perempuan',
                'tgl_lahir' => '1985-05-20',
                'address' => 'Jl. Kos Putri No.2',
                'status' => 'menikah',
                'password' => Hash::make('password'),
                'role' => 'owner',
                'phone_number' => '081234567891',
                'profile_picture' => null,
                'ktp_picture' => null,
                'ktp_picture_person' => null,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid(),
                'name' => 'Penghuni Kos',
                'email' => 'penghuni@simkos.test',
                'no_ktp' => '3201010101010003',
                'npwp' => 0,
                'gender' => 'laki laki',
                'tgl_lahir' => '2000-09-09',
                'address' => 'Jl. Penghuni No.3',
                'status' => 'belum menikah',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone_number' => '081234567892',
                'profile_picture' => null,
                'ktp_picture' => null,
                'ktp_picture_person' => null,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
