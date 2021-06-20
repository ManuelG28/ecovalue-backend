<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function create(Request $request)
    {
        //checks field correctness
        $validator = Organization::validate($request);
        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data",
                "errors" => $validator->errors()->all(),
            ], 400);
        }
        $validatedData = $validator->validated();

        //creates the new queue and saves it to DB
        $organization = Organization::create([
            "name" => $validatedData["name"],
            "user_id" => $request->user()->getId(),
        ]);
        return response()->json([
            "message" => "Organization created successfully",
            "data" => $organization,
        ], 201);
    }

    public function list(Request $request)
    {
        return response()->json([
            OrganizationResource::collection(Organization::all()),
        ]);
    }

    public function delete(Request $request)
    {
        //checks field correctness
        if (!$request->filled("id")) {
            return response()->json([
                "message" => "Invalid data",
                "errors" => ["Organization ID not provided"],
            ], 400);
        }

        $organization = Organization::where("id", $request["id"])
            ->where("user_id", $request->user()->getId())
            ->first();

        if ($organization) {
            $organization->delete();
            return response()->json([
                "message" => "Organization deleted successfully",
            ]);
        } else {
            return response()->json([
                "message" => "Not found",
                "errors" => ["There is not organization with this name in your ownership"],
            ], 404);
        }
    }

}
