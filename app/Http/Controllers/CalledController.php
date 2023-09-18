<?php

namespace App\Http\Controllers;

use App\Models\Called;
use App\Models\IslandStore;
use App\Models\Parts;
use App\Models\PMStore;
use App\Models\Status;
use App\Models\Technic;
use App\Models\Report;
use App\Models\ReportCalled;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CalledController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $callClose = Called::where('status_id', '>', 4)->get();
        $callOpen = Called::where('status_id', '<', 5)->where('status_id', '!=', 2)->limit(10)->get();
        $called = Called::where('status_id', 1)->get();
        $status = Status::where('id', '>', 1)->where('id', '<', 5)->get();
        $statusReport = Status::where('id', '>', 4)->where('id', '<', 7)->get();
        $technic = Technic::all();
        $part = Parts::with('pmStore')->with('islandStore')->get();

        // foreach($part as $parts){
        //     dd($parts->pmStore->amount);
        // }

        return Inertia::render('Dashboard',
        [
            'callclose' => $callClose,
            'callOpen' => $callOpen,
            'status' => $status,
            'statusReport' => $statusReport,
            'technic' => $technic,
            'called' => $called,
            'parts' => $part,
            // 'partPm' => $partPm,
            // 'partIsland' => $partIsland
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

        if ($request->close == 1) {
            Called::findOrFail($id)->update([
                'status_id' => $calledit['status_id'],
                'technic_id' => $calledit['technic_id'],
            ]);
        }else{
            Called::findOrFail($id)->update([
                'status_id' => $calledit['status_id'],
                'technic_id' => $calledit['technic_id'],
            ]);
            return redirect('/called')->with(['message' => 'Alterado status do equipamento!']);
        }

//        Called::findOrFail($id)->update([
//            'status_id' => $calledit['status_id'],
//            'technic_id' => $calledit['technic_id'],
//        ]);
//        return redirect('/called')->with(['message' => 'Alterado status do equipamento!']);

    }

    public function closeCall(Request $request, $id)
    {

        $calledit = $request->validate([
            'status_id' => ['required'],
            'technic_id' => ['required'],
        ]);

        Called::findOrFail($id)->update([
            'status_id' => 6,
            'technic_id' => $calledit['technic_id'],
        ]);
        return redirect('/called')->with(['message' => 'Alterado status do equipamento!']);

    }

    public function report(Request $request)
    {

        $report = $request->validate([
            'called_id' => ['required'],
            'status_id' => ['required'],
            'solution' => ['required'],
            'technic_id' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $calledReport = ReportCalled::create([
                'called_id' => $report['called_id'],
                'status_id' => $report['status_id'],
                'solution' => $report['solution'],
                'tech_report' => $request['tech_report'],
                'technic_id' => $report['technic_id'],

            ]);

            $items = collect($request['item']) ?? null;
            $items->each(function ($item) use ($calledReport) {

                // dd($item);

                // $part = Parts::with('pmStore')->with('islandStore')->where('parts_id', '=', $item['id'])->get();
                $storage = Parts::findOrFail($item['id']);

                if ($storage->amount > $item['quantity']){
                    $part = Parts::where('amount', '>', 0)->where('id', $item['id'])->first();
                    $partPm = PMStore::where('amount', '>', 0)->where('parts_id', $item['id'])->first();
                    $partIsland = IslandStore::where('amount', '>', 0)->where('parts_id', $item['id'])->first();
                    if($partPm->amount > $item['quantity']){
                        $over = $partPm->amount - $item['quantity'];
                        $overp = $part->amount - $item['quantity'];

                        echo "Tem mais peça PM do que a quantidade ". $over;

                        PMStore::findOrFail($partPm->id)->update([
                            'amount' => $over,
                        ]);
                        Parts::findOrFail($part->id)->update([
                            'amount' => $overp,
                        ]);

                        // dd($partPm->id);
                    } else {
                        $saldo = $item['quantity'] - $partPm->amount;
                        //
                        echo "Tem menos peça PM do que a quantidade ". $saldo;
                        dd($partPm->id);
                        dd($saldo);
                    }

                    echo "Tem em ". $storage->amount . " estoque";
                } else {

                    echo "Não tem em estoque";
                }

                // $partPm = PMStore::where('amount', '>', 0)->where('parts_id', $item['id'])->get();
                // dd($partPm);

                DB::commit();
            });

            return redirect('/called')->with(['message' => 'Serviço Realizado!']);
        } catch (Exception $e){
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";

            DB::rollback();
        }




        // foreach($request->items as $item){
        //     $idPart = $item["id"];
        //     $amountPart = $item["quantity"];
        // }
        // $amount = $request;
        // $parts = Parts::with('pmStore')->with('islandStore')->get();
        // foreach($parts as $part){
        //     dd($part);
        // }

        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Called $called)
    {
        //
    }
}
