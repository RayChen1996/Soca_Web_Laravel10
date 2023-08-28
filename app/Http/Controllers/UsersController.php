<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB; // 导入 DB 类
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pg)
    { 
        $page = $pg;
        //處理頁數
        if ($page <= 0 ) {$page = 1;}
      
        $OnePage = 100;
        $skip = $OnePage * ($page-1);
      
        $sql = "SELECT FIRST 100";
        if ($skip > 0) {
          $sql.= " skip ".$skip;  
        }  
        $sql.="  * FROM USERS  ORDER BY U_IDX DESC ";

        $Group = DB::select( $sql );
        return response()->json($Group);
    }

    public function AllList()
    {
        
    }
    public function GetCardListFromGIdx($id){
       
  
        $sql = " select p.R_IDX, r.R_NAME, r.R_NO,r.R_MODEL
                from PERMIT p
                inner join READER r on p.R_IDX = r.R_IDX
                left join PARKING_SPACE ps on ps.READERIDX = p.R_IDX
                where G_IDX = ".$id." order by G_IDX   " ;
        
     

        $readers = DB::select(  $sql );
    
    
        return response()->json($readers);


    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $requestData = $request->all();
        $insertData = [
            'U_NAME' => $requestData['UName'],
        ];

        // 执行插入操作
        $inserted = DB::table('USERS')->insert($insertData);


        $lastUserIdx = Users::orderBy('U_IDX', 'desc')->value('U_IDX');




        $insertData = [
            'C_CARD' => $requestData['Card'],
            'U_IDX' =>  $lastUserIdx,
            'C_PW'=> 0
        ];

        // 执行插入操作
        $inserted = DB::table('CARDS')->insert($insertData);


        if ($inserted) {
            return response()->json(['message' => 'Reader created successfully']);
        } else {
            return response()->json(['message' => 'Failed to New User'], 200);
        }
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
        $sql = "DELETE  FROM USERS where U_IDX =  ".$id;
        
        DB::delete($sql);
        return "delete ".$id;
    }

}
