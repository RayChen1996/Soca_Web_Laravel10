<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\History;

/**
 * @OA\Info(
 *     title="soca web api v1.0",
 *     version="1.0",
 *     description="soca web API Description"
 * )
 * @OA\Tag(name="History")
 */
class HistoryController extends Controller
{
    /**
 * @OA\Get(
 *   path="/api/history/{pg}",
 *     summary="Get a list of history",
 * @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="List of history"),
 *     tags={"History"}
 * )
 */
    public function index($pg){


        $page = $pg;

        if ($page <= 0) {
            $page = 1;
        }

        $onePage = 100;
        $skip = $onePage * ($page - 1);

        /*$history = History::select('H_IDX', 'H_CARD', 'H_DATE', 'H_TIME', 'H_DATETIME', 'H_STATE', 'H_RECVDATETIME', 'H_SUBREADER', 'H_SUBREADERNO', 'R_IDX', 'H_READERMODEL')
            ->orderBy('H_IDX', 'desc')
            ->skip($skip)
            ->take($onePage)
            ->get();*/

        $history = History::select('H_IDX', 'H_CARD', 'H_DATE', 'H_TIME', 'H_DATETIME', 'H_STATE', 'H_RECVDATETIME', 'H_SUBREADER', 'H_SUBREADERNO', 'R_IDX', 'H_READERMODEL', 'c.C_CARD', 'u.WORKNO') // 將 WORKNO 欄位加入到 select 中
            ->leftJoin('CARDS as c', 'H_CARD', '=', 'c.C_CARD')
            ->leftJoin('USERS as u', 'c.U_IDX', '=', 'u.U_IDX')
            ->orderBy('H_IDX', 'desc')
            ->skip($skip)
            ->take($onePage)
            ->get();

        return response()->json($history);
    }



    /**
 * @OA\Get(
 *     path="/api/history/GetConvFormat",
 *     summary="Get Convert Format",
 *     @OA\Response(response="200", description="List of history"),
 *     tags={"History"}
 * )
 
 */
    public function GetConvFormat($pg){

        $sql = "";
        $page = $pg;
        //處理頁數
        if ($page <= 0 ) {$page = 1;}
      
        $OnePage = 100;
        $skip = $OnePage * ($page-1);
      
        $sql = "SELECT  a.IDX, a.NAME, a.FORMAT, a.USEDITEM, a.SETTING  ";
      
        $sql.="  FROM CONVERTFORMAT a      ";

        $history = DB::select($sql);
  
        return response()->json($history);
    }


        /**
 * @OA\Get(
 *     path="/api/AutoConvertSetting/{pg}",
 *     summary="Get Convert Format",
 *     @OA\Response(response="200", description="List of history"),
 *     tags={"History"}
 * )
 */
    public function GetAutoConvSetting($pg){

        $sql = "SELECT  a.IDX,  a.READERLIST, a.SETTING, a.LASTUPDATE_DATETIME, a.LASTCONVERT_HISTORYIDX  ";
      
        $sql.="  FROM AUTOCONVERSETTING a      ";

        $history = DB::select($sql);
  
        return response()->json($history);
    }

    

         /**
 * @OA\Get(
 *     path="/api/history/show/{pg}",
 *     summary="Get Convert Format",
 *     @OA\Response(response="200", description="List of history"),
 *     tags={"History"}
 * )
 */
    public function show($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }



 
    public function showSimpleAttendReport($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }


    }


