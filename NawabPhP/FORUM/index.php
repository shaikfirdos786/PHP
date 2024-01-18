<?php
session_start();
include 'partials/_dbconnect.php';
try {
    $stmt = $conn->prepare("SELECT * FROM categories");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="partials/styles.css">
</head>

<body>
    <?php require "partials/_header.php" ?>
    <!-- Login & Signup stuff -->
    <?php
    // Signup Stuff
    if(isset($_SESSION['user_exists'])){
        warning("User already exists.");
        unset($_SESSION['user_exists']);
    }elseif(isset($_SESSION['signed_up'])){
        alert("You can login now.");
        unset($_SESSION['signed_up']);
    }elseif(isset($_SESSION['signupError'])){
        warning("Something went wrong!. Unable to signup.");
        unset($_SESSION['signupError']);
    }elseif(isset($_SESSION['mis_match'])){
        warning("Password did not match");
        unset($_SESSION['mis_match']);
    }

    //  Login Stuff
    if(isset($_SESSION['invalidLogin'])){
        warning("Invalid Credentials!");
        unset($_SESSION['invalidLogin']);
    }elseif(isset($_SESSION['login'])){
        alert("You are logged in.");
        unset($_SESSION['login']);
    }
    ?>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slider2.jpg" class="d-block w-100" alt="..." style="height: 500px;">
            </div>
            <div class="carousel-item">
                <img src="images/slider3.jpg" class="d-block w-100" alt="..." style="height: 500px;">
            </div>
            <div class="carousel-item">
                <img src="images/slider5.jpg" class="d-block w-100" alt="..." style="height: 500px;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container my-5">
        <h2 class="text-center">iDiscuss - Browse Categories</h2>
        <div class="row justify-content-center">
            <?php while ($result) { ?>
                <?php foreach ($result as $row) { ?>
                    <div class="card p-0 mx-3" style="width: 18rem;">
                        <img src="<?php echo $row['img_url']; ?>" class="card-img-top" alt="..." style="height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadlist.php?category_id=<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></a></h5>
                            <p class="card-text"><?php echo substr($row['category_description'], 0, 90) . "..."; ?></p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                <?php } ?>
                <?php break; ?>
            <?php } ?>

        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>