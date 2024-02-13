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
        $worktime = Worktime::create($request->all());
        return $this->setResponse($worktime, "工数登録しました");
    }

    public function update($id, $worktime_id, Request $request)
    {
        $worktime = Worktime::findOrFail($worktime_id);
        $worktime->update($request->all());
        return $this->setResponse($worktime, "工数更新しました");
    }
}
