<?php include "./includes/header.php" ?>

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
                        $msg = insert_categories();
                        $msg = update_category();
                        delete_category();
                        display_error($msg);
                        ?>
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
                        <?php
                        if (isset($_GET['edit'])) {
                            $id = $_GET['edit'];
                            $query = "SELECT * FROM categories WHERE cat_id = {$id} ";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['cat_id'];
                                $title = $row['cat_title'];
                        ?>
                                <form action="categories.php" method="post">
                                    <div class="form-group">
                                        <label for="cat_title">Edit Category</label>
                                        <input type="text" name="cat_title" class="form-control" value="<?php if (isset($title)) {
                                                                                                            echo $title;
                                                                                                        }; ?>">
                                        <input type="hidden" name="cat_id" value=" <?php if (isset($id)) {
                                                                                        echo $id;
                                                                                    }; ?>">
                                    <?php
                                }
                                    ?>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                                    </div>
                                </form>
                            <?php
                        }
                            ?>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Title</td>
                                    <td>Delete</td>
                                    <td>Edit</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = get_all_categories();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row["cat_id"];
                                    $title = $row["cat_title"];
                                    echo "<tr>
                                    <td>{$id}</td>
                                    <td>{$title}</td>
                                    <td><a href='categories.php?delete={$id}'>Delete</a></td>
                                    <td><a href='categories.php?edit={$id}'>Edit</a></td>
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