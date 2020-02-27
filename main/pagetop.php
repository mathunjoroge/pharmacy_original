<?php include('../connect.php');
$result = $db->prepare("SELECT * FROM `sales_order` ORDER BY transaction_id ASC LIMIT 1");
                $result->execute();
                
                for($i=0; $row = $result->fetch(); $i++){
                $startdate=$row['date'];
                $Date = $startdate;
                $today=date('Y-m-d');
$expdate=date('Y-m-d', strtotime($Date. ' + 70 days'));
$myday=date('Y-m-d', strtotime($today. ' + 1 days'));
$exp=date('d-m-Y', strtotime($expdate));

                
$today=date('Y-m-d');
                if($myday<=$expdate){ echo 'you are using a trial version which expires on '.$exp;
                 }else if($myday>$expdate){
        header("location:flashfiles.php");
        
        }
        }
    ?>