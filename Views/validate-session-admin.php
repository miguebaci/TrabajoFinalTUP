<?php            
            if(isset($_SESSION["loggedUser"])){
                if($_SESSION["loggedUser"]->getRole()=="Admin"){
                    //The program will continue
                }else{
                    echo "<script> alert('You need to be admin to access this page');";  
                    echo "window.location = '../index.php'; </script>";
                }
            }else{
                echo "<script> alert('You need to be admin to access this page');";  
                echo "window.location = '../index.php'; </script>";
            }
?>