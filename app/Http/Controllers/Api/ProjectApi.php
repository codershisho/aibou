<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProjectApi extends ApiController
{
    const UPLOAD_FILE_PATH = "public/projects/";

    public function index()
    {
        $data = Project::with(['partner'])->get();
        return $this->setResponse($data);
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return $this->setResponse($project);
    }

    public function store(Request $request)
    {
        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    public function update($id, Request $request)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return $this->setResponse($project, "案件更新しました");
    }

    public function showStep($id)
    {
        $project = Project::findOrFail($id);
        return $this->setResponse($project->step);
    }

    public function step($id, Request $request)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return $this->setResponse($project->step, "保存しました");
    }

    /**
     * プロジェクトIDに紐づく契約書と金額を返す
     *
     * @param [type] $id
     * @return void
     */
    public function showAgreement($id)
    {
        $project = Project::findOrFail($id);
        $files = Storage::disk('public')->files('projects/' . $id);
        $fileNames = [];

        foreach ($files as $file) {
            $fileNames[] = basename($file);
        }

        $data = [
            'id' => $project->id,
            'file_names' => $fileNames,
            'price' => $project->price,
            'money' => $project->money,
        ];
        return $this->setResponse($data);
    }

    /**
     * プロジェクトIDに紐づく契約書と金額を更新
     *
     * @param [type] $id
     * @return void
     */
    public function updateAgreement($id, Request $request)
    {
        $project = Project::findOrFail($id);

        if ($request->hasFile('file')) {
            $fileName = request()->file->getClientOriginalName();
            request()->file->storeAs(self::UPLOAD_FILE_PATH . $id, $fileName);
        }

        $project->price = $request->price;
        $project->money = $request->money;
        $project->save();

        $files = Storage::disk('public')->files('projects/' . $id);
        $fileNames = [];

        foreach ($files as $file) {
            $fileNames[] = basename($file);
        }

        $project->file_names = $fileNames;

        return $this->setResponse($project, "保存しました");
    }

    /**
     * アップロードされた書類のダウンロード
     *
     * @param [type] $id
     * @param [type] $file_name
     * @return void
     */
    public function downloadAgreement($id, $file_name)
    {
        $file_path = storage_path('app/public/projects/' . $id . '/' .  $file_name);
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
