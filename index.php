<?php
include 'SPNGSTLLC78653.php';
session_start();
//login and logout
if(isset($_POST['sessionoff']) && $_POST['sessionoff']==1)
{
	 session_unset();
}
if(isset($_SESSION['login-failed']) && $_SESSION['login-failed'] == 1)
{
$failed="Login Credentials not found!!!!";	
session_unset();
}
//END
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Z-SmartAudio">
    <meta name="author" content="Zoeb Chhatriwala [ZOEB.CO.IN]">
    <title>Z-SmartAudio | Admin</title>
	<link rel="shortcut icon" href="images/logo.png">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	 <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</head>
<!-- Main Page Start -->
<?php

//Pin Change
if(isset($_POST['pinchange']))
{

if($_SESSION['logged-in']==1)
	{
	   $pin = mt_rand(10000,99999);
	   $sid = $_SESSION['id'];
	   $query = "UPDATE admin SET pin='$pin' WHERE id=$sid";
	   $dataBase->exec($query);
	   $_SESSION['pin'] = $pin;
	}
}
//End
?>

<?php

if(isset($_SESSION['logged-in']) && $_SESSION['logged-in']==1)
{
	
?>
<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Z-SmartAudio</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              
              
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " ".strtoupper($_SESSION['username']); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="" method="post">
      <input type="hidden" name="sessionoff" value="1">
      <input type="submit"  value="Log Out" style="background:none; border:none;" title="Log out of admin panel">
      </form>
	  <form action="" method="post">
      <input type="hidden" name="pinchange" value="1">
      <input type="submit"  value="Pin:<?php echo " ".$_SESSION['pin']; ?> " style="background:none; border:none;" title="Generate another registration pin">
      </form>
                        </li>
                    </ul>
                </li>
			  <li>	<a href="index.php"><i class="fa fa-refresh"></i></b></a>  </li>
            </ul>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
				<!-- File Upload-->
<?php
if(isset($_SESSION['fileupload']))
{
	if($_SESSION['fileupload']!="Please Enter File Name")
	{
		echo $_SESSION['fileupload'];
	}
	else
	{
		$noname = $_SESSION['fileupload'];
	}
$_SESSION['fileupload'] = "";
}
?>
<!-- END-->
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-music fa-fw"></i> Upload Audio File</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Select File</th>
										<th>Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
									<form action="fileupload.php" method="post" enctype="multipart/form-data">
                                         <td><input type="text" name="name" style="width:100%" class="form-control"/>
										 <?php 
								if(isset($noname) && $noname!="")
								{
									echo '<p Style="color:red"> '.$noname.'</p>';
									$noname="";
								}
								?>
										 </td>
                                         <td><input type="file" name="mp3" accept="audio/*" class="form-control"></td>
										 <td><input type="submit" value="Upload" class="btn" title="Upload file to server"/></td>
								    </form>
                                </tbody>
                            </table>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
				<!-- Delete Audio -->
<?php
									if(isset($_POST['deleteid']) && isset($_POST['deletefile']))
									{
                                    $deleteid = htmlspecialchars($_POST['deleteid']);
                                    $deletefile = htmlspecialchars($_POST['deletefile']);
									$deletefile = "uploads/".$deletefile;
	if($_SESSION['logged-in']==1)
	{
	   $query = "DELETE FROM audio WHERE id='$deleteid'";
	   $query = $dataBase->prepare($query);
	   $query->execute();;
	   if (is_file($deletefile))
	   {
           unlink($deletefile);
       }
									} }
	?>
<!-- End -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-music fa-fw"></i> Audio List</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>File</th>
                                        <th>Play</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$query = "SELECT * FROM audio";
						$results = $dataBase->query($query);
						while($row=$results->fetchArray(SQLITE3_ASSOC))
						{ ?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['filelocation']; ?></td>
                                        <td>
                                       <audio controls>
  <source src="uploads/<?php echo $row['filelocation']; ?>" type="audio/mpeg">
  Your browser does not support the audio tag.
                                       </audio>
                                    </td>
									<td>
									
								<form action="" method="post">
      <input type="hidden" name="deleteid" value="<?php echo $row['id']; ?>">
	  <input type="hidden" name="deletefile" value="<?php echo $row['filelocation']; ?>">
      <input type="submit" Style="color:red;" value="X" class="btn">
      </form>
									</td>
                                    </tr>
						<?php } ?>
                                </tbody>
                            </table>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<!-- change Pass -->
<?php
									if(isset($_POST['oldpass']) && isset($_POST['newpass']))
									{
                                    $oldpass = htmlspecialchars($_POST['oldpass']);
                                    $newpass = htmlspecialchars($_POST['newpass']);
                                    $newpassagain = htmlspecialchars($_POST['newpassagain']);
					                if($newpass==$newpassagain){
	if($_SESSION['logged-in']==1 && $_SESSION['password']==$oldpass)
	{
	   $sid = $_SESSION['id'];
	   $query = "UPDATE admin SET password='$newpass' WHERE id=$sid";
	   $query = $dataBase->prepare($query);
	   $query->execute();;
	   session_unset();
	   echo '<meta http-equiv="refresh" content="0"; url="index.php">';
	}
	else
	{
									   $passfailed = "Error in changing password, Please try again!!!";
	} 
	}
	else
	{
										$passfailed = "Password don't match!!!";
	}
	}
	?> <!-- END -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i>Change Password</h3>
                            </div>
                            <div class="panel-body">
							<form action="" method="post">
                                <div id="morris-donut-chart"></div>
								<?php 
								if(isset($passfailed))
								{
								echo '<p Style="color:red">'.$passfailed.'</p>';
								$passfailed="";
								}
								?>
                                <div class="text-left">
								<h5>Old Password</h5>
                                <input type="password" name="oldpass" class="form-control"/>
                                <h5>New Password</h5>
                                <input type="password" name="newpass" class="form-control"/>
								<h5>Confirm Password</h5>
                                <input type="password" name="newpassagain" class="form-control"/><br><br>
								<input type="submit" value="Change" class="btn" title="Change admin password"/>
                            </form>								
                                </div>
                            </div>
                        </div>
                    </div>
					<!-- Approve/Delete -->
<?php
                                    
									if(isset($_POST['acceptid']))
									{
                                    $acceptid = htmlspecialchars($_POST['acceptid']);
									$query = "SELECT accepted FROM users WHERE id='$acceptid'";
									$query = $dataBase->prepare($query);
						            $results = $query->execute();
						            $row = $results->fetchArray(SQLITE3_ASSOC);
									if($row['accepted']==true)
									{
										$acceptstatus=0;
									}
									else
									{
										$acceptstatus=1;
									}
									
	if($_SESSION['logged-in']==1)
	{
		
	$query = "UPDATE users SET accepted='$acceptstatus' WHERE id=$acceptid";
	$query = $dataBase->prepare($query);
	$query->execute();
    } }
	?>

<?php
									if(isset($_POST['kick']))
									{
                                    $kick = htmlspecialchars($_POST['kick']);
									
	if($_SESSION['logged-in']==1)
	{
		
	$query = "DELETE FROM users WHERE id=$kick";
	$query = $dataBase->prepare($query);
	$query->execute();
	 
    } }
	?>

<?php
                                    
									if(isset($_POST['lout']))
									{
                                    $lout = htmlspecialchars($_POST['lout']);
									
	if($_SESSION['logged-in']==1)
	{	
	$query = "UPDATE users SET loggedin='0' WHERE id=$lout";
	$query = $dataBase->prepare($query);
	$query->execute();	
	 
    } }
	?>

	<!-- END -->
	
	
					
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Users</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>User-ID</th>
                                                <th>Playing</th>
                                                <th>Approval | Delete</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
								$query = "SELECT * FROM users";
						$results = $dataBase->query($query);
						while($row = $results->fetchArray(SQLITE3_ASSOC))
						{ ?>
                                            <tr>
                                                <td><?php echo $row['userid']; ?></td>
                                                <td><?php echo $row['playing']; ?></td>
                                                <td>
												<form action="" method="post" style="display: inline;">
												<input type="hidden" name="acceptid" value="<?php echo $row['id']; ?>"/>
												<input type="submit" value="<?php if($row['accepted']==true)
												{echo 'Reject';	
												}else{ echo 'Accept'; }?>" style="<?php if($row['accepted']==true)
												{ echo 'color:red';	
												}else{ echo 'color:green'; }?>" class="btn" title="Accept or reject user audios sync request"/>
												</form>
												<form action="" method="post" style="display: inline;">
												<input type="hidden" name="kick" value="<?php echo $row['id']; ?>"/>
												<input type="submit" value="Kick Out" style="color:red;" class="btn" title="Delete user from server"/>
												</form>
												<form action="" method="post" style="display: inline;">
												<input type="hidden" name="lout" value="<?php echo $row['id']; ?>"/>
												<input type="submit" value="Log Out" style="color:blue;" class="btn" title="Only use when android application is removed and user didn't logged out"/>
												</form>
												</td>
												<td><?php if($row['accepted']==true){echo '<h6 style="color:green">ACTIVE</h6>';}
												else{echo '<h6 style="color:red">NOT ACTIVE</h6>';}?>
												</td>
                                            </tr><?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
						</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
	
<?php }
//Main Page END

//Login Page Start
	
else { session_regenerate_id(true);?>
<div class="container fixbody">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="padding-top:20%">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form action="login.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
								<?php 
								if(isset($failed) && $failed!="")
								{
									echo '<p Style="color:red">'.$failed.'</p>';
									$failed="";
								}
								?>
                                <!-- Change this to a button or input when using this as a form -->
                               <button class="btn btn-primary btn-lg" type="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
<?php 
 }
?>
<!-- Login Page END -->

</body>
</html>