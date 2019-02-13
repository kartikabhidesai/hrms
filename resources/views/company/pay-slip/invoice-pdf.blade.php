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
        @foreach($empPdfArray as $row => $employeeArr)
        <div class="invoice-box">
            <table width="100%">
                <tr>
                    <td class="main-header"><span >HRMS</span></td>
                </tr>
                <tr>
                    <td  colspan="2"><h2>Payslip</h2><b>Net Pay 23,54</b></td>
                    <td >Employee Name  <br/>{{ $employeeArr['empName'] }}</td>
                    <td >Company Name <br/>{{ $employeeArr['company_name'] }}</td>
                    <td >payroll Date <br/> {{ date('d-m-Y',strtotime($employeeArr['due_date'])) }}</td>
                </tr> 
                <tr>
                    <td  colspan="2">&nbsp;</td>
                    <td >Ni Code <br/>GY456123</td>
                    <td >Tax code <br/>{{ $employeeArr['salary_grade'] + $employeeArr['basic_salary']  + $employeeArr['over_time'] + $employeeArr['housing']+ $employeeArr['medical'] + $employeeArr['transportation'] + $employeeArr['travel'] }} </td>
                    <td >Payment period <br/>Monthly</td>
                </tr>
            </table>
        <br/>
        <br/>
            <table width="100%" border="1">

                <thead>
                    <tr>
                        <td>Payments</td>
                        <td class="padding-l-5">Deductions</td>
                        <td class="padding-l-5">Years Of date</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td > Basic Pay  {{ $employeeArr['basic_salary'] }}</td>
                        <td class="padding-l-5">Employee in constributions {{ $employeeArr['salary_grade'] }} </td>
                        <td class="padding-l-5"> Gross Pay  -</td>
                    </tr>  <tr>
                        <td > Total Payments  ${{ $employeeArr['salary_grade'] + $employeeArr['basic_salary'] }}</td>
                        <td class="padding-l-5">Total Deductions  </td>
                        <td class="padding-l-5">Net Pay {{ $employeeArr['salary_grade'] + $employeeArr['basic_salary']  + $employeeArr['over_time'] + $employeeArr['housing']+ $employeeArr['medical'] + $employeeArr['transportation'] + $employeeArr['travel'] }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
         @endforeach
    </body>
</html>