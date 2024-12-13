<?php
global $db;
require_once 'database.php';
// required when working with sessions
session_start();

$login = false;
if (isset($_SESSION['email'])){
    header(header: 'Location: index.php');
}

// Is user logged in?

if (isset($_POST['submit'])) {


//    // Get form data
//    $user_name = $_POST['username'];
    $email = $_POST['email' ?? ''];
    $password = $_POST['password' ?? ''];
//    $user_name = $_GET['username'];

    // Server-side validation
    $errors = [];

    // If data valid

    if ($email === '') {
        $errors['email'] = ' email cant be empty';
    }

    if ($password === '') {
        $errors['password'] = ' password cant be empty';
    }

    if (empty($errors)) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        // SELECT the user from the database, based on the email address.
        $query = "SELECT * FROM users WHERE email = '$email' ";


//        AND $password = 'password'
        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);
        mysqli_close($db);

        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){
//                $_SESSION['username'] = $user_name;
            $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header(header: 'Location: index.php');
                exit();
            } else {
//                $errors['login'];
            }
        }


        // check if the user exists

        // Get user data from result


        // Check if the provided password matches the stored password in the database
//        password_verify($password);
//        $securedPassword =

            // Store the user in the session


            // Redirect to secure page
            header(header: 'Location: index.php');
        // Credentials not valid

        //error incorrect log in

        // User doesn't exist

        //error incorrect log in
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <title>Log in</title>
</head>
<body>
<section class="section">
    <div class="container content">
        <h2 class="title">Log in</h2>

        <?php if ($login) { ?>
            <p>Je bent ingelogd!</p>
            <p><a href="logout.php">Uitloggen</a> / <a href="index.php">Naar secure page</a></p>
        <?php } else { ?>

            <section class="columns">
                <form class="column is-6" action="" method="post">

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="email">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="email" type="text" name="email" value=""/>
                                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['email'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="password">Password</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="password" type="password" name="password"/>
                                    <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                    <?php if (isset($errors['loginFailed'])) { ?>
                                        <div class="notification is-danger">
                                            <button class="delete"></button>
                                            <?= $errors['loginFailed'] ?>
                                        </div>
                                    <?php } ?>

                                </div>
                                <p class="help is-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Log in With Email
                            </button>
                        </div>
                    </div>

                </form>

            </section>
            no account? <a href="register.php">register here</a>
        <?php } ?>

    </div>
</section>
</body>
</html>



