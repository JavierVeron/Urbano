<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert(['nombre' => 'Javier', 'apellido' => 'Verón', 'email' => 'javier.veron@gmail.com', 'observaciones' => 'Desarrollador PHP', 'grupo_cliente_id' => 2, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Daniela', 'apellido' => 'Corrente', 'email' => 'dcorrente@urbano.com.ar', 'observaciones' => 'Desarrollo Humano - Urbano', 'grupo_cliente_id' => 2, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'AFIP', 'email' => 'info@afip.gov.var', 'observaciones' => 'Administración Federal de Ingresos Públicos', 'grupo_cliente_id' => 3, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'ANSES', 'email' => 'info@anses.gov.ar', 'observaciones' => 'Administración Nacional de la Seguridad Social', 'grupo_cliente_id' => 3, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Garbarino', 'email' => 'info@garbarino.com', 'observaciones' => 'Garbarino S.A.', 'grupo_cliente_id' => 4, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Frávega', 'email' => 'info@fravega.com', 'observaciones' => 'Frávega S.A.', 'grupo_cliente_id' => 4, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Mercado Libre', 'email' => 'info@mercadolibre.com.ar', 'observaciones' => 'Mercado Libre S.A.', 'grupo_cliente_id' => 4, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Facebook', 'email' => 'info@facebook.com', 'observaciones' => 'Facebook Inc.', 'grupo_cliente_id' => 5, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Amazon', 'email' => 'info@amazon.com', 'observaciones' => 'Amazon Inc.', 'grupo_cliente_id' => 5, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Apple', 'email' => 'info@apple.com', 'observaciones' => 'Apple Inc.', 'grupo_cliente_id' => 5, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Netflix', 'email' => 'info@netflix.com', 'observaciones' => 'Netflix Inc.', 'grupo_cliente_id' => 5, 'created_at' => date('Y-m-d H:i:s')]);
        DB::table('clientes')->insert(['nombre' => 'Google', 'email' => 'info@google.com', 'observaciones' => 'Google Inc.', 'grupo_cliente_id' => 5, 'created_at' => date('Y-m-d H:i:s')]);
    }
}
