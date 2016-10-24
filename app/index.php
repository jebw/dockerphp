<?php

$host = getenv('DB_HOST') ;
if ($host == '')
  $host = '127.0.0.1' ;

$mysqli = new mysqli($host, 'root', 'root', 'testing');
#
if ($mysqli->connect_errno) {
  echo "COULD NOT CONNECT TO DB\n" ;
  echo "Errno: " . $mysqli->connect_errno . "\n";
  echo "Error: " . $mysqli->connect_error . "\n";
  exit ;
}
#
$sql = "SELECT UNIX_TIMESTAMP() as clock" ;
if (!$result = $mysqli->query($sql)) {
    echo "Sorry, the website is experiencing problems.";

    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

$time = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/static/styles.css" type="text/css" media="screen">
  </head>
  <body>
    <h1>Time is <?php echo strftime('%l:%M:%S', $time['clock']) ?></h1>
  </body>
</html>