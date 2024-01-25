<?php
require('database.php');

global $conn;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $pokemon = $_POST['pokemon'];
    $poketrainer = $_POST['poketrainer'];

    $sql = "INSERT INTO pokegame (pokemon, poketrainer) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$pokemon, $poketrainer]);
}

$sql = "SELECT * FROM pokegame";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <ul>
        <li><a class="active" href="index.php">Pokedex</a></li>
        <li><a href="#training">Poketraining</a></li>
        <li><a href="#info">Info</a></li>
    </ul>
</nav>
<form method="POST" class="pokename">
    <label for="pokemon">Pokemon:</label>
    <input type="text" id="pokemon" name="pokemon" required>

    <label for="poketrainer">Trainer:</label>
    <input type="text" id="poketrainer" name="poketrainer" required>

    <br><br>
    <input type="submit" name="submit">
</form>

<hr>

<?php
if ($result->rowCount() > 0) {
    echo "<div class='existing-records'>";
    echo "<h2>Existing Poké Records:</h2>";
    echo "<ul class='records-list'>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<li><span class='pokemon-name'>{$row['pokemon']}</span>'s Trainer = <span class='trainer-name'>{$row['poketrainer']}</span></li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "<p>No records found</p>";
}
?>

</body>
</html>
