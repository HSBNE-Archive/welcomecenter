<?php


$link = mysql_connect('localhost', 'root', 'hsbne');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_selected = mysql_select_db('doorlog', $link);
if (!$db_selected) {
    die ('Can\'t use doorlog : ' . mysql_error());
}

//$laststamp = '2013-02-23 22:18:52';

$abort = 0;
while($abort <= 40 ){ 

// are there any messages to put on-screen? 

$sql = "SELECT * FROM `alert` WHERE status = 'new'";

$result = mysql_query($sql);
if (!$result) { die('Invalid query: ' . mysql_error()); }
$id = '';
$msg = '';
while ($row = mysql_fetch_assoc($result)) {
    $id = $row['id'];
    $msg = $row['msg'];
}
if ( $msg != '' ) { 
    
sleep(2);  //delay the showing og he text;;;

    echo "$msg<br>"; // show it to the user
    
    // put the expiry on it by changing the status away from 'new'
    $sql = "UPDATE `alert` SET status = 'displaying'  WHERE `id` = $id";
    $result = mysql_query($sql);  
   
    exit();
} 

// are there any messages to remove from the screen? 

$sql = "SELECT * FROM `alert` WHERE status = 'displaying'";
$result = mysql_query($sql);
if (!$result) { die('Invalid query: ' . mysql_error()); }
$id = '';
$msg = '';
while ($row = mysql_fetch_assoc($result)) {
    $id = $row['id'];
    $msg = $row['msg'];
}
if ( $msg != '' ) { 

    sleep(5); // simple way to keep thing on-screen a bit, we could use timestamps in databsae too, if we wanted.


    header("HTTP/1.0 404 Not Found");

    echo "<br>"; // don't show it to the user any more
    
    // put the expiry on it by changing the status away from 'new'
    $sql = "UPDATE `alert` SET status = 'done'  WHERE `id` = $id";
    $result = mysql_query($sql);  
    exit();
   
} 


sleep(1);

$abort++;

} // while
    header("HTTP/1.0 404 Not Found");

?>
