<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index(): Collection
    {
        return Transport::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'name' => 'required|string',
        ]);

        return Transport::create($request->all());
    }

    public function show(Transport $transport): Transport
    {
        return $transport;
    }

    public function update(Request $request, Transport $transport): Transport
    {
        $request->validate([
            'type' => 'string',
            'name' => 'string',
        ]);

        $transport->update($request->all());

        return $transport;
    }

    public function destroy(Transport $transport): JsonResponse
    {
        $transport->delete();

        return response()->json(null, 204);
    }
}
