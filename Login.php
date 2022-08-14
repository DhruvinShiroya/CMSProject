<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CMS project</title>
    <!--Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

</head>

<?php

if (isset($_POST['login'])) {
    require_once("authenticate_login.php");
}

?>

<body>
    <?php require_once("header.php") ?>

    <main>
        <?php
        if (isset($_SESSION)) {
            if (isset($_SESSION["success_message"])) {

                $msg = $_SESSION["success_message"];
                echo "<div class=\"alert alert-success\">";
                echo $msg;
                echo "</div>";
            } else {

                if (isset($_SESSION["error_message"])) {
                    $msg = $_SESSION["error_message"];
                    foreach ($msg as $output) {
                        echo "<div class=\"alert alert-danger\">";
                        echo $output;
                        echo "</div>";
                    }
                }
            }
            $_SESSION["success_message"] = null;
            $_SESSION["error_message"] = null;
        }
        ?>

        <form class="form" action=<?php echo $_SERVER['PHP_SELF']; ?> method="POST" class="form">
            <div class="container border-right border-bottom mt-3">
                <div class="row ">

                    <div class="" offset-lg-3 col-lg-8 p-4 ">


                        <div class=" form-group m-3">
                        <input type="text" name="email" placeholder="Email or User Name" required>
                    </div>
                    <div class="form-group m-3">
                        <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
                    </div>
                    <div>
                        <a href="createAccount.php">Sign up</a>
                    </div>


                    <!-- <div class="g-recaptcha" data-sitekey="6LcT3J4gAAAAAJn8yKRvPyKK1YaFg0OA4hMJB3M4" require></div> -->
                    <button type="submit" name="login" value="login" class="btn btn-primary mb-2">Log in</button>


                </div>
            </div>
            </div>
        </form>

    </main>
    <?php require_once("footer.php") ?>

</body>
<script>
    src = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity = "sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin = "anonymous" >
</script>
<script>
    document.getElementById("year").innerHTML(new Date().getFullYear().toString());
</script>

</html>