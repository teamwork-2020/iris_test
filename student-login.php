<?php
include 'connect.php'; 
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);}
else{
error_reporting(0);
$username=$_POST['username'];
$testcode=$_POST['testcode'];
$empty='';
$num=0;
$sql = "SELECT id,student FROM student WHERE student='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0){

	setcookie('susername', $username, time() + (86400*365));
      setcookie('stestcode', $testcode, time() + (86400*365));
      echo "<script>window.open('student-test.php','_self');</script>";  
}
else{  

$sql = "SELECT id,testcode FROM userdata WHERE testcode='$testcode'";
$result = $conn->query($sql);
if ($result->num_rows > 0){  
      print "string";
	setcookie('susername', $username, time() + (86400*365));
      setcookie('stestcode', $testcode, time() + (86400*365));
       $stmt = $conn->prepare("insert into student(student,testcode,answer1,answer2,answer3,answer4,answer5,percentage) values(?,?,?,?,?,?,?,?)");
       $stmt->bind_param("sssssssi",$username,$testcode,$empty,$empty,$empty,$empty,$empty,$num);
      $execval = $stmt->execute();
      echo "<script>window.open('student-test.php','_self');</script>";
}
 else {
	echo "<script>alert('testcode incorrect');</script>";
	echo "<script>window.open('index_student-login.html','_self');</script>";
	}
}
}
?>