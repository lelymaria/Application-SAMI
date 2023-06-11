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

        $users = [
            ["nip" => 2003071, "level_id" => Level::where("name", "Operator")->first()->id, "password" => bcrypt("password")],
            ["nip" => 2003073, "level_id" => Level::where("name", "Ketua P4MP")->first()->id, "password" => bcrypt("password")],
            ["nip" => 2003075, "level_id" => Level::where("name", "Lead Auditor")->first()->id, "password" => bcrypt("password")],
            ["nip" => 2003076, "level_id" => Level::where("name", "Anggota Auditor")->first()->id, "password" => bcrypt("password")],
            ["nip" => 2003077, "level_id" => Level::where("name", "Auditee")->first()->id, "password" => bcrypt("password")],
            ["nip" => 2003079, "level_id" => Level::where("name", "Jurusan")->first()->id, "password" => bcrypt("password")]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
