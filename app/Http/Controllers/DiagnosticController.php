<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

        //creates the new diagnostic and saves it to DB
        $diagnostic = Diagnostic::create([
            'free_cash_flow' => $validatedData['free_cash_flow'],
            'accounts_payable_turnover' => $validatedData['accounts_payable_turnover'],
            'operating_margin' => $validatedData['operating_margin'],
            'sales_per_employee' => $validatedData['sales_per_employee'],
            'asset_turnover' => $validatedData['asset_turnover'],
            'total_debt' => $validatedData['total_debt'],
            'current_ratio' => $validatedData['current_ratio'],
            'revenue_growth' => $validatedData['revenue_growth'],
            'return_on_assets' => $validatedData['return_on_assets']
        ]);

        //creates the classification
        $answer= requestAPI('http://localhost:8080/predict',
        array(
            'free_cash_flow_to_total_debt' => $validatedData['free_cash_flow'],
            'accounts_ayable_turnover' => $validatedData['accounts_payable_turnover'],
            'operating_margin' => $validatedData['operating_margin'],
            'sales_per_employee' => $validatedData['sales_per_employee'],
            'asset_turnover' => $validatedData['asset_turnover'],
            'total_debt_to_total_assets' => $validatedData['total_debt'],
            'current_ratio' => $validatedData['current_ratio'],
            'revenue_growth_year_over_year' => $validatedData['revenue_growth'],
            'return_on_assets' => $validatedData['return_on_assets']
        )
        );
        dd($answer);
        
        
        //creates the advise


        return response()->json([
            "message" => "Diagnostic created successfully",
            "data" => $organization,
        ], 201);

    }

    public function requestAPI($url,$data)
    {
        $client = new Client();
        $api_url = $url;

        $response = $client->post(
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