								<?php
								// Enable CORS (http://enable-cors.org/server_php.html)
								require 'public/Initialize.php';
								//require_once("public/http_status.php");
								require_once("public/db_opt.php");
								$classid=$_POST["Classid"];
								$engname=$_POST["EngName"];
								$passwd=$_POST["PassWord"];
								//$classid="k1003";
								//$engname="jason";
								//check if have the same engname in db
								$conn=db_conn("daresay_db");
								$sql="SELECT * FROM online_user WHERE engname='$engname' and classid='$classid' and passwd='$passwd'";
								$result=mysql_query($sql,$conn);
								if (!$result) {
									http_response_code(400);
								}

								$row = mysql_fetch_assoc($result);
								if ($row) {
									//http_response_status(200);
									//header('HTTP/1.1 200 OK');
									# upate the access times
								    $access_times = $row['access_times'] + 1;
									$sql="UPDATE online_user SET access_times='$access_times' WHERE engname='$engname' AND classid='$classid' AND passwd='$passwd'";
								    $result=mysql_query($sql,$conn);
									http_response_code(200);

								} else {
									//http_response_status(400);
									http_response_code(400);
									//header('HTTP/1.1 400 Bad Request');
								}
								mysql_close($conn);
								