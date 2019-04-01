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
                    <td >Employee No  <br/>{{ $employeeArr['emp_id'] }}</td>
                    <td >Employee Name  <br/>{{ $employeeArr['empName'] }}</td>
                    <td >Company Name <br/>{{ $employeeArr['company_name'] }}</td>
                    <td >Salary Grade <br/>{{ $employeeArr['salary_grade'] }}</td>
                    <td >Basic Salary <br/>{{ $employeeArr['basic_salary'] }}</td>
                </tr> 
            </table>
            <br/>
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <td class="padding-l-5">Over Time</td>
                        <td class="padding-l-5">Due Date</td>
                        <td class="padding-l-5">Housing</td>
                        <td class="padding-l-5">Medical</td>
                        <td class="padding-l-5">Transportation</td>
                        <td class="padding-l-5">Travel</td>
                        <td class="padding-l-5">Award</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>  {{ $employeeArr['over_time'] }}</td>
                        <td>  {{ $employeeArr['due_date'] }}</td>
                        <td>  {{ $employeeArr['housing'] }}</td>
                        <td>  {{ $employeeArr['medical'] }}</td>
                        <td>  {{ $employeeArr['transportation'] }}</td>
                        <td>  {{ $employeeArr['travel'] }}</td>
                        <td>  {{ $employeeArr['award'] }}</td>
                    </tr>  
                </tbody>
            </table>
            <br>
        </div>
        <hr/>
         @endforeach
    </body>
</html>