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

    <?php
        $count = sizeof($empPdfArray);
        // echo "<pre>"; print_r($count); exit();
        $i = 1; 
    ?>

    @foreach($emparray as $erow)
        @if(!empty($empPdfArray[$erow]))

            <table  style="width: 100%; margin:10px;">
                <tr>
                    <td style="font-size: 25px; font-weight: bold; width: 20%;">
                        HRMS
                    </td>
                    <td style="font-size: 25px; font-weight: bold; width: 60%; text-align: center;">
                        Performance List
                    </td>
                    <td valign="top" style="width: 20%;">
                    </td>
                 </tr>
            </table>

            <table style="width: 100%; margin-top: 10px;" cellpadding="3" border='1'>
                <tr>
                    <td class="light table_field" style="width: 20%;">Employee Name : </td>
                    <td class="font-small" style="width: 30%;">{{ $empPdfArray[$erow][0]['name'] }}</td>
                    <td class="light table_field" style="width: 20%;">Company Name : </td>
                    <td class="font-small" style="width: 30%;">{{ $empPdfArray[$erow][0]['company_name'] }}</td>
                </tr>
            </table>

            <table style="width: 100%; margin-top: 10px;" cellpadding="3" border='1'>
                <tr class="light">
                    <!-- <td>Payments</td> -->
                    <td>Availability</td>
                    <td>Dependability</td>
                    <td>Job Knowledge</td>
                    <td>Quality</td>
                    <td>Productivity</td>
                    <td>Working <br>Relationship</td>
                    <td>Honesty</td>
                    <td>Notes & Details</td>
                    <td>month/Year</td>
                </tr>
                @foreach($empPdfArray[$erow] as $employeeArr)
                    <tr class="font-small">
                        <td>{{ $employeeArr['availability'] }}</td>
                        <td>{{ $employeeArr['dependability'] }}</td>
                        <td>{{ $employeeArr['job_knowledge'] }}</td>
                        <td>{{ $employeeArr['quality'] }}</td>
                        <td>{{ $employeeArr['productivity'] }}</td>
                        <td>{{ $employeeArr['working_relationship'] }}</td>
                        <td>{{ $employeeArr['honesty'] }}</td>
                        <td>{{ $employeeArr['notes_and_details'] }}</td>
                        <td>{{ $employeeArr['month'] }}/{{ $employeeArr['year'] }}</td>
                    </tr>  
                @endforeach
            </table>       
            <br/>
            <hr/>

            <?php $i++;
                if($i <= $count)
                {
            ?>
                    <!-- <div style="page-break-after: always;"></div> -->
            <?php
                }
            ?>
            <br/>     

        @endif
    @endforeach