<!-- header -->
<?php
include("includes/db.php");
include("includes/header.php");
?>

<!-- Navigation -->
<?php
include("includes/navigation.php")
?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- Blog Post -->
            <?php
            $query = "SELECT * FROM posts";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <h2>
                    <a href="index.php"><?php echo $row["post_title"] ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row["post_author"] ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row["post_date"] ?></p>
                <hr>
                <img class="img-responsive" src=<?php echo $row["post_image"] ?> alt="img_posted">
                <hr>
                <p><?php echo $row["post_content"] ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            <?php
            } ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php
        include("includes/sidebar.php")
        ?>

    </div>
    <!-- /.row -->
    <hr>

    <!-- Footer -->
    <?php
    include("includes/footer.php")
    ?>