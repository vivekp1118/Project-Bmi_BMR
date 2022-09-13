<?php
if(isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 600)) {
    session_unset(); 
    session_destroy();
    header("Location: https://bmi-calculator001.000webhostapp.com ");
    exit;
    }
    elseif($_SESSION['id']==null)
    {
        header("Location: https://bmi-calculator001.000webhostapp.com "); 
    }
    $_SESSION['sestime'] = time(); 
?>