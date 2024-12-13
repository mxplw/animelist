<?php
global $db;
require_once 'database.php';

// ALS id aanwezig in de url id ophalen en opslaan
//$id = mysqli_escape_string($_POST['id']);
// query opbouwen"DELETE FROM albumsWHERE id='$albumId’”
// query uitvoeren
// ALS gelukt stuur naar index
// anders geef melding

$id = $_GET['id'];

$query = "SELECT * FROM animes WHERE id = $id";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$animes = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {

    $query = "DELETE FROM `animes` WHERE id = $id";

    $result = mysqli_query($db, $query)
    or die('Error ' . mysqli_error($db) . ' with query ' . $query);


    header(header: 'Location: index.php');

    mysqli_close($db);
}
?>

<!doctype html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>

<header class="hero is-danger"
        style="background-image:url('pictures/red.gif'); background-repeat: no-repeat; background-position: center center; background-size: cover">


    <div class="hero-body ">
        <!--        <p class="title" style="color:white">Deleting --><?php //= $animes['name'] ?><!-- </p>-->
<!---->

    </div>

</header>

<section class="section">
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
    <h1 class="title" style="text-align: center">are you sure you want to delete "<?= $animes['name'] ?>" ?</h1>
</section>

<form class="column is-6" action="" method="post">

    <div class=" column ">
        <button class="button is-danger is-fullwidth is-outlined " type="submit"
                name="submit" value="Send File">
            delete
        </button>
        <a class="button mt-4" href="index.php">&hearts; No</a>
    </div>


</form>
