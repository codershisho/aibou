<?php

namespace App\Http\Controllers\Api;

use App\Models\Worktime;
use Illuminate\Http\Request;

class WorktimeApi extends ApiController
{
    public function show($id)
    {
        $worktime = Worktime::where('project_id', $id)->first();
        return $this->setResponse($worktime);
    }

    public function store(Request $request)
    {
        $project = Worktime::create($request->all());
        return response()->json($project, 201);
    }
}
