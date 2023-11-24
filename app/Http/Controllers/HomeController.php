<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\WebsiteLog;
use App\Models\ApiLog;
use Exception;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function search() {
        return view('website.home.search');
    }

    public function searchFlights()
    {
        try {

            $client = new \GuzzleHttp\Client();

            $headers = [
                'Content-Type' => 'application/json',
            ];

            $body = '{
                "Segment": [
                    {
                        "DepFrom": "DXB",
                        "ArrTo": "AMM",
                        "DepDate": "2023-12-31"
                    }
                ],
                "tripType": "oneway",
                "Adult": 1,
                "Child": 0,
                "Infant": 0,
                "Class": "Economy"
            }';

            $request = new \GuzzleHttp\Psr7\Request('POST', 'https://gallpax.flyjatt.com/v1/Duffel/AirSearch.php', $headers, $body);

            $res = $client->sendAsync($request)->wait();

            ApiLog::create([
                'log' => $res->getBody()
            ]);

            $api_data = json_decode($res->getBody(), true);

            ////////////////////////////////////////////////////////////////////

            $flights = Flight::get(['id','offer_id','caree','total_fare','currency'])->toArray();

            return response()->json([
                'status' => 'success',
                'api_arr' => $api_data,
                'flights' => $flights,
            ]);


        } catch(Exception $exception) {

            return response()->json([
                'status' => 'error',
            ]);

        }

    }
}
