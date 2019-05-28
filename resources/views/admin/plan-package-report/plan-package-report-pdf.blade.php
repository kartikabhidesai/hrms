<html>
    <head>
        <meta charset="utf-8">
        <title>Plan And Package Report</title>
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
                <td style="text-align: right;">Plan And Package Report</td>
            </tr>
        </table>

        <table width="100%" border="1">
            <thead>
                <tr>
                    <td class="padding-l-5">Company Name</td>
                    <td class="padding-l-5">Company Email</td>
                    <td class="padding-l-5">Status</td>
                    <td class="padding-l-5">Subscription</td>
                    <td class="padding-l-5">Expire At</td>
                </tr>
            </thead>
            <tbody>
            @foreach($companies as $key => $value)
                <tr>
                    <td>  {{ $value['company_name'] }}</td>
                    <td>  {{ $value['email'] }}</td>
                    <td>  {{ $value['status'] }}</td>
                    <td>  {{ $value['subcription'] }}</td>
                    <td>  {{ date('d-m-Y',strtotime($value['expiry_at'])) }}</td>
                </tr>  
            @endforeach
            </tbody>
        </table>
            
    </body>
</html>