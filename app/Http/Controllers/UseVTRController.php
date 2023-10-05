<?php

namespace App\Http\Controllers;

use App\Models\Called;
use App\Models\Cars;
use App\Models\Drivers;
use App\Models\UsedVtr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UseVTRController extends Controller
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
        return Inertia::render('P4/UseVTR');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        try {
            DB::beginTransaction();


            $usedVtr = $request->validate([
                'kmstart' => ['required'],
                'fuel' => ['required'],
                'drivers_id' => ['required'],
                'vtr_id' => ['required']
            ]);


            $used = UsedVtr::create([
                'cars_id' => $usedVtr['vtr_id'],
                'kmstart' => $usedVtr['kmstart'],
                'fuel' => $usedVtr['fuel'],
                'drivers_id' => $usedVtr['drivers_id'],
                'date_go' => now(),
                'used' => 1
            ]);

            $cars = Cars::where('id', $used->cars_id)->first();

            Cars::findOrFail($cars->id)->update([
                        'used' => 1,
                    ]);

            DB::commit();

//            return redirect('/useVtr')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

//            return redirect('/useVtr')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
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
        try {
            DB::beginTransaction();

        $usededit = $request->validate([
            'kmend' => ['required'],
            'fuel' => ['required'],
        ]);


        UsedVtr::findOrFail($request->id)->update([
            'kmend' => $usededit['kmend'],
            'fuel' => $usededit['fuel'],
            'date_back' => now(),
        ]);


        Cars::findOrFail($request->vtr_id)->update([
                'km' => $usededit['kmend'],
                'fuel' => $usededit['fuel'],
                'used' => 0
            ]);
//            return redirect('/called')->with(['message' => 'Alterado status do equipamento!']);

            DB::commit();

//            return redirect('/useVtr')->with(['message' => 'Novo produto criado com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

//            return redirect('/useVtr')->with(['error' => 'Não foi possível registrar produto, tente novamente mais tarde.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function used($id)
    {
        $car = Cars::findOrFail($id);
        $driver = Drivers::all();
        $usedvtr = UsedVtr::where('cars_id', $car->id)->first();


        return Inertia::render('P4/UseVTR',
            [
                'car' => $car,
                'driver' => $driver,
                'usedvtr' => $usedvtr,

            ]);


    }

}
