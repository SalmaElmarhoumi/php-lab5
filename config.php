<?php 

    $dbhost='localhost';
    $dbuser='root';
    $dbpass ='';
    $dbname='phplab5';
    $connection = mysqli_connect($dbhost , $dbuser, $dbpass, $dbname);

    if(!$connection){
        die("Connection failed : " . mysqli_connect_error());
    }
        echo "Connected successfully";
        mysqli_select_db( $connection,$dbname );

        // check if table exists
  $result = mysqli_query($connection, 'SHOW TABLES LIKE "signup"');
  // if table does not exist
if (mysqli_num_rows($result) == 0) {
$mysql= 'CREATE TABLE signup (
  id INT  NOT NULL AUTO_INCREMENT ,
  username varchar(15) not null ,
  useremail varchar(20) not null ,
  userpassword varchar(20) not null ,
  PRIMARY KEY (id))';

$tableConn = mysqli_query($connection , $mysql);

if(! $tableConn ) {
    die('Could not create table: ' . mysqli_error($connection));
 }

 echo "<br>Database Table  created successfully\n";
}

?>