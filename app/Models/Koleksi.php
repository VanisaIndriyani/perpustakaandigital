<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Koleksi extends Model
{
    protected $fillable = [
        'judul',
        'pengarang',
        'tahun',
        'kategori_id',
        'jenis',
        'deskripsi',
        'cover',
        'file_pdf',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    protected $appends = [
        'cover_url',
        'file_pdf_url',
    ];

    public static function jenisOptions(): array
    {
        return [
            'buku' => 'Buku',
            'e-book' => 'E-Book',
            'jurnal' => 'Jurnal',
            'e-jurnal' => 'E-Jurnal',
            'skripsi' => 'Skripsi',
        ];
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function getCoverUrlAttribute(): ?string
    {
        if (!$this->cover) {
            return null;
        }

        return '/storage/' . ltrim($this->cover, '/');
    }

    public function getFilePdfUrlAttribute(): ?string
    {
        if (!$this->file_pdf) {
            return null;
        }

        return '/storage/' . ltrim($this->file_pdf, '/');
    }
}
