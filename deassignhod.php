<?php
	session_start();
	require_once('dbconfig/config.php');
	if(!isset($_SESSION['username'])){
    echo "<script>window.location.href='index.php';</script>";
    //header('location:index.php');
     }
	//phpinfo();

    if(isset($_POST[$user_id]))
			{
			    $query="select * from faculty where dept='$dept' and user_type='HOD'";
			    $query_run = mysqli_query($con,$query);
			    if($query_run)
			    {
				    if(mysqli_num_rows($query_run)>1)
				    {
				        $query = "update faculty set user_type='faculty' where username='$user_id' ";
				        $query_run = mysqli_query($con,$query);
			        	if($query_run)
				    	{
					     echo '<script type="text/javascript">alert("Successfully deassigned hod ")</script>';
					     echo "<script>window.location.href='homepage.php';</script>";
				    	}
				    	else
					    {
					     echo '<script type="text/javascript">alert("DB error")</script>';
					    }
				    }
				    else
				    {
				        echo '<script type="text/javascript">alert("Not an HOD for the department!")</script>';
				    }
			    }
			    else
			    {
			        echo '<script type="text/javascript">alert("DB error")</script>';
			    }
			}
		?>

