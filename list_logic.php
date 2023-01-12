<?php
    ini_set('display_errors', 1);
    
    // Verbindung zur MySQL-Datenbank herstellen
    $host = "localhost";
    $username = "thoxh";
    $password = "Ilmb*R*mTe1!";
    $database = "meet_gym";
        

    $mysqli = new mysqli($host, $username, $password);

    // Verbindung überprüfen
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Durchlaufe Ergebnisse und überprüfen, ob Datenbank enthalten ist
    $result = $mysqli->query("SHOW DATABASES");
    $dbExists = false;
    while($row = $result->fetch_assoc()) {
        if($row['Database'] == $database) {
            $dbExists = true;
            break;
        }
    }
       
    if ($dbExists) {
        $mysqli = new mysqli($host, $username, $password, $database);
        // Prüfe ob die Tabelle existiert
        $query = "SHOW TABLES LIKE 'appointments'";
        $result = $mysqli->query($query);
        if($result->num_rows > 0) {
            // Führe SQL-Befehle aus
            $query = "SELECT firstname, lastname, date, musclegroups FROM appointments";
            $result = $mysqli->query($query);
            // Umwandlung der SQL-Ergebnisse in Tabelle 
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>Vorname: " . $row["firstname"]. " - Nachname: " . $row["lastname"]. " - Datum: " . $row["date"]. " - Muskelgruppe: " . $row["musclegroups"]. "</li>";
                }
            } else {
                echo "Keine Termine vorhanden.";
            }
        } else {
            echo "Die Tabelle 'appointments' existiert nicht in der Datenbank 'meet_gym'.";
        }
    } else {
        echo "Es wurden keine Einträge gefunden.";
    }

    // Verbindung zur MySQL-Datenbank schließen
    $mysqli->close();
    echo '<br><a href="index.html">
    <input type="submit" value="Zurück zum Hauptmenü"/>
    </a>';
?>
