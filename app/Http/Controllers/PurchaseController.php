<?php

namespace App\Http\Controllers;

use App\Models\IslandStore;
use App\Models\Parts;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $purchase = Purchase::all();
        $parts = Parts::where('parts_type_id', 2)->get();
        $purchase = Purchase::all();


        return Inertia::render('Maintenance/Purchase/ListPurchase',
        [
            'purchase' => $purchase,
            'parts' => $parts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parts = Parts::all();

        return Inertia::render('Maintenance/Purchase/CreatePurchase',[
            'parts' => $parts,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $purchase = $request->validate([
                'priceu' => ['required'],
                'amount' => ['required'],
                'parts_id' => ['required'],
            ]);

            $buy_date = now();

            $pricet = $purchase['priceu']*$purchase['amount'];

            Purchase::create([
                'priceu' => $purchase['priceu'],
                'amount' => $purchase['amount'],
                'buy_date' => $buy_date,
                'pricet' => $pricet,
                'parts_id' => $purchase['parts_id'],

            ]);

            $islandParts = IslandStore::where('parts_id', $purchase['parts_id'])->first();

            if(isset($islandParts->amount)){
                $over = $islandParts->amount+$purchase['amount'];

                IslandStore::findOrFail($islandParts->id)->update([
                        'amount' => $over,

                ]);

            }else{
                $over = $purchase['amount'];

                IslandStore::create([
                    'amount' => $over,
                    'parts_id' => $purchase['parts_id'],
                ]);

            }

            $parts = Parts::where('id', $purchase['parts_id'])->first();

            // dd($parts);

            if(isset($parts->amount)){
                $over = $parts->amount+$purchase['amount'];

                Parts::findOrFail($parts->id)->update([
                        'amount' => $over,

                ]);
            }


            DB::commit();

            return redirect('/purchases')->with(['message' => 'Nova compra registrada com sucesso!']);

        } catch (\Exception $e) {
            DB::rollback();

            return redirect('/purchases')->with(['error' => 'Não foi possível registrar a compra, tente novamente mais tarde.']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
