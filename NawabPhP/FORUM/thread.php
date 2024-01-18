<?php
session_start();
include 'partials/_dbconnect.php';
$id = $_GET['thread_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['loggedIn']) && isset($_SESSION['user_id'])) {
    $comment = $_POST["comment"];
    $comment = str_replace("<", "&lt;", $comment);
    $comment = str_replace(">", "&gt;", $comment);
    $user = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO comments(comment_content, thread_id, comment_by) VALUES(:comment_content, :thread_id, :comment_by)");

    $stmt->bindParam(':comment_content', $comment);
    $stmt->bindParam(':thread_id', $id);
    $stmt->bindParam(':comment_by', $user);

    if ($stmt->execute()) {
        $_SESSION['commented'] = true;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}
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
    if (isset($_SESSION['commented'])) {
        alert("Commented Posted.");
        unset($_SESSION['commented']);
    }
    ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                try {
                    $stmt = $conn->prepare("SELECT t.thread_id, t.thread_title, t.thread_desc,t.reg_date, u.user_name
                            FROM threads t
                            INNER JOIN users u ON t.thread_user_id = u.user_id
                            WHERE t.thread_id = :id");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $thread = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($thread) {
                        $thread_id = $thread['thread_id'];
                        $title = $thread['thread_title'];
                        $description = $thread['thread_desc'];
                        $user_name = $thread['user_name'];
                        $date = $thread['reg_date'];
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
                <div class="h-100 p-5 bg-body-secondary border rounded-3">
                    <h1><?php echo $title ?></h1>
                    <p><?php echo $description ?></p>
                    <hr>
                    <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post "offensive" posts, links or images. Do not crost post questions. Remain respectful of other members at all times.</p>
                    <p>Posted by: <b class="text-success"><?php echo $user_name ?></b> on <?php echo $date ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['user']) && isset($_SESSION['loggedIn'])) { ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Post a Comment</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Type your comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Post Comment</button>
                    </form>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p class="lead fw-bold text-center">Please login to Post Comment.</p>
    <?php } ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                <h2>Discussions</h2>
                <?php
                try {
                    $stmt = $conn->prepare("SELECT c.comment_id, c.comment_content,c.comment_time, u.user_name FROM comments c INNER JOIN users u ON c.comment_by = u.user_id WHERE c.thread_id=:thread_id");
                    $stmt->bindParam(':thread_id', $thread_id);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($comment = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $comment_desc = $comment['comment_content'];
                            $user_name = $comment['user_name'];
                            $date = $comment['comment_time'];

                            echo '<div class="d-flex my-5">';
                            echo '<div class="flex-shrink-0">';
                            echo '<img src="images/user1.jpg" width="50px" alt="...">';
                            echo '</div>';
                            echo '<div class="flex-grow-1 ms-3">';
                            echo  '<p class="fw-bold my-0 text-success" style="display: inline;">' . $user_name . '</p><span class="ms-5">' . $date . '</span>';
                            echo '<p>' . $comment_desc . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="h-100 text-center pt-5 pb-0 bg-body-secondary border rounded-3">';
                        echo '<h1>No Comments Found</h1>';
                        echo '<p class="lead m-0">Be the first person to reply</p>';
                        echo '</div>';
                    }
                } catch (PDOException $e) {
                    echo "Error:" . $e->getMessage();
                }

                ?>
            </div>

        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>