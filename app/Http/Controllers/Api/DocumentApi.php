<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DocumentApi extends ApiController
{
    public function index()
    {
        $documents = Document::all();
        $documents = $documents->map(function ($document) {
            $fileName = basename($document->basic_path);
            $document->fileName = $fileName;
            return $document;
        });
        return $this->setResponse($documents);
    }

    public function upload($id, Request $request)
    {
        // $document = Document::findOrFail($id);
        $document = new Document();
        $document->partner_id = $id;
        if ($request->hasFile('file')) {
            // $file_name = request()->file->getClientOriginalName();
            $date = Carbon::now()->format('YmdHis');
            $fileName = $date . '_基本契約書.pdf';
            request()->file->storeAs('public/basic/' . $id, $fileName);
            $file_path = '/storage/basic/' . $id . '/' . $fileName;
            $document->basic_path = $file_path;
        }
        $document->save();
        return $this->setResponse($document, "保存しました");
    }
}
