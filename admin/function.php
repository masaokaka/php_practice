<?php
function insert_categories($connection)
{
    if (isset($_POST["submit"])) {
        $category = $_POST["cat_title"];
        if (strlen($category) === 0) {
            return "Error: category should be more than 1 caracter";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUES ('$category') ";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("QUERY FAILED" . mysqli_error(($connection)));
            } else {
                return "Addition Success: '$category' is added to Categories";
            }
        }
    }
}
function update_category($connection)
{
    if (isset($_POST['update'])) {
        $id = $_POST["cat_id"];
        $category = $_POST["cat_title"];
        if (strlen($category) === 0) {
            return "Error: category should be more than 1 caracter";
        } else {
            $query = "UPDATE categories SET cat_title = '$category' WHERE cat_id = '$id' ";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("QUERY FAILED" . mysqli_error(($connection)));
            } else {
                return "Update Success: ID: {$id} is updated to {$category} ";
            }
        }
    }
}

function display_error($msg)
{
    global $msg;
    if (isset($msg)) {
        if (preg_match("/Error/", $msg)) {
            echo "<div class='alert alert-danger' role='alert'>{$msg}</div>";
        } else if (preg_match("/Success/", $msg)) {
            echo
            "<div class='alert alert-success' role='alert'>{$msg}</div>";
        }
    }
}

function get_all_categories($connection)
{
    $query = "SELECT * FROM categories ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED" . mysqli_error(($connection)));
    } else {
        return $result;
    }
}

function delete_category($connection)
{
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$id} ";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("QUERY FAILED" . mysqli_error(($connection)));
        } else {
            header("Location: categories.php");
        }
    }
}
