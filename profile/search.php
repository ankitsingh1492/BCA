<?php
    include ('../pg/header.php');
    if ($user){

    } else
    {
    	die("please login first!!");
    }
?>

<div class="searchbox">
	<form action=" search.php " method="GET">
		<textarea class="txt" id="post" name="post" rows="2" cols="75" placeholder="SEARCH HERE !!"></textarea><br><br>
		Search for:
	 		<input type = "radio" name="designation" value="1" checked ="checked">Teacher
	 		<input type = "radio" name="designation" value="2">Student<br><br>
	 		<button class="btnExample" name="searchin" type="submit" value="Search"/>Search</button><br><br>
		
	</form>	
</div>

<div class="result">
    <?php
         $search = @$_GET['searchin'];
         $new_query = @$_GET['post'];
         $designation=@$_GET['designation'];
         if (isset($_GET["searchin"]))
         {

         	$search_query= mysqli_query($db," SELECT * FROM system_db WHERE fname= '$new_query' and  d_id = '$designation' ");
         	$countrow = mysqli_num_rows($search_query);
         	if ($countrow != '0')
         	{
         		while ($row = mysqli_fetch_assoc($search_query)){

	                $id = $row['fname'];
	                $profile = $row['username'];
	                echo nl2br ("'$id'  <a href='$profile'>visit profile</a> \n \n");
         	
        		 }

    		 }
         	else{ echo "couldn't find"; }
          }
          else{ echo "please enter a valid name!"; }
         
    ?>

</div>	