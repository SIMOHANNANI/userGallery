<?php
    session_start();
    $pectureAvailibility = false;
    $printPictures = false;
//! VARAIBLE TO CONNECT TO THE DATA BASE;
    $serverName = "localhost";
    $userName = "root";
    $passWord = "";
    $data_baseName = "userPictures";

    // $serverName = "sql210.epizy.com";
    // $userName = "epiz_25190521";
    // $passWord = "TxqDhfiIwdwTqk";
    // $data_baseName = "epiz_25190521_userPictures";
//! OPEN THE CONNECTION ;
    $conn = mysqli_connect($serverName,$userName,$passWord,$data_baseName);
//! CHECK IF THE CONNECTION IS ATTEMPTED;
    if(!$conn){
        //? CONNECTION FAILED
        echo("CONNECION FAILED ! PLEASE TRY AGAIN.");
    }
    if(FILTER_HAS_VAR(INPUT_POST,"submit") && $go_to_connect_page == true){
        //? GET THE DATA SUMBMITTED 
        $userNameForm = $_POST['Username'];
        $EmailFrom = $_POST['Email'];
        $passWordForm = $_POST['Password'];
        //! INSERT INTO THE DATABASE A NEW USER
        $query = "INSERT INTO users(userName,Email,passWord) VALUES('$userNameForm','$EmailFrom','$passWordForm')";
        $go_to_connect_page == false;
        mysqli_query($conn,$query);
    }
    if(FILTER_HAS_VAR(INPUT_POST,'connect')){
        $userNameConnect = $_POST['Username'];
        $passWordConnect = $_POST['password'];

        //! CHECK IF THE USER IS REGISTRED IN THE DATABASE
        $queryFetchConnect = "SELECT ID FROM users WHERE passWord = '$passWordConnect' and userName = '$userNameConnect'";
        $outputID = mysqli_query($conn,$queryFetchConnect);
        $userID = mysqli_fetch_assoc($outputID);
        if(!empty($userID)){
            $pectureAvailibility = true;
            $ID = $userID['ID'];

            $_SESSION['ID'] = $ID;
            //! DISPLAY THE USER PICTURES PRESENT IN THE DATABASE 
            $query = "SELECT pictureTitle,picturePath  FROM userpictures WHERE ID = $ID";
            $outputPictures = mysqli_query($conn,$query);
            $Pictures = mysqli_fetch_all($outputPictures,MYSQLI_ASSOC);
            $_SESSION['Username'] = $userNameConnect;
            header('Location: login.php');
            if(!empty($Pictures)){
                $printPictures = true;
            }
    }
    else{
        $message = "Not registred yet !";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
        mysqli_free_result($outputID);
    }
    if(FILTER_HAS_VAR(INPUT_POST,'submitAddPicture')){
        //! STORE THE NEW IMAGE IN THE DATABASE 
        $ID = $_SESSION['ID'];
        $pictureTitle = $_POST['pictureTitle'];
        $filePath = $_FILES['filepath']['name'];
        $query = "INSERT INTO userpictures(ID,pictureTitle,picturePath) VALUES($ID,'$pictureTitle','$filePath')";
        mysqli_query($conn,$query);
        //! DISPLAY THE USER PICTURES PRESENT IN THE DATABASE 
        $query = "SELECT pictureTitle,picturePath  FROM userpictures WHERE ID = $ID";
        $outputPictures = mysqli_query($conn,$query);
        $Pictures = mysqli_fetch_all($outputPictures,MYSQLI_ASSOC);
        if(!empty($Pictures)){
            $printPictures = true;
        }
    }
    if(FILTER_HAS_VAR(INPUT_POST,'submitRemovePicture')){
        $ID = $_SESSION['ID'];
        $pictureTitle = $_POST['pictureTitle'];
        $query = "DELETE FROM userpictures WHERE pictureTitle = '$pictureTitle'";
        mysqli_query($conn,$query);
        //! DISPLAY THE USER PICTURES PRESENT IN THE DATABASE 
        $query = "SELECT pictureTitle,picturePath  FROM userpictures WHERE ID = $ID";
        $outputPictures = mysqli_query($conn,$query);
        $Pictures = mysqli_fetch_all($outputPictures,MYSQLI_ASSOC);
        if(!empty($Pictures)){
            $printPictures = true;
        }
    }
    if(isset($_SESSION['ID'])){

        $ID = $_SESSION['ID'];
        //! DISPLAY THE USER PICTURES PRESENT IN THE DATABASE 
        $query = "SELECT pictureTitle,picturePath  FROM userpictures WHERE ID = $ID";
        $outputPictures = mysqli_query($conn,$query);
        $Pictures = mysqli_fetch_all($outputPictures,MYSQLI_ASSOC);
        if(!empty($Pictures)){
            $printPictures = true;
        }
    }
    
    
    mysqli_close($conn);
?>
