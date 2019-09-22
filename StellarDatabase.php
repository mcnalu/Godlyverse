<?php

function createDatabase() {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->exec("DROP TABLE StarSystems");
        //create the table
        $db->exec("CREATE TABLE StarSystems (id INTEGER NOT NULL, time INTEGER NOT NULL, name TEXT, theta REAL, alpha1 REAL, alpha2 REAL, G REAL, H REAL, PRIMARY KEY (id,time))");
        // close the database connection
        $db = NULL;
    } catch (PDOException $e) {
        print 'Exception : ' . $e->getMessage();
    }
}

function insertRow($row) {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($row as $key => $value) {
            $keys = isset($keys) ? $keys . "," . $key : $key;
            $values = isset($values) ? $values . ",:" . $key : ":" . $key;
        }
        $sql = "INSERT INTO StarSystems ($keys)";
        $sql .= " VALUES ($values);";
        $stmt = $db->prepare($sql);

        foreach ($row as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $stmt->execute();
        // close the database connection
        $db = NULL;
    } catch (PDOException $e) {
        print 'Exception : ' . $e->getMessage();
    }
}

function updateRow($row) {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');

        $sql = "UPDATE StarSystems Set ";
        $isFirst = TRUE;
        foreach ($row as $key => $value) {
            $sql .= $isFirst ? "" : ",";
            $sql .= $key . "=" . $value;
            $isFirst = FALSE;
        }
        echo $sql;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        // close the database connection
        $db = NULL;
    } catch (PDOException $e) {
        print 'Exception : ' . $e->getMessage();
    }
}

function displayRows() {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM StarSystems ORDER BY id,time");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $colNames = array_keys($result[0]);
        print "<table border=1>";
        print "<tr>";
        foreach ($colNames as $c) {
            echo "<th>$c</th>";
        }
        print "</tr>";
        foreach ($result as $row) {
            print "<tr>";
            foreach ($row as $key => $value) {
                print "<td>" . $value . "</td>";
            }
            print "</tr>";
        }
        print "</table>";
        // close the database connection
        $db = NULL;
    } catch (PDOException $e) {
        echo "<p>Exception : " . $e->getMessage() . "</p>";
    }
}

function getLastRows() {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');

        $result = $db->query('select *,max(time) from StarSystems GROUP BY id;
');
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        // close the database connection
        $db = NULL;
        return $rows;
    } catch (PDOException $e) {
        print 'Exception : ' . $e->getMessage();
    }
}

?>