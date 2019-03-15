<?php
// Definiera inställningar
$host = 'localhost';
$user = 'vaderlekUser';
$pass = 'password';
$db = 'vaderlek';

// Skapa anslutningssträng
$dsn = "mysql:dbname=$db;host=$host;charset=utf8";

// Här skrivs mina inställningar ut
$settings = array(
   // Hämta data som :wassociativ array
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

   // Ge exception när det går fel
   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    );


// Skapa anslutningen och fånga ev. fel
try {
    $dbm = new PDO($dsn, $user, $pass, $settings);
    echo "Användaren " . "<b>$user</b>" . " är kopplad till " . "<b>$db</b>";
} catch (PDOException $e) {
    echo 'Kunde inte koppla mot db.<br>'.$e->getMessage();
    exit;
}



/**
 * Run a query against the database.
 * 
 * @param string $query Query string
 * @param string[] $queryParams Contains parameters used in the query 
 * @param boolean $fetchBool (optional) Required true if the query will return data
 * @return string[] Containing fetched data from database using $query
 */
function runQuery($query, $queryParams, $fetchBool = false) {
    global $dbm;

    try {
        // Förbered frågan i dbm
        $stmt = $dbm->prepare($query);

        // Kör frågan, data finns nu redo i dbm
        $stmt->execute($queryParams);

        if ($fetchBool) {
            // Hämta data från dbm till variabel ($results) i php
           return $results = $stmt->fetch();
        }
        
    } catch (PDOException $e) {
        echo 'Frågan gick åt skogen. Förklaring:<br>'
      .$e->getMessage();
        echo '<br><br>';

        echo 'Query';
        var_dump($query);
        echo '<br><br>';

        echo 'POST';
        var_dump($_POST);
        echo '<br><br>';

        echo 'GET';
        var_dump($_GET);
        echo '<br><br>';

        echo 'SESSION';
        var_dump($_SESSION);
        echo '<br><br>';
        
        exit;
    }
}
