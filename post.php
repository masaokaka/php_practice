<!-- header -->
<?php
include("function.php");
include("db.php");
include("includes/header.php");
?>

<!-- Navigation -->
<?php
include("includes/navigation.php")
?>

<?php
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $result = get_a_post($post_id);
}
?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- Blog Post -->
            <?php
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
                <img class="img-responsive" src="images/<?php echo $row["post_image"] ?>" alt="img_posted" width=200>
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
    <!-- Blog Comments -->
    <?php
    if (isset($_POST['create_comment'])) {
        $p_id = $_GET['post_id'];
        $author = $_POST['comment_author'];
        $email = $_POST['comment_email'];
        $comment = $_POST['comment_content'];

        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) ";
        $query .= "VALUES('$p_id','$author','$email','$comment','unapproved',now()) ";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
        $query = "UPDATE posts SET post_comment_count = post_comment_count +  1 ";
        $query .= "WHERE post_id = '$p_id' ";
        $result = mysqli_query($connection, $query);
        confirmQuery($result);
    }
    ?>

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" method="post" action="">
            <div class="form-group">
                <label for="Author">Author</label>
                <input type="text" class="form-control" name="comment_author"></input>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" name="comment_email"></input>
            </div>
            <div class="form-group">
                <label for="Comment">Comment</label>
                <textarea class="form-control" rows="3" name="comment_content"></textarea>
            </div>
            <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <hr>
    <!-- Comment -->
    <?php
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $comment_result = get_a_post_comments($post_id);
        while ($row = mysqli_fetch_assoc($comment_result)) {
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
            $comment_author = $row['comment_author'];
    ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4><?php echo $comment_content; ?>
                </div>
            </div>
    <?php
        }
    }
    ?>
    <!-- Footer -->
    <?php
    include("includes/footer.php")
    ?>