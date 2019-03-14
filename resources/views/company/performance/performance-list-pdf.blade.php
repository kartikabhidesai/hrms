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
    <div class="invoice-box">
            <table width="100%">
                <tr>
                    <td class="main-header"><span >HRMS</span></td>
                
                    <td class="main-header"><span >Performance List</span></td>
                </tr>
            </table>
    </div>
        @foreach($empPdfArray as $row => $employeeArr)
        <div class="invoice-box">
            <table width="100%">
              
                <tr>
                    <td >Employee Name</td>
                    <td >{{ $employeeArr['name'] }}</td>                    
                    <td ></td>
                    <td >Company Name</td>                    
                    <td >{{ $employeeArr['company_name'] }}</td>
                </tr> 
                
            </table>
        <br/>
        <br/>
            <table width="100%" border="1">
                <thead>
                    <tr>
                        <td>Payments</td>
                        <td class="padding-l-5">Availability</td>
                        <td class="padding-l-5">Dependability</td>
                        <td class="padding-l-5">Job Knowledge</td>
                        <td class="padding-l-5">Quality</td>
                        <td class="padding-l-5">Productivity</td>
                        <td class="padding-l-5">Working <br>Relationship</td>
                        <td class="padding-l-5">honesty</td>
                        <td class="padding-l-5">notes_and_details</td>
                        <td class="padding-l-5">month <br>Year</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $employeeArr['availability'] }}</td>
                        <td>{{ $employeeArr['dependability'] }}</td>
                        <td>{{ $employeeArr['job_knowledge'] }}</td>
                        <td>{{ $employeeArr['quality'] }}</td>
                        <td>{{ $employeeArr['productivity'] }}</td>
                        <td>{{ $employeeArr['working_relationship'] }}</td>
                        <td>{{ $employeeArr['honesty'] }}</td>
                        <td>{{ $employeeArr['notes_and_details'] }}</td>
                        <td>{{ $employeeArr['month'] }}{{ $employeeArr['year'] }}</td>
                    </tr>  
                   
                </tbody>
            </table>
            <br>
        </div>
         @endforeach
    </body>
</html>