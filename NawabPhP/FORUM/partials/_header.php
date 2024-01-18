<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Top Categories
                    </a>
                    <ul class="dropdown-menu">
                        <?php 
                        try{
                            $stmt = $conn->prepare("SELECT category_name FROM categories LIMIT 3");
                            $stmt->execute();
                            while($category = $stmt->fetch(PDO::FETCH_ASSOC)){
                                echo '<li><a class="dropdown-item" href="#">'.$category['category_name'].'</a></li>';
                            }

                        }catch(PDOException $e){
                            echo "Error: ".$e->getMessage();
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php" aria-disabled="true">Contact</a>
                </li>
            </ul>
            <?php
            if (isset($_SESSION['loggedIn'])) {
                echo '<div class="d-flex">
                <form class="d-flex" role="search" action="search.php" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
                <p class="text-light mb-0 pt-2 ms-1"><b>'.$_SESSION['user']. '</b></p>
                <a href="partials/_logout.php" class="btn btn-outline-success link-underline-success mx-2">Logout</a>
            </div>';
            }else{
                echo '<div class="d-flex">
                <form class="d-flex" role="search" action="search.php" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
                <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#login">Login</button>
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signup">Signup</button>
            </div>';
            }
            ?>
            
        </div>
    </div>
</nav>
<?php
function alert($msg)
{
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success! </strong>' . $msg . ' 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

function warning($msg)
{
    echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
  <strong>Failed! </strong>' . $msg . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

<?php include 'partials/_login.php' ?>
<?php include 'partials/_signup.php' ?>