<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Pedro Gomez',
            'email' => 'pedro@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        Categoria::factory(5)->create();
        Post::factory(50)->create();
        Etiqueta::factory(10)->create();
    }
}
