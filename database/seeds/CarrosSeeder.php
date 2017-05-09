<?php

use Illuminate\Database\Seeder;

class CarrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carros = [
            0 => [
                'nome' => 'Gol',
                'placa' => 'DFG-2143'
            ],
            1 => [
                'nome' => 'Celta',
                'placa' => 'POF-9865' 
            ]
        ];
        
        DB::table('carros')->insert($carros);
    }
}
