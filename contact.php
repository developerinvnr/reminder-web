<?php 
   $name = $_GET['name'];
   $phone = $_GET['phone'];
    $connection = mysqli_connect('localhost', 'reminder_root', 'reminder_password','reminder_web');
    if(!$connection){
    die("Database connection failed");
    }
    $query = "INSERT INTO contacts(contact_name,contact_number) VALUES ('$name', '$phone')";
    $result = mysqli_query($connection, $query);
    if(!$result){
    die('query is faild' . mysqli_connect_error());
    }else{echo "inseted....";}
?>