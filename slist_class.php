<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
	if(!isset($_SESSION['username'])){
    echo "<script>window.location.href='index.php';</script>";
    //header('location:index.php');
     }
	$username=$_SESSION['username'];
	$query="select * from faculty where username='$username'";
	$result=mysqli_query($con,$query);
	$row1=mysqli_fetch_array($result);
	$dept1=$row1['dept'];
	$batch=$row1['batch'];
?>

<html>  
<head lang="en">    
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css\tailwind.min.css">
    <title>View students</title>  
</head>    
  
<body>   
    <div class="container ">
	<h1 class="mb-8 text-center text-2xl text-teal-400">
    Students of <?php echo "$dept1  batch $batch";?>
  </h1> 
  <table class="text-left w-full ml-8">
		<thead class="bg-teal-400 flex text-white w-full"> 
  
        <tr class="flex w-full mb-4"> 
  
            <th class="p-4 w-1/6">User Name</th>  
            <th class="p-4 w-1/6">Department</th>  
            <th class="p-4 w-1/6">Year of Join</th>  
            <th class="p-4 w-1/6">Year of Passout</th>  
            <th class="p-4 w-1/6">Email</th>
            <th class="p-4 w-1/6">Edit User</th>  
        </tr>  
        </thead>  
        <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full" style="height: 50vh;">
        <?php  
         
        $view_users_query="select * from student where dept='$dept1' and start_yr='$batch'";//select query for viewing users.  
        $run=mysqli_query($con,$view_users_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
        {  
            $user_id=$row['username'];  
            $department=$row['dept'];  
            $sy=$row['start_yr'];  
            $ey=$row['end_yr'];
            $user_email=$row['email']; 
  
        ?>  
        <form action="slist_class.php" method="post">
        <tr class="flex w-full mb-1">
<!--here showing results in the table -->  
            <td class="p-4 w-1/6 overflow-hidden"><?php echo $user_id;  ?></td>  
            <td class="p-4 w-1/6 overflow-hidden"><?php echo $department;  ?></td>  
            <td class="p-4 w-1/6 overflow-hidden"><?php echo $sy;  ?></td>  
            <td class="p-4 w-1/6 overflow-hidden"><?php echo $ey;  ?></td>
            <td class="p-4 w-1/6 overflow-hidden"><?php echo $user_email; ?></td>
            <td class="p-4 w-1/6 overflow-hidden"><a href="slist_class.php"><button class="btn btn-danger" type="submit" name="<?php echo $user_id; ?>">Delete</button></a></td> <!--btn btn-danger is a bootstrap button to show danger-->  
        </tr>  
        </form>
        
        <?php
			if(isset($_POST[$user_id]))
			{
				$batch=$_POST['batch'];
				$query="delete from student where username='$user_id'";
			    $query_run = mysqli_query($con,$query);
			    if($query_run)
			    {
					      echo '<script type="text/javascript">alert("Student deleted successfully ")</script>';
					        echo "<script>window.location.href='advisor.php';</script>";
				}
			    else
			    {
			        echo '<script type="text/javascript">alert("DB error")</script>';
			    }
			}
		?>
        <?php } ?>  
  
        </tbody>  
       
  
       </table> 
       </br>
       <form href="slist_class.php" method="post">
       <a href="slist_class.php"><button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline float-right" type="submit" name="back">
                                   back
           </button> </a>
           </form>
           <?php
               if(isset($_POST['back']))
               {
                    echo "<script>window.location.href='advisor.php';</script>";
                    
               }?>
           </div>
  
</body>  
  
</html> 