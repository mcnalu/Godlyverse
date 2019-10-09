
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
         * //- improve stellar creation code
         * - balance trade
         */

        require 'StellarDatabase.php';
        require "StarSystem.php";
        createDatabase();
        $ss= new StarSystem(0,0,"sol");
        insertRow($ss->getAll());
        $ss= new StarSystem(0,1,"sirius");
        $ss->iota=0.1;
        insertRow($ss->getAll());
        displayRows();
        $rows = getLastRows();
        foreach ($rows as $row) {
            echo "<p>".$row['name']."</p>";
            echo "<table>";
            echo "<tr><th>i</th><th>Y</th><th>C</th><th>H</th></tr>";

            $ss = new StarSystem();
            $ss->setAll($row);
            for ($i = 0; $i < 10; $i++) {
                $Y=$ss->update();
                $format = "<tr><td>%3d</td><td>%0.1f</td><td>%0.1f</td><td>%0.1f</td></tr>";
                echo(sprintf($format, $i, $Y, $ss->getC($Y), $ss->H));
            }
            echo "</table>";
            insertRow($ss->getAll());
        }
        ?>

    </body>
</html>
