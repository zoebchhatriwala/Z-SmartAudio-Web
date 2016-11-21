<?php
include 'SPNGSTLLC78653.php';
									if(isset($_GET['username']) && isset($_GET['password']))
									{
                                    $password = htmlspecialchars($_GET['password']);
                                    $username = htmlspecialchars($_GET['username']);
	                                $query = "UPDATE users SET loggedin='0' WHERE userid='$username' AND password='$password'";
									$query = $dataBase->prepare($query);
					                if($query->execute())
									{
										echo '#PASS';
									}
									else
									{
										echo '#FAIL';
									}
	                                 }
	?>
