<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Session;
class UAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function login(Request $request)
    {
        $LoginCheck = false;
        Session::put("sess_Lang", $request->input('Lang'));

        if ($request->filled('ID')) {
            $id = $request->input('ID');
            if ($id == 'user') {
                $id = strtoupper($id);
            }
            $pw = $request->input('PW');
            $pw_md5 = md5($pw);

            try {
                $result = DB::select("select * from UAC where U_ID = ? and (U_PASSWORD = ? or U_PASSWORD = ?)", [$id, $pw_md5, $pw]);

                if (!empty($result)) {
                    $row = $result[0];

                    $Access_Blob = $row->U_ACCESS; // Assuming U_ACCESS is a JSON string already

                    Session::put("sess_id", $id);
                    if (strlen($request->input('PW')) == 32) {
                        Session::put("sess_passwd", $request->input('PW'));
                    } else {
                        Session::put("sess_passwd", $pw_md5);
                    }

                    Session::put("sess_Access", json_decode($Access_Blob));
                    $LoginCheck = true;
                } else {
                    $LoginCheck = false;
                    Session::put("sess_id", "");
                    Session::put("sess_passwd", "");
                    Session::put("sess_Access", (object) [
                        "Holiday" => 0,
                        "WorkTime" => 0,
                        "Dep" => 0,
                        "Reader" => 0,
                        "Historys" => 0,
                        "ConvertHistory" => 0,
                        "Special_Query" => 0,
                        "User" => 0,
                        "Card" => 0,
                        "Groups" => 0,
                        "Attend" => 0,
                        "Permission" => 0
                    ]);
                }

                // Handle session checks here
                $sessionData = $this->checkSession();

                $RPData = [
                    "LoginCheck" => $LoginCheck,
                    "Session" => $sessionData
                ];

                return response()->json($RPData);
            } catch ( Exception  $e) {
                // Handle the exception
                // ...
            }
        }
    }



    public function checkSession()
    {
        // Check session and return relevant data
        $sessionData = [
            "sess_id" => Session::get("sess_id"),
            "sess_passwd" => Session::get("sess_passwd"),
            "sess_Access" => Session::get("sess_Access"),
            // Add more session data here as needed
        ];

        return $sessionData;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
