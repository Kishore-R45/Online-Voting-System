<?php

$conn= mysqli_connect('localhost','root','Kishore@2006','voting');
if(!$conn){
    echo "Connection failed";
}else{
    echo "Connection Succesful";
}

?>