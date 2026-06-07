<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Koleksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KoleksiController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $jenis = (string) $request->query('jenis', '');
        $kategoriId = (string) $request->query('kategori_id', '');

        $allowedJenisKeys = $this->allowedJenisKeys($request);
        $jenisOptions = collect(Koleksi::jenisOptions())
            ->only($allowedJenisKeys)
            ->all();

        $koleksis = Koleksi::query()
            ->with('kategori')
            ->whereIn('jenis', $allowedJenisKeys)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner
                        ->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%")
                        ->orWhere('tahun', 'like', "%{$q}%");
                });
            })
            ->when($jenis !== '', fn ($query) => $query->where('jenis', $jenis))
            ->when($kategoriId !== '', fn ($query) => $query->where('kategori_id', $kategoriId))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $kategoris = Kategori::query()->orderBy('nama_kategori')->get(['id', 'nama_kategori']);

        return view('admin.koleksi.index', [
            'q' => $q,
            'jenis' => $jenis,
            'kategoriId' => $kategoriId,
            'jenisOptions' => $jenisOptions,
            'kategoris' => $kategoris,
            'koleksis' => $koleksis,
        ]);
    }

    public function create()
    {
        $allowedJenisKeys = $this->allowedJenisKeys(request());
        $jenisOptions = collect(Koleksi::jenisOptions())
            ->only($allowedJenisKeys)
            ->all();

        return view('admin.koleksi.create', [
            'jenisOptions' => $jenisOptions,
            'kategoris' => Kategori::query()->orderBy('nama_kategori')->get(['id', 'nama_kategori']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request, $this->allowedJenisKeys($request));

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('pdf', 'public');
        }

        Koleksi::query()->create($validated);

        return redirect()->route('admin.koleksi.index');
    }

    public function edit(Koleksi $koleksi)
    {
        $allowedJenisKeys = $this->allowedJenisKeys(request());

        if ($this->isStaff(request()) && !in_array($koleksi->jenis, $allowedJenisKeys, true)) {
            abort(403);
        }

        return view('admin.koleksi.edit', [
            'koleksi' => $koleksi,
            'jenisOptions' => collect(Koleksi::jenisOptions())->only($allowedJenisKeys)->all(),
            'kategoris' => Kategori::query()->orderBy('nama_kategori')->get(['id', 'nama_kategori']),
        ]);
    }

    public function update(Request $request, Koleksi $koleksi)
    {
        $allowedJenisKeys = $this->allowedJenisKeys($request);

        if ($this->isStaff($request) && !in_array($koleksi->jenis, $allowedJenisKeys, true)) {
            abort(403);
        }

        $validated = $this->validatePayload($request, $allowedJenisKeys);

        $removeCover = (bool) $request->boolean('remove_cover');
        $removePdf = (bool) $request->boolean('remove_file_pdf');

        if ($request->hasFile('cover')) {
            $newCover = $request->file('cover')->store('covers', 'public');
            if ($koleksi->cover) {
                Storage::disk('public')->delete($koleksi->cover);
            }
            $validated['cover'] = $newCover;
        } elseif ($removeCover && $koleksi->cover) {
            Storage::disk('public')->delete($koleksi->cover);
            $validated['cover'] = null;
        }

        if ($request->hasFile('file_pdf')) {
            $newPdf = $request->file('file_pdf')->store('pdf', 'public');
            if ($koleksi->file_pdf) {
                Storage::disk('public')->delete($koleksi->file_pdf);
            }
            $validated['file_pdf'] = $newPdf;
        } elseif ($removePdf && $koleksi->file_pdf) {
            Storage::disk('public')->delete($koleksi->file_pdf);
            $validated['file_pdf'] = null;
        }

        $koleksi->update($validated);

        return redirect()->route('admin.koleksi.index');
    }

    public function exportPdf(Request $request)
    {        $q = trim((string) $request->query('q', ''));
        $jenis = (string) $request->query('jenis', '');
        $kategoriId = (string) $request->query('kategori_id', '');

        $allowedJenisKeys = $this->allowedJenisKeys($request);

        $items = Koleksi::query()
            ->with('kategori')
            ->whereIn('jenis', $allowedJenisKeys)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner
                        ->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%")
                        ->orWhere('tahun', 'like', "%{$q}%");
                });
            })
            ->when($jenis !== '', fn ($query) => $query->where('jenis', $jenis))
            ->when($kategoriId !== '', fn ($query) => $query->where('kategori_id', $kategoriId))
            ->latest()
            ->get();

        $logoPath = public_path('logo.jpeg');
        $logoDataUri = null;
        if (is_file($logoPath)) {
            $logoDataUri = 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($logoPath));
        }

        $pdf = Pdf::loadView('admin.koleksi.export_pdf', [
            'items' => $items,
            'q' => $q,
            'jenis' => $jenis,
            'logoDataUri' => $logoDataUri,
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('koleksi-' . now()->format('Ymd-His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {        $q = trim((string) $request->query('q', ''));
        $jenis = (string) $request->query('jenis', '');
        $kategoriId = (string) $request->query('kategori_id', '');

        $allowedJenisKeys = $this->allowedJenisKeys($request);

        $items = Koleksi::query()
            ->with('kategori')
            ->whereIn('jenis', $allowedJenisKeys)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner
                        ->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%")
                        ->orWhere('tahun', 'like', "%{$q}%");
                });
            })
            ->when($jenis !== '', fn ($query) => $query->where('jenis', $jenis))
            ->when($kategoriId !== '', fn ($query) => $query->where('kategori_id', $kategoriId))
            ->latest()
            ->get();

        $jenisOptions = Koleksi::jenisOptions();

        $callback = function () use ($items, $jenisOptions) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Judul', 'Pengarang', 'Tahun', 'Jenis', 'Kategori', 'Tanggal Ditambahkan']);

            foreach ($items as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->judul,
                    $item->pengarang,
                    $item->tahun ?: '-',
                    $jenisOptions[$item->jenis] ?? $item->jenis,
                    $item->kategori?->nama_kategori ?: '-',
                    $item->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="koleksi-' . now()->format('Ymd-His') . '.csv"',
        ];

        return response()->stream($callback, 200, $headers);
    }

    public function destroy(Koleksi $koleksi)
    {
        if ($this->isStaff(request())) {
            abort(403);
        }

        if ($koleksi->cover) {
            Storage::disk('public')->delete($koleksi->cover);
        }

        if ($koleksi->file_pdf) {
            Storage::disk('public')->delete($koleksi->file_pdf);
        }

        $koleksi->delete();

        return redirect()->route('admin.koleksi.index');
    }

    private function validatePayload(Request $request, array $jenisKeys): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:180'],
            'pengarang' => ['required', 'string', 'max:120'],
            'tahun' => ['nullable', 'integer', 'min:1900', 'max:' . (int) now()->addYear()->format('Y')],
            'kategori_id' => ['required', 'integer', Rule::exists('kategoris', 'id')],
            'jenis' => ['required', 'string', Rule::in($jenisKeys)],
            'deskripsi' => ['nullable', 'string'],
            'cover' => ['nullable', 'file', 'max:5120', 'mimes:jpeg,png,jpg,webp'],
            'file_pdf' => ['nullable', 'file', 'max:51200', 'mimes:pdf'],
            'remove_cover' => ['nullable', 'boolean'],
            'remove_file_pdf' => ['nullable', 'boolean'],
        ], [
            'file_pdf.uploaded' => 'File PDF gagal diunggah. Pastikan ukuran file tidak melebihi batas server (max 50MB) dan koneksi stabil.',
            'cover.uploaded' => 'Cover gagal diunggah. Pastikan ukuran file tidak melebihi batas server (max 5MB).',
        ]);
    }

    private function isStaff(Request $request): bool
    {
        return $request->user()?->role === 'staf';
    }

    private function allowedJenisKeys(Request $request): array
    {
        if ($this->isStaff($request)) {
            return ['buku', 'e-book'];
        }

        return array_keys(Koleksi::jenisOptions());
    }
}
