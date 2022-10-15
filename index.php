<?php
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);
//var_dump($friends);

$errors =[];
if (!empty($_post)) {
$friends =array_map('trim', $_POST);
$friends = array_map('htmlentities', $friends);
$firstName = $friends['firstname'];
$lastName = $friends['lastname'];

if (empty($firstName)) {
 $errors[] = "firstname is mandatory";
}
if (empty($lastName)) {
    $errors[] = "lastname is mandatory";
}
    if (empty($errors)) {
      $query = 'INSERT INTO friend(firstname, lastname) VALUES (:firstname, :lastname)';
      $statement = $pdo->prepare($query);
      $statement->bindValue(':firstname', $firstName, \PDO::PARAM_STR);
      $statement->bindValue(':lastname', $lastName, \PDO::PARAM_STR);

      $statement->execute();
      header('location:/');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form:"" method="POST">

   <?php if(!empty($errors)) : ?>
    <h1>Please enter firstaneme and lastname</h1>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>
    
   <div> 
        <label for="firstname">Firstname</label>
    <input type="text" id="firstname" name="firstanme" required>
    </div> 
    <div> 
        <label for="lastname">Lastname</label>
        <input type="text" id="lastname" name="lastname" required>
    </div>
    <div>
        <input type="submit" value="submit">
    </div>

    <section>
        <?php
        $query = "SELECT * FROM friend ";
        $statement = $pdo->query($query);
        $firends = $statement->fetchall();

        foreach ($friends as $friend): ?>

        <div>
            <h2><?= $friend['firstname']?></h2>
            <h2><?= $friend['lastname']?><h2>
        </div>
        <?php endforeach; ?>
        </section>


</body>
</html>


