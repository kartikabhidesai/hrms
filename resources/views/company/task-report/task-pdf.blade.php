<html>
    <head>
        <meta charset="utf-8">
        <title>Pay Slip</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .main-header{
                font-size: 35px;
                /*line-height: 35px;
                text-align: right !important;*/
            }
            .text-undeline{
                text-decoration: underline;
            }
            .small-fornt{
                font-size: 11px;
                text-align: right;
            }
            .page-break {
                page-break-after: always;
            }
            .padding-l-5{
                padding-left: 5px;
            }
        </style>
        <!-- Favicon -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    </head>
    
    <body>
         <table width="100%">
                <tr>
                    <td class="main-header"><span >HRMS</span></td>
                </tr>
            </table>
        @foreach($empPdfArray as $row => $employeeArr)
        <div class="invoice-box">
            <table width="100%">
                <tr>
                    <td >Employee Name  <br/>{{ $employeeArr['empName'] }}</td>
                    <td >Company Name <br/>{{ $employeeArr['company_name'] }}</td>
                    <td >Task Report Number <br/> {{ $employeeArr['task_report_number'] }}</td>
                    <td >Download Date <br/>{{ $employeeArr['download_date'] }}</td>
                </tr> 
            </table>
            <br/>
            <table width="100%" border="1">

                <thead>
                    <tr>
                        <td class="padding-l-5">Task</td>
                        <td class="padding-l-5">About Task</td>
                        <td class="padding-l-5">Priority</td>
                        <td class="padding-l-5">Assign Date</td>
                        <td class="padding-l-5">Deadline date</td>
                        <td class="padding-l-5">Complete Progress</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>  {{ $employeeArr['task'] }}</td>
                        <td>  {{ $employeeArr['about_task'] }}</td>
                        <td>  {{ $employeeArr['priority'] }}</td>
                        <td>  {{ $employeeArr['assign_date'] }}</td>
                        <td>  {{ $employeeArr['deadline_date'] }}</td>
                        <td>  {{ $employeeArr['complete_progress'] }}</td>
                    </tr>  
                </tbody>
            </table>
            <br>
        </div>
        <hr/>
         @endforeach
    </body>
</html>