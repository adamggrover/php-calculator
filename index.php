<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Calculator</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
</head>

<body>
    <div class="container">


        <h1>Calculator</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="number" name="num1" placeholder="Enter Number" aria-label="Number One">
            <select name="operator" aria-label="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="number" name="num2" placeholder="Enter Number" aria-label="Number Two">
            <button aria-label="Calculate">Calculate</button>
        </form>

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = filter_input(INPUT_POST, "operator", FILTER_SANITIZE_SPECIAL_CHARS);


            // Error handlers

            $errors = false;

            if (empty($num1) || empty($num2) || empty($operator)) {

                echo '<p class="error">Please fill in all the fields</p>';
                $errors = true;
            }

            if (!is_numeric($num1) || !is_numeric($num2)) {

                echo '<p class="error">Please only enter numbers</p>';
                $errors = true;
            }

            if (!$errors) {

                $result = 0;

                switch ($operator) {
                    case "add":
                        $result = $num1 + $num2;
                        break;
                    case "subtract":
                        $result = $num1 - $num2;
                        break;
                    case "multiply":
                        $result = $num1 * $num2;
                        break;
                    case "divide":
                        $result = $num1 / $num2;
                        break;
                    default:
                        echo '<p class="error">Something went wrong. Please try again</p>';
                }

                echo '<p class="result">Result: ' . $result . '</p>';
            }
        }

        ?>

    </div> <!-- container -->

</body>

</html>