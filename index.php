<?php 

require_once 'connect.php';
$pdo = new PDO(DSN, USER, PASS);

$query = "SELECT firstname, lastname FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
</head>
<body>


    <?php
        

    foreach ($friends as $friend) {
    ?> 
    <ul>
        <li><?= $friend['firstname'] . ' ' . $friend['lastname'];?></li>
    </ul>
    <?php } ?>


    <form method="post">
        <input type="text" name="prenom" id="prenom" placeholder="prenom" required>
        <input type="text" name="nom" id="nom" placeholder="nom" required>
        <button type ="submit">Envoyer</button>
    </form>
    <?php
        if (isset($_POST['prenom']) && isset($_POST['nom'])) {
        $firstname = trim($_POST['prenom']);
        $lastname = trim($_POST['nom']);

        $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);

        $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

        $statement->execute();
    }
    ?>
</body>
</html>











