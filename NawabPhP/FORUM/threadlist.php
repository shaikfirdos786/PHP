<?php
session_start();
include 'partials/_dbconnect.php';
$id = $_GET['category_id'];
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_SESSION['loggedIn']) && isset($_SESSION['user_id'])){
            $title = $_POST['title'];
            $title = str_replace("<", "&lt;", $title);
            $title = str_replace(">", "&gt;", $title);
            $concern = $_POST['problem'];
            $concern = str_replace("<", "&lt;", $concern);
            $concern = str_replace(">", "&gt;", $concern);
            $user_id = $_SESSION['user_id'];

            $stmt = $conn->prepare("INSERT INTO threads(thread_title, thread_desc, thread_category_id, thread_user_id) VALUES(:thread_title, :thread_desc, :thread_category_id, :thread_user_id)");

            $stmt->bindParam(':thread_title', $title);
            $stmt->bindParam(':thread_desc', $concern);
            $stmt->bindParam(':thread_category_id', $id);
            $stmt->bindParam(':thread_user_id', $user_id);

            if ($stmt->execute()) {
                $_SESSION['inserted'] = true;
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }
        }
    }
} catch (PDOException $e) {
    echo "Error" . $e->getMessage();
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
    <?php
    if (isset($_SESSION['inserted'])) {
        alert("New thread inserted!");
        unset($_SESSION['inserted']);
    }
    ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <?php
            try {
                $stmt = $conn->prepare("SELECT * FROM categories WHERE category_id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $category = $stmt->fetch(PDO::FETCH_ASSOC);
                if($category) {
                    $cat_id = $category['category_id'];
                    $name = $category['category_name'];
                    $description = $category['category_description'];
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
            <div class="col-md-8">
                <div class="h-100 p-5 bg-body-secondary border rounded-3">
                    <h2>Welcome to <?php echo $name ?> Forums</h2>
                    <p><?php echo $description ?></p>
                    <hr>
                    <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post "offensive" posts, links or images. Do not crost post questions. Remain respectful of other members at all times.</p>
                    <button class="btn btn-success" type="button">Learn More</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <?php if (isset($_SESSION['user']) && isset($_SESSION['loggedIn'])) { ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Start a Discussion</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">Problem Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp">
                            <div id="title" class="form-text">Keep your title as short and crisp as possible</div>
                        </div>
                        <div class="mb-3">
                            <label for="problem" class="form-label">Elaborate your concern</label>
                            <textarea class="form-control" id="problem" name="problem" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
                <p class="lead fw-bold text-center">Please login to start a Discussion.</p>
        <?php } ?>
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                <h2>Browse Questions</h2>
                <?php
                try {
                    $stmt = $conn->prepare("SELECT t.thread_id, t.thread_title, t.thread_desc,t.reg_date, u.user_name
                            FROM threads t
                            INNER JOIN users u ON t.thread_user_id = u.user_id
                            WHERE t.thread_category_id = :cat_id");
                    $stmt->bindParam(':cat_id', $cat_id);
                    $stmt->execute();

                    // Check if any threads were found
                    if ($stmt->rowCount() > 0) {
                        while ($thread = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $thread_id = $thread['thread_id'];
                            $title = $thread['thread_title'];
                            $desc = $thread['thread_desc'];
                            $user_name = $thread['user_name'];
                            $date = $thread['reg_date'];

                            // Output each thread within the loop
                            echo '<div class="d-flex my-5">';
                            echo '<div class="flex-shrink-0">';
                            echo '<img class="pt-3" src="images/user1.jpg" width="50px" alt="...">';
                            echo '</div>';
                            echo '<div class="flex-grow-1 ms-3">';
                            echo '<p class="fw-bold text-success" style="display: inline;">' . $user_name . '</p><span class="ms-5">' . $date . '</span>';
                            echo '<h5><a href="thread.php?thread_id=' . $thread_id . '">' . $title . '</a></h5>' . $desc;
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="h-100 text-center pt-5 pb-0 bg-body-secondary border rounded-3">';
                        echo '<h1>No Threads Found</h1>';
                        echo '<p class="lead m-0">Be the first person to ask a question</p>';
                        echo '</div>';
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                ?>
            </div>

        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>