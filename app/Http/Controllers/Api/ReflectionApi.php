<?php

namespace App\Http\Controllers\Api;

use App\Models\Reflection;
use Illuminate\Http\Request;

class ReflectionApi extends ApiController
{
    public function show($id)
    {
        $worktime = Reflection::where('project_id', $id)->first();
        return $this->setResponse($worktime);
    }

    public function store(Request $request)
    {
        $project = Reflection::create($request->all());
        return response()->json($project, 201);
    }
}
