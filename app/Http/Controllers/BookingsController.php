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
        dd($request->all());
        return new BookingResource(Booking::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $bookings)
    {
        //

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

        return $booking->update($request->all());

    }

    /**
     * Eliminar una reserva específica
     */
    public function destroy(Booking $bookings)
    {
        //
    }
}
