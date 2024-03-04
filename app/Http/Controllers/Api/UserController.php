<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Traits\HttpResponser\HttpResponser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HttpResponser;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(UserService $service)
    {
        $user = $service->login();

        if ($user) {
            return $this->sendJsonResponse(true, 200, $user);
        } else {
            return $this->sendErrorResponse(false, 500, $user);
        }
    }

    public function register(UserService $service)
    {
        $user = $service->register();

        if ($user) {
            return $this->sendJsonResponse(true, 200, $user);
        } else {
            return $this->sendErrorResponse(false, 500, $user);
        }
    }
}
