<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Date Countdown</title>
<style>
    /* Body styling */
    body {
        font-family: 'Arial', sans-serif;
        background: #f2f7ff;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    /* Form container */
    .form-container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 350px;
    }

    /* Heading */
    .form-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 25px;
    }

    /* Labels */
    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-weight: bold;
    }

    /* Inputs */
    input[type="number"], input[type="submit"] {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 20px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
        box-sizing: border-box;
        transition: 0.3s;
    }

    input[type="number"]:focus {
        border-color: #4a90e2;
        outline: none;
        box-shadow: 0 0 5px rgba(74,144,226,0.3);
    }

    /* Submit button */
    input[type="submit"] {
        background: #4a90e2;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    input[type="submit"]:hover {
        background: #357ABD;
    }

    /* Result message */
    .result {
        background: #e8f0fe;
        padding: 15px 20px;
        border-radius: 10px;
        color: #333;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
</style>
</head>
<body>

<div class="form-container">
    <h2>Enter Your Date</h2>

    <form method="post">
        <label for="years">Year (YYYY):</label>
        <input type="number" id="years" name="years" min="2025" max="2100">

        <label for="month">Month (MM):</label>
        <input type="number" id="month" name="month" min="1" max="12" required>

        <label for="day">Day (DD):</label>
        <input type="number" id="day" name="day" min="1" max="31" required>

        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $years = !empty($_POST['years']) ? intval($_POST['years']) : date("Y");
        $month = intval($_POST['month']);
        $day = intval($_POST['day']);

        date_default_timezone_set("Asia/Kolkata");

        if (checkdate($month, $day, $years)) {
            $target_date = strtotime("$years-$month-$day");
            $diff_days = ceil(($target_date - time()) / (60 * 60 * 24));

            if ($diff_days < 0) {
                echo "<div class='result'>The date has already passed.</div>";
            } else {
                $years_left = floor($diff_days / 365);
                $days_after_years = $diff_days % 365;

                $weeks = floor($days_after_years / 7);
                $days_left = $days_after_years % 7;

                echo "<div class='result'>$years_left years, $weeks weeks, and $days_left days left until your date.</div>";
            }
        } else {
            echo "<div class='result'>Invalid date. Please enter a valid date.</div>";
        }
    }
    ?>
</div>

</body>
</html>
