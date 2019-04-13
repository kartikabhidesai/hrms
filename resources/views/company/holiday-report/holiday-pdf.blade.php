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
                    <td >Employee Name  <br/>{{ $employeeArr[0]['empName'] }}</td>
                    <td >Company Name <br/>{{ $employeeArr[0]['company_name'] }}</td>
                    <td >Holiday Report Number <br/> {{ @$holiday_report_number }}</td>
                    <td >Download Date <br/>{{ @$download_date }}</td>
                </tr> 
            </table>
            <br/>
            <table width="100%" border="1">

                <thead>
                    <tr>
                        <td class="padding-l-5">Start Date</td>
                        <td class="padding-l-5">End Date</td>
                        <td class="padding-l-5">From Date</td>
                        <td class="padding-l-5">To Date</td>
                        <td class="padding-l-5">Reason</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employeeArr as $key=>$val)
                    <tr>
                        <td>  {{ (!empty($val['start_date'])) ?  date('d-m-Y',strtotime($val['start_date'])) : 'N/A' }}</td>
                        <td>  {{ (!empty($val['end_date'])) ?  date('d-m-Y',strtotime($val['end_date'])) : 'N/A' }}</td>
                        <td>  {{ (!empty($val['from_date'])) ?  date('d-m-Y',strtotime($val['from_date'])) : 'N/A' }}</td>
                        <td>  {{ (!empty($val['to_date'])) ?  date('d-m-Y',strtotime($val['to_date'])) : 'N/A' }}</td>
                        <td>  {{ $val['reason'] }}</td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
            <br>
        </div>
        <hr/>
         @endforeach
    </body>
</html>