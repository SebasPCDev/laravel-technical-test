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
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(StoreToursRequest $request)
    {
        //
        return new TourResource(Tour::create($request->all()));
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(UpdateToursRequest $request, Tour $tour)
    {
        //
        return $tour->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
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
