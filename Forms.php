<?php
include 'connection.php';
session_start();
$id = uniqid();
$_SESSION['id'] = $id;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Bmi-Form</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src='main.js'></script>
  </head>
  <body id="bdform">
    <div class="container" id="form">
      <div class="row">
        <div class="Content">
          <div id="Heading">
            <p>Tell us about Yourself</p>
          </div>
          <form action="Bmi.php" method="post" id="form">
            <div class="form-group">
              <label for="usr">Name</label>
              <input type="text" class="form-control" id="usr" name="uname" placeholder="Full Name">
            </div>
            <div class="form-group">
              <label for="usr">Age</label>
              <input type="number" min="18" max="80" class="form-control" id="usr" name="age" placeholder="Age" required>
            </div>
            <div class="form-group">
              <label for="usr">Weight</label>
              <input type="number" pattern="[0-9]{3}" maxlength="3" class="form-control" id="usr" name="weight" title="Weight should NOT > Three figures Eg.60 ,110" placeholder="Weight in Kg" required>
            </div>
            <div class="form-group">
              <label for="usr">Height</label>
              <input type="number" pattern="[0-9]{3}" maxlength="3" class="form-control" id="usr" name="height" placeholder="Height in cm" required>
            </div>
            <div class="form-group">
              <label for="usr">Gender</label>
              <select name="gender" style="width:300; height:35px; margin-left: 0px;" id="frm_select" required>
                <option value="Male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div id="button_form">
              <button type="submit" id="form_sub" name="first">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>