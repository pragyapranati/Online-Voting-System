<?php
    
    session_start();
    if(!isset($_SESSION['userdata']))
    {
        header("location: ../");
        exit;
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];
    if($_SESSION['userdata']['Status']==0)
    {
        $status='<b style= "color:red">Not Voted</b>';
    }
    else{
        $status='<b style= "color:green"> Voted</b>';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Voting System-Dashboard</title> 
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
    <style>
        #back
        {
    padding: 5px;
    border-radius: 5px;
    background-color: blue;
    color: white;
    float: left;
    margin: 10px;
    }

        #logout
        {
    padding: 5px;
    border-radius: 5px;
    background-color: blue;
    color: white;
    float: right;

    }

        #Profile
        {
            float: left;
            background-color: white;
            width: 30%; 
            padding: 20px;
        }
        #Group{
            float: right;
            width: 60%;
            padding: 20px;
            background-color: white;
        }
        #votebtn{
            padding: 5px;
            border-radius: 5px;
            background-color: blue;
            color: white;
            float: left;
        }

        #mainpanel{
            padding: 10px;
        }
        #HeaderSection{
            padding: 10px;
        }

        #voted
        {
            padding: 5px;
            border-radius: 5px;
            color: green;
            font-size: 15 px;
        }

        .clearfix::after 
        {
        content: "";
        display: table;
        clear: both;
        }

    </style>
    
    <div id="MainSection">
    <div id="HeaderSection">
        <a href="../" ><button id="back">Back</button> </a>
        <a href="logout.php"><button id="logout"> LogOut</button></a>
        <h1>Online Voting System</h1>
    </div>
    <hr>
    <div id="mainpanel">
    <div id="Profile">
    <img src="../uploads/<?php echo $userdata['Photo'] ?>" height="150" width="150"><br><br>
    <b>Name: </b><?php echo $userdata['Name'] ?><br><br>
    <b>Mobile: </b><?php echo $userdata['Phone'] ?><br><br>
    <b>Address: </b><?php echo $userdata['Address'] ?><br><br>
    <b>Status: </b><?php echo $status ?><br><br>
    </div>

    
    
    <div id="Group">
        <?php
            if($_SESSION['groupsdata'])
            {
                for($i=0;$i<count($groupsdata);$i++){
                    ?>
                    <div>
                        <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['Photo'] ?> " height="100" width="100"> <br><br>
                        
                        <b>Group Name</b>: <?php echo $groupsdata[$i]['Name']?> <br>
                        <b>Votes </b><?php echo $groupsdata[$i]['Voters']?><br>
                        <?php
if($_SESSION['userdata']['Role'] == 1)
{
    ?>
    <form action="../api/votes.php" method="post">
        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['Voters'] ?>"> 
        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['ID'] ?>">  
        
        <?php
            // Check if the user has not voted
            if($_SESSION['userdata']['Status'] == 0)
            {
                ?>
                <input type="submit" name="votebtn" value="Vote" id="votebtn">
                <?php
            }
            else
            {
                ?>
                <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                <?php
            }
        ?>
    </form>
    <?php
}
?>
                        <div class="clearfix"></div>
                        <hr>
                        
                </div>
                 <?php       

                }
            }
            else
            {

            }
        ?>
    </div>
    </div>
    
</body>
</html>