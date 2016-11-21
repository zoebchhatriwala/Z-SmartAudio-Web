<?php
include 'SPNGSTLLC78653.php';
									if(isset($_GET['username']) && isset($_GET['password']))
									{
                                    $password = htmlspecialchars($_GET['password']);
                                    $username = htmlspecialchars($_GET['username']);
	                                $query = "SELECT id FROM users WHERE userid='$username' AND password='$password' AND loggedin='0'";
									$query = $dataBase->prepare($query);
					                $result = $query->execute();
									$row = $result->fetchArray(SQLITE3_ASSOC);
	                 if ($row['id']>=1)
					 {
						 $query = "UPDATE users SET loggedin='1' WHERE userid='$username' AND password='$password'";
						 $query = $dataBase->prepare($query);
						 $query->execute();
						 echo '#PASS';
					 }
				 else
				 {
					 echo '#FAIL';	 
				 }
	                                 }
	?>
