<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => Str::random(10),
            'apellido' => Str::random(10),
            'direccion' => Str::random(10),
            'cedula' => 123456,
            'telefono' => 123456,
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'id_nivel' => 1,
        ]);
    }
}
