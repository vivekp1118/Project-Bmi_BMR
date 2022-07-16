<?php
include 'connection.php';
session_start();
$bmi = "";
$weight1 = "";
$weight2 = "";
$weight3 = "";
$range = "";
$loose = "";
$redi = "";
$cnt = 0;
if (isset($_POST['first'])) {
  $user = $_POST['uname'];
  $age = $_POST['age'];
  $weight = $_POST['weight'];
  $height = $_POST['height'];
  $gender = $_POST['gender'];
  $heightm = $height / 100;

  $bmi = $weight / ($heightm ** 2);

  $IDEAL_BMI_LOWER = 18.5 * ($heightm ** 2);
  $IDEAL_BMI_UPPER = 25 * ($heightm ** 2);
  $bmi = number_format((float)$bmi, 1, '.', '');

  //Bmr-----------
  if ($gender == "Male") {
    $bmr = (10 * $weight) + (6.25 * ($heightm * 100)) - (5 * $age) + 5;
  } else {
    $bmr = (10 * $weight) + (6.25 * ($heightm * 100)) - (5 * $age) - 161;
  }
  $kal = 4.184 * $bmr;
  //Bmi------------

  if ($bmi < 18.5) {
    $range = "Underweight";
    $weight3 = $IDEAL_BMI_LOWER - $weight;
    $weight3 = (int)$weight3;
    $loose = $weight3;
    $suffix = "Kgs";
  } else if ($bmi < 25) {
    $range = "Normal (healthy weight)";
    $weight3 = "";
    $suffix = "";
  } else if ($bmi < 30) {
    $range = "overweight";
    $weight3 = $weight - $IDEAL_BMI_UPPER;
    $weight3 = (int)$weight3;
    $loose = $weight3;
    $suffix = " Kgs";
  } else if ($bmi < 35) {
    $range = "class I obese";
    $weight3 = $weight - $IDEAL_BMI_UPPER;
    $weight3 = (int)$weight3;
    $suffix = " Kgs";
  } else if ($bmi < 40) {
    $range = "class II obese";
    $weight3 = $weight - $IDEAL_BMI_UPPER;
    $weight3 = (int)$weight3;
    $suffix = " Kgs";
  } else {
    $range = "class III obese";
    $weight3 = $weight - $IDEAL_BMI_UPPER;
    $weight3 = (int)$weight3;
    $suffix = " Kgs";
  }

  if ($bmi > 18.5 && $bmi < 25) {
    $statement = " ";
    $recommendation = " ";
  } else {
    if ($bmi < 18.5) {
      $statement = "A little effort away from your ideal weight";
      $recommendation = "We recommend you to Gain " . $weight3;
    } else {
      $statement = "A little effort away from your ideal weight";
      $recommendation = "We recommend you to Lose " . $weight3;
    }
  }
  // Flooring values 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $bmr = (int)$bmr;
  $IDEAL_BMI_LOWER = (int)$IDEAL_BMI_LOWER;
  $IDEAL_BMI_UPPER = (int)$IDEAL_BMI_UPPER;
  $id = $_SESSION["id"];

  $ins_status = "";
  if ($cnt == 0) {
    $ins = "INSERT INTO bmi (id,name,age,weight,height,gender,bmi,bmr,upper_weight,lower_weight,bmi_range) VALUES ('$id','$user','$age','$weight','$height','$gender','$bmi','$bmr','$IDEAL_BMI_UPPER','$IDEAL_BMI_LOWER','$range')";

    if ($conn->query($ins) === TRUE) {

      $cnt++;
      $ins_status = "Insterted";
    } elseif ($cnt == 1) {
      $ins_status = "Insterted Once";
    } else {
      $ins_status = "Not Inserted";
    }
  }
}
?>
<!-- PHP End -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Bmi-Home</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Roboto:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript" src='main.js'></script>
</head>

