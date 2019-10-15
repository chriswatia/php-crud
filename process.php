<?php
session_start();

//Declare variables
$id = 0;
$update = false;
$name = '';
$location = '';


//connect to database
$mysqli = new mysqli('localhost', 'root', 'Chris100+', 'php_crud') or die(mysqli_error($mysqli));

//check if save button is clicked
if (isset($_POST['save'])) {

    //Define variables
    $name = $_POST['name'];
    $location = $_POST['location'];

    //Insert data to database
    $mysqli->query("INSERT INTO crud (name, location) VALUES('$name', '$location') ") or die($mysqli->error);

    //Declare session variables
    $_SESSION['message'] = 'Record saved successfuly!';
    $_SESSION['msg_type'] = 'success';

    //redirect user back to home page
    header("Location: index.php");
}


//if delete button is clicked
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    //delete record from table
    $mysqli->query("DELETE FROM crud WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = 'Record deleted!';
    $_SESSION['msg_type'] = 'danger';

    //redirect user back to home page
    header("Location: index.php");
}

//if edit button is clicked
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM crud WHERE id=$id ") or die($mysqli->error);
    if($result){
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $location = $row['location'];

    }
}

//Update a record
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    //Insert data to database
    $mysqli->query("UPDATE crud SET name='$name', location='$location' WHERE id=$id ") or die($mysqli->error);

    //Declare session variables
    $_SESSION['message'] = 'Record updated successfuly!';
    $_SESSION['msg_type'] = 'info';

    //redirect user back to home page
    header("Location: index.php");
}