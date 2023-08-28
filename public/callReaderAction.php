<?php
// phpinfo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
    <div id="aa"></div>
    <Button onclick="CallAction()">12</Button>

    <script>

        function GetUserParamter() {

        var Login = {
            cmd:"",
            DeviceAddress:"",
            Account:"",
            Password:"",
            Port:"",
            Name:"",
            Card:"",
            WordID:"",
            RightPlan:"",
            All_WorkID:"",
            All_WorkID_Index:"",
            Photo:"",
            HistoryStartDate:"",
            HistoryStartTime:"",
            HistoryEndDate:"",
            HistoryEndTime:"",

            TimezoneEnable:"",
            SelectTimezone:"",
            TimezoneSegment:[],
            UnlockTimezoneEnable:"",
            UnlockTimezoneSegment:[],
            HolidayEnable:"",
            Holiday:[],
            Holidayindex:"",
        }

        Login.DeviceAddress = $("#InputDeviceAddress").val();
        Login.Port = $("#InputPort").val();
        Login.Account = $("#InputAccount").val();
        Login.Password = $("#InputPassword").val();
        Login.Port = $("#InputPort").val();

        var IName = encodeURI($("#InputName").val());
        Login.Name = IName;
        Login.Card = $("#InputCard").val();
        Login.WordID = $("#InputWorkID").val();
        Login.RightPlan = $("#InputRightPlan").val();

        Login.HistoryStartDate = $('#SDate').val();
        Login.HistoryStartTime = $("#STime").val();
        Login.HistoryEndDate = $("#EDate").val();
        Login.HistoryEndTime = $("#ETime").val();

        Login.TimezoneEnable = $("#TimezoneEnable").prop('checked');
        Login.SelectTimezone = $("#SelectTimezone option:selected").index()+1;



        for(var i=1; i<57; i++)
        { 
        Login.TimezoneSegment.push({"Enablechecked":$("#TimezoneSeg"+i.toString()).prop('checked'),"StTime":$("#StTime"+i.toString()).val(),"EdTime":$("#EdTime"+i.toString()).val()});
        }

        Login.UnlockTimezoneEnable = $("#UnlockTimezoneEnable").prop('checked');

        for(var i=1; i<57; i++)
        { 
        Login.UnlockTimezoneSegment.push({"UnlockEnablechecked":$("#UnlockTimezoneSeg"+i.toString()).prop('checked'),"UnlockStTime":$("#UnlockStTime"+i.toString()).val(),"UnlockEdTime":$("#UnlockEdTime"+i.toString()).val()});
        }

        Login.HolidayEnable = $("#HolidayEnable").prop('checked');

        Login.Holidayindex = 0;

        //console.log(Login);

        return Login;
        }

        function CallAction(){
           
            var Readers = {
                Comm: 'TCP,192.168.10.83,4444',
                CreateTime: "2019-05-07 08:34:46",
                EditTime: "2019-05-08 15:04:02",
                Idx: 1,
                Model: 501,
                Name: '',
                No: 1,
                Polling: 1,
                Timeout: 3
            }
            var RS = new Array();
            RS.push(Readers);
            try {
   
                $.ajax({
                    url: "/Backend/Reader_Action.cgi/GetSocaWebPath",
                    type: "post",
                  
                    data: {
                        "Readers": JSON.stringify(RS),
                        "Select_Idx": 1,
                        "NIST": ''
                    },
                    success: function(response) {   
                       console.log(JSON.parse(response).webpath)
                        
                            
                    },
                    error: function(xhr, status, error){
                
                    }
                });
            }catch(e) {
               alert("Get Failed!");
         
            }   


        }
    </script>
</body>
</html>


