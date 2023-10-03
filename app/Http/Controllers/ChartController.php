<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getAcquisition()
    {

        $login1 = Http::withHeaders([
            "Authorization" => Auth::user()->authorization,
            'App-Token' => 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1',
            'Session-Token' => Auth::user()->sessiontoken,
        ])->withBasicAuth('cms', '6hybWpJpbjM')->withOptions(['verify' => false])->get('https://suporte.pm.sc.gov.br/apirest.php/search/Ticket/?', [
            'order' => 'DESC',      // sort direction
            'range' => '0-30000',   // range
            'is_deleted' => 0,      // item is not deleted
            'criteria' => [
                [
                    'field' => 8,              // field index in search options
                    'itemtype' => 'Ticket',
                    'searchtype' => 'contains',     // type of search
                    'value' => 'Pedido de Aquisição',   // value to search
                ],
            ],

        ]);

        $login2 = Http::withHeaders([
            "Authorization" => Auth::user()->authorization,
            'App-Token' => 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1',
            'Session-Token' => Auth::user()->sessiontoken,
        ])->withBasicAuth('cms', '6hybWpJpbjM')->withOptions(['verify' => false])->get('https://suporte.pm.sc.gov.br/apirest.php/search/Ticket/?', [
            'order' => 'DESC',      // sort direction
            'range' => '0-30000',   // range
            'is_deleted' => 0,      // item is not deleted
            'criteria' => [
                [
                    'field' => 8,              // field index in search options
                    'itemtype' => 'Ticket',
                    'searchtype' => 'contains',     // type of search
                    'value' => 'Manutenção',   // value to search
                ],
            ],

        ]);

        $login3 = Http::withHeaders([
            "Authorization" => Auth::user()->authorization,
            'App-Token' => 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1',
            'Session-Token' => Auth::user()->sessiontoken,
        ])->withBasicAuth('cms', '6hybWpJpbjM')->withOptions(['verify' => false])->get('https://suporte.pm.sc.gov.br/apirest.php/search/Ticket/?', [
            'order' => 'DESC',      // sort direction
            'range' => '0-30000',   // range
            'is_deleted' => 0,      // item is not deleted
            'criteria' => [
                [
                    'field' => 8,              // field index in search options
                    'itemtype' => 'Ticket',
                    'searchtype' => 'contains',     // type of search
                    'value' => 'Câmera',   // value to search
                ],
            ],

        ]);

        $acquisition = json_decode($login1->getBody(), true);
        $maintenance = json_decode($login2->getBody(), true);
        $camera = json_decode($login3->getBody(), true);

        return Inertia::render('Charts',
            [
                'acquisition' => $acquisition['data'],
                'maintenance' => $maintenance['data'],
                'camera' => $camera['data'],
            ]);
    }

    public function getMaintenance()
    {

        $login = Http::withHeaders([
            "Authorization" => Auth::user()->authorization,
            'App-Token' => 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1',
            'Session-Token' => Auth::user()->sessiontoken,
        ])->withBasicAuth('cms', '6hybWpJpbjM')->withOptions(['verify' => false])->get('https://suporte.pm.sc.gov.br/apirest.php/search/Ticket/?', [
            'order' => 'DESC',      // sort direction
            'range' => '0-30000',   // range
            'is_deleted' => 0,      // item is not deleted
            'criteria' => [
                [
                    'field' => 8,              // field index in search options
                    'itemtype' => 'Ticket',
                    'searchtype' => 'contains',     // type of search
                    'value' => 'Manutenção',   // value to search
                ],
            ],

        ]);


        $tickets = json_decode($login->getBody(), true);

        return Inertia::render('Charts',
            [
                'maintenance' => $tickets['data'],
            ]);
    }

    public function getCamera()
    {

        $login = Http::withHeaders([
            "Authorization" => Auth::user()->authorization,
            'App-Token' => 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1',
            'Session-Token' => Auth::user()->sessiontoken,
        ])->withBasicAuth('cms', '6hybWpJpbjM')->withOptions(['verify' => false])->get('https://suporte.pm.sc.gov.br/apirest.php/search/Ticket/?', [
            'order' => 'DESC',      // sort direction
            'range' => '0-30000',   // range
            'is_deleted' => 0,      // item is not deleted
            'criteria' => [
                [
                    'field' => 8,              // field index in search options
                    'itemtype' => 'Ticket',
                    'searchtype' => 'contains',     // type of search
                    'value' => 'Câmera',   // value to search
                ],
            ],

        ]);

        $tickets = json_decode($login->getBody(), true);


        return Inertia::render('Charts',
            [
                'camera' => $tickets['data'],
            ]);
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
}
