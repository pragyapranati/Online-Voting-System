<?php
    include("connect.php");
    $name= $_POST['name'];
    $mobile= $_POST['mobile'];
    $password= $_POST['password'];
    $cpassword= $_POST['cpassword'];
    $address= $_POST['address'];
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $role = $_POST['role'];

    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/', $password)) {
        
        echo ' 
            <script>
            alert("Password must contain at least one alphabet, one digit, and one special character, and be at least 8 characters long.");
            window.location = "../routes/register.html";
            </script>
        ';
        exit; 
    }

    $mobile_pattern = '/^\d{10}$/'; // Matches a 10-digit number

    if (!preg_match($mobile_pattern, $mobile)) 
    {
    echo '
        <script>
        alert("Mobile number must be a 10-digit number without any special characters or spaces.");
        window.location = "../routes/register.html";
        </script>
    ';
    exit;
}


    if($password == $cpassword)
    {
        move_uploaded_file($tmp_name,"../uploads/$image");
        $insert = mysqli_query($con,"INSERT INTO user(Name, Phone, Password, Address, Photo, Role, Status, Voters) VALUES ('$name', '$mobile', '$password', '$address', '$image','$role',0,0)");
        if($insert)
        {
            echo '
            <script>
            alert("Successfully Registered!");
            window.location = "../";
            </script>
            ';
        }
        else
        {
            echo '
            <script>
            alert("Some error occurred!");
            window.location = "../routes/register.html";
            </script>
            ';
        }
    }
    else
    {
        echo '
            <script>
            alert("Password and Confirm Password does not match.");
            window.location = "../routes/register.html";
            </script>
        ';
       
    }
?>