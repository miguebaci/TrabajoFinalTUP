<?php            
            if(isset($_SESSION["loggedUser"])){
                if(isset($_SESSION["loggedUser"])){
                    //The program will continue
                }else{
                    echo "<script> alert('You need to be logged in to access this page');";  
                    echo "window.location = '../index.php'; </script>";
                }
            }else{
                echo "<script> alert('You need to be logged in to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
?>