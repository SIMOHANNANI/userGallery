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
    <link rel="stylesheet" href="..\bootswatch\bootstrapFlaty.css" type="text/css"/>
    <title>Document</title>
</head>
<body>
<div class="container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control"  placeholder="Enter username" name="Username" value="Hannani">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" class="form-control"   placeholder="Enter email" name="Email" value="mohamed@gmail.com">
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="text" class="form-control"  placeholder="Password" name="Password">
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
        <?php if(FILTER_HAS_VAR(INPUT_POST,"submit")):?>
            <?php if(strlen($Username) == 0 && FILTER_HAS_VAR(INPUT_POST,"submit")) :?>
                <div class="container alert <?php echo $msg;?>"><?php echo $outputUsername;?></div>
            <?php endif;?>

            <?php if(strlen($Email) == 0 && FILTER_HAS_VAR(INPUT_POST,"submit")) :?>
                <div class="container alert <?php echo $msg;?>"><?php echo $outputEmail;?></div>
            <?php endif;?>

            <?php if( strlen($Password) == 0  && FILTER_HAS_VAR(INPUT_POST,"submit") ) :?>
                <div class="container alert <?php echo $msg;?>"><?php echo $outputPassword;?></div>
            <?php endif;?>

            <?php if(!empty($Username) && !empty($Email) && !empty($Password)):?>
                <div class="container alert <?php echo $msgSuccess;?>"><?php echo $outputSuccess;?></div>
            <?php endif;?>

            <?php if(!empty($Email) && FILTER_VAR($Email,FILTER_VALIDATE_EMAIL)===false):?>
                <div class="container alert <?php echo $msg;?>"><?php echo $outputInvalidEmail;?></div>
            <?php endif;?>

            <?php if(strlen($Password) < 6 && strlen($Password) > 0 && FILTER_VAR($Email,FILTER_VALIDATE_EMAIL)):?>
                <div class="container alert <?php echo $msg;?>"><?php echo $outputInvalidPassword;?></div>
            <?php endif;?>
        <?php endif ;?>
    </div>  
</body>
</html>