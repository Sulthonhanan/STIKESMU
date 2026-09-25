<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.documents.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|string',
            'is_public'   => 'required|boolean',
            'file'        => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $validated['file_path'] = $request->file('file')->store('documents', 'public');
        $validated['file_name'] = $request->file('file')->getClientOriginalName();
        $validated['user_id']   = auth()->id();
        unset($validated['file']);

        Document::create($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diupload!');
    }

    public function edit(Document $document)
    {
        return view('admin.documents.form', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'nullable|string',
            'is_public'   => 'required|boolean',
            'file'        => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            if ($document->file_path) Storage::disk('public')->delete($document->file_path);
            $validated['file_path'] = $request->file('file')->store('documents', 'public');
            $validated['file_name'] = $request->file('file')->getClientOriginalName();
        }
        unset($validated['file']);

        $document->update($validated);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path) Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
