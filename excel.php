<?php
    if(isset($_POST["xcel_download"])) {	
        $filename = "stock.xls";			
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        session_start();
        $data = $_SESSION['stockData'];
        if(!empty($data)) {
             // display tilte names
             echo "\t \t \t \t \t \t", $data['dataset']['name'];
             echo "\n";
             echo "\n";

            foreach($data['dataset']['column_names'] as  $value) {
                // display field/column names in first row
                echo "\t", $value; 
            }

            foreach($data['dataset']['data'] as  $dataValue) {
                echo "\n";
               foreach($dataValue as  $allValues) {
                  // display field/column names in first row
                  echo "\t", $allValues; 
                }
                echo "\n";
            }
            exit;
        }
    }
?>
