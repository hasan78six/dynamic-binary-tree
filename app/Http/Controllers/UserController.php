<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Intializing variables
        $response = null;
        $responseCode = 201;

        try {
            // Fetch Json data
            $data = $request->json()->all();

            // Intializing rules array
            $rules = [
                'username' => ['required', 'string', 'alpha_dash', 'max:30','unique:members,username'],
                'name' => ['required', 'string', 'max:50'],
                'sponsor_username' => ['required', 'string', 'alpha_dash', 'max:30'],
                "position" => ['required', 'string', "in:right,left"]
            ];

            // Validating json data
            $validator = Validator::make($data, $rules);

            // Checking if json data is valid
            if ($validator->passes()) {
                // Getting valid data fields
                $fields = $validator->valid();

                // Getting sponsor detail by username
                $sponser = Member::where('username', $fields["sponsor_username"])->first();

                // Checking if sponsor is not empty
                if (!empty($sponser)) {
                    $checkUser = Member::where('sponsor_id', $sponser->id)
                        ->where('position', strtolower(trim($fields["position"])))->first();

                    if(empty($checkUser)){
                        // Creating new member under sponser
                        Member::create([
                            'username' => strtolower(trim($fields["username"])),
                            'name' => ucwords(trim($fields["name"])),
                            'sponsor_id' => $sponser->id,
                            'position' => strtolower(trim($fields["position"]))
                        ]);

                        // Returning success message in response
                        $response = ["success" => true, "message" => "Member registered successfully."];
                    }else{
                        // Returning error in response
                        $response = ["success" => false, "message" => "You already have a member on this position"];
                        $responseCode = 400;
                    }
                } else {
                    // Returning error in response
                    $response = ["success" => false, "message" => "No sponser found with this username."];
                    $responseCode = 400;
                }
            } else {
                // Returning error in response
                $response = $response = ["success" => false, "message" => "Ops please provide valid data.",
                    "errors" => $validator->errors()->all()];
                $responseCode = 400;
            }
        } catch (Exception $ex) {
            // Returning error in response
            $response = ["success" => false, "message" => $ex->getMessage()];
            $responseCode = 400;
        }

        // Returning response
        return Response::json($response, $responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Intialize variable
        $response = null;
        $responseCode = 200;

        try {
            // Fetch Json data
            $data = $request->json()->all();

            // Intializing rules array
            $rules = [
                'sponsor_username' => ['required', 'string', 'alpha_dash', 'max:30']
            ];

            // Validating json data
            $validator = Validator::make($data, $rules);

            // Checking if json data is valid
            if ($validator->passes()) {
                // Getting valid data fields
                $fields = $validator->valid();

                // Fetching member by username
                $sponser = Member::where('username', $fields["sponsor_username"])->first();

                // Checking if sponser not empty
                if (!empty($sponser)) {
                    // Fetching members by sponsor id
                    $members = Member::where('sponsor_id', $sponser->id)->orderBy('position', 'ASC')->with(["children"])->get();

                    // Returning member data in response
                    $response = ["success" => true, "data" => $members];
                } else {
                    // Returning error in response
                    $response = ["success" => false, "message" => "No sponser found with this username."];
                    $responseCode = 400;
                }
            } else {
                // Returning error in response
                $response = $response = ["success" => false, "message" => "Ops please provide valid data.",
                    "errors" => $validator->errors()->all()];
                $responseCode = 400;
            }
        } catch (Exception $ex) {
            // Returning error in response
            $response = ["success" => false, "message" => $ex->getMessage()];
            $responseCode = 400;
        }

        // Returning response
        return Response::json($response, $responseCode);
    }
}
