<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Resource;
use App\Card;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->seedUsers();
        $this->seedResources();

        Model::reguard();
    }

    public function seedUsers()
    {
        User::create([
            'name' => 'Amministratore',
            'email' => 'admin@example.com',
            'password' => 'admin'
        ]);

        foreach (['uno', 'due', 'tre'] as $name) {
            $user = User::create([
                'name' => "Utente {$name}",
                'email' => "{$name}@example.com",
                'password' => $name
            ]);

            $user->cards()->create(['id' => uniqid()]);
        }
    }

    public function seedResources()
    {
        Resource::create(['name' => 'Sala riunioni']);
        Resource::create(['name' => 'Coworking']);
    }
}
