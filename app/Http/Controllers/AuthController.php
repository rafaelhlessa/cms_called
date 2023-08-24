<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Inertia\Inertia;
use App\Models\Status;
use App\Models\Technic;
use App\Models\Called;

class AuthController extends Controller
{

    private $baseUrl;
    private $client;

    public function __construct()
    {
        //

    }


    public function getTickets()
    {

        $login = Http::withHeaders([
            "Authorization" => "cmFmYWVsaGxlc3NhOjEyMzQ1Njc4",
            'App-Token' => 'sFv5CtqlnZuxr6HvlMMFJUmYT3dyCB9q0uUWsW6G',
            'Session-Token' => '0qljj6a5odjp4slhpffs4ar5dt'
        ])->withBasicAuth('glpi', '12345678')->get('http://127.0.0.1/glpi-10.0.9/glpi/apirest.php/Ticket/');

        $tickets = json_decode($login->getBody(), true);

        $status = Status::where('id', '!=', 2)->where('id', '<', 5)->get();
        $technic = Technic::all();
        $callClose = Called::where('status_id', '>', 4)->get();
        $callOpen = Called::where('status_id', '<', 5)->where('status_id', '!=', 2)->limit(10)->get();
        $called = Called::where('status_id', 2)->get();

            return Inertia::render('Cadastros',
            [
                'call' => $tickets,
                'status' => $status,
                'technic' => $technic,
                'callclose' => $callClose,
                'callOpen' => $callOpen,
                'called' => $called,
            ]);
    }

    public function create(Request $request)
    {
        $login = Http::withHeaders([
            "Authorization" => "cmFmYWVsaGxlc3NhOjEyMzQ1Njc4",
            'App-Token' => 'sFv5CtqlnZuxr6HvlMMFJUmYT3dyCB9q0uUWsW6G',
            'Session-Token' => '0qljj6a5odjp4slhpffs4ar5dt'
        ])->withBasicAuth('glpi', '12345678')->get('http://127.0.0.1/glpi-10.0.9/glpi/apirest.php/Ticket/');

        $tickets = json_decode($login->getBody(), true);

        Called::create([
            'id' => $request['id'],
            'glpi' => $request['id'],
            'created_at' => $request['date'],
            'updated_at' => $request['date_mod'],
            'name' => $request['name'],
            'status_id' => $request['status'],

        ]);

    }

    public function index()
    {

    }

    public function update(Request $request, $id)
    {

        dd($request);
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
}
