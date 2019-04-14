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
                    <td >Employee Name  <br/>{{ @$employeeArr[0]['empName'] }}</td>
                    <td >Company Name <br/>{{ @$employeeArr[0]['company_name'] }}</td>
                    <td >Ticket Report Number <br/> {{ @$ticket_report_number }}</td>
                    <td >Download Date <br/>{{ @$download_date }}</td>
                </tr> 
            </table>
            <br/>
            <table width="100%" border="1">

                <thead>
                    <tr>
                        <td class="padding-l-5">Code</td>
                        <td class="padding-l-5">Subject</td>
                        <td class="padding-l-5">Priority</td>
                        <td class="padding-l-5">Details</td>
                        <td class="padding-l-5">Created By</td>
                        <td class="padding-l-5">Complete Progress</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employeeArr as $key=>$val)
                        <tr>
                            <td>  {{ $val['code'] }}</td>
                            <td>  {{ $val['subject'] }}</td>
                            <td>  {{ $val['priority'] }}</td>
                            <td>  {{ $val['details'] }}</td>
                            <td>  {{ $val['created_by'] }}</td>
                            <td>  {{ $val['complete_progress'] }}</td>
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