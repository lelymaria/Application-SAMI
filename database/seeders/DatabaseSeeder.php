<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $levels = ["Operator", "Ketua P4MP", "Lead Auditor", "Anggota Auditor", "Auditee", "Jurusan"];
        foreach ($levels as $level) {
            Level::create([
                'name' => $level
            ]);
        }

        $akunOperator = User::create([
            "nip" => 199602092019031011,
            "level_id" => Level::where("name", "Operator")->first()->id,
            "password" => bcrypt("password"),
            "foto_profile" => 'images/profile/profile.png'
        ]);
        $akunOperator->akunOperator()->create([
            "email" => "operator@gmail.com",
            "nama" => "Tantowi Yahya Yogas Tamara, A.Md.Kom."
        ]);
    }
}
