<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $kategoris = Kategori::query()
            ->when($q !== '', fn ($query) => $query->where('nama_kategori', 'like', "%{$q}%"))
            ->withCount('koleksis')
            ->orderBy('nama_kategori')
            ->paginate(12)
            ->withQueryString();

        return view('admin.kategori.index', [
            'q' => $q,
            'kategoris' => $kategoris,
        ]);
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:120', 'unique:kategoris,nama_kategori'],
        ]);

        Kategori::query()->create($validated);

        return redirect()->route('admin.kategori.index');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', [
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:120', 'unique:kategoris,nama_kategori,' . $kategori->id],
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index');
    }
}

