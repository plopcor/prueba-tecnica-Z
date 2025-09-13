<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Src\Applications\Infrastructure\Eloquent\ApplicationModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Usuario administrador
        $userAdmin = User::factory()->create([
            'username' => 'julia_perez',
            'name' => 'Julia',
            'surname' => 'Perez Vaez',
            'email' => 'jperez@mail.com',
            'password' => 'admin1234',
            'department' => 'Administracion',
            'is_admin' => true
        ]);

        // Usuario normal
        $userNormal = User::factory()->create([
            'username' => 'ana_fernandez',
            'name' => 'Ana',
            'surname' => 'Fernandez',
            'email' => 'afernandez@mail.com',
            'password' => 'user1234',
            'department' => 'RR.HH.',
            'is_admin' => false
        ]);

        // Aplicaciones activas
        $apps = ['CRM Clientes v2', 'Factury', 'Documanager', 'Herramientas internas'];
        foreach ($apps as $app) {
            ApplicationModel::create([
                'name' => $app,
                'url' => fake()->url(),
                'is_active' => true
            ]);
        }
        // Aplicacion inactiva
        ApplicationModel::create([
            'name' => 'CRM Clientes v1',
            'url' => fake()->url(),
            'is_active' => false
        ]);

        // Permisos de aplicaciones
        $randApps = ApplicationModel::inRandomOrder()->take(2)->get();
        $userNormal->applications()->attach(
            $randApps->pluck('id')->toArray()
        );

    }
}
