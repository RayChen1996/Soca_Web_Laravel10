<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // 导入 DB 类
use App\Models\Reader;
 /**
 
 * @OA\Tag(name="Readers")
 */
class ReaderController extends Controller
{         
/**
     * @OA\Get(
     *     path="/api/Readers/{pg}",
     *     summary="Get Reader data",
     *  @OA\Parameter(
 *         name="pg",
 *         in="path",
 *         required=true,
 *         description="Page number for pagination 45",
 *         @OA\Schema(type="integer")
 *     ),
     *     @OA\Response(response="200", description="List of Readers"),
     *     tags={"Readers"}
     * )
     */
    public function index($pg){

        $page = $pg;


        // //處理頁數
        
        if ($page <= 0 ) {$page = 1;}
      
        $OnePage = 10;
        $skip = $OnePage * ($page-1);
      
        
        $sql = "SELECT FIRST 10";
        if ($skip > 0) {
          $sql.= " skip ".$skip;  
        }
        $sql.= '  a.R_IDX,  m.M_TYPE , a.R_NO ,a.R_MODEL,a.R_NAME,a.R_INTERFACE,a.R_TIMEOUT,a.POLLING,a.R_READ_IDX, a.CREATETIME, a.EDITTIME  ';
        $sql.= "  FROM READER a";
        $sql.="    left join MODEL m on m.M_TYPE = a.R_MODEL";
        $readers = DB::select($sql);

        return response()->json($readers);
        
    }

    public function show($id)
    {
        $reader = DB::select('SELECT R_IDX ,R_NO ,R_MODEL,R_NAME,R_INTERFACE,R_TIMEOUT,POLLING,R_READ_IDX, CREATETIME, EDITTIME FROM READER WHERE R_IDX = ?', [$id]);
        return response()->json($reader);
    }


/**
 * @OA\Post(
*     path="/api/Readers/",
*     summary="Insert reader data",
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             type="object",
*             @OA\Property(property="R_NO", type="integer", description="Reader number"),
*             @OA\Property(property="R_MODEL", type="integer", description="Reader model"),
*             @OA\Property(property="R_NAME", type="string", description="Reader name"),
*             @OA\Property(property="R_INTERFACE", type="string", description="Reader interface"),
*             @OA\Property(property="R_TIMEOUT", type="integer", description="Reader timeout"),
*             @OA\Property(property="R_MAP_IDX", type="integer", description="Reader map index"),
*             @OA\Property(property="R_READ_POINTER3", type="integer", description="Reader read pointer 3"),
*             @OA\Property(property="R_READ_POINTER4", type="integer", description="Reader read pointer 4"),
*             @OA\Property(property="POLLING", type="integer", description="Polling value"),
*             @OA\Property(property="CREATETIME", type="string", format="date-time", description="Creation time"),
*         )
*     ),
*     @OA\Response(response="200", description="create Users  "),
*     @OA\Response(response="500", description="Failed to create reader"),
*     tags={"Readers"}
* )
*/
    public function create(Request $request){

        $requestData = $request->all();  

        // 假设 $requestData 包含了前端传递的读者信息，例如 $requestData['R_NO']、$requestData['R_MODEL'] 等
 
        $insertData = [
            'R_NO' => intval($requestData['R_NO']),
            'R_MODEL' => intval($requestData['R_MODEL']),
            'R_NAME' => $requestData['R_NAME'],
            'R_INTERFACE' =>$requestData['R_INTERFACE'],
            'R_TIMEOUT'=>intval($requestData['R_TIMEOUT']),
            'R_PARAMETER'=>$requestData['Param'],
            'R_MAP_IDX'=>1,
            'R_READ_POINTER3'=>1,
            'R_READ_POINTER4'=>1,
            'POLLING'=>1,
            'CREATETIME' => now() 
        ]; 

        // 执行插入操作
        $inserted = DB::table('READER')->insert($insertData);

        if ($inserted) {
            return response()->json(['message' => 'Reader created successfully',201]);
        } else {
            return response()->json(['message' => 'Failed to create reader'], 401);
        }
 
    }
   
    public function UpdateHKFaceReaderParam(Request $request)
    {
        $requestData = $request->all();
        $insertData = [
            'R_PARAMETER' => intval($requestData['R_NO']),
         
        ];
        // return json_encode($insertData);

        // 执行插入操作
        $inserted = DB::table('READER')->insert($insertData);
        if ($inserted) {
            return response()->json(['message' => 'Reader created successfully']);
        } else {
            return response()->json(['message' => 'Failed to create reader'], 500);
        }
    }

    public function UpdatePollingStatus(Request $request)
    {
        $requestData = $request->all();
        $readerIdx = intval($requestData['R_IDX']);
        $newPollingValue = intval($requestData['new_polling_value']); // 假設新的 POLLING 數值在請求數據中

        $reader = Reader::find($readerIdx);
        // return json_encode($insertData);
        if (!$reader) {
            return response()->json(['message' => 'Reader not found'], 404);
        }
        if($newPollingValue==0){
            $newPollingValue = 1;
        }else{
            $newPollingValue = 0;
        }
    
        $reader->POLLING = $newPollingValue;
        $reader->save();

        return response()->json(['message' => 'POLLING value updated successfully']);
    
    }


    public function ReaderParam($id)
    {
        $readers = DB::select('SELECT R_PARAMETER  FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_PARAMETER) {
                $reader->R_PARAMETER = base64_encode($reader->R_PARAMETER);
            }
        }
    
