
<!DOCTYPE HTML>  
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>  

        <?php
        /* TO DO
         * //- Read state from DB
         * //- Save state to DB
         * //- tidy code
         * - first git commit
         */

        require 'StellarDatabase.php';
        require "StarSystem.php";
        //createDatabase();
        //$ss= new StarSystem();
        //insertRow($ss->getAll());
        displayRows();
        $row = getLastRow();
        $theta = $row['theta'];

        echo "<table>";
        echo "<tr><th>i</th><th>Y</th><th>C</th><th>H</th></tr>";

        $ss = new StarSystem("sol", $row['H'], $theta, $row['G']);

        for ($i = 0; $i < 20; $i++) {
            $ss->update();
            //echo "<tr><td>$i</td><td>$Y</td><td>$C</td><td>$H</td></tr>";
            $format = "<tr><td>%3d</td><td>%0.1f</td><td>%0.1f</td><td>%0.1f</td></tr>";
            echo(sprintf($format, $i, $ss->getY(), $ss->getC(), $ss->getH()));
        }
        echo "</table>";
        updateRow($ss->getUpdate());
        ?>

    </body>
</html>
