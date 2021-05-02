<?php
    $conn = new mysqli("localhost","u856954936_stock","Bull$100&%Bear","u856954936_stockdata");
    $sql = "SELECT stock_code, stock_name FROM stock ORDER BY stock_name";
    $query = mysqli_query($conn, $sql);
    while($value = mysqli_fetch_assoc($query)){
        $stockCode[] = $value['stock_code'];
        $stockName[] = $value['stock_name'];
    }
?>
<html>
   <head>
        <meta charset="utf-8">
        <title>Stock History|Search Stock |Analys Stock Perfomence</title>
        <meta name="description" content="Get all the historical stock prices and Analys Stock Perfomence, get all history details of stocks">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href ="images/logo.png" type="image/x-icon"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css">
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    	<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"type="text/javascript"></script>
    	<link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"rel="stylesheet" type="text/css" />
        <script src="stock.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-PJ8GPVYSGJ"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-PJ8GPVYSGJ');
        </script>
        <script>
            $(document).ready(function(){
                $("form").submit(function(){
                    $(".loader").removeAttr('hidden');
                });
                $(window).load(function() {
                    setTimeout(function() {
                        $('.loader').attr('hidden',true);
                    }, 1500);
                });
            });
        </script>
        <link rel="stylesheet" href="css/search.css">
        <style>   
            .loader 
            {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url('images/loader.gif') 50% 50% no-repeat rgb(249,249,249);
                background-size: 350px;
            }
        </style>
   </head>
   <body style="background-image: url('images/searchpage.png');opacity:0.8;">
      <div class="loader"></div>
      <div class="col-md-12 card mb-1 homecontent">
          <div class="card-body">
                <h2>Stock History Search</h2><hr>
                <?php 
                    session_start();
                    if(isset($_SESSION["errormsg"])) {
                        $error = $_SESSION["errormsg"];
                        session_unset();
                        echo "<div id='alert'><div class='alert alert-danger'>".$error."</div></div>"; 
                    }
                ?>
                <form class="form-horizontal" action="stock.php" method="POST" autocomplete="off">
                    <div class="row">
                        <div class="col-md-4">
                            <label style="margin-bottom:6%;">Stock Code</label>
                            <select name="stockCode"  id="stockCode" class="form-control selectpicker"  required="" data-live-search="true"> 
                                <option value="">Select Stock</option>
                                <?php foreach($stockCode as $key => $value){
                                    echo '<option value="'.$value.'">'.$stockName[$key].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="startDate" style="margin-bottom:6%;">Start Date</label>
                            <input id="startDate" name="startDate" type="text" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <label for="endDate" style="margin-bottom:6%;">End Date</label>
                            <input id="endDate" name="endDate" type="text" class="form-control" />
                        </div>
                    <div>
                    <center><button id="search_button_history" type="submit" class="search_btn btn"><i class="fa fa-search fa-fw"></i>&nbsp;Search</button></center>
                       
                </form>
          </div>
      </div>
    </body>
</html>