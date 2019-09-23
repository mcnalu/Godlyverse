
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
         * //- Histories in DB
         * //- Multiple systems in DB
         * //- update multiple systems
         * //- avoid repetition of DB opening/closing code
         * - improve stellar creation code
         */

        require 'StellarDatabase.php';
        require "StarSystem.php";
//        createDatabase();
//        $ss= new StarSystem(0,0,"sol");
//        insertRow($ss->getAll());
//        $ss= new StarSystem(0,1,"sirius");
//        insertRow($ss->getAll());
        displayRows();
        $rows = getLastRows();
        foreach ($rows as $row) {
            echo "<p>".$row['name']."</p>";
            echo "<table>";
            echo "<tr><th>i</th><th>Y</th><th>C</th><th>H</th></tr>";

            $ss = new StarSystem($row['time'], $row['id'], $row['name'], $row['H'], $row['theta'], $row['G']);

            for ($i = 0; $i < 10; $i++) {
                $ss->update();
                //echo "<tr><td>$i</td><td>$Y</td><td>$C</td><td>$H</td></tr>";
                $format = "<tr><td>%3d</td><td>%0.1f</td><td>%0.1f</td><td>%0.1f</td></tr>";
                echo(sprintf($format, $i, $ss->getY(), $ss->getC(), $ss->getH()));
            }
            echo "</table>";
            insertRow($ss->getAll());
        }
        ?>

    </body>
</html>
