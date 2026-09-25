<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::where('is_public', true);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $documents = $query->latest()->paginate(10)->withQueryString();

        return view('documents.index', compact('documents'));
    }

    public function download(Document $document)
    {
        if (!$document->file_path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        // Gunakan nama asli yang diupload atau fallback ke judul dokumen rapi
        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION) ?: 'pdf';
        $downloadName = $document->file_name ?? (\Illuminate\Support\Str::slug($document->title) . '.' . $extension);

        return \Illuminate\Support\Facades\Storage::disk('public')->download($document->file_path, $downloadName);
    }
}
