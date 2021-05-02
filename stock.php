<?php
   $stockCode = trim($_POST['stockCode']);
   $stockName = 'BOM'.$stockCode;
   $startDate = $_POST['startDate'];
   $endDate = $_POST['endDate'];
   $apiKey = "AFXPsRHkFYVGKm59byaJ";

   $url = "https://www.quandl.com/api/v3/datasets/BSE/".$stockName."?start_date=".$startDate."&end_date=".$endDate."&api_key=".$apiKey;
   
    $cObj = curl_init();
    curl_setopt($cObj, CURLOPT_URL, $url);
    //curl_setopt($cObj, CURLOPT_HTTPHEADER, $headers);
    //curl_setopt($cObj, CURLOPT_TIMEOUT, self::$timeout);
    curl_setopt($cObj, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($cObj, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($cObj);
    if ($result === FALSE) {
        die("Curl failed: " . curL_error($cObj));
    }
    $resultData =  json_decode($result, true);
    session_start();
    $_SESSION['stockData'] = $resultData; 
    if(isset($resultData['quandl_error'])){
        session_start();
        $_SESSION["errormsg"]='Your Stock is Invaid! Please Select Right Stock';
        header("Location: index.php");
    }
    curl_close($cObj);
      
?>
<html>
   <head>
       <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PJ8GPVYSGJ"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-PJ8GPVYSGJ');
        </script>
        <title>Stock History</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href ="images/logo.png" type="image/x-icon"> 
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"> 
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
        <script src="stock.js"></script>
        <script>
            $(document).ready(function() {
                $('#stocktable').DataTable();
            } );
        </script>
        <link rel="stylesheet" href="css/result.css">
   </head>
   <body style="background-image: url('images/resultpage.jpeg');opacity:0.7;">
        <div style="text-align: center;color:lightsteelblue;">
            <h3>Stock Data</h3> <h3><?php echo $resultData['dataset']['name'];  ?></h3>
        </div>
        <form class="form-horizontal" action="excel.php" method="POST" autocomplete="off">
            <div class="row" style="text-align: center;">
                <div class="col-md-12">
                    <button id="xcel_download" name="xcel_download" type="submit" class="xcel_download btn"><i class="fa fa-search fa-fw"></i>&nbsp;Download Excel</button>
                </div>
            </div>
        </form>
        <?php
            echo "<table id='stocktable' class='table table-striped'><thead><tr>
            <th>Date</th>
            <th>Open</th>
            <th>High</th>
            <th>Low</th>
            <th>Close</th> </tr></thead><tbody>";
            $i = 0;
            foreach($resultData['dataset']['data'] as  $key => $value){  
            echo "<tr>";
                foreach($value as  $keyindex => $values) {
                    if($keyindex < 5){
                        echo "<td>".$values."</td>";
                    }
                }
                echo"</tr>";
            }
                echo "</tbody></table>";
            
        ?>
    </body>
</html>    