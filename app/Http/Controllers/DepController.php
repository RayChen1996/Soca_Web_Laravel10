<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dep;
use Illuminate\Support\Facades\DB; // 导入 DB 类


/**
 
 * @OA\Tag(name="部門")
 */
class DepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        /**
 * @OA\Get(
 *     path="/api/Deps/{pg}",
 *     summary="Get Deps data",
 *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="List of 部門"),
     *     tags={"部門"}
     * )
     */
    public function index($pg)
    {
        $page = $pg;
        //處理頁數
        if ($page <= 0 ) {$page = 1;}
      
        $OnePage = 10;
        $skip = $OnePage * ($page-1);
      
        $sql = "SELECT FIRST 10";
        if ($skip > 0) {
          $sql.= " skip ".$skip;  
        }
        $sql.="  D_DEPNO, D_NAME, D_NOTE  FROM DEP    ";
        $Dep = DB::select( $sql );
        return response()->json($Dep);
    }

    
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
        // 在這裡使用 $D_DEPNO 查找相對應的 DEPS 資訊
        $dep = Dep::find($id);
        if (!$dep) {
            return response()->json(['message' => 'DEPS not found'], 404);
        }
        return response()->json($dep);
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
        $sql = "DELETE  FROM DEP where D_DEPNO = ".$id;
        
        DB::delete($sql);
        return "delete ".$id;
    }
}
