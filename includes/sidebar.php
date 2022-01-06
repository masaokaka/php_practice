        <div class="col-md-4">
            <!-- Blog Search Well -->
            <div class="well">
                <h4>Blog Search</h4>
                <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <?php
            $query = "SELECT * FROM categories LIMIT 8";
            $result = mysqli_query($connection, $query);
            ?>
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-unstyled">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row["cat_id"];
                                $title = $row["cat_title"];
                                echo "<li><a href='category.php?cat_id={$id}'>{$title}</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>



            <!-- Side Widget Well -->
            <?php include "widget.php" ?>
        </div>