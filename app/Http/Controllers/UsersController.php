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
    // public function index($pg)
    // { 
    //     $page = $pg;
    //     //處理頁數
    //     if ($page <= 0 ) {$page = 1;}
      
    //     $OnePage = 100;
    //     $skip = $OnePage * ($page-1);
      
    //     $sql = "SELECT FIRST 100";
    //     if ($skip > 0) {
    //       $sql.= " skip ".$skip;  
    //     }  
    //     $sql.="  * FROM USERS  ORDER BY U_IDX DESC ";

    //     $Group = DB::select( $sql );
    //     return response()->json($Group);
    // }

  


    public function index()
    {
        $users = Users::paginate(100);
        return response()->json([
            'data' => $users->items(), // 實際資料項目
            'current_page' => $users->currentPage(), // 當前頁數
            'per_page' => $users->perPage(), // 每頁顯示筆數
            'total' => $users->total(), // 總資料筆數
        ]);
        // return response()->json($users);
    }

    public function show($id)
    {
        $user = Users::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        // 根據請求中的資料建立新使用者
        // 回傳表示成功或失敗的 JSON 響應
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // 根據請求中的資料更新使用者
        // 回傳表示成功或失敗的 JSON 響應
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // 回傳表示成功或失敗的 JSON 響應
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

 

   
  

}
