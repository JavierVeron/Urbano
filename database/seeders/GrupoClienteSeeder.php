<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupo_clientes')->insert(['nombre' => '(Ninguno)', 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('grupo_clientes')->insert(['nombre' => 'Particular', 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('grupo_clientes')->insert(['nombre' => 'Público', 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('grupo_clientes')->insert(['nombre' => 'Privado', 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('grupo_clientes')->insert(['nombre' => 'Internacional', 'created_at' => date('Y-m-d H:i:s')]);
    }
}
