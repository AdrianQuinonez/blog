<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Article;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Eliminar carpeta
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');
        Storage::deleteDirectory('profiles');

        //Creamos la carpetas de nuevo de almacenamiento de la imagenes
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');
        Storage::makeDirectory('profiles');

        
        //Llamar al seeder
        $this->call(UserSeeder::class);

        //Factories
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
        Profile::factory(20)->create();
    }
}
