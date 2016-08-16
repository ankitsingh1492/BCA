<?php 
include ( "../pg/header.php" );?>
<?php
 if (isset( $_GET['u'])) {
 	$username = mysqli_real_escape_string($db,$_GET['u']);
 	if (ctype_alnum($username)) {
 		// check user exists
 		$check = mysqli_query($db,"SELECT username, fname FROM system_db WHERE username='$username'");
 		if (mysqli_num_rows($check)==1) {
 			$get = mysqli_fetch_assoc($check);
 			$username = $get['username'];
 			$firstname = $get['fname'];
 		}
 		else {
 			 echo "<meta http-equiv=\"refresh\" content=\"0; url= http://localhost/bca/home.html\"`	>";
 			exit();
 		}
 	}
 }  
 $post= @$_POST['post'];
    if($post != ""){
	$date_added = date("Y-m-d");
	$added_by = $user ;
	$user_posted_to = $username;

	$sql = "INSERT INTO posts VALUES ('','$post','$date_added','$added_by','$user_posted_to')";
	$result= mysqli_query($db,$sql) or die (mysql_error());
	//echo "<meta http-equiv=\"refresh\" content=\"0; url= http://localhost/bca/profile/".$user."\">";  

    }
    
?>

<div class="photo"> <?php 
                       // selects the associated row 
						
                       $fname = mysqli_query($db, "SELECT fname, lname, designation FROM system_db, designation WHERE system_db.d_id = designation.d_id AND username ='$username'");
                       $get_name = mysqli_fetch_assoc($fname);
                       $f_name = @$get_name['fname'];
                       $l_name = @$get_name['lname'];
                       $desg = @$get_name['designation'];
                       echo nl2br("NAME = $f_name $l_name \n\n IS A = $desg \n\n USERNAME = $username");?>
 </div>

<div class="friend"> 
<h3>Bio-</h3>
<?php 
     $bio_query= mysqli_query($db,"SELECT bio FROM system_db WHERE username ='$username'");
     $get_bio = mysqli_fetch_assoc($bio_query);
     $user_bio = $get_bio['bio'];
     echo $user_bio;
?>
 </div>
<div class="postques"> 

	<form action="<?php echo $username ;?>" method="POST">
		<textarea id="post" name="post" rows="5" cols="75" placeholder="Share here !!"></textarea>
		<button class="post" type="submit" name="send" value="post"/>Submit</button>
	</form>	
</div>
<div class="profilepost"> 
<?php
// stores the fetch query
$getposts = mysqli_query($db,"SELECT * FROM posts WHERE user_posted_to ='$username' ORDER BY id DESC LIMIT 10") or die(mysqli_error());
// stores the associative array
while ($row = mysqli_fetch_assoc($getposts)){

	                $id = $row['id'];
	                $body = $row['body'];
	                $date_added = $row['date_added'];
	                $added_by = $row['added_by'];
	                $user_posted_to = $row['user_posted_to'];
	                echo nl2br("<a href='$added_by'>$added_by</a> - $date_added   \n '$body'\n \n  ");
}
?>

 </div>

