<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.min.css" >
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <title>Users Admin Page</title>
</head>
<body>
    <?php include 'header.php'; ?> 

    <!-- Popup Insert -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="add_user.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First name:</label>
                            <input type="text" class="form-control" name="firstname">
                        </div>
                        <div class="form-group">
                            <label>Last name:</label>
                            <input type="text" class="form-control" name="lastname">
                        </div>
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="number" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Adsress:</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <label>City:</label>
                            <input type="text" class="form-control" name="city">
                        </div>
                        <div class="form-group">
                            <label>Country:</label>
                            <input type="text" class="form-control" name="country">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertUser" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Insert -->

    <!-- Popup Edit -->
    <div class="modal fade" id="edtModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit_user.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="number" class="form-control" id="id_edt" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>First name:</label>
                            <input type="text" class="form-control" id="firstname_edt" name="firstname">
                        </div>
                        <div class="form-group">
                            <label>Last name:</label>
                            <input type="text" class="form-control" id="lastname_edt" name="lastname">
                        </div>
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" class="form-control" id="username_edt" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="password_edt" name="password">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email_edt" name="email">
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="number" class="form-control" id="phone_edt" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Adsress:</label>
                            <input type="text" class="form-control" id="address_edt" name="address">
                        </div>
                        <div class="form-group">
                            <label>City:</label>
                            <input type="text" class="form-control" id="city_edt" name="city">
                        </div>
                        <div class="form-group">
                            <label>Country:</label>
                            <input type="text" class="form-control" id="country_edt" name="country">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updateUser" class="btn btn-success">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Edit -->

    <!-- Popup Delete -->
    <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete_user.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="number" class="form-control" id="id_del" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>First name:</label>
                            <input type="text" class="form-control" id="firstname_del" name="firstname" readonly>
                        </div>
                        <div class="form-group">
                            <label>Last name:</label>
                            <input type="text" class="form-control" id="lastname_del" name="lastname" readonly>
                        </div>
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" class="form-control" id="username_del" name="username" readonly>
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" id="password_del" name="password" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" id="email_del" name="email" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="number" class="form-control" id="phone_del" name="phone" readonly>
                        </div>
                        <div class="form-group">
                            <label>Adsress:</label>
                            <input type="text" class="form-control" id="address_del" name="address" readonly>
                        </div>
                        <div class="form-group">
                            <label>City:</label>
                            <input type="text" class="form-control" id="city_del" name="city" readonly>
                        </div>
                        <div class="form-group">
                            <label>Country:</label>
                            <input type="text" class="form-control" id="country_del" name="country" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="deleteUser" class="btn btn-danger">Delete User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->
    
    <!-- Content -->
    <h1 class="aboutus-title pricing-title title-admin">Users</h1>
    <div class="container">
        <button type="button" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            Add User
        </button><br></br>
        <table class="table table-striped table-bordered dt-responsive nowrap table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Actions</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                     include 'connect_db.php';
                     $query = "SELECT * FROM users WHERE is_deleted = '0'";
                     $query_run = mysqli_query($connection, $query);
                    if ($query_run)
                    {
                        foreach ($query_run as $row)
                        {
                ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>
                                </td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['country']; ?></td>
                                <td><?php echo $row['created_date']; ?></td>
                                <td><?php echo $row['updated_date']; ?></td>                                        
                            </tr>
                <?php            
                        }
                    }
                    else
                    {
                        echo "Error query select users data: ".$connection->error;
                    }
                    $connection->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- end Content -->

    <?php include 'footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.table-admin').DataTable({
                // "pagingType": "full_numbers",
                // // "lengthMenu": [
                // //     [10, 25, 50, -1],
                // //     [10, 25, 50, "All"]
                // // ],
                // responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Users"
                }
            });

            $('.table-admin').on('click', '.edt-btn-admin', function(){
                $('#edtModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id_edt').val(data[0]);
                $('#firstname_edt').val(data[2]);
                $('#lastname_edt').val(data[3]);
                $('#username_edt').val(data[4]);
                $('#password_edt').val(data[5]);
                $('#email_edt').val(data[6]);
                $('#phone_edt').val(data[7]);
                $('#address_edt').val(data[8]);
                $('#city_edt').val(data[9]);
                $('#country_edt').val(data[10]);
            });

            $('.table-admin').on('click', '.del-btn-admin', function(){
                $('#delModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id_del').val(data[0]);
                $('#firstname_del').val(data[2]);
                $('#lastname_del').val(data[3]);
                $('#username_del').val(data[4]);
                $('#password_del').val(data[5]);
                $('#email_del').val(data[6]);
                $('#phone_del').val(data[7]);
                $('#address_del').val(data[8]);
                $('#city_del').val(data[9]);
                $('#country_del').val(data[10]);
            });
        });
    </script>
</body>
</html>
