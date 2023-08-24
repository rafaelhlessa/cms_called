<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getData(Request $request) {
        // Process data and return response
    }

    public function processData(Request $request) {
        $jsonData = $request->json()->all();
        // Process $jsonData
    }
}


