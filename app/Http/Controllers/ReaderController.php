<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // 导入 DB 类

class ReaderController extends Controller
{
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
        $sql.= '  a.R_IDX, m.M_NAME ,a.R_NO ,a.R_MODEL,a.R_NAME,a.R_INTERFACE,a.R_TIMEOUT,a.POLLING,a.R_READ_IDX, a.CREATETIME, a.EDITTIME  ';
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




    public function create(Request $request){

        $requestData = $request->all(); // 获取从前端传来的数据

        // 假设 $requestData 包含了前端传递的读者信息，例如 $requestData['R_NO']、$requestData['R_MODEL'] 等

        // 构建插入数组
        $insertData = [
            'R_NO' => intval($requestData['R_NO']),
            'R_MODEL' => intval($requestData['R_MODEL']),
            'R_NAME' => $requestData['R_NAME'],
            'R_INTERFACE' =>$requestData['R_INTERFACE'],
            'R_TIMEOUT'=>intval($requestData['R_TIMEOUT']),
            'R_MAP_IDX'=>1,
            'R_READ_POINTER3'=>1,
            'R_READ_POINTER4'=>1,
            'POLLING'=>1,
            'CREATETIME' => now()
            // 'EDITTIME' => now(),
        ];
        // return json_encode($insertData);

        // 执行插入操作
        $inserted = DB::table('READER')->insert($insertData);

        if ($inserted) {
            return response()->json(['message' => 'Reader created successfully']);
        } else {
            return response()->json(['message' => 'Failed to create reader'], 500);
        }
        // $reader = DB::select('SELECT R_IDX ,R_NO ,R_MODEL,R_NAME,R_INTERFACE,R_TIMEOUT,POLLING,R_READ_IDX, CREATETIME, EDITTIME FROM READER WHERE R_IDX = ?', [$id]);
        // return response()->json($reader);
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
