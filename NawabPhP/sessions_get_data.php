<?php

session_start();
if (isset($_SESSION['username'])) {
    //overwriting the username
    $_SESSION['username'] = 'Firdos';
    echo "Welcome " . $_SESSION['username'];
    echo "<br> Your favourite category is " . $_SESSION['favCat'];
    echo "<br>";
} else {
    echo "please login to continue.";
}


?>


<?php
//second method to display all the session variables
//session_start();
//?>
<!DOCTYPE html>
<html>

<body>

    <?php
    //print_r($_SESSION);
    //?>

</body>

</html>