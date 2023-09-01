<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\OverTimeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AttendController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\WorkTimeController;
use App\Http\Controllers\SysParamController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/api-docs', 'App\Http\Controllers\SwaggerController@index');

Route::prefix('history')->group(function () {
    Route::get('/{pg}', [HistoryController::class, 'index']); // 取得所有 
    Route::get('/show/{id}', [HistoryController::class, 'show']); // 取得特定 
  
    Route::get('/simpleAttend/{pg}', 'App\Http\Controllers\HistoryController@showSimpleAttendReport');
    Route::get('/CardTimesUse/{pg}', 'App\Http\Controllers\HistoryController@showCardTimesUseReport');
    Route::get('/InOutReport/{pg}', 'App\Http\Controllers\HistoryController@showInOutReport');
    Route::get('/NoDoorClose/{pg}', 'App\Http\Controllers\HistoryController@showNoDoorCloseReport');
    Route::get('/PatralReport/{pg}', 'App\Http\Controllers\HistoryController@showPatralReportReport');
    Route::get('/NoLeaveMemberReport/{pg}', 'App\Http\Controllers\HistoryController@showNoLeaveMemberReportReport');
    
     
    Route::get('/RealMonitorShow/{id}', 'App\Http\Controllers\HistoryController@RealMonitorShow');


    Route::get('/NoRegCard/{pg}', 'App\Http\Controllers\HistoryController@showNoRegCardReport');
  
  
    Route::post('/', [HistoryController::class, 'create']); // 創建 
    Route::put('/{id}', [HistoryController::class, 'update']); // 更新 
    Route::delete('/', [HistoryController::class, 'destroy']); // 刪除 
});
 


Route::prefix('Deps')->group(function () {
    Route::get('/{pg}', [DepController::class, 'index']); // 取得所有使用者
 
    Route::post('/', [DepController::class, 'store']); // 創建使用者
    Route::put('/{id}', [DepController::class, 'update']); // 更新使用者
    Route::delete('/{id}', [DepController::class, 'destroy']); // 刪除使用者
});


Route::prefix('WorkTime')->group(function () {
    Route::get('/{pg}', [WorkTimeController::class, 'index']); // 取得所有使用者
    Route::get('/{id}', [WorkTimeController::class, 'show']); // 取得特定使用者
    Route::post('/', [WorkTimeController::class, 'store']); // 創建使用者
    Route::put('/{id}', [WorkTimeController::class, 'update']); // 更新使用者
    Route::delete('/{id}', [WorkTimeController::class, 'destroy']); // 刪除使用者
});
 

Route::prefix('Holiday')->group(function () {
    Route::get('/{pg}', [HolidayController::class, 'index']); // 取得所有使用者
    Route::get('/{id}', [HolidayController::class, 'show']); // 取得特定使用者
    Route::post('/', [HolidayController::class, 'store']); // 創建使用者
    Route::put('/{id}', [HolidayController::class, 'update']); // 更新使用者
    Route::delete('/{id}', [HolidayController::class, 'destroy']); // 刪除使用者
});
 
 

Route::get('AttendReport', 'App\Http\Controllers\DepController@index');
 
 

