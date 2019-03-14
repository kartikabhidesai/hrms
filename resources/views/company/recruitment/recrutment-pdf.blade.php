<html>
    <head>
        <meta charset="utf-8">
        <title>Pay Slip</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .main-header{
                font-size: 35px;
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
        <h2>HRMS : Job Offer Letter</h2>
        <div class="invoice-box">
            <table width="100%">
                <tr>
                    <td>Task </td>
                    <td>{{ $data['recrutment']['task'] }} </td>
                </tr>  
                  <tr>
                    <td>Department </td>
                    <td>{{ $data['recrutment']['dept'] }} </td>
                </tr>  
                  <tr>
                    <td>Responsibility </td>
                    <td>{{ $data['recrutment']['responsibility'] }} </td>
                </tr>  
                  <tr>
                    <td>Requirement </td>
                    <td>{{ $data['recrutment']['requirement'] }} </td>
                </tr>  
                  <tr>
                    <td>Experience Level </td>
                    <td>{{ $data['recrutment']['experience_level'] }} </td>
                </tr>  
                  <tr>
                    <td>Job Time </td>
                    <td>{{ $data['recrutment']['jobtime'] }} </td>
                </tr>  
                  <tr>
                    <td>Contract </td>
                    <td>{{ $data['recrutment']['contract'] }} </td>
                </tr>  
                 <tr>
                    <td>Salary </td>
                    <td>{{ $data['recrutment']['salary'] }} </td>
                </tr>  
                 <tr>
                    <td>Email </td>
                    <td>{{ $data['recrutment']['email'] }} </td>
                </tr>  
                 <tr>
                    <td>Conact us </td>
                    <td>{{ $data['recrutment']['conatact_us'] }} </td>
                </tr>  
                 <tr>
                    <td>Start Date </td>
                    <td>{{ $data['recrutment']['start_date'] }} </td>
                </tr>     
                  <tr>
                    <td>Expire Date </td>
                    <td>{{ $data['recrutment']['expire_date'] }} </td>
                </tr>      <tr>
                    <td>Job id </td>
                    <td>{{ $data['recrutment']['job_id'] }} </td>
                </tr>  
               
               
            </table>
            
            <br>
        </div>
        <!-- </div> -->
    </body>
</html>