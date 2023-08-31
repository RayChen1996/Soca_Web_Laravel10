<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB; // 导入 DB 类


 /**
 * @OA\Tag(name="Users")
 */
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2($pg)
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

  

    /**
 * @OA\Get(
 *     path="/api/Users/{pg}",
 *     summary="Get users data",
 *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="List of USERS"),
     *     tags={"Users"}
     * )
     */
    public function index($pg)
    {

        $page = $pg;
        // 處理頁數
        if ($page <= 0) {
            $page = 1;
        }
        $onePage = 100;
        $skip = $onePage * ($page - 1);

        $users = Users::orderBy('U_IDX', 'desc')
                        ->skip($skip)
                        ->take($onePage)
                        ->get();
        return response()->json($users);
 
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

  /**
     * @OA\Get(
     *     path="/api/Users/Previous/{id}",
     *     summary="Get users data",
     *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="List of USERS"),
     *     tags={"Users"}
     * )
     */
    public function Previous(Request $request)
    {
    
    }
  /**
     * @OA\Get(
     *     path="/api/Users/Next/{id}",
     *     summary="Get users data",
     *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="List of USERS"),
     *     tags={"Users"}
     * )
     */
    public function Next(Request $request)
    {
        
    }


      /**
     * @OA\Patch(
     *     path="/api/Users/{id}",
     *     summary="update users data",
     *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="List of USERS"),
     *     tags={"Users"}
     * )
     */
    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        // 根據請求中的資料更新使用者
        // 回傳表示成功或失敗的 JSON 響應
    }


        /**
     * @OA\Delete(
     *     path="/api/Users/{id}",
     *     summary="Delete users data",
     *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="Delete Users Id"),
     *     tags={"Users"}
     * )
     */
    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();
        // 回傳表示成功或失敗的 JSON 響應
    }



    /**
     * @OA\Get(
     *     path="/api/GetReaderFromGIdx/{GIdxStr}",
     *     summary="Get Reader data",
     *  @OA\Parameter(
 *         name="GIdxStr",
 *         in="path",
 *         required=true,
 *         description="獲取群組的讀卡機清單資料",
 *         @OA\Schema(type="string")
 *     ),
     *     @OA\Response(response="200", description="List of USERS"),
     *     tags={"Users"}
     * )
     */
    public function GetCardListFromGIdx($GIdxStr){
     
  
        if($GIdxStr==""){
            $sql = " select p.R_IDX, r.R_NAME, r.R_NO,r.R_MODEL
            from PERMIT p
            inner join READER r on p.R_IDX = r.R_IDX
            left join PARKING_SPACE ps on ps.READERIDX = p.R_IDX
            where G_IDX  in  (0)  order by G_IDX   " ;
    
            $readers = DB::select(  $sql );
            return response()->json($readers);
        }
        $sql = " select p.R_IDX, r.R_NAME, r.R_NO,r.R_MODEL
                from PERMIT p
                inner join READER r on p.R_IDX = r.R_IDX
                left join PARKING_SPACE ps on ps.READERIDX = p.R_IDX
                where G_IDX  in  (" .$GIdxStr. ")  order by G_IDX   " ;
        
        $readers = DB::select(  $sql );
        return response()->json($readers);
    }
 
         /**
     * @OA\Post(
     *     path="/api/Users/",
     *     summary="Create users data",
     *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="Delete Users Id"),
     *     tags={"Users"}
     * )
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

 
    public function edit($id)
    {
        //
    }

 

   
  

}
