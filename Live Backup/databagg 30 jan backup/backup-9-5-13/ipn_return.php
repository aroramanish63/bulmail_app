<?php
     
        if(isset($_GET['tx']) && !empty($_GET['tx'])){
            
            $transactionID = $_GET['tx'];
            $status        = $_GET['st'];
            
            if($status == 'Completed'){ 
                header("Location:success.php?tx=$transactionID");
            }else{ 
                header("Location:pending.php?tx=$transactionID");
                 
            }
        }

?>