Route::get('AttendRecord', 'App\Http\Controllers\DepController@index');
Route::get('AttendRecord/{W_IDX}', 'App\Http\Controllers\WorkTimeController@show');
Route::put('AttendRecord/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('AttendRecord', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('AttendRecord/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');


Route::prefix('Schedule')->group(function () {
    Route::get('/{pg}', [HolidayController::class, 'index']); // 取得所有使用者
    Route::get('/{id}', [HolidayController::class, 'show']); // 取得特定使用者
    Route::post('/', [HolidayController::class, 'store']); // 創建使用者
    Route::put('/{id}', [HolidayController::class, 'update']); // 更新使用者
    Route::delete('/{id}', [HolidayController::class, 'destroy']); // 刪除使用者
});
 
  

Route::prefix('OverTime')->group(function () {
    Route::get('/{pg}', [OverTimeController::class, 'index']); // 取得所有使用者
    Route::get('/{id}', [OverTimeController::class, 'show']); // 取得特定使用者
    Route::post('/', [OverTimeController::class, 'store']); // 創建使用者
    Route::put('/{id}', [OverTimeController::class, 'update']); // 更新使用者
    Route::delete('/{id}', [OverTimeController::class, 'destroy']); // 刪除使用者
});

Route::prefix('Absence')->group(function () {
    Route::get('/{pg}', [AbsenceController::class, 'index']); // 取得所有使用者
    Route::get('/{id}', [AbsenceController::class, 'show']); // 取得特定使用者
    Route::post('/', [AbsenceController::class, 'store']); // 創建使用者
    Route::put('/{id}', [AbsenceController::class, 'update']); // 更新使用者
    Route::delete('/{id}', [AbsenceController::class, 'destroy']); // 刪除使用者
});


Route::get('AttendSet', 'App\Http\Controllers\DepController@index');



Route::get('HolidaySet', 'App\Http\Controllers\DepController@index');




Route::get('DataConvert', 'App\Http\Controllers\DepController@index');
Route::put('AutoConvertSetting/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('DataConvert', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('DataConvert/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');





Route::get('ConvertFormatSet/{pg}', 'App\Http\Controllers\HistoryController@GetConvFormat');
Route::put('AutoConvertSetting/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('DataConvert', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('DataConvert/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');




Route::get('AutoConvertSetting/{pg}'   , 'App\Http\Controllers\HistoryController@GetAutoConvSetting');
Route::put('AutoConvertSetting/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('AutoConvertSetting', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('AutoConvertSetting/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');





Route::prefix('Users')->group(function () {
    Route::get('/{pg}', [UsersController::class, 'index']); // 取得所有使用者
    Route::get('/{id}', [UsersController::class, 'show']); // 取得特定使用者
    Route::get('/Previous/{id}', [UsersController::class, 'Previous']); // 取得 Previous 使用者
    Route::get('/Next/{id}', [UsersController::class, 'Next']); // 取得 Next 使用者
    Route::post('/', [UsersController::class, 'store']); // 創建使用者
    Route::put('/{id}', [UsersController::class, 'update']); // 更新使用者
    Route::delete('/{id}', [UsersController::class, 'destroy']); // 刪除使用者
});


Route::prefix('Readers')->group(function () {
    Route::get('/{pg}', [ReaderController::class, 'index']); // 取得所有 
    Route::get('/{id}', [ReaderController::class, 'show']); // 取得特定 
    Route::post('/', [ReaderController::class, 'create']); // 創建 
    Route::put('/{id}', [ReaderController::class, 'update']); // 更新 
    Route::delete('/{id}', [ReaderController::class, 'destroy']); // 刪除 
    Route::put('/toggle', [ReaderController::class, 'UpdatePollingStatus']); // 更新 

    Route::put('/ReadersFaceReader/{id}', [ReaderController::class, 'UpdateHKFaceReaderParam']); // 更新 

    Route::get('/Param/{id}', [ReaderController::class, 'ReaderParam']); // 取得特定 
    Route::get('/Member/{id}/{pg}', [ReaderController::class, 'ReaderMember']); // 取得特定 


    Route::get('/Holiday/{id}', [ReaderController::class, 'ReaderHoliday']); // 取得特定
    Route::get('/TimeZoneHoliday/{id}', [ReaderController::class, 'ReaderTZ']); // 取得特定
    Route::get('/TimeZoneName/{id}', [ReaderController::class, 'ReaderTZN']); // 取得特定
    Route::get('/HolidayCtrl/{id}', [ReaderController::class, 'ReaderHolidayCtrl']); // 取得特定
    Route::get('/TimeFrame/{id}', [ReaderController::class, 'ReaderTimeFrame']); // 取得特定
    Route::get('/Bell/{id}', [ReaderController::class, 'ReaderBell']); // 取得特定
    Route::get('/Light/{id}', [ReaderController::class, 'ReaderLight']); // 取得特定
    Route::get('/Camera/{id}', [ReaderController::class, 'ReaderCarama']); // 取得特定
    Route::get('/LightName/{id}', [ReaderController::class, 'ReaderLightName']); // 取得特定

});

 

  
  

Route::get('Groups/{pg}',     [GroupController::class, 'index']  );
Route::get('GroupsCount',    [GroupController::class, 'GetCount']   );






Route::get('GroupsPersonal/{pg}',     [GroupController::class, 'PersonalGroup']    );
 
Route::get('GroupsReaderSet/{id}/{pg}',    [GroupController::class, 'GroupReaderSet']    );

Route::get('GroupsUserList/{id}/{pg}',   [GroupController::class, 'GroupUserList']  );
Route::get('GroupsUserListCount/{id}',    [GroupController::class, 'GroupUserCount']    );
Route::get('GetReaderFromGIdx/{GIdxStr}', 'App\Http\Controllers\UsersController@GetCardListFromGIdx')   ;


Route::post('Groups',   [GroupController::class, 'create']);
Route::put('Groups',    [GroupController::class, 'update']    );
Route::delete('Groups/{id}',     [GroupController::class, 'destroy']   );


 
Route::get('Map', 'App\Http\Controllers\AutoRecvController@index');
Route::get('Map/{id}', 'App\Http\Controllers\AutoRecvController@index');



Route::get('HolidayCategory', 'App\Http\Controllers\SysParamController@GetHolidayCategory');


 
Route::get('Permission', 'App\Http\Controllers\AutoRecvController@index');
Route::put('Permission/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::delete('Permission/{id}', 'App\Http\Controllers\UsersController@destroy');
Route::post('Permission', 'App\Http\Controllers\UsersController@create');
  


Route::get('AutoRecv', 'App\Http\Controllers\AutoRecvController@index');
Route::put('AutoRecv/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::delete('AutoRecv/{id}', 'App\Http\Controllers\UsersController@destroy');
Route::post('AutoRecv', 'App\Http\Controllers\UsersController@create');
 



Route::get('AutoUpdate', 'App\Http\Controllers\AutoRecvController@index');
Route::put('AutoUpdate/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::delete('AutoUpdate/{id}', 'App\Http\Controllers\UsersController@destroy');
Route::post('AutoUpdate', 'App\Http\Controllers\UsersController@create');
 


Route::get('AutoUpdateTime', 'App\Http\Controllers\AutoRecvController@index');
Route::put('AutoUpdateTime/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::delete('AutoUpdateTime/{id}', 'App\Http\Controllers\UsersController@destroy');
Route::post('AutoUpdateTime', 'App\Http\Controllers\UsersController@create');
 


Route::get('SystemParameter', 'App\Http\Controllers\AutoRecvController@index');



Route::get('SystemSetting', 'App\Http\Controllers\AutoRecvController@index');
Route::put('SystemSetting/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('SystemSetting', 'App\Http\Controllers\UsersController@create');
 


Route::get('SystemLog', 'App\Http\Controllers\AutoRecvController@index');
Route::post('SystemLog', 'App\Http\Controllers\UsersController@create');
 



Route::get('MailReport', 'App\Http\Controllers\AutoRecvController@index');
Route::put('MailReport/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('MailReport', 'App\Http\Controllers\UsersController@create');


 


Route::post('login', 'App\Http\Controllers\UAController@login');

// Route to check session
Route::get('/check-session', 'App\Http\Controllers\UAController@checkSession' );

Route::get('/logout', function () {
    Session::flush(); // Clear all session data
    return response()->json(['message' => 'Logged out successfully']);
});
/**
 * 
 * 其他
 */
Route::get('ReaderModel', 'App\Http\Controllers\ReaderController@ReaderModel');

Route::prefix('System')->group(function () {
    Route::get('/SysPolling', [SysParamController::class, 'PollingStatus']); // 取得所有使用者
    Route::get('SysPolling/{val}', [SysParamController::class, 'SetPollingStatus']); // 取得特定使用者
 
});

 

// 語言檔 API 路由
Route::prefix('/language')->group(function () {
    // 獲取語言檔
    Route::get('/{locale}', 'App\Http\Controllers\LanguageController@getLanguageFile');
    
    // 更新語言檔
    Route::put('/{locale}', 'App\Http\Controllers\LanguageController@updateLanguageFile');
});