<body id="bd_bmi">
  <div class="container">
    <div class="row">
      <div class="card1">
        <p>
          <span class="textbmi"> Your BMI: </span>
          <span class="counter"> <?php echo $bmi ?> </span>
        </p>
      </div>
      <div class="card2">
        <p class="textbmi">Your BMR: <span class="counter1"> <?php echo $bmr; ?> </span>
          <span class="cal">cal</span>
        </p>
      </div>
      <div class="card3">
        <p>Ideal Weight Range: <span id="idl_weight">
            <span class="counter1"> <?php echo " " . $IDEAL_BMI_LOWER ?> </span>
            <span>-</span>
            <span class="counter1"> <?php echo " " . $IDEAL_BMI_UPPER ?> </span>
          </span> Kgs </p>
      </div>
    </div>
    <div class="row">
      <div class="card4">
        <p id="statement">
          <span> <?php echo $range; ?> </span>
        </p>
        <p id="statement">
          <span> <?php echo $statement; ?> </span>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="card5">
        <h3>What is BMI ?</h3>
        <p> The body mass index calculator measurement is the calculation of your body weight in relation to your height and is commonly used as an indicator of whether you might be in a risk category for health problems caused by your weight.</p>
        <div class="ref">
          <h5>
            <strong> Reference:</strong>
          </h5>
          <p>
            <p id="note">Calculations are performed on the basis of Mifflin - St Jeor equation</p>
            <a href="https://www.nhlbi.nih.gov/files/docs/guidelines/prctgd_c.pdf"><small> <p>Practical Guide: National Institutes of Health (NIH), National Heart, Lung, and Blood Institute (NHLBI).</p></small></a>
          </p>
        </div>
      </div>
      <div class="card6">
        <h3> BMI Classification Table </h3>
        <table class="table table-borderless table-sm">
          <thead>
            <tr>
              <th scope="col">Body Mass Index</th>
              <th scope="col">Classification</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Less than 18.5: </td>
              <td>Underweight</td>
            </tr>
            <tr>
              <td>18.5 - 24.9:</td>
              <td>Normal Weight</td>
            </tr>
            <tr>
              <td>25 - 29.9: </td>
              <td>Overweight</td>
            </tr>
            <tr>
              <td>30 - 34.9: </td>
              <td>Class I Obese</td>
            </tr>
            <tr>
              <td>35 - 39.9: </td>
              <td>Class II Obese</td>
            </tr>
            <tr>
              <td>40 upwards: </td>
              <td>Class III Obese</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="card7">
        <h3>What is BMR ? </h3>
        <p> The Basal Metabolic Rate (BMR) Calculator estimates your basal metabolic rate-the amount of energy expended while at rest in a neutrally temperate environment. </p>
        <div class="bmrsdetails">
          <h3>Your BMR Summary</h3>
          <p> Your body will burn <b>
            <span> <?php echo $bmr ?> </span> calories( <span> <?php echo (int)$kal; ?> </span> kJ) </b> each day if you engage in no activity for that day. The estimate for maintaining your current weight (based upon your chosen activity level) is <b>
            <span> <?php echo (int)(1.2 * $bmr) ?> </span> calories ( <span> <?php echo (int)(1.2 * $kal) ?> </span> kJ). </b> </p>
        </div>
      </div>
      <div class="card8">
        <h3>BMR Table</h3>
        <table class="table table-borderless table-m" id="bmrtbl">
          <thead>
            <tr>
              <th scope="col">Activity level </th>
              <th scope="col">BMR</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td> Little / No Exercise </td>
              <td> <?php echo (int)($bmr * 1.2) ?> </td>
            </tr>
            <tr>
              <td> Light Exercise / Sports 1-3 Days per week </td>
              <td> <?php echo (int)($bmr * 1.375) ?> </td>
            </tr>
            <tr>
              <td>Moderate Exercise / Sports 3-5 Days per week </td>
              <td> <?php echo (int)($bmr * 1.55) ?> </td>
            </tr>
            <tr>
              <td> Intense Exercise / Sports 6-7 Days per week </td>
              <td>
                <span> <?php echo (int)($bmr * 1.725) ?> </span>
              </td>
            </tr>
            <tr>
              <td> Very Intense Exercise / Physical Job </td>
              <td> <?php echo (int)($bmr * 1.9) ?> </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="card9">
        <h4>
          <p> Are You Want to lose or gain Weight</p> 
          <p id="choice">Yes <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"> 
          No <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck"></p>
        </h4>
      </div>
    </div>
    <div class="row" id="r6">
      <div class="card10" id="ifyes" style="display:none;">
          <span>
            <strong> <?php echo  $recommendation . " " . $suffix; ?> </strong>
          </span>
        <form method="POST" name="diet" action="Plan.php" id="Plan_Form">
          <h6>
            <p> Daily activity: <select name="activityLevel">
            </p>
            <option value="1.2">Desk job, little/no exercise</option>
            <option value="1.375">Light exercise 1-3 days/wk</option>
            <option value="1.55"> Moderate exercise 3-5 days/wk</option>
            <option value="1.725"> Hard exercise 6-7 days/wk</option>
            <option value="1.9"> Physical job & hard daily exercise</option>
            </select>
          </h6>
          <table align="center" id="tbl">
            <thead>
              <tr>
                <th id="th">Your Goals</th>
                <th id="th">Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Want to <select name="loseGain">
                    <option value="0">Lose</option>
                    <option value="1">Gain</option>
                  </select>: <br>
                </td>
                <td id>
                  <input type="number" step="any" name="aim"  value="<?php echo $weight3 ?>" placeholder="Weight in kgs">
                </td>
              </tr>
              <tr>
                <td>
                  <select name="periodType">
                    <option value="1">Days</option>
                    <option value="7">Weeks</option>
                    <option value="30.4" selected>Months</option>
                    <option value="365">Years</option>
                  </select> to achieve goal:
                </td>
                <td >
                  <input type="number" step="any" name="periodNum" value="3">
                </td>
              </tr>
            </tbody>
          </table>
          <button type="submit" class="btn btn-primary btn-s text-center" name="diet" id="sbmtBtn">Next</button>
        </form>
      </div>
    </div>
  </div>
  <div id="beforepage"></div>
</body>

</html>