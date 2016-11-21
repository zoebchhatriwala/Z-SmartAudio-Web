<?php
include 'SPNGSTLLC78653.php';
									if(isset($_GET['username']) && isset($_GET['oldpass']) && isset($_GET['newpass']))
									{
                                    $oldpass = htmlspecialchars($_GET['oldpass']);
                                    $newpass = htmlspecialchars($_GET['newpass']);
                                    $username = htmlspecialchars($_GET['username']);
	                 $query = "UPDATE users SET password='$newpass', loggedin='0' WHERE userid='$username' AND password='$oldpass'";
					 $query = $dataBase->prepare($query);
	                 if ($query->execute())
					 {
						 echo '#PASS';
					 }
				 else
				 {
					 echo '#FAIL';	 
				 }
	                                 }
	?>
