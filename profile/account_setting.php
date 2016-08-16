<?php
    include ('../pg/header.php');
    if ($user){

    } else
    {
    	die("please login first!!");
    }
?>

<?php 
    $senddata = @$_POST['senddata'];

    //declaration of variables
    $old_password= @$_POST['oldpassword'];
    $new_password = @$_POST['newpassword'];
    $repeat_password= @$_POST['newpassword2'];
    if ($senddata)
    {
        $pass= mysqli_query($db,"SELECT * FROM system_db WHERE username= '$user' ");
        while ($row = mysqli_fetch_assoc($pass)){
            $db_pass = $row['password'];
            // hash the old password
            $old_password_md5 = md5($old_password);
            // check the old password equals the $db_pass
            if ($old_password_md5 == $db_pass){
                // check for new passwords to match
                 $new_password_md5 = md5($new_password);
                if($new_password == $repeat_password){
                 $pass_update= mysqli_query($db,"UPDATE system_db SET password='$new_password_md5' WHERE username= '$user'");
                  echo "your password has been changed!!";
                }
                else{
                    echo "ERROR !! Passwords don't match";
                }
            }else{
                echo "Old password is incorrect";
            }
           
        }
        }

        else{
           // echo "please update first ";
        }

?>  

<?php
   $biodata = @$_POST['senddata2'];

    $new_bio = @$_POST['bio'];

   if ($biodata){

    $bioupdate= mysqli_query($db, "UPDATE system_db SET bio='$new_bio' WHERE username='$user' ");
    echo "<meta http-equiv=\"refresh\" content=\"0; url= http://localhost/bca/profile/".$user."\">";  
    
   }



?>

<div class="account">
<div class="acc">
<p> Change Password: </p><br>
<form action="account_setting.php" method="POST">
<input type="password" name="oldpassword" id="oldpassword" size="30" placeholder="Old Password:"/><br><br>
<input type="password" name="newpassword" id="newpassword" size="30" placeholder="New Password:"/><br><br>
<input type="password" name="newpassword2" id="newpassword2" size="30" placeholder="Repeat Password:"/><br><br>
 <button class="btnExample" name="senddata" type="submit" value="UPDATE"/>UPDATE</button><br><br>
</form>
</div>

<div class="bio">
	<p> Update Bio : </p> <br>
	<form action="account_setting.php" method="POST">
	<textarea id="post" name="bio" rows="5" cols="40" placeholder="Bio"></textarea> <br><br>
    <button class="btnExample" name="senddata2" type="submit" value="UPDATE"/>UPDATE</button><br><br>
  
</form>
</div>
</div>