<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Mostrar todos los usuarios
     */
    public function index()
    {
        //
        $users = User::all();

        return new UserCollection($users->load('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Crear un nuevo usuario
     */
    public function store(StoreUsersRequest $request)
    {
        //
    }

    /**
     * Mostar un usuario específico
     */
    public function show(User $user)
    {

        //
        return new UserResource($user);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users)
    {
        //
    }


    /**
     * Actualizar información de un usuario.
     */
    public function update(UpdateUsersRequest $request, User $users)
    {
        //
    }

    /**
     * Eliminar un usuario específico
     */
    public function destroy(User $users)
    {
        //
    }

    /**
     * Obtener las reservas de un usuario específico
     */

    public function bookings(User $user)
    {
        return $user->bookings;
    }
}
