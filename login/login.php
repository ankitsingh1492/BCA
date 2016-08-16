
<?php include ("../pg/header.php");?>

<?php 



// user login code

if (isset($_POST["user_login"]) && isset($_POST["password_login"])){
	$user_login =  preg_replace('#[^A-Za-z0-9]#i', '',$_POST["user_login"]); // filter all characters but numbers and letters
    $password_login =  preg_replace('#[^A-Za-z0-9]#i', '',$_POST["password_login"]); //filter all characters but numbers and letters
    $password_login_md5 = md5($password_login);
    $sql= "SELECT user_id FROM system_db WHERE username='$user_login' AND password='$password_login_md5' LIMIT 1";
    $result=mysqli_query($db,$sql);
    // check for user
    $usercount = mysqli_num_rows($result);
    if ($usercount == 1) {
        while($row = mysqli_fetch_array($result)){
        	$id = $row["user_id"];
        }

        $_SESSION['user_login'] = $user_login;
        header("location: ../pg/home.php");
        exit();
    }  
     else{
    	echo "the information is incorrect , try again";
    	exit();}
    }

   
?>

<div id = "login" >
	
			<h2>Login below !! </h2>
             <form action ="login.php" method="POST">
	 		<input type = "text" name="user_login" size= "30" placeholder="username"/><br><br>
	 		<input type = "password" name="password_login" size= "30" placeholder="Password"/><br><br>
            <button class="btnExample" type="submit" value="Login"/>Submit</button><br><br>
	 	     </form>	
	      
</div>	 	

<?php include ("../pg/footer.php");?>
