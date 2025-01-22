<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class kategoriController extends Controller
{
    public function index()
    {
        $kategoris = kategori::all();
        return view('kategori.index', compact('kategoris'));
    }
    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        Log::info($request->all()); 
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ],  [
            // pesan kustom untuk field 'nama'
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.string' => 'Nama kategori berupa teks.',
            'nama.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Nama kategori sudah digunakan, silahkan pilih nama lain.',

            // pesan kustom untuk field 'keterangan'
            'keterangan.string' => 'keterangan harus berupa teks.',
            'keterangan.max' => 'keterangan tidak boleh dari 255 karakter.',

            // pesan kustom untuk field 'status'
            'status.required' => 'Status kategori wajib diisi.',
            'status.in' => 'Status kategori harus berupa salah satu dari nilai yang valid (aktif atau nonaktif).',

        ]);

        Kategori::create($request->all());

        return redirect()->route('master.data.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.show', compact('kategori'));
    }

    public function edit(string $id_kategori)
    {
        // Cari kategori berdasarkan id_kategori
        $kategori = Kategori::findOrFail($id_kategori);
    
        return view('kategori.edit', compact('kategori'));
    }
    
    public function update(Request $request, string $id_kategori)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|max:255|unique:kategori,nama,' . $id_kategori . ',id_kategori',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ],  [
            // pesan kustom untuk field 'nama'
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.string' => 'Nama kategori harus berupa teks.',
            'nama.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Nama kategori sudah digunakan, silakan pilih nama lain.',

            // pesan kustom untuk field 'keterangan'
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',

            // pesan kustom untuk 'status'
            'status.required' => 'Status kategori wajib diisi.',
            'status.in' => 'Status kategori harus berupa salah satu dari nilai yang valid (aktif atau nonaktif).',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->update($request->all());
    
        return redirect()->route('master.data.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }
    /**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    // Cari kategori berdasarkan ID
    $kategori = Kategori::findOrFail($id);

    // Cek apakah Kategori memiliki relasi dengan buku
    if ($kategori->buku()->count() > 0) {
        // Jika ada buku yang terhubung dengan kategori ini, kembalikan pesan error
        return redirect()->route('master.data.kategori.index')
            ->with('error', 'Kategori ini tidak bisa dihapus karena memiliki relasi dengan buku.');
    }

    // Hapus kategori jika tidak ada relasi dengan buku
    $kategori->delete();

    // Redirect ke halaman index dengan sukses
    return redirect()->route('master.data.kategori.index')
        ->with('success', 'Kategori berhasil dihapus.');
}
}