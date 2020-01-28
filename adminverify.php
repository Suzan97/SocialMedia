<?php
session_start();
$con=mysqli_connect('localhost', 'root')
    or die("Could not establish connection");

mysqli_select_db($con,'project') or
    die ("Could not select the db");

if(isset($_POST['adminname']) && isset($_POST['password'])){
    
    $adminname=$_POST['adminname'];
    $password=($_POST['password']);
    
   $_SESSION['adminname']=$adminname;
    $_SESSION['password']=$password;
    
    
    $sql=mysqli_query($con, "SELECT * FROM admin WHERE adminname = '$adminname' AND password= '$password'");
    //echo "SELECT * FROM register WHERE adminname = '$adminname' AND password= '$password'";
    
    $rows = mysqli_num_rows($sql);
   
   
    if($sql && $rows > 0){
        $arr_result = mysqli_fetch_array($sql);
     header ("location:update.php");
        
    }else{
        echo "Login failed".mysqli_error($con);
        
    }
    

}

?>