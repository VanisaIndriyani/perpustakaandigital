<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Koleksi;
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

        $koleksis = Koleksi::query()
            ->with('kategori')
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
            'jenisOptions' => Koleksi::jenisOptions(),
            'kategoris' => $kategoris,
            'koleksis' => $koleksis,
        ]);
    }

    public function create()
    {
        return view('admin.koleksi.create', [
            'jenisOptions' => Koleksi::jenisOptions(),
            'kategoris' => Kategori::query()->orderBy('nama_kategori')->get(['id', 'nama_kategori']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

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
        return view('admin.koleksi.edit', [
            'koleksi' => $koleksi,
            'jenisOptions' => Koleksi::jenisOptions(),
            'kategoris' => Kategori::query()->orderBy('nama_kategori')->get(['id', 'nama_kategori']),
        ]);
    }

    public function update(Request $request, Koleksi $koleksi)
    {
        $validated = $this->validatePayload($request);

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

    public function destroy(Koleksi $koleksi)
    {
        if ($koleksi->cover) {
            Storage::disk('public')->delete($koleksi->cover);
        }

        if ($koleksi->file_pdf) {
            Storage::disk('public')->delete($koleksi->file_pdf);
        }

        $koleksi->delete();

        return redirect()->route('admin.koleksi.index');
    }

    private function validatePayload(Request $request): array
    {
        $jenisKeys = array_keys(Koleksi::jenisOptions());

        return $request->validate([
            'judul' => ['required', 'string', 'max:180'],
            'pengarang' => ['required', 'string', 'max:120'],
            'tahun' => ['nullable', 'integer', 'min:1900', 'max:' . (int) now()->addYear()->format('Y')],
            'kategori_id' => ['required', 'integer', Rule::exists('kategoris', 'id')],
            'jenis' => ['required', 'string', Rule::in($jenisKeys)],
            'deskripsi' => ['nullable', 'string'],
            'cover' => ['nullable', 'file', 'max:2048', 'mimetypes:image/jpeg,image/png,image/webp'],
            'file_pdf' => ['nullable', 'file', 'max:20480', 'mimetypes:application/pdf'],
            'remove_cover' => ['nullable', 'boolean'],
            'remove_file_pdf' => ['nullable', 'boolean'],
        ]);
    }
}
