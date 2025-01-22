<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:1000|unique:buku',
            'deskripsi' => 'required|string',
            'penulis' => 'required|string',
            'cover' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'harga' => 'required|numeric|min:0',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.string' => 'Judul buku harus berupa teks.',
            'judul.max' => 'Judul buku tidak boleh lebih dari 1000 karakter.',
            'judul.unique' => 'Judul buku sudah digunakan, silakan pilih judul lain.',
            'deskripsi.required' => 'Deskripsi buku wajib diisi.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'cover.required' => 'File cover wajib diunggah.',
            'cover.image' => 'File cover harus berupa gambar.',
            'cover.mimes' => 'Format file cover harus JPG, JPEG, PNG, atau GIF.',
            'cover.max' => 'Ukuran file cover tidak boleh lebih dari 2MB.',
            'status.required' => 'Status buku wajib dipilih.',
            'status.in' => 'Status buku harus berupa salah satu nilai yang valid (aktif atau nonaktif).',
            'harga.required' => 'Harga buku wajib diisi.',
            'harga.numeric' => 'Harga buku harus berupa angka.',
            'harga.min' => 'Harga buku tidak boleh kurang dari 0.',
        ]);

        if ($request->hasfile('cover')) {
            $file = $request->file('cover');
            $coverName = 'cover_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/covers'), $coverName);
        }

        Buku::create([
            'kategori_id' => $validated['kategori_id'],
            'judul' => $validated['judul'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'penulis' => $validated['penulis'],
            'cover' => 'images/covers/' . $coverName,
            'status' => $validated['status'],
        ]);
        return redirect()->route('master.data.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('buku.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'judul' => 'required|string|max:1000|unique:buku,judul,' . $id . ',id_buku',
            'deskripsi' => 'required|string|max:1000',
            'penulis' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'harga' => 'required|numeric|min:0',
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.string' => 'Judul buku harus berupa teks.',
            'judul.max' => 'Judul buku tidak boleh lebih dari 1000 karakter.',
            'judul.unique' => 'Judul buku sudah digunakan, silakan pilih judul lain.',
            'deskripsi.required' => 'Deskripsi buku wajib diisi.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'cover.image' => 'File cover harus berupa gambar.',
            'cover.mimes' => 'Format file cover harus JPG, JPEG, PNG, atau GIF.',
            'status.required' => 'Status buku wajib dipilih.',
            'status.in' => 'Status buku harus berupa salah satu nilai yang valid (aktif atau nonaktif).',
            'harga.required' => 'Harga buku wajib diisi.',
            'harga.numeric' => 'Harga buku harus berupa angka.',
            'harga.min' => 'Harga buku tidak boleh kurang dari 0.',
        ]);

        $buku = Buku::findOrFail($id);

        if ($request->hasFile('cover')) {
            if ($buku->cover && file_exists(public_path($buku->cover))) {
                unlink(public_path($buku->cover));
            }

            $file = $request->file('cover');
            $coverName = 'cover_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/covers'), $coverName);
            $validated['cover'] = 'images/covers/' . $coverName;
        } else {
            $validated['cover'] = $buku->cover;
        }

        $buku->update($validated);

        return redirect()->route('master.data.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('buku.show', compact('buku', 'kategoris'));
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->peminjaman()->where('status', 'dipinjam')->exists()) {
            return redirect()->back()->with('error', 'Buku tidak dapat dihapus karena sedang dipinjam.');
        }

        $buku->delete();
        return redirect()->route('master.data.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
