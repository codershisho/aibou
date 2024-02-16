<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ProjectApi extends ApiController
{
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
        $data = [
            'id' => $project->id,
            'agreement_path' => $project->agreement_path,
            'estimate_path' => $project->estimate_path,
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
            request()->file->storeAs('public/agreement/' . $id, $fileName);
            $file_path = '/storage/agreement/' . $id . '/' . $fileName;
            $project->agreement_path = $file_path;
        }
        if ($request->hasFile('file2')) {
            $fileName = request()->file->getClientOriginalName();
            request()->file2->storeAs('public/estimate/' . $id, $fileName);
            $file_path = '/storage/estimate/' . $id . '/' . $fileName;
            $project->estimate_path = $file_path;
        }

        $project->price = $request->price;
        $project->money = $request->money;
        $project->save();

        return $this->setResponse($project, "保存しました");
    }
}
