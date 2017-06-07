<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = ['name' => 'Erandir Junior', 'email' => 'aefs12junior@gmail.com', 'password' => bcrypt('123456')];
        DB::table('users')->insert($user);
    }
}
