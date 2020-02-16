<?php
    $conn = new mysqli("localhost","root","","note");
    if($conn->connect_error){
        die("connection failed!".$conn->connect_error);
    }
      $result = array('error'=>false);
    $action='';
    if(isset($_GET['action'])){
        $action=$_GET['action'];
    }
    if($action =='read'){
        $sql=$conn->query("SELECT * FROM users");
        $users = array(); 
        while($row=$sql->fetch_assoc()){
            array_push($users,$row);
        }
        $result['users'] = $users;
    }
    if($action =='create'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        $sql=$conn->query("INSERT INTO users ( name , email , note) VALUES('$name','$email','$note')");
        if($sql){
            $result['message']="note added successfully";
        }
        else{
            $result['error']=true;
            $result['message']="failed";
        }
    }

    if($action =='update'){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['note'];
        $sql=$conn->query("UPDATE users SET name='$name' ,email='$email' ,note= '$note' WHERE id='$id'");
        if($sql){
            $result['message']="note updated successfully";
        }
        else{
            $result['error']=true; 
            $result['message']="failed";
        }
    }

    if($action =='delete'){
        $id = $_POST['id'];
       
        $sql=$conn->query("DELETE FROM users WHERE id='$id'");
        if($sql){
            $result['message']="user deleted successfully";
        }
        else{
            $result['error']=true;
            $result['message']="failed";
        }
    }
    $conn->close();

    echo json_encode($result);
    
?>