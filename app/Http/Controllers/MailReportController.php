<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MailReportController extends Controller
{
    public function index($pg)
    {
        $page = $pg;
        // //處理頁數
        if ($page <= 0 ) {$page = 1;}
      
        $OnePage = 10;
        $skip = $OnePage * ($page-1);
      
        $sql = "SELECT FIRST 10";
        if ($skip > 0) {
          $sql.= " skip ".$skip;  
        }  
        $sql.="  G_IDX, G_NAME, G_PRIORITY ,G_USERIDX FROM GROUPS WHERE G_USERIDX is null  ";

        $Group = DB::select( $sql );
        return response()->json($Group);
    }
    public function create()
    {
        //
        return "new ";
        
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
        return "update ".$id;
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
        $sql = "DELETE  FROM Groups where G_IDX =  ".$id;
        
        DB::delete($sql);
        return "delete ".$id;
    }
}
