<?php require_once("authentication.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Search</title>
    <!--Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

<body>
    <?php require_once("header.php"); ?>


    <form class="form m-5 p-5" action=<?php echo $_SERVER['PHP_SELF'] ?> method="get" class="form" enctype="multipart/form-data">
        <div class="container border-right border-bottom mt-3">
            <div class="row">
                <div class="offset-lg-3 col-lg-8">

                    <div class="card-body">
                        <h3 class="display-5">
                            Search for Blog
                        </h3>
                        <div class="col-md-8 pt-3">
                            <div class="form-group">

                                <input type="text" name="keywords" class="form-control" placeholder="Search" aria-label="Search" required />
                            </div>
                            <div class="form-group mb-5">
                                <input type="Submit" name="search" id="search" class="btn btn-outline-primary" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    <?php
    if (isset($_GET['search'])) {
        require_once("search_result.php");
    }
    ?>
    <?php require_once("footer.php"); ?>
</body>

</html>