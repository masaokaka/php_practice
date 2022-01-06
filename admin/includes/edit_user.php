<?php
if (isset($_GET['p_id'])) {
    $edit_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = {$edit_id}";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['post_id'];
        $author = $row['post_author'];
        $title = $row['post_title'];
        $category = $row['post_category_id'];
        $status = $row['post_status'];
        $image = $row['post_image'];
        $tags = $row['post_tags'];
        $comments = $row['post_comment_count'];
        $content = $row['post_content'];
        $date = $row['post_date'];
    }
}

if (isset($_POST['update_post'])) {
    $edit_id = $_GET['p_id'];
    $post_title = escape($_POST['post_title']);
    $post_author = escape($_POST['post_author']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POST['post_status']);
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_comment_count = 4;

    // move image where you want
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $edit_id ";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_comment_count = '{$post_comment_count}' ";
    $query .= "WHERE post_id = '{$edit_id}' ";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $title; ?>">
    </div>
    <div class="form-group">
        <label for="post_category_id">Category</label>
        <select name="post_category_id" id="post_category_id" value="<?php echo $category; ?>">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="post_author" id="author" value="<?php echo $author; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="published" <?php if ($status == 'published') {
                                            echo 'selected';
                                        }; ?>>Published</option>
            <option value="draft" <?php if ($status == 'draft') {
                                        echo 'selected';
                                    }; ?>>Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img width=100 src='../images/<?php echo $image; ?>' alt='img'>
        <input type="file" name="image" value="<?php echo $image; ?>">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="post_content" id="" cols="30" rows="10"><?php echo $content; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>