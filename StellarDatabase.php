<?php

function createDatabase() {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');
        $db->exec("DROP TABLE StarSystems");
        //create the table
        $db->exec("CREATE TABLE StarSystems (id INTEGER PRIMARY KEY, name TEXT, theta REAL, alpha1 REAL, alpha2 REAL, G REAL, H REAL)");
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
        $isFirst=TRUE;
        foreach ($row as $key => $value) {
            $sql .= $isFirst ? "" : ",";
            $sql .= $key."=".$value;
            $isFirst=FALSE;
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
        $stmt = $db->prepare("SELECT * FROM StarSystems");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $colNames=array_keys($result[0]);
               print "<table border=1>";
        print "<tr>";
        foreach ($colNames as $c){
            echo "<th>$c</th>";
        }
        print "</tr>";
        print "<tr>";
        foreach ($result as $row) {//NOTE ERROR: $row isn't an assoc array!
            foreach ($row as $key => $value) {
                print "<td>" . $value . "</td>";
            }
        }
        print "</tr></table>";
        // close the database connection
        $db = NULL;
    } catch (PDOException $e) {
        print 'Exception : ' . $e->getMessage();
    }
}

function getLastRow() {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');

        $result = $db->query('SELECT * FROM StarSystems ORDER BY id LIMIT 1');
        $row = $result->fetch();
        // close the database connection
        $db = NULL;
        return $row;
    } catch (PDOException $e) {
        print 'Exception : ' . $e->getMessage();
    }
}

?>