        return response()->json($readers);
    }
    
    public function ReaderHoliday($id)
    {
        $readers = DB::select('SELECT R_HOLIDAY FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_HOLIDAY) {
                $reader->R_HOLIDAY = base64_encode($reader->R_HOLIDAY);
            }
        }
    
        return response()->json($readers);
    }

    public function ReaderTZ($id)
    {
        $readers = DB::select('SELECT R_TIMEZONE FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_TIMEZONE) {
                $reader->R_TIMEZONE = base64_encode($reader->R_TIMEZONE);
            }
        }
    
        return response()->json($readers);
    }


    public function ReaderTZN($id)
    {
        $readers = DB::select('SELECT TIMEZONENAME FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        // foreach ($readers as $reader) {
        //     if ($reader->TIMEZONENAME) {
        //         $reader->TIMEZONENAME = base64_encode($reader->TIMEZONENAME);
        //     }
        // }
    
        return response()->json($readers);
    }


    public function ReaderHolidayCtrl($id)
    {
        $readers = DB::select('SELECT R_HOLIDAYCTRL FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_HOLIDAYCTRL) {
                $reader->R_HOLIDAYCTRL = base64_encode($reader->R_HOLIDAYCTRL);
            }
        }
    
        return response()->json($readers);
    }

    public function ReaderTimeFrame($id)
    {
        $readers = DB::select('SELECT R_TIMEFRAME FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_TIMEFRAME) {
                $reader->R_TIMEFRAME = base64_encode($reader->R_TIMEFRAME);
            }
        }
    
        return response()->json($readers);
    }

    public function ReaderTimeZoneGroup($id)
    {
        $readers = DB::select('SELECT R_TIMEZONEGROUP FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_TIMEZONEGROUP) {
                $reader->R_TIMEZONEGROUP = base64_encode($reader->R_TIMEZONEGROUP);
            }
        }
    
        return response()->json($readers);
    }
 


    public function ReaderBell($id)
    {
        $readers = DB::select('SELECT R_BELL FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_BELL) {
                $reader->R_BELL = base64_encode($reader->R_BELL);
            }
        }
    
        return response()->json($readers);
    }
 
    
    public function ReaderLight($id)
    {
        $readers = DB::select('SELECT R_LIGHT FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_LIGHT) {
                $reader->R_LIGHT = base64_encode($reader->R_LIGHT);
            }
        }
    
        return response()->json($readers);
    }

    public function ReaderLightName($id)
    {
        $readers = DB::select('SELECT R_LIGHT_NAME FROM READER WHERE R_IDX = ? ', [$id]);
    
        // Convert BLOB data to base64 before sending to frontend
        foreach ($readers as $reader) {
            if ($reader->R_LIGHT_NAME) {
                $reader->R_LIGHT_NAME = base64_encode($reader->R_LIGHT_NAME);
            }
        }
    
        return response()->json($readers);
    }


    public function ReaderCarama($id)
    {
        $readers = DB::select(' SELECT IDX, "NAME", CTYPE, "URL", CNO, CHANNEL, ACCOUNT, "PASSWORD", READERIDX, CREATETIME, EDITTIME,CAMERAID  FROM NVR  where READERIDX = ? ', [$id]);
    
      
    
        return response()->json($readers);
    }

    public function ReaderModel()
    {
         
        $sql =" SELECT  M_NAME, M_TYPE FROM MODEL    ";

        $model = DB::select( $sql );
        foreach ($model as $reader) {
           $reader->M_NAME =  trim($reader->M_NAME);
        }        
        return response()->json($model);
    }
    public function ReaderMember($id,$pg)
    {
        $page = $pg;


        // //處理頁數
        
        if ($page <= 0 ) {$page = 1;}
      
        $OnePage = 100;
        $skip = $OnePage * ($page-1);
      
        
        $sql = "SELECT FIRST 100";
        if ($skip > 0) {
          $sql.= " skip ".$skip;  
        }  
        $sql .= '     C_CARD,U_NAME,P_TIMEZONEIDX,C_FP_COUNT,p.R_IDX';
        $sql .= ' from CARDS c';
        $sql .= ' inner join LIMIT l on l.C_IDX = c.C_IDX';
        $sql .= ' left join PERMIT p on p.G_IDX = l.G_IDX';
        $sql .= ' left join USERS u on u.U_IDX = c.U_IDX';
        $sql .= ' left join GROUPS g on g.G_IDX = l.G_IDX';
        $sql .= ' where p.R_IDX = '.$id;
        $sql .= ' order by C_CARD';

        $readers = DB::select($sql);

        // $readers = DB::select(' SELECT IDX, "NAME", CTYPE, "URL", CNO, CHANNEL, ACCOUNT, "PASSWORD", READERIDX, CREATETIME, EDITTIME,CAMERAID  FROM NVR  where READERIDX = ? ', [$id]);
    
        return response()->json($readers);
        // return $id." "."".$pg;
    }

    public function store(Request $request)
    {
        // 获取前端传递的数据并插入到数据库
        // ...

        return response()->json(['message' => 'Reader created successfully']);
    }

    public function update(Request $request, $id)
    {
        // 获取前端传递的数据并更新数据库中对应的记录
        // ...

        return response()->json(['message' => 'Reader updated successfully']);
    }

    public function destroy($id)
    {
        // 根据传入的 ID 删除对应的读者记录
        // ...
        $sql = "DELETE  FROM READER where R_IDX =  ".$id;
        
        DB::delete($sql);
        return "delete ".$id;
         
    }

}
