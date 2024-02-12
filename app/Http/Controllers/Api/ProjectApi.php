<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectApi extends ApiController
{
    public function index()
    {
        $data = Project::all();
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
}
