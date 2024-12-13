<?php

//  connect met de database
// zorg ervoor dat de id teruggevonden wordt in de database

// voor de waardes die worden geupdated:
// zoek de id op in de database
// gebruik SELECT * FROM query om de id te zoeken
// Query uitvoeren op de databas
// als id gevonden is alle resultaten uit de lijst alvast laten zien


// als de submit knop is ingedrukt
//   als de form leeg is en of het onjuist is ingevoerd
//          laat foutmeldingen zien bij de juiste veld
//            zorg ervoor dat de vorige gegevens teruggeschreven wordt in de form
//            sla de gegevens niet op in de database
//   als er geen errors zijn
//      gebruik UPDATE SET query om de query te updaten
//        Query uitvoeren op de database
//          als de database geupdated is
//            stuur ons terug naar de index.php
//              sluit de database

global $db;
require_once 'database.php';

$id = $_GET['id'];

$query = "SELECT * FROM animes WHERE id = $id";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$animes = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {

    $errors = [];

    $name = $_POST['name'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $status = $_POST['status'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $year = $_POST['year'] ?? '';
    $episodes = $_POST['episodes'] ?? '';
    $info = $_POST['info'] ?? '';


    if ($_POST['name'] == '') {
        $errors['name'] = 'Name cant be empty';
    }

    if ($_POST['genre'] == '') {
        $errors['genre'] = "Genre can't be empty";
    }

    if ($_POST['status'] == '') {
        $errors['status'] = "Status can't be empty";
    }

    if ($_POST['rating'] == '') {
        $errors['rating'] = "Rating can't be empty";
    }

    if ($_POST['year'] == '') {
        $errors['year'] = "Year can't be empty";
    } elseif (!is_numeric($year)) {
        $errors['year'] = "must be a number";
    }

    if ($_POST['episodes'] == '') {
        $errors['episodes'] = "Episodes can't be empty";
    } elseif (!is_numeric($episodes)) {
        $errors['episodes'] = "must be a number";
    }

    if ($_POST['info'] == '') {
        $errors['info'] = "Info can't be empty";

    }
    if (empty($errors)) {
//    $image = $_POST['image'];
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $status = $_POST['status'];
        $rating = $_POST['rating'];
        $year = $_POST['year'];
        $episodes = $_POST['episodes'];
        $info = $_POST['info'];




        $query = "UPDATE `animes` 
SET  `name`='$name',`genre`='$genre',`status`='$status',`rating`='$rating',`year`='$year',`episodes`='$episodes',`info`='$info' WHERE id = $id";
        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);



        header(header: 'Location: index.php');


        // sluit de db
        mysqli_close($db);
    }

}
?>

<!doctype html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <title>Anime list - Create</title>
</head>

<body>
<header class="hero is-danger"
        style="background-image:url('pictures/red.gif'); background-repeat: no-repeat; background-position: center center; background-size: cover">


    <div class="hero-body ">
        <!--        <p class="title" style="color:white">Deleting --><?php //= $animes['name'] ?><!-- </p>-->
        <!---->

    </div>

</header>
<div class="container px-4">
    <section>
    <?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo ' <h1 class="title" style="text-align: center">must be logged in to delete </h1>';

        echo '<button class="button is-info  is-outlined is-fullwidth table ">
            <a href="login.php" class=" has-text-info">&spades; login</a>
        </button>';
        echo '<button class="button is-danger  is-outlined is-fullwidth  ">
            <a href="index.php" class=" has-text-danger">	&hearts; go back</a>
        </button>';

//            header("Location: login.php");
        exit;
    }
    ?>
    </section>

    <section class="columns is-centered">
        <div class="column is-10">

            <h2 class="title mt-4">Edit - <?= $animes['name']?> </h2>
            <form class="column is-6" action="" method="post">

                <div>
                    <div class="field-body ">
                        <div class="field">
                            <div class="control">
                                <!--                                <div class="control has-icons-left">-->
                                <label class="label" for="name">Name</label>
                                <input class="input" id="name" type="text" name="name" value="<?= $animes['name']?>"/>
                                <p class="help is-danger">
                                    <span> <?= $errors['name'] ?? '' ?> </span>
                                </p>

                                <label class="label" for="genre">Genre</label>
                                <input class="input" id="genre" type="text" name="genre"
                                       value="<?= $animes['genre'] ?>"/>
                                <p class="help is-danger">
                                    <span> <?= $errors['genre'] ?? '' ?> </span>
                                </p>

                                <label class="label" for="status">Status</label>
                                <input class="input" id="status" type="text" name="status"
                                       value="<?= $animes['status'] ?>"/>
                                <p class="help is-danger">
                                    <span> <?= $errors['status'] ?? '' ?>  </span>
                                </p>

                                <label class="label" for="rating">Rating</label>
                                <input class="input" id="rating" type="text" name="rating"
                                       value="<?= $animes['rating'] ?>"/>
                                <p class="help is-danger">
                                    <span> <?= $errors['rating'] ?? '' ?>  </span>
                                </p>

                                <label class="label" for="year">Year</label>
                                <input class="input" id="year" type="text" name="year" value="<?= $animes['year'] ?>"/>
                                <p class="help is-danger">
                                    <span> <?= $errors['year'] ?? '' ?> </span>
                                </p>

                                <label class="label" for="episodes">Episodes</label>
                                <input class="input" id="episodes" type="text" name="episodes"
                                       value="<?= $animes['episodes'] ?>"/>
                                <p class="help is-danger">
                                    <span> <?= $errors['episodes'] ?? '' ?>  </span>
                                </p>

                                <label class="label" for="info">Synopsis</label>
                                <input class="input" id="info" type="text" name="info" value="<?= $animes['info'] ?>"/>
                                <p class="help is-danger">
                                    <span> <?= $errors['info'] ?? '' ?> </span>
                                </p>

                                <input type="hidden" name="id" value="<?= $animes ?>">


                            </div>
                            <p class="help is-danger">
                                <!--                            --><?php //=$error['emptyname'] ?? '' ?>
                        </div>
                    </div>
                </div>


                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-success is-fullwidth " type="submit" name="submit">Save changes
                        </button>
                    </div>
                </div>

            </form>

            <a class="button mt-4" href="index.php">&hearts; Go back to the list</a>
        </div>
    </section>
</div>
</body>
</html>
