<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'Web Application Technology',
            'Object Orientated Programming',
            'Developing Mobile Applications',
            'Advanced Web Engineering',
            'Database Systems',
            'Software Engineering',
            'Artificial Intelligence',
            'Cloud Computing',
            'Cyber Security',
            'Data Structures and Algorithms',
            'Human Computer Interaction',
            'Computer Networks',
        ];
        foreach ($modules as $module) {
            \App\Models\Module::firstOrCreate([
                'module' => $module,
                'slug' => \Illuminate\Support\Str::slug($module),
            ]);
        }
    }
}
