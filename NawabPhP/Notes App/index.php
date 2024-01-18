<!-- Connecting to the Database -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes";

$insert = false;
$update = false;
$delete = false;

// Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection status
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if (isset($_GET["delete"])) {
    $sno = $_GET["delete"];
    $stmt = $conn->prepare("DELETE FROM mynotes WHERE s_no = ?");
    $stmt->bind_param("i", $sno);
    if ($stmt->execute()) {
        $_SESSION["delete_success"] = true;
    }

    // Redirect after successful delete
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST["snoEdit"])) {
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];

        // Using prepared statement for UPDATE
        $stmt = $conn->prepare("UPDATE mynotes SET title = ?, description = ? WHERE s_no = ?");
        $stmt->bind_param("ssi", $title, $description, $sno);

        if ($stmt->execute()) {
            $_SESSION["update_success"] = true;
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();

        // Redirect after successful update
        header("Location: index.php");
        exit;
    } else {
        $title = $_POST["title"];
        $description  = $_POST["description"];

        // Using prepared statement for INSERT
        $stmt = $conn->prepare("INSERT INTO mynotes (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);

        if ($stmt->execute()) {
            $_SESSION["insert_success"] = true;
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();

        // Redirect after successful insert
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit This Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./" method="post" class="mt-4">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="titleEdit" class="form-label"><strong>Note Title</strong></label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" for="descriptionEdit" class="form-label"><strong>Note Description</strong></label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="2"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    function alertMessage($message)
    {
        return "<div class='alert alert-success alert-dismissible fade show' role='alert'>
               <strong>Success!</strong> Your note has been $message successfully.
               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    if (isset($_SESSION["insert_success"])) {
        echo alertMessage('inserted');
        unset($_SESSION["insert_success"]); // Clear the session variable
    }
    if (isset($_SESSION["update_success"])) {
        echo alertMessage('updated');
        unset($_SESSION["update_success"]); // Clear the session variable
    }
    if (isset($_SESSION["delete_success"])) {
        echo alertMessage('deleted');
        unset($_SESSION["delete_success"]); // Clear the session variable
    }
    ?>

    <main>
        <div class="container mt-5" style="width: 60%;">
            <h2>Add Notes</h2>
            <form action="./" method="post" class="mt-4">
                <div class="mb-3">
                    <label for="title" class="form-label"><strong>Note Title</strong></label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" for="description" class="form-label"><strong>Note Description</strong></label>
                    <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Notes</button>
            </form>
        </div>
        <hr style="border: none;border-top: 2px solid black;">
        <div class="container mt-5 mb-5" style="width: 60%;">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM mynotes";
                    $result = $conn->query($sql);
                    $sno = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $sno = $sno + 1;
                            echo "<tr>
                             <th scope='row'>" . $sno . "</th>
                            <td>" . $row['title'] . "</td>
                            <td>" . $row['description'] . "</td>
                            <td><button type='button' class='edit btn btn-primary' id=" . $row['s_no'] . ">Edit</button> <button type='button' class='delete btn btn-primary' id=d" . $row['s_no'] . ">Delete</button></td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
    </script>
    <script>
        function editNote(e) {
            console.log("edit ", )
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[0].innerText;
            description = tr.getElementsByTagName("td")[1].innerText;
            titleEdit.value = title;
            descriptionEdit.value = description;
            snoEdit.value = e.target.id;
            $("#editModal").modal('toggle');
            console.log(title, description);
            console.log(e.target.id);
        }

        function deleteNote(e) {
            console.log("delete ", );
            sno = e.target.id.substr(1, );

            if (confirm("Delete Note!")) {
                console.log("yes");
                window.location = `?delete=${sno}`;
            } else {
                console.log("No");
            }
        }

        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                editNote(e);

            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                deleteNote(e);
            })
        })
    </script>

</body>

</html>