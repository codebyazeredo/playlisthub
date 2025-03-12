<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        Genre::create(['name' => 'Pop']);
        Genre::create(['name' => 'Rock']);
        Genre::create(['name' => 'Hip Hop']);
        Genre::create(['name' => 'Rap']);
        Genre::create(['name' => 'Indie']);
        Genre::create(['name' => 'Eletrônica']);
        Genre::create(['name' => 'R&B']);
        Genre::create(['name' => 'Jazz']);
        Genre::create(['name' => 'Reggae']);
        Genre::create(['name' => 'Música Clássica']);
        Genre::create(['name' => 'Country']);
        Genre::create(['name' => 'Dance']);
        Genre::create(['name' => 'Metal']);
        Genre::create(['name' => 'Blues']);
        Genre::create(['name' => 'Música Latina']);
        Genre::create(['name' => 'Música Brasileira']);
        Genre::create(['name' => 'Punk']);
        Genre::create(['name' => 'Soul']);
        Genre::create(['name' => 'Folk']);
        Genre::create(['name' => 'Trap']);
    }
}
