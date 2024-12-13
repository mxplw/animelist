<?php
global $db;
require_once 'database.php';

$id = $_GET['id'];
$query = "SELECT * FROM animes WHERE id = $id";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$animes = mysqli_fetch_assoc($result);


mysqli_close($db);
?>
<!doctype html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime - Details <?= $animes['name'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>

<header class="hero is-danger"
        style="background-image:url('pictures/red.gif'); background-repeat: no-repeat; background-position: center center; background-size: cover">
    <div class="hero-body">
        <p class="title is-size-1 " style="color:grey">  <?= $animes['name'] ?></p>
        <p class="subtitle" style="color:white">  <?= $animes['genre'] ?> </p>
    </div>
</header>

<main class="container">
    <section class="section content ">

        <section class="section">

            <!--            --><?php //= $animes['image']?>
            <h1 class="title">synopsis</h1>
            <?= $animes['info'] ?>
        </section>

        <ul>
            <li>aired in <?= $animes['year'] ?></li>
            <li>show is <?= $animes['status'] ?> with <?= $animes['episodes'] ?> episodes</li>

        </ul>


        <a class="button" href="index.php">&hearts; Go back to the list</a>


    </section>
</main>
</body>
</html>
