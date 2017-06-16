<?php

use App\User;
use Illuminate\Database\Seeder;

class DefenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $admin = Defender::createRole('admin');

        // Cria permissões
        $alunoIndex = Defender::createPermission('alunos.index', 'Listar Alunos');
        $alunoCreate = Defender::createPermission('alunos.create', 'Criar Alunos');

        // Atribui permissões ao grupo admin
        $admin->attachPermission($alunoIndex);
        $admin->attachPermission($alunoCreate);

        // Coloca determinado usuário no grupo admin
        $user = User::find(1);
        $user->attachRole($admin);
    }
}
