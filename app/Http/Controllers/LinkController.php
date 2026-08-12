<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage; // Import Facade Storage

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::paginate(10);
        return view('admin.links.index', compact('links'));
    }
    /**
     * Menampilkan formulir pendaftaran tautan baru.
     */
    public function create(): View{
        return view('admin.links.create');
    }

    /**
     * Menampilkan formulir edit tautan berdasarkan model $link.
     */
    public function edit(Link $link): View
    {
        return view('admin.links.edit', compact('link'));
    }

        /**
     * Menghapus record tautan dari database dan memusnahkan berkas gambarnya.
     */
    public function destroy(Link $link): RedirectResponse
    {
        // 1. Eksekusi pembersihan berkas fisik di storage server
        if ($link->image) {
            Storage::disk('public')->delete($link->image);
        }

        // 2. Hapus record dari tabel database
        $link->delete();

        // 3. Kembalikan ke halaman indeks dengan flash notification
        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Tautan beserta berkas gambarnya berhasil dihapus secara permanen!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('links', 'public');
        }

        Link::create($validated);

        return redirect()->back()->with('success', 'Link added successfully.');
    }

    /**
     * Memproses pembaruan data dan penggantian berkas di server.
     */
    public function update(Request $request, Link $link): RedirectResponse
    {
        // 1. Validasi Input Data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Default: Gunakan path gambar lama yang sudah ada di DB
        $imagePath = $link->image;

        // 2. Logika Replacement Berkas
        if ($request->hasFile('image')) {
            // Hapus gambar fisik lama dari disk 'public' jika ada
            if ($link->image) {
                Storage::disk('public')->delete($link->image);
            }

            // Simpan gambar baru ke direktori 'links'
            $imagePath = $request->file('image')->store('links', 'public');
        }

        // 3. Evaluasi Checkbox & Update Record Database
        $link->update([
            'title'     => $validated['title'],
            'url'       => $validated['url'],
            'image'     => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.links.index')
            ->with('success', 'Tautan berhasil diperbarui!');
    }
}