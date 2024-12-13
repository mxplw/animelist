<?php
global $db;
require_once 'database.php';

$query = "SELECT * FROM animes";



$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$animes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $animes[] = $row;
}
mysqli_close($db);


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
        <p class="title" style="color:white">Anime list</p>
        <p class="subtitle" style="color:white">Overview of my top animes</p>
    </div>

</header>
<main class="container">



    <section class="section">

        <button class="button is-danger  is-outlined table ">
            <a href="login.php" class=" has-text-danger">login</a>
        </button>
        <button class="button is-danger  is-outlined table ">
            <a href="register.php" class=" has-text-danger">register</a>
        </button>
        <button class="button is-danger  is-outlined table ">
            <a href="logout.php" class=" has-text-danger">logout</a>
        </button>
        <table class="table mx-auto  is-hoverable">
            <thead>

            <tr class="is-dark">
                <!--                <th></th>-->
                <th>#</th>
                <th>name</th>
                <th>Genre</th>
                <th>Status</th>
                <th>Rating</th>
                <th>Released</th>
                <th>Episodes</th>
                <th>Details</th>
                <th>Edit</th>
                <th>delete</th>
            </tr>

            </thead>

            <tfoot>
            <tr>
                <td colspan="6">&copy; Anime recommendations</td>
                <td></td>
                <td></td>
                <td></td>
                <!--                <td></td>-->

                <td class="table is-narrow">
                    <button class="button is-danger  is-outlined table ">
                        <a href="create.php" class=" has-text-danger">Add anime</a>
                    </button>
                </td>

            </tr>
            </tfoot>

            <tbody>

            <?php

            foreach ($animes as $key => $animes) { ?>
                <tr class="table is-bordered ">
                    <!--                    <td>--><?php //= $animes['image']?><!--</td>-->
                    <td><?= ($key + 1) ?></td>
                    <td> <?= $animes['name'] ?> </td>
                    <td><span class="tag is-danger is-hoverable is-rounded"><?= $animes['genre'] ?></span></td>
                    <td> <?= $animes['status'] ?></td>
                    <td> <?= $animes['rating'] ?> </td>
                    <td> <?= $animes['year'] ?> </td>
                    <td> <?= $animes['episodes'] ?> </td>
                    <td>
                        <button class="button is-danger is-inverted"><a class="has-text-info-light"
                                                                        href="detail.php?id=<?= $animes['id'] ?>">Details</a>
                        </button>
                    </td>
                    <td>
                        <button class="button is-danger is-inverted"><a class="has-text-warning"
                                                                        href="edit.php?id=<?= $animes['id'] ?>">edit</a>
                        </button>
                    </td>
                    <td>
                        <button class="button is-danger is-inverted"><a class="has-text-danger"
                                                                        href="delete.php?id=<?= $animes['id'] ?>">delete</a>
                        </button>
                    </td>

                </tr>


            <?php } ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>