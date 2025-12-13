<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data['name']     = 'admin';
        $data['email']    = 'admin12@inventaris.test';
        $data['password'] = Hash::make('admin12');
        User::create($data);
    }
}
