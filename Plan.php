<?php
include 'connection.php';
session_start();
if (isset($_POST['diet'])) {
    $activityLevel = $_POST['activityLevel'];
    $loseGain = $_POST['loseGain'];
    $aim = $_POST['aim'];
    $periodType = $_POST['periodType'];
    $periodNum = $_POST['periodNum'];

    $id = $_SESSION["id"];
    $sql = "SELECT name,age,weight,height,gender,bmi,bmr,upper_weight,lower_weight,bmi_range FROM bmi WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $user = $row["name"];
            $age = $row["age"];
            $height = $row["height"];
            $weight = $row["weight"];
            $gender = $row["gender"];
            $bmi = $row["bmi"];
            $bmr = $row["bmr"];
            $upper_weight = $row["upper_weight"];
            $lower_weight = $row["lower_weight"];
            $range = $row["bmi_range"];
        }
    } else {
    }
}
$tdee = $bmr * $activityLevel;
$totalDays = $periodType * $periodNum;
$totalcalories = $aim * 3500 * 2.2;
$dailyCalChange = 0;
$newtdee = 0;
if ($aim > 0 && $periodNum > 0) {
    $dailyCalChange = $totalcalories / $totalDays;
    if ($loseGain == 0) {
        $weightgoal = $weight - $aim;
        $loseGainText = "Lose";
        $newtdee = $tdee - $dailyCalChange;
        $maintaintdee = $bmr * $activityLevel * ($weight - $aim) / $weight;
    } else {
        $loseGainText = "Gain";
        $weightgoal = $weight + $aim;
        $newtdee = $tdee + $dailyCalChange;
        $maintaintdee = $bmr * $activityLevel * ($weight + $aim) / $weight;
    }
}
if ($periodType == 1) {
    $reachtime = "Days";
} elseif ($periodType == 7) {
    $reachtime = "Weeks";
} elseif ($periodType == 30.4) {
    $reachtime = "Months";
} else {
    $reachtime = "Years";
}

if ($aim == 1) {
    $aimtext = "kg";
} else {
    $aimtext = "kgs";
}

if ($loseGain == 0) {
    $changeText = "reduce";
} else {
    $changeText = "increase";
}
if ($dailyCalChange > 1000) {
  echo '<script>alert("Unsafe!!! Increase Time Period ")</script>';
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Bmi-Plan</title>
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
  <body>
    <div class="container" id="Details_plan">
      <div class="row">
        <div class="card">

        <div id="logo"><a  id="back" href="javascript:history.back()"><i class="fa-solid fa-left-long"></a></i></div>
          <h3>Your Details</h3>
        </div>
      </div>
      <div class="row">
        <div class="card">
          <p>Your Name : <span> <?php echo $user ?> </span></p>
          <p>Height : <span> <?php echo $height ?> </span> cm </p>
          <p>weight : <span> <?php echo $weight ?> </span> <span> <?php echo $aimtext ?> </span></p>
          <p>Age : <span> <?php echo $age ?> </span></p>
          <p>Wanted to : <span> <?php echo $loseGainText . " " ?> </span> <span> <?php echo $aim . "  " . $aimtext ?> </span> </p>
          <p>Amount of Time : <?php echo $periodNum ?> </span> <span> <?php echo $reachtime ?> </span></p>
        </div>
        <div class="card">
          <p>Weight Goal : <span> <?php echo $weightgoal ?> </span></p>
          <p>Your Currunt Caloric Requirements : <span> <?php echo $tdee ?> </span></p>
          <p>Your Currunt Bmi : <span> <?php echo $bmi ?> </span></p>
          <p>Curruntly You Are : <span> <?php echo $range ?> </span></p>
          <p>Ideal Weight Range : <span> <?php echo (round($lower_weight, 0)) . '-' . round($upper_weight, 0); ?> Kgs </span></p>
          <p>Your Calorie Cut : <span id="cal_change"> <?php echo round($dailyCalChange, 0) ?> </span></p>
        </div>
      </div>
      <div class="row">
        <div class="card">
          <h3 id="Calorie_Table">Calorie Table</h3>
          <table class="corg-tabledesign table-borderless table-sm" id="Plan_Table">
            <thead>
              <tr>
                <th>Daily Caloric Requirements</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <p> Maintain Current Weight:</p>
                  <span><small>Calories required to maintain current weight</small></span>
                </td>
                <td align="center">
                  <span> <?php echo (round($tdee, 0)); ?> Calories </span>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Meet Your Goal:</p>
                  <span> <small>Calories required to meet your weight goal</small> </span>
                </td>
                <td align="center">
                  <span> <?php echo (round($newtdee, 0)); ?> Calories </span>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Maintain New Weight</p>
                  <span><small>Calories required to maintain new weight </small></span>
                </td>
                <td align="center">
                  <span> <?php echo (round($maintaintdee, 0)); ?> Calories </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card">
          <h3 id="Calorie_Table">Explaination for Calorie Intake!</h3>
          <p> In order to <b><span> <?php echo $loseGainText ?> </span> </b> <b> <span> <?php echo $aim ?> </span></b><b>  <span> <?php echo $aimtext ?> </span>
            </b> in <b>
              <span> <?php echo round($periodNum, 0) ?> </span>
            </b>
            <b>
              <span> <?php echo ($reachtime) ?> </span>
            </b> you will need to <b>
              <span> <?php echo $changeText ?> </span>
            </b> your daily calorie intake from your normal maintenance level of <b>
              <span> <?php echo round($tdee, 0) ?> </span>
            </b> calories per day, down to <b>
              <span> <?php echo round($newtdee, 0) ?> </span>
            </b> calories per day, or exercise more to boost your calorie burn rate by about <b>
              <span id="cal_change"> <?php echo round($dailyCalChange, 0) ?> </span>
            </b> calories per day.
          </p>
          <p> A calorie differential of 500 calories a day is equivalent to a 2 kg per month change in weight.</p>
        </div>
      </div>
    </div>
    <div id="error" style="display: none;">
      <div id="err">
      <h1>Error !!!</h1>
        <h3>Your are trying to lose too much Weight in short period of  time</h3>
        <h3> Please Increase amount of Time Period And try Again. </h3>
       <a  id="back" href="javascript:history.back()"><i class="fa-solid fa-left-long"></a></i>

      </div>
    </div>
  </body>
</html>