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
        <h2>HRMS</h2>
        <div class="invoice-box">
            @foreach($data['advanceSalaryApprovedRequest'] as $data)
            <table width="100%">
                <!-- <tr>
                    <td class="main-header"><span >HRMS</span></td>
                </tr> -->
                <tr>
                    <!-- <td  colspan="2"><h2>Payslip</h2><b>Net Pay 230,54</b></td> -->
                    <td>Employee Name  <br/>{{ $data['name'] }}</td>
                    <td>Company Name <br/>{{ $data['company_name'] }}</td>
                    <td>Department Name <br/> {{ $data['department_name'] }}</td>
                </tr> 
                <!-- <tr>
                    <td  colspan="2">&nbsp;</td>
                    <td>Ni Code <br/>GY456123</td>
                    <td>Tax code <br/>8974</td>
                    <td>Payment period <br/>Monthly</td>
                </tr> -->
            </table>
            <br/><br/>

            <table width="100%" border="1">
                <thead>
                    <!-- <tr>
                        <td>Payments</td>
                        <td class="padding-l-5">Deductions</td>
                        <td class="padding-l-5">Years Of date</td>
                    </tr> -->
                </thead>
                <tbody>
                    <tr>
                        <td> Date Of Submit : {{ date('Y-m-d', strtotime($data['date_of_submit'])) }}</td>
                        <td class="padding-l-5">Comment : {{ $data['comments'] }} </td>
                        <td class="padding-l-5"> Phone : {{ $data['phone'] }}</td>
                    </tr>  
                    <!-- <tr>
                        <td> Total Payments : $232311121</td>
                        <td class="padding-l-5">Total Deductions : 560 580.00 </td>
                        <td class="padding-l-5">Net Pay : 23045</td>
                    </tr> -->
                </tbody>
            </table>
            <br><br><hr>
            @endforeach
            <br>
        </div>
        <!-- </div> -->
    </body>
</html>