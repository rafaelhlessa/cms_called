<?php

namespace App\Http\Controllers;
use App\Models\IslandStore;
use App\Models\Parts;
use App\Models\PMStore;
use App\Models\ReportCalled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Inertia\Inertia;
use App\Models\Status;
use App\Models\Technic;
use App\Models\Called;
use GuzzleHttp\Psr7\Header;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    private $baseUrl;
    private $client;

    public function loginToGLPI()
    {
        $apiUrl = 'https://suporte.pm.sc.gov.br/apirest.php/initSession/';
        $AuthToken = 'Uv7qaMuxBhR71xyx2Jc2andq3AjxvzyvcrVd8EZX';
        $AppToken = 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1';

        if (auth()->check()) {
            $user = auth()->user();
            // You can now access $user and perform actions related to the authenticated user

            $response = Http::withHeaders([
                'Authorization' => $AuthToken,
                'App-Token' => $AppToken,
            ])->withBasicAuth('933270', 'RL327#Hs')->withOptions(['verify' => false])->get($apiUrl);

            return response()->json([
                'message' => 'Session token generated and stored successfully.',
            ]);
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    }

    public function getLogin()
    {
        $login = Http::withHeaders([
            "Authorization" => "OTMzMjcwOlJMMzI3I0hz",
            'App-Token' => 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1',
        ])->withBasicAuth('933270', 'RL327#Hs')->withOptions(['verify' => false])->get('https://suporte.pm.sc.gov.br/apirest.php/initSession/');

        $log = json_decode($login, true);

        $token = $log['session_token'];

    }

    public function getTickets()
    {

        $login = Http::withHeaders([
            "Authorization" => Auth::user()->authorization,
            'App-Token' => 'wtfAh37wNZiQPpbO6flXxBlJKs32E4mBX28WzkJ1',
            'Session-Token' => Auth::user()->sessiontoken,
        ])->withBasicAuth('933270', 'RL327#Hs')->withOptions(['verify' => false])->get('https://suporte.pm.sc.gov.br/apirest.php/search/Ticket/?',[
            'order' => 'DESC',
            'range' => '0-10000',
            //'start'      => 0,      // start with first item (index 0)
            //'is_deleted' => 0,      // item is not deleted
            //'sort'       => 1,      // sort by name
            //'order'      => 'DESC',  // sort direction
            //'reset'      => 'reset',// reset search flag
           'criteria'   => [
                [
                    'field'      => 8,// field index in search options
                    'itemtype'   => 'Ticket',
                    'searchtype' => 'contains',  // type of search
                    'value'      => 'Manutenção',         // value to search
                ],
               [
                   'link'=>       'AND',
                   'itemtype'=>   'Ticket',
                   'field'=>      12,
                   'searchtype'=> 'lessthan',
                   'value'=>      6
               ]
            ],

        ]);

        $tickets = json_decode($login->getBody(), true);
        dd($tickets['data']);
        //dd($tickets);
        //$tickets = json_decode($login->getBody(), JSON_FORCE_OBJECT);

        $status = Status::where('id', '!=', 2)->where('id', '<', 5)->get();
        $technic = Technic::all();
        $callClose = Called::where('status_id', '>', 4)->get();
        $callOpen = Called::where('status_id', '<', 5)->where('status_id', '!=', 2)->limit(10)->get();
        $statusReport = Status::where('id', '=', 6)->get();
        $called = Called::where('status_id', 1)->get();


            return Inertia::render('Cadastros',
            [
                'call' => $tickets,
                'status' => $status,
                'technic' => $technic,
                'statusReport' => $statusReport,
                'callclose' => $callClose,
                'callOpen' => $callOpen,
                'called' => $called,
            ]);
    }

    public function create(Request $request)
    {
        $pim = explode("PIM - ", $request->name);

        // Define the separators
            $startSeparator = "&lt;/b&gt;&lt;p&gt;";
            $endSeparator = "&lt;/p&gt;&lt;/div&gt;&lt;div&gt;&lt;b&gt;12)";

        // Split the string into an array based on the start separator
            $parts = explode($startSeparator, $request);

        // Get the part after the start separator
            $partAfterStart = end($parts);

        // Split the part after the start separator based on the end separator
            $finalParts = explode($endSeparator, $partAfterStart);

        // Get the part before the end separator
            $desiredText = $finalParts[0];


        Called::create([
            'id' => $request['id'],
            'glpi' => $request['id'],
            'pim' => $pim[1],
            'service' => $desiredText,
            'created_at' => $request['date'],
            'updated_at' => $request['date_mod'],
            'name' => $request['name'],
            'status_id' => $request['status'],

        ]);

    }

    public function index()
    {
        $callClose = Called::where('status_id', '>', 4)->get();
        $callOpen = Called::where('status_id', '<', 5)->where('status_id', '!=', 2)->limit(10)->get();
        $called = Called::where('status_id', 1)->get();
        $status = Status::where('id', '>', 1)->where('id', '<', 5)->get();
        $statusReport = Status::where('id', '>', 4)->where('id', '<', 7)->get();
        $technic = Technic::all();
        $part = Parts::with('pmStore')->with('islandStore')->get();

        return Inertia::render('Cadastros',
            [
                'callclose' => $callClose,
                'callOpen' => $callOpen,
                'status' => $status,
                'statusReport' => $statusReport,
                'technic' => $technic,
                'called' => $called,
                'parts' => $part,

            ]);
    }

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

    public function report(Request $request)
    {

        dd($request);
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

                if ($storage->amount > $item['quantity']) {
                    $part = Parts::where('amount', '>', 0)->where('id', $item['id'])->first();
                    $partPm = PMStore::where('amount', '>', 0)->where('parts_id', $item['id'])->first();
                    $partIsland = IslandStore::where('amount', '>', 0)->where('parts_id', $item['id'])->first();
                    if ($partPm->amount > $item['quantity']) {
                        $over = $partPm->amount - $item['quantity'];
                        $overp = $part->amount - $item['quantity'];

                        echo "Tem mais peça PM do que a quantidade " . $over;

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
                        echo "Tem menos peça PM do que a quantidade " . $saldo;
                        dd($partPm->id);
                        dd($saldo);
                    }

                    echo "Tem em " . $storage->amount . " estoque";
                } else {

                    echo "Não tem em estoque";
                }

                // $partPm = PMStore::where('amount', '>', 0)->where('parts_id', $item['id'])->get();
                // dd($partPm);

                DB::commit();
            });

            return redirect('/called')->with(['message' => 'Serviço Realizado!']);
        } catch (Exception $e) {
            echo 'Exceção capturada: ', $e->getMessage(), "\n";

            DB::rollback();
        }
    }
}