/**
 * @OA\Get(
 *     path="/api/NoRegCard/{pg}",
 *     summary="Get No Reg Card report",
 *     @OA\Response(response="200", description="List of history"),
 *     tags={"History"}
 * )
 */
    public function showNoRegCardReport($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }


    public function showCardTimesUseReport($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }
    }

    public function showInOutReport($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }

        
    }

    

    public function showNoDoorCloseReport($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }

        
    }


    public function showPatralReportReport($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }

        
    }


    public function showNoLeaveMemberReportReport($id)
    {
        $history = History::find($id);
        if ($history) {
            return response()->json($history);
        } else {
            return response()->json(['error' => 'Record not found'], 404);
        }

        
    }

     /**
      * 即時監控用
      */
    public function RealMonitorShow($pg)
    {
        $page = $pg;
        //處理頁數
        if ($page <= 0 ) {$page = 1;}
      
        $OnePage = 100;
        $skip = $OnePage * ($page-1);
        $sql = "SELECT  FIRST 100     ";
        if ($skip > 0) {
            $sql.= " skip ".$skip;  
        }
        $sql.= " h.H_IDX as H_IDX,";
        $sql.= " cast( h.H_CARD as varchar(10)) as H_CARD , ";
        $sql.= " cast( u.U_NAME as varchar(50)) as U_NAME , ";
        $sql.= " u.PHOTO_FILE  as PHOTO_FILE ,";
        $sql.= " h.H_DATETIME  as H_DATETIME ,";
        $sql.= " h.H_STATE  as H_STATE ,";
        $sql.= " r.R_IDX  as R_IDX ,";
        $sql.= " cast( r.R_NAME as varchar(80)) as R_NAME,";
        $sql.= " r.R_MODEL  as R_MODEL, ";
        $sql.= " h.H_SUBREADERNO  as H_SUBREADERNO  ";        
        $sql.= " FROM HISTORYS h";
        $sql.= " left join READER r on r.R_IDX=h.R_IDX";
        $sql.= " left join CARDS c on c.C_CARD=h.H_CARD";
        $sql.= " left join USERS u on u.U_IDX=c.U_IDX";
        // $sql.= " WHERE H_IDX > ".$id;
        $sql.= " order by H_IDX asc";
        $history = DB::select($sql); 
        return response()->json($history);
    }

/**
 * @OA\Post(
 *     path="/api/history",
 *     summary="Create One History data",
 *     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             type="object",
*             @OA\Property(property="H_CARD", type="string",default="0000000001", description=""),
*             @OA\Property(property="H_DATE", type="string", default="20230901",description=""),
*             @OA\Property(property="H_TIME", type="string", default="120000",description=""),
*             @OA\Property(property="H_DATETIME", type="string", default="01.09.2023, 23:59:59.000",format="date-time", description=""),
*             @OA\Property(property="H_STATE", type="integer", default="1",description=""),
*             @OA\Property(property="H_RECVDATETIME", type="string", default="09.02.2023, 10:51:42.000",description=""),
*             @OA\Property(property="H_SUBREADER", type="integer", description=""),
*             @OA\Property(property="H_SUBREADERNO", type="integer", description=""),
*             @OA\Property(property="R_IDX", type="integer", default="1", description="R_IDX"),
*             @OA\Property(property="H_READERMODEL", type="integer",default="501", description="READERMODEL"),
*         )
*     ),
*     @OA\Response(response="200", description="Insert history"),
*     @OA\Response(response="500", description="Failed to create historys"),
*     tags={"History"}
* )
*/
    public function create(Request $request)
    {
        $requestData = $request->all();
        $insertData = [
            'H_CARD' => $requestData['H_CARD'],
            'H_DATE' => $requestData['H_DATE'],
            'H_TIME' => $requestData['H_TIME'],
            'H_DATETIME' => $requestData['H_DATETIME'],
            'H_STATE' => $requestData['H_STATE'],
            'H_RECVDATETIME' => $requestData['H_RECVDATETIME'],
            'H_SUBREADER' => $requestData['H_SUBREADER'],
            'H_SUBREADERNO' => $requestData['H_SUBREADERNO'],
            'R_IDX' => $requestData['R_IDX'],
            'H_READERMODEL' => $requestData['H_READERMODEL']
        ];
        // 执行插入操作
        $inserted = DB::table('HISTORYS')->insert($insertData);
        if ($inserted) {
            return response()->json(['message' => 'History created successfully',201]);
        } else {
            return response()->json(['message' => 'Failed to New History'], 401);
        }
    }
}
