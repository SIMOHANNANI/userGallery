<?php
        $go_to_connect_page = false;
        //COLLECT THE VARAIBLES VALUES
        if(FILTER_HAS_VAR(INPUT_POST,"submit")){
            $Username = $_POST['Username'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $_SESSION['Username'] = $Username;
            $_SESSION['Email'] = $Email;
            $_SESSION['Password'] = $Password;
            if(empty($Password)){
                $msg = 'alert-danger';
                $outputPassword = "empty password";
                $_SESSION['msg'] = $msg;
                $_SESSION['outputPassword'] = $outputPassword;
            }
            if(empty($Email)){
                $msg = 'alert-danger';
                $outputEmail = "empty E-mail";
                $_SESSION['msg'] = $msg;
                $_SESSION['outputEmail'] = $outputEmail;
            }
            if(empty($Username)){
                $msg = 'alert-danger';
                $outputUsername = "empty username !";
                $_SESSION['msg'] = $msg;
                $_SESSION['outputUsername'] = $outputUsername;
            }
            if(!empty($Username)){
                if(!empty($Email) && FILTER_VAR($Email,FILTER_VALIDATE_EMAIL)){
                    if(!empty($Password) && strlen($Password) >= 6){
                        $msgSuccess = 'alert-success';
                        $outputSuccess = "Have a nice day Mr $Username !";
                        $_SESSION['msgSuccess'] = $msgSuccess;
                        $_SESSION['outputSuccess'] = $outputSuccess;
                        $go_to_connect_page = true;
                    }
                    else{
                        $msg = 'alert-danger';
                        $outputInvalidPassword = "Weak Password !";
                        $_SESSION['msg'] = $msg;
                        $_SESSION['outputInvalidPassword'] = $outputInvalidPassword;
                    }
                }
                else{
                        $msg = 'alert-danger';
                        $outputInvalidEmail = "Invalid Email !";
                        $_SESSION['msg'] = $msg;
                        $_SESSION['outputInvalidEmail'] = $outputInvalidEmail;
                }
            }
        }
        if($go_to_connect_page == true){
            header('Location:index.php');

        }
        
    ?>