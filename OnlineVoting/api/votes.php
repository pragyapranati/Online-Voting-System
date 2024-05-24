<?php
    session_start(); 
    include("connect.php");
    
    
    if(isset($_SESSION['userdata']) and isset($_SESSION['userdata']['ID'])) 
    {
        if($_SESSION['userdata']['Status'] == 1) {
            echo '<script>alert("You have already voted!"); window.location = "../routes/dashboard.php";</script>';
            exit;
        }

        $votes = $_POST['gvotes'];
        $total_votes = $votes + 1;
        $gid = $_POST['gid'];
        $uid = $_SESSION['userdata']['ID'];

       
        $update_votes = mysqli_query($con, "UPDATE user SET Voters='$total_votes' WHERE ID='$gid'");
        
        $update_user_status = mysqli_query($con, "UPDATE user SET Status=1 WHERE ID='$uid'");

        if($update_votes and $update_user_status) {
            
            $groups = mysqli_query($con, "SELECT ID, Name, Voters, Photo FROM user WHERE Role=2");
            $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

            $_SESSION['userdata']['Status'] = 1;
            $_SESSION['groupsdata'] = $groupsdata;  

            
            echo '<script>alert("Voting Successful!"); window.location = "../routes/dashboard.php";</script>';
        } 
        else {
            
            echo '<script>alert("Some error occurred!"); window.location = "../routes/dashboard.php";</script>';
        }
    } 
    else 
    {
        
        echo "Session data is not set.";
    }
?>
