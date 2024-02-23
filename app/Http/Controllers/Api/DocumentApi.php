<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class DocumentApi extends ApiController
{
    public function index($id)
    {
        $documents = Document::where('partner_id', $id)->get();
        $documents = $documents->map(function ($document) {
            $fileName = basename($document->basic_path);
            $document->fileName = $fileName;
            return $document;
        });
        return $this->setResponse($documents);
    }

    public function upload($id, Request $request)
    {
        $document = new Document();
        $document->partner_id = $id;
        if ($request->hasFile('file')) {
            $fileName = request()->file->getClientOriginalName();
            request()->file->storeAs('public/basic/' . $id, $fileName);
            $file_path = '/storage/basic/' . $id . '/' . $fileName;
            $document->basic_path = $file_path;
        }
        $document->save();
        return $this->setResponse($document, "保存しました");
    }

    public function download($id, $file_name)
    {
        $file_path = storage_path('app/public/basic/' . $id . '/' .  $file_name);
        if (file_exists($file_path)) {
            // Fileのタイプと名前をセットします。
            $headers = array(
                'Content-Type: ' . File::mimeType($file_path),
                'Content-Disposition: attachment; filename="' . basename($file_path) . '"',
            );

            // ダウンロードを開始します。
            return response()->download($file_path, basename($file_path), $headers);
        } else {
            // ファイルが存在しない場合は、404エラーを返します。
            abort(404);
        }
    }
}
