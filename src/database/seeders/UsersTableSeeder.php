<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//パスワードのハッシュ化をサポート
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '山田太郎',
            'email' => 'aaa@bbb.com',
            //パスワードをハッシュ化
            'password' => Hash::make('aaa'),
        ];
        DB::table('users')->insert($param);
    }
}
