<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/api-docs', 'App\Http\Controllers\SwaggerController@index');



Route::get('history/{pg}', 'App\Http\Controllers\HistoryController@index');

Route::get('NoRegCard/{pg}', 'App\Http\Controllers\HistoryController@showNoRegCardReport');
Route::get('simpleAttend/{pg}', 'App\Http\Controllers\HistoryController@showSimpleAttendReport');
Route::get('CardTimesUse/{pg}', 'App\Http\Controllers\HistoryController@showCardTimesUseReport');
Route::get('InOutReport/{pg}', 'App\Http\Controllers\HistoryController@showInOutReport');
Route::get('NoDoorClose/{pg}', 'App\Http\Controllers\HistoryController@showNoDoorCloseReport');
Route::get('PatralReport/{pg}', 'App\Http\Controllers\HistoryController@showPatralReportReport');
Route::get('NoLeaveMemberReport/{pg}', 'App\Http\Controllers\HistoryController@showNoLeaveMemberReportReport');

 



Route::get('RealMonitorShow/{id}', 'App\Http\Controllers\HistoryController@RealMonitorShow');




Route::get('Deps/{pg}', 'App\Http\Controllers\DepController@index');
Route::get('Deps/{D_DEPNO}', 'App\Http\Controllers\DepController@show');
Route::put('Deps/{D_DEPNO}', 'App\Http\Controllers\DepController@store');
Route::post('Deps', 'App\Http\Controllers\DepController@create');
Route::delete('Deps/{D_DEPNO}', 'App\Http\Controllers\DepController@destroy');





Route::get('WorkTime', 'App\Http\Controllers\WorkTimeController@index');
Route::get('WorkTime/{W_IDX}', 'App\Http\Controllers\WorkTimeController@show');
Route::put('WorkTime/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('WorkTime', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('WorkTime/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');









Route::get('Holiday', 'App\Http\Controllers\DepController@index');
Route::get('Holiday/{W_IDX}', 'App\Http\Controllers\WorkTimeController@show');
Route::put('Holiday/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('Holiday', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('Holiday/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');





Route::get('AttendReport', 'App\Http\Controllers\DepController@index');
 




Route::get('AttendRecord', 'App\Http\Controllers\DepController@index');
Route::get('AttendRecord/{W_IDX}', 'App\Http\Controllers\WorkTimeController@show');
Route::put('AttendRecord/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('AttendRecord', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('AttendRecord/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');







Route::get('Schedule', 'App\Http\Controllers\DepController@index');
Route::get('Schedule/{W_IDX}', 'App\Http\Controllers\WorkTimeController@show');
Route::put('Schedule/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('Schedule', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('Schedule/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');




Route::get('Absence', 'App\Http\Controllers\DepController@index');
Route::get('Absence/{W_IDX}', 'App\Http\Controllers\WorkTimeController@show');
Route::put('Absence/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('Absence', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('Absence/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');


 
Route::get('OverTime', 'App\Http\Controllers\DepController@index');
Route::get('OverTime/{W_IDX}', 'App\Http\Controllers\WorkTimeController@show');
Route::put('OverTime/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::post('OverTime', 'App\Http\Controllers\WorkTimeController@create');
Route::delete('OverTime/{W_IDX}', 'App\Http\Controllers\WorkTimeController@destroy');




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







Route::get('Users/{pg}', 'App\Http\Controllers\UsersController@index');

Route::get('Users/Next/{id}', 'App\Http\Controllers\UsersController@index');
Route::get('Users/Previous/{id}', 'App\Http\Controllers\UsersController@index');


Route::put('Users/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::delete('Users/{id}', 'App\Http\Controllers\UsersController@destroy');
Route::post('Users', 'App\Http\Controllers\UsersController@create');
  

Route::get('Groups/{pg}', 'App\Http\Controllers\GroupController@index');
Route::put('Users/{W_IDX}', 'App\Http\Controllers\WorkTimeController@store');
Route::delete('Users/{id}', 'App\Http\Controllers\UsersController@destroy');
Route::post('Users', 'App\Http\Controllers\UsersController@create');
  




Route::get('GroupsPersonal/{pg}', 'App\Http\Controllers\GroupController@PersonalGroup');
// Get_Group_ReaderSet_Json.php 
Route::get('GroupsReaderSet/{id}/{pg}', 'App\Http\Controllers\GroupController@GroupReaderSet');
//DB_Group_UserList.php
Route::get('GroupsUserList/{id}/{pg}', 'App\Http\Controllers\GroupController@GroupUserList');
Route::get('GroupsUserListCount/{id}', 'App\Http\Controllers\GroupController@GroupUserCount');
Route::get('GetReaderFromGIdx/{id}', 'App\Http\Controllers\UsersController@GetCardListFromGIdx');


Route::post('Groups', 'App\Http\Controllers\GroupController@create');
Route::put('Groups', 'App\Http\Controllers\GroupController@update');
Route::delete('Groups/{id}', 'App\Http\Controllers\GroupController@destroy');



Route::get('ReaderMonitor', 'App\Http\Controllers\AutoRecvController@index');
Route::get('Map', 'App\Http\Controllers\AutoRecvController@index');
Route::get('Map/{id}', 'App\Http\Controllers\AutoRecvController@index');


Route::get('Readers/{pg}', 'App\Http\Controllers\ReaderController@index');
// Route::get('Readers/{id}', 'App\Http\Controllers\ReaderController@show');
Route::delete('Readers/{id}', 'App\Http\Controllers\ReaderController@destroy');

Route::post('Readers', 'App\Http\Controllers\ReaderController@create');
Route::put('ReadersFaceReader/{id}', 'App\Http\Controllers\ReaderController@UpdateHKFaceReaderParam');


Route::get('ReaderParam/{id}', 'App\Http\Controllers\ReaderController@ReaderParam');
Route::get('ReaderHoliday/{id}', 'App\Http\Controllers\ReaderController@ReaderHoliday');
Route::get('ReaderTimeZoneHoliday/{id}', 'App\Http\Controllers\ReaderController@ReaderTZ');
Route::get('ReaderTimeZoneName/{id}', 'App\Http\Controllers\ReaderController@ReaderTZN');
Route::get('ReaderHolidayCtrl/{id}', 'App\Http\Controllers\ReaderController@ReaderHolidayCtrl');
Route::get('ReaderTimeFrame/{id}', 'App\Http\Controllers\ReaderController@ReaderTimeFrame');
Route::get('ReaderBell/{id}', 'App\Http\Controllers\ReaderController@ReaderBell');
Route::get('ReaderLight/{id}', 'App\Http\Controllers\ReaderController@ReaderLight');
Route::get('ReaderCamara/{id}', 'App\Http\Controllers\ReaderController@ReaderCarama');
Route::get('ReaderLightName/{id}', 'App\Http\Controllers\ReaderController@ReaderLightName');
Route::get('ReaderMember/{id}/{pg}', 'App\Http\Controllers\ReaderController@ReaderMember');


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


Route::get('SysPolling', 'App\Http\Controllers\SysParamController@PollingStatus');
Route::get('SysPolling/{val}', 'App\Http\Controllers\SysParamController@SetPollingStatus');
 

// 語言檔 API 路由
Route::prefix('/language')->group(function () {
    // 獲取語言檔
    Route::get('/{locale}', 'App\Http\Controllers\LanguageController@getLanguageFile');
    
    // 更新語言檔
    Route::put('/{locale}', 'App\Http\Controllers\LanguageController@updateLanguageFile');
});

