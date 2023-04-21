<?php

namespace App\Http\Controllers;

use App\Models\Called;
use App\Models\Status;
use App\Models\Technic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CalledController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $callClose = Called::where('status_id', '>', 4)->get();
        $callOpen = Called::where('status_id', '<', 5)->where('status_id', '!=', 2)->limit(10)->get();
        $called = Called::where('status_id', 2)->get();
        $status = Status::where('id', '<', 5)->get();
        $technic = Technic::all();
        return Inertia::render('Dashboard',
        [
            'callclose' => $callClose,
            'callOpen' => $callOpen,
            'status' => $status,
            'technic' => $technic,
            'called' => $called
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Status::all();
        return Inertia::render('Entrada', ['status' => $status, 'message' => session('message')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $called = $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'glpi' => ['required'],
            'pim' => ['required'],
            'service' => ['required'],
        ]);
//        dd($identification);

        Called::create([
            'name' => $called['name'],
            'phone' => $called['phone'],
            'glpi' => $called['glpi'],
            'pim' => $called['pim'],
            'status_id' => 1,
            'service' => $called['service']
        ]);
        return redirect('/called')->with(['message' => 'Novo cadastro criado com sucesso!']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Called $called)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Called $called)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $calledit = $request->validate([
            'status_id' => ['required'],
            'technic_id' => ['required'],
        ]);

        Called::findOrFail($id)->update([
            'status_id' => $calledit['status_id'],
            'technic_id' => $calledit['technic_id'],
        ]);
        return redirect('/called')->with(['message' => 'Alterado status do equipamento!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Called $called)
    {
        //
    }
}
