<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>Id</td>
            <td>Author</td>
            <td>Title</td>
            <td>Category</td>
            <td>Status</td>
            <td>Image</td>
            <td>Tags</td>
            <td>Comments</td>
            <td>Date</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = get_all_posts();
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['post_id'];
            $author = $row['post_author'];
            $title = $row['post_title'];
            $category = $row['post_category_id'];
            $status = $row['post_status'];
            $image = $row['post_image'];
            $tags = $row['post_tags'];
            $comments = $row['post_comment_count'];
            $date = $row['post_date'];
            echo "<tr>
                <td>{$id}</td>
                <td>{$author}</td>
                <td>{$title}</td>
                <td>{$category}</td>
                <td>{$status}</td>
                <td><img width=100 src='../images/$image' alt='img'></td>
                <td>{$tags}</td>
                <td>{$comments}</td>
                <td>{$date}</td>
                <td><a href='posts.php?source=edit_post&p_id={$id}'>Edit</a></td>
                <td><a href='posts.php?delete={$id}'>Delete</a></td>
            </tr>";
        }
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
    $result = mysqli_query($connection, $query);
}
?>