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
    require_once("registration.php");
}
?>

<body>
    <?php require_once("header.php") ?>

    <main>
        <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
            <?php
            if (isset($_SESSION)) {
                if (isset($_SESSION["success_message"])) {

                    $msg = $_SESSION["success_message"];
                    foreach ($msg as $output) {
                        echo "<div class=\"alert alert-success\">";
                        echo $output;
                        echo "</div>";
                    }
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
            <div class="container border-right border-bottom mt-3">
                <div class="row">
                    <div class="offset-lg-3 col-lg-8">

                        <div class="card-body">
                            <h3 class="display-5">
                                New User?
                            </h3>
                            <div class="form-group m-3">
                                <label for="firstName"> <span class="form-text"> First name: </span></label>
                                <input class="form-control" type="text" name="firstname" id="firstName" placeholder="Type first name here" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="lastName"> <span class="form-text"> last name: </span></label>
                                <input class="form-control" type="text" name="lastname" id="lastName" placeholder="Type Last name here" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="userName"> <span class="form-text"> user name: </span></label>
                                <input class="form-control" type="text" name="username" id="userName" placeholder="Type user name here" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="email"> <span class="form-text"> Email: </span></label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Type name here" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="passoword"> <span class="form-text"> Password: </span></label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Type passowrd" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="repassword"> <span class="form-text"> Retype Password: </span></label>
                                <input class="form-control" type="password" name="repassword" id="repassword" placeholder="Retype password" min="8" required>
                            </div>

                            <div class="g-recaptcha" data-sitekey="6LcT3J4gAAAAAJn8yKRvPyKK1YaFg0OA4hMJB3M4" require></div>
                            <button type="submit" name="login" value="login" class="btn btn-primary mb-2">Sign Up</button>



                        </div>
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