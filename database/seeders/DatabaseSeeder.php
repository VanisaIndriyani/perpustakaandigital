<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Koleksi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@perpustakaan.test');
        $adminPassword = env('ADMIN_PASSWORD', 'Admin12345!');

        User::query()->updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin',
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'mahasiswa@perpustakaan.test'],
            [
                'name' => 'Mahasiswa Demo',
                'nim' => '2026001',
                'phone' => '082371114136',
                'password' => Hash::make('Mahasiswa123!'),
                'role' => 'mahasiswa',
            ],
        );

        if (User::query()->where('email', 'test@example.com')->doesntExist()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role' => 'mahasiswa',
            ]);
        }

        $kategoriNames = [
            'Teknik Informatika',
            'Manajemen',
            'Akuntansi',
            'Hukum',
            'Kesehatan',
        ];

        $kategoriIds = collect($kategoriNames)
            ->map(fn (string $name) => Kategori::query()->firstOrCreate(['nama_kategori' => $name])->id)
            ->values();

        $faker = \Faker\Factory::create('id_ID');
        $jenisKeys = array_keys(Koleksi::jenisOptions());

        for ($i = 1; $i <= 5; $i++) {
            Koleksi::query()->create([
                'judul' => 'Contoh Koleksi ' . $i . ' - ' . $faker->sentence(4),
                'pengarang' => $faker->name(),
                'tahun' => (int) $faker->numberBetween(2016, (int) now()->format('Y')),
                'kategori_id' => $faker->randomElement($kategoriIds),
                'jenis' => $faker->randomElement($jenisKeys),
                'deskripsi' => $faker->paragraphs(2, true),
                'cover' => null,
                'file_pdf' => null,
            ]);
        }
    }
}
