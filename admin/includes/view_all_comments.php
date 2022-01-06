<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>Id</td>
            <td>Author</td>
            <td>Comment</td>
            <td>Email</td>
            <td>Status</td>
            <td>In Response to</td>
            <td>Date</td>
            <td>Approve</td>
            <td>Unapprove</td>
            <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = get_all_comments();
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['comment_id'];
            $post = null;
            $post_id = null;
            $post_name = get_a_post($row['comment_post_id']);
            while ($the_post = mysqli_fetch_assoc($post_name)) {
                $post = $the_post['post_title'];
                $post_id = $the_post['post_id'];
            };
            $email = $row['comment_email'];
            $author = $row['comment_author'];
            $content = $row['comment_content'];
            $status = $row['comment_status'];
            $date = $row['comment_date'];
            echo "<tr>
                <td>{$id}</td>
                <td>{$author}</td>
                <td>{$content}</td>
                <td>{$email}</td>
                <td>{$status}</td>
                <td><a href='../post.php?post_id={$post_id}'>{$post}</a></td>
                <td>{$date}</td>
                <td><a href='comments.php?approve={$id}'>Approve</a></td>
                <td><a href='comments.php?unapprove={$id}'>Unapprove</a></td>
                <td><a href='comments.php?delete={$id}'>Delete</a></td>
            </tr>";
        }
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];
    delete_comment($comment_id);
}
if (isset($_GET['approve'])) {
    $app_id = $_GET['approve'];
    update_comment_status($app_id, 'approved');
}
if (isset($_GET['unapprove'])) {
    $unapp_id = $_GET['unapprove'];
    update_comment_status($unapp_id, 'unapproved');
}
?>