<style>
    body
    {
      margin: 0mm 0mm 0mm 0mm;
      font-family: sans-serif;
    }
    @page { 
        margin-top: 0px;
        margin-left: 10px;
        margin-right: 10px;
        margin-bottom: 0px; 
    }
    @media print {
        body
        {
          margin: 0px;
        }
        .wrap{word-break: break-all;
        display: inline-block;
        word-break: break-word;}
    }
    table
    {
        border-color: #000;
        color: #000;
        border-collapse: collapse;
        font-family: sans-serif;
    }
    .table_field{
        font-size: 14px;
    }
    .font-small{
        font-size: 13px;
        height: 13px;
    }
    .dark{
        /*color: white;*/
        /*background-color: #75b979;*/
        background-color: #ffaa00;
        font-weight: bold;
    }
    .white{
        color: white;
    }
    .light{
        font-size: 12px;
        background-color: #DCDCDC;
        font-weight: bold;
    }
    .pfont{
        font-size: 10px;
    }
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .brdr{
        border: 2px solid orange;
    }
</style>
    <table  style="width: 100%; margin:10px;">
        <tr>
            <td style="font-size: 25px; font-weight: bold; width: 20%;">
                HRMS
            </td>
            <td style="font-size: 25px; font-weight: bold; width: 60%; text-align: center;">
                Client List
            </td>
            <td valign="top" style="width: 20%;">
            </td>
         </tr>
    </table>

    <table style="width: 100%; margin-top: 10px;" cellpadding="3" border='1'>
        <tr>
            <td class="light table_field" style="width: 40%;">Company Name : </td>
            <td class="font-small" style="width: 60%;">{{ @$company_name }}</td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 10px;" cellpadding="3" border='1'>
        <tr class="light">
            <!-- <td>Payments</td> -->
            <td>Name</td>
            <td>National</td>
            <td>Work</td>
            <td>Company</td>
            <td>Date of joining</td>
            <td>Bank</td>
            <td>iban</td>
            <td>Phone number</td>
            <td>Mobile number</td>
            <td>Email</td>
        </tr>
        @foreach($clientReportPdfArray as $employeeArr)
            <tr class="font-small">
                <td>{{ $employeeArr['name'] }}</td>
                <td>{{ $employeeArr['national_id'] }}</td>
                <td>{{ $employeeArr['work'] }}</td>
                <td>{{ $employeeArr['company'] }}</td>
                <td>{{ $employeeArr['date_of_joining'] }}</td>
                <td>{{ $employeeArr['bank'] }}</td>
                <td>{{ $employeeArr['iban'] }}</td>
                <td>{{ $employeeArr['phone_number'] }}</td>
                <td>{{ $employeeArr['mobile_number'] }}</td>
                <td>{{ $employeeArr['email'] }}</td>
            </tr>  
        @endforeach
    </table>