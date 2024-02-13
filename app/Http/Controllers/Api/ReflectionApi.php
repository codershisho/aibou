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
        $reflection = Reflection::create($request->all());
        return $this->setResponse($reflection, "振り返り登録しました");
    }

    public function update($id, $reflection_id, Request $request)
    {
        logger("aa");
        logger($reflection_id);
        $reflection = Reflection::findOrFail($reflection_id);
        $reflection->update($request->all());
        return $this->setResponse($reflection, "振り返り更新しました");
    }
}
