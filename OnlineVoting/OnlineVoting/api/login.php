<?php

    session_start();
    include('connect.php');
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    
    $check=mysqli_query($con,"SELECT * FROM user WHERE Phone='$mobile' AND Password='$password' AND Role='$role' ");
    
    if(mysqli_num_rows($check)>0)
    {
        $userdata = mysqli_fetch_array($check);

        $insert_query = "INSERT INTO Party (Group_ID, Group_Name, Voters, Status) 
                         SELECT ID, Name, Voters, Status 
                         FROM user 
                         WHERE Role = 2
                         ON DUPLICATE KEY UPDATE 
                         Group_Name = VALUES(Group_Name), 
                         Voters = VALUES(Voters), 
                         Status = VALUES(Status)";
        mysqli_query($con, $insert_query);

        $groups = mysqli_query($con, "SELECT * FROM user WHERE Role=2");
        $groupsdata = mysqli_fetch_all($groups,MYSQLI_ASSOC);

        $_SESSION['userdata']=$userdata;
        $_SESSION['groupsdata']=$groupsdata;

        echo '
            <script>
            window.location = "../routes/dashboard.php";
            </script>
            ';
    }
    else
    {
        echo '
            <script>
            alert("Invalid credentials!");
            window.location = "../";
            </script>
            ';
    }
?>
