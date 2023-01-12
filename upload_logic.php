<?php
    ini_set('display_errors', 1);
    // Verbindung zur MySQL-Datenbank herstellen
    $host = "localhost";
    $username = "thoxh";
    $password = "Ilmb*R*mTe1!";
    $database = "meet_gym";
    
    $mysqli = mysqli_connect($host, $username, $password);

    if (!$mysqli) {
        die("Fehler beim Verbinden zur MySQL-Datenbank: " . mysqli_connect_error());
    }

    // Prüfe ob Datenbank existiert
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    if (mysqli_query($mysqli, $sql)) {
        // echo "Datenbank wurde erfolgreich erstellt.";
    } else {
        echo "Fehler beim Erstellen der Datenbank. " . mysqli_error($conn);
    }

    // Benutze die neu erstellte Datenbank
    $mysqli = new mysqli($host, $username, $password, $database);

    // Prüfe ob Tabelle existiert
    $table = "appointments";
    $sql = "CREATE TABLE IF NOT EXISTS $table (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, date DATE NOT NULL, musclegroups VARCHAR(255) NOT NULL)";
    if ($mysqli->query($sql) === TRUE) {
        // echo "Tabelle wurde erfolgreich erstellt.";
    } else {
        echo "Fehler beim erstellen der Tabelle " . $mysqli->error;
    }

    $mysqli = new mysqli($host, $username, $password, $database);

    // Die Daten aus dem Formular abfragen
    $firstName = $mysqli->real_escape_string($_POST["first-name"]);
    $lastName = $mysqli->real_escape_string($_POST["last-name"]);
    $date = $mysqli->real_escape_string($_POST["date"]);
    $muscleGroups = $mysqli->real_escape_string($_POST["muscle-groups"]);

    // Den neuen Termin in der Datenbank speichern
    $query = "INSERT INTO appointments (firstname, lastname, date, musclegroups)
              VALUES ('$firstName', '$lastName', '$date', '$muscleGroups')";
    $result = $mysqli->query($query);

    if ($result) {
        // Abfrage erfolgreich
        echo "Der Termin wurde erfolgreich in der Datenbank gespeichert.";
    } else {
        // Abfrage fehlgeschlagen
        echo "Fehler beim Speichern des Termins in der Datenbank: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    // Verbindung zur MySQL-Datenbank schließen
    $mysqli->close();

    echo '<br><br><a href="index.html">
    <input type="submit" value="Zurück zum Hauptmenü"/>
    </a>';
?>




