<?php
    require("userValidChecker.php");
    require("db.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootswatch\bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="css\index.css" type="text/css"/>
    <link rel="stylesheet" href="css\wallpaper.css" type="text/css"/>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white  bg-gradient-primary">
  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
       <img src="img/artboard.png" alt="logo">
      </li>
    </ul>
    <form method = "POST" class="form-inline my-2 my-lg-0" action = "<?php echo $_SERVER['PHP_SELF']?>" >
      <input class="form-control mr-sm-2" type="text" required placeholder="Username" name="Username" value = "<?php echo isset($_POST['Username']) ? $_POST['Username'] :"";?>">
      <input class="form-control mr-sm-2" type="password" required placeholder="password" name="password">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="connect" >Connect</button>
    </form>
    <button  class="btn btn-primary" onclick="window.location.href = 'register.php';">Register</button>
  </div>
</nav>
<?php if((FILTER_HAS_VAR(INPUT_POST,'connect') || FILTER_HAS_VAR(INPUT_POST,'submitAddPicture')) && $pectureAvailibility == true) :?>
    <br>
    <div class="container-sm d-flex justify-content-center">
        <button type="button" class="btn btn-info  btn_1" name = "addPictures" onclick = "showFromAddPicture()" style="display: inline" >Add more pictures</button>
        <button type="button" class="btn alert alert-danger  btn_2" name = "removePicture" onclick = "showFromRemovePicture()" style="display: inline">Remove a picture</button>
        <br>
    </div>
<?php endif ;?>
<?php if((FILTER_HAS_VAR(INPUT_POST,'connect') && $printPictures === true) || FILTER_HAS_VAR(INPUT_POST,'submitAddPicture') || FILTER_HAS_VAR(INPUT_POST,'submitRemovePicture')) :?>
        <div class="mx-auto  row">
            <?php foreach($Pictures as $picture):?>
                <div class="card border-primary px-4">
                    <div><h6><?php echo $picture['pictureTitle'];?></h6></div>
                    <img src = "pictures/<?php echo $picture['picturePath'];?>" width = "230" height = "230">
                    <button class="btn btn-danger" name = "removePicture" >Remove</button>
                </div>            
            <?php endforeach ;?>
        </div>
<?php endif ;?>
</body>
</html>
