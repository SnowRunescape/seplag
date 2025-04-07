<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'teste@seplag.mt.gov.br'],
            [
                'name' => 'Teste',
                'email' => 'teste@seplag.mt.gov.br',
                'password' => Hash::make('123456'),
            ]
        );
    }
}
