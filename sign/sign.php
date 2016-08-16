<?php

include ('../pg/connection.php');

$fname  = mysqli_real_escape_string($db, $_POST['fname']);
$lname = mysqli_real_escape_string($db, $_POST['lname']);
$username = mysqli_real_escape_string($db, $_POST['username']);
$pass = mysqli_real_escape_string($db, $_POST['password']);
$pass2 = mysqli_real_escape_string($db, $_POST['password2']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$u_id = mysqli_real_escape_string($db, $_POST['reg_id']);
$designation_id = mysqli_real_escape_string($db, $_POST['designation']);

//form validation
// checks if all the fields are filled 
if($u_id&&$designation_id&&$fname&&$lname&&$username&&$pass&&$email){
// checks the password match
if ($pass== $pass2){
// check the user already exists
$u_check = mysqli_query($db,"SELECT username FROM system_db where username = '$username'");
$check = mysqli_num_rows($u_check);
if ($check == 0){
	// check for id match
	$ids_check = mysqli_query($db,"SELECT id FROM stud where id = '$u_id'");
	$idt_check = mysqli_query($db,"SELECT  id FROM teach where id = '$u_id'");
	$s_result = mysqli_num_rows($ids_check);
	$t_result = mysqli_num_rows($idt_check);
	if ($s_result == 0 && $t_result == 0){
		echo "Please provide Valid ID";
	}
	elseif ($s_result !=0 && $designation_id ==2 || $t_result !=0 && $designation_id ==1) {
	// insert values in table
	$pass = md5($pass);
	$sql="INSERT INTO system_db (id , d_id, fname, lname, username, password, email)
	VALUES ('$u_id', '$designation_id', '$fname', '$lname', '$username', '$pass', '$email')";
	if (!mysqli_query($db,$sql)) {
    die('Error: ' . mysqli_error($db));}
  	
  	echo "Thankyou for Registration!!. Please <a href='../login/login.php'> LOGIN </a>back to continue";
  }

 
  elseif($s_result !=0 && $designation_id == 1 || $t_result !=0 && $designation_id ==2){
  	echo "Designation mismatch!!!! please verify the radio buttons";
  }
}

else {
	echo "This username Exists!!!!";
}

}
else{
	echo "Passwords Don't match!!!";
}
}

else{
	echo "Enter all the values !!!";
}

//close the database
mysqli_close($db);

?>