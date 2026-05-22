<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TurnitinSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'file_doc',
        'status',
        'similarity_percent',
        'report_pdf',
        'catatan_admin',
    ];

    protected $casts = [
        'similarity_percent' => 'integer',
    ];

    protected $appends = [
        'file_doc_url',
        'report_pdf_url',
    ];

    public static function statusOptions(): array
    {
        return [
            'submitted' => 'Diajukan',
            'checking' => 'Diproses',
            'completed' => 'Selesai',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFileDocUrlAttribute(): ?string
    {
        if (!$this->file_doc) {
            return null;
        }

        return '/storage/' . ltrim($this->file_doc, '/');
    }

    public function getReportPdfUrlAttribute(): ?string
    {
        if (!$this->report_pdf) {
            return null;
        }

        return '/storage/' . ltrim($this->report_pdf, '/');
    }
}

