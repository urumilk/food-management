<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;          // ← モデルの読み込み
use Illuminate\Support\Facades\Hash;  // ← パスワードハッシュ用
use Illuminate\Support\Str;   // ← remember_token 用

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // ← パスワードはハッシュ化！
            'remember_token' => Str::random(10),
        ]);
    }
}
