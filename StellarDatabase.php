<?php

function execSQL($sql, $keyvalues = []) {
    try {
        //open the database
        $db = new PDO('sqlite:stellar_PDO.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare($sql);
        foreach ($keyvalues as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // close the database connection
        $db = NULL;
        return $result;
    } catch (PDOException $e) {
        echo "<p>Exception : " . $e->getMessage() . "<br/>";
        echo $sql . "</p>";
    }
}

function createDatabase() {
    execSQL("DROP TABLE StarSystems");
    $sql = <<<EOT
CREATE TABLE StarSystems (
    id INTEGER NOT NULL,
    time INTEGER NOT NULL,
    name TEXT,
    theta REAL,
    alpha1 REAL,
    alpha2 REAL,
    iota REAL,
    xi REAL,
    G REAL,
    H REAL,
    PRIMARY KEY (id,time))
EOT;
    execSQL($sql);
}

function insertRow($row) {
    foreach ($row as $key => $value) {
        $keys = isset($keys) ? $keys . "," . $key : $key;
        $values = isset($values) ? $values . ",:" . $key : ":" . $key;
    }
    $sql = "INSERT INTO StarSystems ($keys)";
    $sql .= " VALUES ($values);";
    execSQL($sql,$row);
}

function displayRows() {
    $result = execSQL("SELECT * FROM StarSystems ORDER BY id,time");
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
}

function getLastRows() {
    return execSQL("select *,max(time) from StarSystems GROUP BY id");
}

?>