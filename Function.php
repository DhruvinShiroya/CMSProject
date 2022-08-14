<?php
function Redirect_to($location)
{
    header("Location:" . $location);
    exit;
}




function ErrorMessage()
{
    session_start();
    if (isset($_SESSION["error_message"])) {
        foreach ($_SESSION["error_message"] as $error)
            $output = "<div class=\"alert alert-danger\">";
        $output .= "<p>" . $error . "</p></div>";

        $_SESSION["error_message"] = null;
        return $output;
    }
}

function SuccessMessage()
{
    session_start();
    if (isset($_SESSION["success"])) {
        $output = "<div class=\"alert alert-success\">";
        $output .= "<p>" . $_SESSION["success"] . "</p>" . "</div>";

        $_SESSION["success"] = null;
        return $output;
    }
}
