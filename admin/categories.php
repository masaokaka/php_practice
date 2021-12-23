<?php include "includes/header.php" ?>
<?php
$msg;
if (isset($_POST["submit"])) {
    $category = $_POST["cat_title"];
    if (strlen($category) === 0) {
        global $msg;
        $msg = "Error: category should be more than 1 caracter";
    } else {
        $query = "INSERT INTO categories(cat_title) VALUES ('$category') ";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("QUERY FAILED" . mysqli_error(($connection)));
        } else {
            global $msg;
            $msg = "Success: '$category' is added to Categories";
        }
    }
}
?>
<div id="wrapper">
    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categories
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-12">
                        <?php
                        global $msg;
                        if (isset($msg)) {
                            if (preg_match("/Error/", $msg)) {
                                echo "<div class='alert alert-danger' role='alert'>{$msg}</div>";
                            } else if (preg_match("/Success/", $msg)) {
                                echo
                                "<div class='alert alert-success' role='alert'>{$msg}</div>";
                            }
                        } ?>
                    </div>
                    <div class="col-xs-6">
                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Title</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM categories ";
                                $result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row["cat_id"];
                                    $title = $row["cat_title"];
                                    echo "<tr>
                                    <td>{$id}</td>
                                    <td>{$title}</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/footer.php" ?>