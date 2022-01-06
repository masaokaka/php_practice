<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>Id</td>
            <td>Username</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Email</td>
            <td>Role</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = get_all_users();
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['user_id'];
            $username = $row['username'];
            $firstname = $row['user_firstname'];
            $lastname = $row['user_lastname'];
            $email = $row['user_email'];
            $role = $row['user_role'];
            $img = $row['user_image'];
            echo "<tr>
                <td>{$id}</td>
                <td><img src={$img} alt='user_image'>{$username}</td>
                <td>{$firstname}</td>
                <td>{$lastname}</td>
                <td>{$email}</td>
                <td>{$role}</td>
                 <td><a href='users.php?admin={$id}'>Admin</a></td>
                <td><a href='users.php?subscriber={$id}'>Subscriber</a></td>
                <td><a href='users.php?delete={$id}'>Delete</a></td>
            </tr>";
        }
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    delete_user($user_id);
}
if (isset($_GET['admin'])) {
    $ad_id = $_GET['admin'];
    update_user_role($ad_id, 'admin');
}
if (isset($_GET['subscriber'])) {
    $sub_id = $_GET['subscriber'];
    update_user_role($sub_id, 'subscriber');
}
?>