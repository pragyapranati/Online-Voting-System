<?php
    
    $con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "C:\Program Files\MySQL\DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($con, "voting.mysql.database.azure.com", "username", "<password>", "voting", 3306, MYSQLI_CLIENT_SSL);
    
?>