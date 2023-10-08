<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Drivers;
use App\Models\Factorye;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MaintenanceController extends Controller
{
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
        return Inertia::render('P4/Maintenance/CreateMaintenance');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $carsMaint = $request->validate([
                'factory_id' => ['required'],
                'active' => ['required'],
                'drivers_id' => ['required'],
            ]);

            Maintenance::create([
                'cars_id' => $request['cars_id'],
                'factory_id' => $carsMaint['factory_id'],
                'active' => $carsMaint['active'],
                'drivers_id' => $carsMaint['drivers_id'],
                'description' => $request['description'],
                'oil' => $request['oil'],
                'icon' => 'WrenchIcon',
                'iconBackground' => 'bg-red-500'
            ]);

            $cars = Cars::where('id', $request['cars_id'])->first();

            if ($request['oil'] === null){
                $oil = $cars->kmoil;
            } else {
                $oil = $request['oil']+$cars->km;
            }

            Cars::findOrFail($request['cars_id'])->update([
                    'kmoil' => $oil,
                    'operation' => $carsMaint['active']
            ]);


            DB::commit();

            return redirect('/cars')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect('/cars')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
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

    public function carMaint(string $id)
    {
        $car = Cars::findOrFail($id);
        $drivers = Drivers::all();
        $factorye = Factorye::all();


        return Inertia::render('P4/Maintenance/CreateMaintenance',
        [
            'car' => $car,
            'driver' => $drivers,
            'factorye' => $factorye
        ]
        );
    }
}
