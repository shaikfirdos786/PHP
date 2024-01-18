<?php
session_start();

include "partials/_dbconnect.php";
$query = $_GET['search'];
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

    <div class="container my-5">
        <h1>Search results for <em>"<?php echo $query ?>"</em></h1>
        <?php
        $stmt = $conn->prepare("SELECT * FROM threads WHERE MATCH(thread_title, thread_desc) AGAINST(:query)");
        $stmt->bindParam(':query', $query);
        $stmt->execute();
        $foundResults = false;

        while ($searchResult = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $foundResults = true;
            $thread_id = $searchResult['thread_id'];
            $thread_title = $searchResult['thread_title'];
            $thread_desc = $searchResult['thread_desc'];

            echo '<div class="Result mt-5 mb-2">';
            echo '<h3><a href="thread.php?thread_id=' . $thread_id . '">' . $thread_title . '</a></h3>';
            echo '<p>' . $thread_desc . '</p>';
            echo '</div>';
        }
        if(!$foundResults){
            echo '<div class="h-80 mt-5 ps-5 pt-5 pb-0 bg-body-secondary border rounded-3">';
            echo '<h1>No Results Found</h1>';
            echo '<ul><li>Make sure that all words are spelled correctly.</li>';
            echo '<li>Try different keywords.</li>';
            echo '<li>Try more general keywords.</li>';
            echo '<li>Try fewer keywords.</li></ul>';
            echo '</div>';
        }
        ?>
        

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>