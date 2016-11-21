<?php 
include 'SPNGSTLLC78653.php';
if(isset($_GET['username']) && isset($_GET['password']))
									{
                                    $password = htmlspecialchars($_GET['password']);
                                    $username = htmlspecialchars($_GET['username']);
	                                $query = "SELECT id FROM users WHERE userid='$username' AND password='$password' AND accepted=1 ";
									$query = $dataBase->prepare($query);
					                $result = $query->execute();
									$row = $result->fetchArray(SQLITE3_ASSOC);
								   if ($row['id']>=1)
					 {
$query = "SELECT * FROM audio";
$results = $dataBase->query($query);
$output='{ "audio":[';
while ($row = $results->fetchArray(SQLITE3_ASSOC))
{
$output = $output.json_encode($row);
$output = $output.',';
}
$output = rtrim($output, ",");
$output = $output.'] }';
echo $output;
					 }
					 }
?>