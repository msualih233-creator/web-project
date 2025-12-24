<?php
$success="";
$name=$email=$phon_number="";
$name_error=$email_error=$phon_number_error="";
if($_SERVER("requasted")=="post"){
    $name=trim($_POST["name"]);
    $email=trim($_POST["email"]);
    $phon_number=trim($_POST["phone_number"])
    if (empty(($name))){
        $name_error="name is requared";
    }
    if(empty($email)){
        $email_error="email is requared";
    }elseif(is_numeric($email)){
    $email_error="email must include @";
    }
    
    if(empty($phon_number)){
        $phone_number_error="phone requared";
    }elseif(!is_numeric($phon_number))
    $phone_number_error="phone must be numberic";
    if(
        $name_error==""&&
        $email_error==""&&
        $phon_number==""&&
        )
      {
        $onn=$mysqli_connect("localhost","root","","sign_up");
        if(!$conn){
            echo="connect error"
        }
        $sql="insert  into users(name,email,phone_number )VALUES('$name,$email,$phon_number)";
        $mysqli_query($conn,$sql);
        $conn_close($conn);
        $success = " signup submitted successfully!"
        $name=$email=$phon_number="";
    }


      }  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent Apartment</title>
    
</head>
<body>
<form method="POST" class="contact-card">
    <h2>🏢 Rent Out Your Apartment</h2>

    <?php if ($success != "") { ?>
        <div style="color:green; margin-bottom:15px;">
            <?php echo $success; ?>
        </div>
    <?php } ?>
    <label>👤 Owner Name</label>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <small style="color:red;"><?php echo $name_error; ?></small>
     <label>🏢 email</label>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <small style="color:red;"><?php echo $emil_error; ?></small>

   <label>📞 Phone Number</label>
<input type="text" name="phone_number" value="<?php echo $phon_number; ?>">
<small style="color:red;"><?php echo $phone_number_error; ?></small>
</form>
</body>
</html>

   