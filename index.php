<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP-CRUD</title>
</head>

<body>
<?php require_once 'process.php' ?>

        <!-- Dispaly message -->
        <?php if(isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
        <?php endif ?>

    <div class="container">
        <h1>PHP CRUD OPERATIONS</h1>       

            <!-- Display Records from database-->
            <?php
                //Connect to database
                $mysqli = new mysqli('localhost', 'root', 'Chris100+', 'php_crud') or die(mysqli_error($mysqli));

                //Select all records from table crud
                $result = $mysqli->query("SELECT * FROM crud") or die($mysqli->error);

                //pre_r($result);
                //Fetch records
                // pre_r($result->fetch_assoc());
                // pre_r($result->fetch_assoc());
                // function pre_r($array)
                // {
                //     echo '<pre>';
                //     print_r($array);
                //     echo '</pre>';
                // }
                // 
                ?> <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th clospan="2">Action</th>
                        </tr>
                    </thead>
                    <?php
                        while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><a class="btn btn-info" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                            <a class="btn btn-danger" href="process.php?delete=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>

            <div class="row justify-content-center">
                <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $name;?>" placeholder="Enter your Name">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location" value="<?php echo $location;?>" placeholder="Enter your Location">
                    </div>
                    <?php if($update == true):?>
                        <button type="submit" name="update" class="btn btn-info">Update</button>
                    <?php else : ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php endif ?>
                </form>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
</body>

</html>