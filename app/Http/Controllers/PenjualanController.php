<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'super_admin') {
            $penjualan = Penjualan::with(['user', 'buku'])->get();
        } else {
            $penjualan = Penjualan::with(['user', 'buku'])
                ->where('user_id', $user->id)
                ->get();
        }

        return view('penjualan.index', compact('penjualan', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        $bukus = Buku::with('kategori')
            ->where('status', 'aktif')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('penjualan.create', compact('user', 'bukus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'buku_id' => 'required|integer|exists:buku,id_buku',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'pembayaran' => 'required|numeric|min:0',
        ], [
            'user_id.required' => 'ID pengguna wajib diisi.',
            'user_id.exists' => 'ID pengguna tidak valid.',
            'buku_id.required' => 'ID buku wajib diisi.',
            'buku_id.exists' => 'ID buku tidak valid.',
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
            'jumlah.required' => 'Jumlah buku wajib diisi.',
            'harga.required' => 'Harga buku wajib diisi.',
            'pembayaran.required' => 'Pembayaran wajib diisi.',
        ]);

        // Hitung total harga
        $validated['total_harga'] = $validated['jumlah'] * $validated['harga'];

        // Validasi pembayaran
        if ($validated['pembayaran'] < $validated['total_harga']) {
            return back()->withErrors(['pembayaran' => 'Pembayaran tidak boleh kurang dari total harga.']);
        }

        // Hitung kembalian
        $validated['kembalian'] = $validated['pembayaran'] - $validated['total_harga'];

        Penjualan::create($validated);

        return redirect()->route('master.data.penjualan.index')
        ->with('success', 'Penjualan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $users = User::all();
        $bukus = Buku::where('status', 'aktif')->get();

        return view('penjualan.edit', compact('penjualan', 'users', 'bukus'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'buku_id' => 'nullable|integer|exists:buku,id_buku',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'total_harga' => 'required|numeric|min:0',
            'pembayaran' => 'required|numeric|min:0',
            'status' => 'required|in:pending,selesai',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        // Hitung total harga
        $validated['total_harga'] = $validated['jumlah'] * $validated['harga'];

        // Validasi pembayaran
        if ($validated['pembayaran'] < $validated['total_harga']) {
            return back()->withErrors(['pembayaran' => 'Pembayaran tidak boleh kurang dari total harga.']);
        }

        // Hitung kembalian
        $validated['kembalian'] = $validated['pembayaran'] - $validated['total_harga'];

        // Fallback buku_id jika tidak diubah
        if (!$request->has('buku_id') || $request->buku_id === null) {
            $validated['buku_id'] = $penjualan->buku_id;
        }

        $penjualan->update($validated);

        return redirect()->route('master.data.penjualan.index')->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('master.data.penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}
