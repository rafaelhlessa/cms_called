<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Drivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Session;
use Inertia\Inertia;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $drivers = Drivers::all();

        return Inertia::render('P4/Drivers/DriversList',
            [
                'drivers' => $drivers,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

            return Inertia::render('P4/Drivers/DriversCreate');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {


            DB::beginTransaction();

            $driver = $request->validate([
                'name' => ['required'],
                'location' => ['required'],
                'phone' => ['required'],
                'password' => ['required'],
            ]);


            Drivers::create([
                'name' => $driver['name'],
                'location' => $driver['location'],
                'phone' => $driver['phone'],
                'password' => $driver['password']
            ]);

            DB::commit();

            return redirect('/drivers')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/drivers')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
        }

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
}
