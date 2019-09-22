<?php

$thetaErr = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $thetaErr = getError("theta");
        }

        function getError($varName) {
            if (empty($_POST[$varName])) {
                return "theta is required";
            } else {
                $$varName = test_input($_POST[$varName]);
                // check if name only contains letters and whitespace
                if (!is_numeric($$varName)) {
                    return "Must be a number.";
                } else {
                    return $$varName; //no error, return the value
                }
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <h2>Stellar control</h2>
        <p><span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            Name: <input type="text" name="theta" value="<?php echo $theta; ?>">
            <span class="error">* <?php echo $thetaErr; ?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit">  
        </form>

