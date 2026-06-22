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

        User::query()->updateOrCreate(
            ['email' => 'staf@perpustakaan.test'],
            [
                'name' => 'Staf Perpustakaan',
                'password' => Hash::make('Staf12345!'),
                'role' => 'staf',
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('Test12345!'),
                'role' => 'mahasiswa',
            ],
        );

        $kategoriNames = [
            'Teknik Informatika',
            'Manajemen',
            'Akuntansi',
            'Hukum',
            'Kesehatan',
        ];

        $kategoriMap = collect($kategoriNames)
            ->mapWithKeys(fn (string $name) => [$name => Kategori::query()->firstOrCreate(['nama_kategori' => $name])->id]);

        $kategoriIds = $kategoriMap->values();

        if (class_exists(\Faker\Factory::class)) {
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

        $sampleKknItems = [
            [
                'judul' => 'Laporan KKN Desa Bulo Wattang 2026',
                'pengarang' => 'Nur Aisyah',
                'tahun' => 2026,
                'kategori' => 'Manajemen',
                'deskripsi' => 'Laporan KKN mahasiswa yang membahas program pemberdayaan UMKM, digitalisasi pencatatan usaha, dan pelatihan administrasi desa.',
            ],
            [
                'judul' => 'Laporan KKN Kelurahan Rijang Pittu 2026',
                'pengarang' => 'Muhammad Irfan',
                'tahun' => 2026,
                'kategori' => 'Teknik Informatika',
                'deskripsi' => 'Dokumen laporan kegiatan KKN mahasiswa terkait pendampingan literasi digital, pengenalan aplikasi administrasi, dan edukasi keamanan data.',
            ],
            [
                'judul' => 'Laporan KKN Desa Mojong 2025',
                'pengarang' => 'Siti Rahmah',
                'tahun' => 2025,
                'kategori' => 'Akuntansi',
                'deskripsi' => 'Laporan akhir KKN mahasiswa berisi kegiatan pendampingan penyusunan laporan keuangan sederhana dan edukasi pengelolaan kas masyarakat.',
            ],
        ];

        foreach ($sampleKknItems as $item) {
            Koleksi::query()->updateOrCreate(
                [
                    'judul' => $item['judul'],
                    'jenis' => 'kkn',
                ],
                [
                    'pengarang' => $item['pengarang'],
                    'tahun' => $item['tahun'],
                    'kategori_id' => $kategoriMap[$item['kategori']] ?? $kategoriIds->first(),
                    'deskripsi' => $item['deskripsi'],
                    'cover' => null,
                    'file_pdf' => null,
                ],
            );
        }
    }
}
