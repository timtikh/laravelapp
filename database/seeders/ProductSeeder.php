<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.ru']);

       $admin->assignRole('admin');

        $users = User::factory()->count(10)->create();
        foreach ($users as $user) {
            $user->assignRole('manager');
        }
        Product::factory()->count(40)->create();
    }
}
