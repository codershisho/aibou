<?php

namespace App\Http\Controllers\Api;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingApi extends ApiController
{
    public function index($id)
    {
        $meetings = Meeting::where('project_id', $id)->get();
        return $this->setResponse($meetings);
    }

    public function store($id, Request $request)
    {
        $meeting = Meeting::create($request->all());
        return $this->setResponse($meeting, "会議登録しました");
    }
}
