<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudis = ProgramStudi::orderBy('kode_nim')->get();
        return view('admin.program_studi.index', compact('programStudis'));
    }

    public function create()
    {
        return view('admin.program_studi.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prodi'    => 'required|string|max:255|unique:program_studis',
            'jenjang'       => 'required|string|in:S1,D3,D4,Profesi',
            'kode_nim'      => 'required|string|size:4|unique:program_studis',
            'kode_dikti'    => 'nullable|string|max:20',
            'gelar'         => 'nullable|string|max:50',
            'akreditasi'    => 'nullable|string|max:50',
            'deskripsi'     => 'nullable|string',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'prospek_karir' => 'nullable|string',
            'thumbnail'     => 'nullable|image|max:2048',
            'is_active'     => 'required|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('program_studi', 'public');
        }

        ProgramStudi::create($validated);

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program Studi "' . $validated['nama_prodi'] . '" berhasil ditambahkan!');
    }

    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.program_studi.form', compact('programStudi'));
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $validated = $request->validate([
            'nama_prodi'    => 'required|string|max:255|unique:program_studis,nama_prodi,' . $programStudi->id,
            'jenjang'       => 'required|string|in:S1,D3,D4,Profesi',
            'kode_nim'      => 'required|string|size:4|unique:program_studis,kode_nim,' . $programStudi->id,
            'kode_dikti'    => 'nullable|string|max:20',
            'gelar'         => 'nullable|string|max:50',
            'akreditasi'    => 'nullable|string|max:50',
            'deskripsi'     => 'nullable|string',
            'visi'          => 'nullable|string',
            'misi'          => 'nullable|string',
            'prospek_karir' => 'nullable|string',
            'thumbnail'     => 'nullable|image|max:2048',
            'is_active'     => 'required|boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($programStudi->thumbnail) {
                Storage::disk('public')->delete($programStudi->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('program_studi', 'public');
        }

        $programStudi->update($validated);

        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program Studi "' . $validated['nama_prodi'] . '" berhasil diperbarui!');
    }

    public function destroy(ProgramStudi $programStudi)
    {
        if ($programStudi->thumbnail) {
            Storage::disk('public')->delete($programStudi->thumbnail);
        }
        $nama = $programStudi->nama_prodi;
        $programStudi->delete();
        return redirect()->route('admin.program-studi.index')
            ->with('success', 'Program Studi "' . $nama . '" berhasil dihapus.');
    }

    /**
     * Toggle status aktif prodi (buka/tutup di PMB).
     */
    public function toggleActive(ProgramStudi $programStudi)
    {
        $programStudi->update(['is_active' => !$programStudi->is_active]);
        $status = $programStudi->fresh()->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', 'Program Studi "' . $programStudi->nama_prodi . '" berhasil ' . $status . '.');
    }
}
