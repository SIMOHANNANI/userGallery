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
    <title>login</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <img src="pictures/index.jfif" alt="Avatar" class="avatar" style="vertical-align: middle;width: 35px;height: 35px;border-radius: 50%;"> 
        <?php echo $_SESSION['Username'] ;?>
      </li>
    </ul>
    <form method = "POST" class="form-inline my-2 my-lg-0" action = "<?php echo $_SERVER['PHP_SELF']?>" >
    
       <button  class="btn btn-primary" name = "logout">logout</button>
    </form>
  </div>
</nav>
<?php
 if(FILTER_HAS_VAR(INPUT_POST,'logout')){
    header('Location: index.php');
     session_destroy();
 }
 ?>
<br>
    <div class="container-sm d-flex justify-content-center">
        <button type="button" class="btn btn-info  btn_1" name = "addPictures" onclick = "showFromAddPicture()" style="display: inline" >Add more pictures</button>
        <button type="button" class="btn alert alert-danger  btn_2" name = "removePicture" onclick = "showFromRemovePicture()" style="display: inline">Remove a picture</button>
        <br>
    </div>
<div class = "container">
<div class="text-center w-50 p-5 container" id="myDIV">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pictureTitle">picture Title</label>
                    <input type="text" class="form-control"  placeholder="Enter title" name="pictureTitle">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" class="form-control" name = "filepath" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name = "submitAddPicture" >ADD</button>
                </div>

    </form>
</div> 
<div class="text-center w-50 p-5 container" id="myDIV1">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="pictureTitle" >picture Title</label>
                    <input type="text" class="form-control"  placeholder="Enter title" name="pictureTitle" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name = "submitRemovePicture" >Remove</button>
                </div>

    </form>
</div> 
</div>
<?php if(isset($_SESSION['Username']) || FILTER_HAS_VAR(INPUT_POST,'submitAddPicture') || FILTER_HAS_VAR(INPUT_POST,'submitRemovePicture')) :?>
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
<script>
function showFromAddPicture(){
    if(document.getElementById("myDIV").style.display == "block"){
        document.getElementById("myDIV").style.display = "none";

    }
    
    else{
        document.getElementById("myDIV").style.display = "block";
    }
    if(document.getElementById("myDIV1").style.display == "block"){
        document.getElementById("myDIV1").style.display = "none";
    }
}
function showFromRemovePicture(){
    if(document.getElementById("myDIV1").style.display == "block"){
        document.getElementById("myDIV1").style.display = "none";
    }
    else{
        document.getElementById("myDIV1").style.display = "block";
    }
    if(document.getElementById("myDIV").style.display == "block"){
        document.getElementById("myDIV").style.display = "none";

    }
}
    
</script>
</html>
