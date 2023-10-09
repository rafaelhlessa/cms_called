<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Maintenance;
use App\Models\UsedVtr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Cars::all();

        return Inertia::render('P4/Cars/ListCars',
            [
                'cars' => $cars,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('P4/Cars/CreateCars');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $cars = $request->validate([
                'plate' => ['required'],
                'brandmodel' => ['required'],
                'km' => ['required'],
                'fuel' => ['required'],
            ]);


            Cars::create([
                'plate' => $cars['plate'],
                'brandmodel' => $cars['brandmodel'],
                'km' => $cars['km'],
                'fuel' => $cars['fuel'],
                'used' => 0,
            ]);

            DB::commit();

            return redirect('/cars')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/cars')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Cars::findOrFail($id);
        $maint = Maintenance::where('cars_id', $id)->orderBy('id', 'desc')->get();

        return Inertia::render('P4/Cars/ShowCars',
            [
                'car' => $car,
                'maint' => $maint,
            ]
        );
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

    public function vtrs()
    {
        $cars = Cars::all();

        return Inertia::render('P4/Vtrs',
            [
                'cars' => $cars,
            ]);
    }
}
