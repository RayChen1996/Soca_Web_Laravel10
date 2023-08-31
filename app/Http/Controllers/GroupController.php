<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // 导入 DB 类
use App\Models\Group;

/**
 
 * @OA\Tag(name="Group")
 */
class GroupController extends Controller
{
    /**
     * 
     */
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





    /***
     * 
     * 
     */
    public function PersonalGroup($pg)
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
        $sql.="  G_IDX, G_NAME, G_PRIORITY ,G_USERIDX FROM GROUPS WHERE G_USERIDX is not null  ";


        $Group = DB::select( $sql  );
    
         
        return response()->json($Group);
    }






    public function GroupUserCount($id)
    {


      
      

        $sql = "SELECT  count(c.C_CARD)   ";
       
 
        $sql.= " FROM LIMIT l";
        $sql.= " inner join CARDS c on l.C_IDX = c.C_IDX";
        $sql.= " left join USERS u on u.U_IDX = c.U_IDX";
        $sql.= " where l.G_IDX = ".$id;
         


        $Group = DB::select($sql);
    
    
    
        return response()->json($Group);
    }




    public function GetCount()
    {


      
      

        $sql = "SELECT  count(G_IDX)   ";
       
 
        $sql.= " FROM GROUPS ";
    
         


        $Group = DB::select($sql);
    
    
    
        return response()->json($Group);
    }





    public function GroupUserList($id,$pg)
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
        $sql.= "   C_CARD, U_NAME";
        $sql.= " FROM LIMIT l";
        $sql.= " inner join CARDS c on l.C_IDX = c.C_IDX";
        $sql.= " left join USERS u on u.U_IDX = c.U_IDX";
        $sql.= " where l.G_IDX = ".$id;
        $sql.= " order by C_CARD";


        $Group = DB::select($sql);
    
    
    
        return response()->json($Group);
    }


    public function GroupReaderSet($id,$pg)
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
        $sql.= "   p.R_IDX,r.R_NAME,P_TIMEZONEIDX,P_TIMEZONEGROUPIDX,P_READPOINT,TIMEZONENAME,R_MODEL,R_TIMEZONEGROUP,PARKINGGROUP,JSON";
        $sql.= " from PERMIT p";
        $sql.= " inner join READER r on p.R_IDX = r.R_IDX";
        $sql.= " left join PARKING_SPACE ps on ps.READERIDX = p.R_IDX";
        $sql.= " where G_IDX =  ".$id;
        $Group = DB::select($sql);
    
        return response()->json($Group);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
