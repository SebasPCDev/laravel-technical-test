<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingsRequest;
use App\Http\Requests\UpdateBookingsRequest;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\BookingResource;
use App\Models\Booking;

class BookingsController extends Controller
{
    /**
     * Mostrar todas las reservas
     */
    public function index()
    {
        //
        $bookings = Booking::paginate();
        return new BookingCollection($bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Crear una nueva reserva
     */
    public function store(StoreBookingsRequest $request)
    {
        //

        //Validar si el usuario ya tiene una reserva para el mismo tour
        $existingBooking = Booking::where('user_id', $request->user_id)
            ->where('tour_id', $request->tour_id)
            ->where('status', 'pending')
            ->first();

        if ($existingBooking) {
            return response()->json([
                'message' => 'Ya tienes una reserva pendiente para este tour.'
            ], 400);
        }

        return new BookingResource(Booking::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $bookings)
    {
        //
        return new BookingResource($bookings);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $bookings)
    {
        //
    }

    /**
     * Actualizar información de la reserva
     */
    public function update(UpdateBookingsRequest $request, Booking $booking)
    {
        //
        $booking->update($request->all());

        $bookingUpdated = $this->show($booking);
        return response()->json([
            'message' => 'Reserva actualizada',
            'status' => 200,
            'data' => $bookingUpdated
        ]);


    }

    /**
     * Eliminar una reserva específica
     */
    public function destroy(Booking $bookings)
    {
        //
    }
}
