<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Classification;
use App\Models\Advise;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;

class DiagnosticController extends Controller
{
    public function create(Request $request)
    {
        $validator = Diagnostic::validate($request);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data",
                "errors" => $validator->errors()->all(),
            ], 400);
        }
        $validatedData = $validator->validated();

        $data= 
        [
            'free_cash_flow_to_total_debt' => $validatedData['free_cash_flow_to_total_debt'],
            'accounts_payable_turnover' => $validatedData['accounts_payable_turnover'],
            'operating_margin' => $validatedData['operating_margin'],
            'sales_per_employee' => $validatedData['sales_per_employee'],
            'asset_turnover' => $validatedData['asset_turnover'],
            'total_debt_to_total_assets' => $validatedData['total_debt_to_total_assets'],
            'current_ratio' => $validatedData['current_ratio'],
            'revenue_growth_year_over_year' => $validatedData['revenue_growth_year_over_year'],
            'return_on_assets' => $validatedData['return_on_assets']
        ];
        //creates the new diagnostic and saves it to DB
        $diagnostic = Diagnostic::create($data);

        //creates the classification
           
        $answer = Http::post('http://localhost:8080/predict', $data);

        $answer = json_decode($answer->getBody());
        $classification= Classification::create([
            'cluster' => $answer->{'cluster'},
            'human_readable_msg' => $answer->{'state'} 
        ]);
        
        $diagnostic -> setClassification($classification->getId());

        //creates the advise

        $answer = Http::post('http://localhost:4500/recommend', $data);

        $answer = json_decode($answer->getBody());
        

        $advise= Advise::create([
            'leverage' => $answer->{'apalancamiento'},
            'growth' => $answer->{'crecimiento'},
            'eficiency' => $answer->{'eficiencia'},
            'liquidity' => $answer->{'liquidez'},
            'cost_effectiveness' => $answer->{'rentabilidad'},
            'solvency' => $answer->{'solvencia'}
        ]);

        $diagnostic -> setAdvise($advise->getId());

        return response()->json([
            "message" => "Diagnostic created successfully",
            "data" => $diagnostic,
        ], 201);

    }

    public function requestAPI($url,$data)
    {
        $client = new Client();
        $api_url = $url;

        $response = $client->request('POST',
            $api_url, 
            $data
        );

        $responseBody = json_decode($response->getBody());

        return $responseBody;
    
    }


    public function list(Request $request)
    {
        
    }

    public function delete(Request $request)
    {
        //checks field correctness
        if (!$request->filled("id")) {
            return response()->json([
                "message" => "Invalid data",
                "errors" => ["Diagnostic ID not provided"],
            ], 400);
        }

        $diagnostic = Diagnostic::where("id", $request["id"])
            ->where("user_id", $request->user()->getId())
            ->first();

        if ($diagnostic) {
            $diagnostic->delete();
            return response()->json([
                "message" => "Diagnostic deleted successfully",
            ]);
        } else {
            return response()->json([
                "message" => "Not found",
                "errors" => ["There is not a diagnostic associated to your organization"],
            ], 404);
        }
    }

}