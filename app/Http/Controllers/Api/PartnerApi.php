<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerApi extends ApiController
{
    public function index()
    {
        $partners = Partner::all();
        return $this->setResponse($partners);
    }

    public function show($id)
    {
        $partner = Partner::findOrFail($id);
        return $this->setResponse($partner);
    }

    public function store(Request $request)
    {
        $partner = Partner::create($request->all());
        return response()->json($partner, 201);
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update($request->all());
        return response()->json($partner);
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return response()->json(null, 204);
    }
}
