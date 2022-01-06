<?php
if (isset($_POST['create_user'])) {
    $username = escape($_POST['username']);
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $role = escape($_POST['role']);
    $image = escape($_FILES['image']['name']);
    $image_temp = escape($_FILES['image']['tmp_name']);

    move_uploaded_file($image_temp, "../images/$image");

    $query = "INSERT INTO users(username,user_firstname,
    user_lastname,user_email,user_password,user_image,user_role) ";

    $query .= "VALUES ('{$username}','{$firstname}','
    {$lastname}','{$email}','{$password}','{$image}','{$role}') ";
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname">
    </div>
    <div class="form-group">
        <label for="image">UserImage</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="role">Role</label><br>
        <select name="role" id="role">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>
</form>