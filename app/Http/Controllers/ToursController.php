<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToursRequest;
use App\Http\Requests\UpdateToursRequest;
use App\Http\Resources\TourCollection;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ToursController extends Controller
{
    /**
     * Mostrar todos los tours
     */
    public function index()
    {
        //
        $tours = Tour::paginate();
        return new TourCollection($tours);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Guardar un nuevo tour
     */
    public function store(StoreToursRequest $request)
    {
        //
        return new TourResource(Tour::create($request->all()));
    }

    /**
     * Mostrar un tour específico
     */
    public function show(Tour $tour)
    {

        //
        return new TourResource($tour);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tours)
    {
        //
    }

    /**
     * Actualizar un tour específico
     */
    public function update(UpdateToursRequest $request, Tour $tour)
    {
        //


        $tour->update($request->all());

        $tourUpdated = $this->show($tour);
        return $tourUpdated;
    }

    /**
     * Eliminar un tour en específico
     */
    public function destroy(Tour $tour)
    {
        try {
            $tour->delete();
            return response()->json([
                'message' => 'Tour deleted',
                'status' => 204,
            ], 204);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }


    }
}
