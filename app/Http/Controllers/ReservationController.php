<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(): Collection|array
    {
        return Reservation::with('transport', 'user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'transport_id' => 'required|exists:transports,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
        ]);

        return Reservation::create($request->all());
    }

    public function show(Reservation $reservation)
    {
        return $reservation->load('transport', 'user');
    }

    public function update(Request $request, Reservation $reservation): Reservation
    {
        $request->validate([
            'user_id' => 'exists:users,id',
            'transport_id' => 'exists:transports,id',
            'departure_time' => 'date',
            'arrival_time' => 'date',
        ]);

        $reservation->update($request->all());

        return $reservation;
    }

    public function destroy(Reservation $reservation): JsonResponse
    {
        $reservation->delete();

        return response()->json(null, 204);
    }
}
