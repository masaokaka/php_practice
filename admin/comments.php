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
                        Posts
                        <small>Author</small>
                    </h1>
                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_comment':
                            include "includes/add_comment.php";
                            break;
                        case 'edit_comment':
                            include "includes/edit_comment.php";
                            break;
                        case '34':
                            echo "NICE";
                            break;
                        default:
                            include "includes/view_all_comments.php";
                            break;
                    }
                    ?>
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