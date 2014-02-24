<?php

// send any pending emails in the SQL database that are outstanding:
// single-threaded, use lock to prevent others running.

$lockfile = "/var/www/welcomecentre/queue.lck";

if ( ! file_exists( $lockfile ) ) { 

touch($lockfile);

$link = mysql_connect('localhost', 'root', 'hsbne');
$db_selected = mysql_select_db('doorlog', $link);


$sql = "SELECT * from email_queue where status = 'pending' "; 


$result = mysql_query($sql);

if (!$result) { print "error, died\n"; die('Invalid query: ' . mysql_error()); }

while ($row = mysql_fetch_assoc($result)) {


  $id = $row['id'];
  print "id: $id\n";

  $to  = $row['to'];
  $subject = $row['subject'];
  $headers = $row['headers'];
  $message = $row['message'];
  $status = $message['status'];

mail($to, "$subject $id", $message, $headers);

$sql = "update email_queue set status = 'sent' where id = '$id'";
print "sql: $sql\n";

mysql_query($sql);


}

unlink($lockfile);

} // if lock file? 

