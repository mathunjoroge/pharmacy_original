<?php
    $toDay = date('d-m-Y');

    $dbhost =   "localhost";
    $dbuser =   "root";
    $dbpass =   "";
    $dbname =   "sales";

    exec("mysqldump --user=$dbuser --password='$dbpass' --host=$dbhost $dbname > /localhost/lumumba/".$toDay."_DB.sql");


?>