<?php

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error(($connection)));
    }
}

function escape($string)
{

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function insert_categories()
{
    global $connection;
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
function update_category()
{
    global $connection;
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

function get_all_categories()
{
    global $connection;
    $query = "SELECT * FROM categories ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED" . mysqli_error(($connection)));
    } else {
        return $result;
    }
}

function get_a_category($id)
{
    global $connection;
    $query = "SELECT * FROM categories WHERE cat_id = {$id} ";
    $category_result = mysqli_query($connection, $query);
    if (!$category_result) {
        die("QUERY FAILED" . mysqli_error(($connection)));
    } else {
        $result = null;
        while ($row = mysqli_fetch_assoc($category_result)) {
            $result = $row['cat_title'];
        };
        if ($result !== null) {
            return $result;
        }
    }
};

function delete_category()
{
    global $connection;
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

function get_all_posts()
{
    global $connection;
    $query = "SELECT * FROM posts ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED" . mysqli_error(($connection)));
    } else {
        return $result;
    }
}

function get_a_post($id)
{
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id = {$id} ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED" . mysqli_error(($connection)));
    } else {
        return $result;
    }
}

function get_a_post_comments($p_id)
{
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_post_id = '$p_id' ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC ";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("QUERY FAILED" . mysqli_error(($connection)));
    } else {
        return $result;
    }
}
