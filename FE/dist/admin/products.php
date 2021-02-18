<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.min.css" >
    <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <title>Products Admin Page</title>
</head>
<body>
    <?php include 'header.php'; ?> 

    <!-- Popup Insert -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="add_product.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <select class="form-control selectpicker show-tick" data-live-search="true" name="category_id">
                                <option selected value="">Select Category</option>
                            <?php
                                include 'connect_db.php';
                                $query = "SELECT  category_id,
                                                  category_name
                                          FROM    product_categories 
                                          WHERE   is_deleted = '0'
                                          ORDER BY category_id, category_name
                                          ";
                                $query_run = mysqli_query($connection, $query);
                                if ($query_run)
                                {
                                    foreach ($query_run as $row)
                                    {
                            ?>
                                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_id'].'. '.$row['category_name']; ?></option>
                            <?php            
                                    }
                                }
                                else
                                {
                                    echo "Error query select products data: ".$connection->error;
                                }
                                $connection->close();
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Src:</label>
                            <input type="text" class="form-control" name="src">
                        </div>
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <div class="form-group">
                            <label>Currency:</label>
                            <input type="text" class="form-control" name="currency">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertProduct" class="btn btn-primary">Save Product</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit_product.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="number" class="form-control" id="id_edt" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" id="name_edt" name="name">
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="category_id_edt" name="category_id">
                            <?php
                                include 'connect_db.php';
                                $query = "SELECT  category_id,
                                                  category_name
                                          FROM    product_categories 
                                          WHERE   is_deleted = '0'
                                          ORDER BY category_id, category_name
                                          ";
                                $query_run = mysqli_query($connection, $query);
                                if ($query_run)
                                {
                                    foreach ($query_run as $row)
                                    {
                            ?>
                                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_id'].'. '.$row['category_name']; ?></option>
                            <?php            
                                    }
                                }
                                else
                                {
                                    echo "Error query select products data: ".$connection->error;
                                }
                                $connection->close();
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Src:</label>
                            <input type="text" class="form-control" id="src_edt" name="src">
                        </div>
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="number" class="form-control" id="price_edt" name="price">
                        </div>
                        <div class="form-group">
                            <label>Currency:</label>
                            <input type="text" class="form-control" id="currency_edt" name="currency">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <input type="text" class="form-control" id="description_edt" name="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updateProduct" class="btn btn-success">Update Product</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete_product.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="number" class="form-control" id="id_del" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" id="name_del" name="name"  readonly>
                        </div>
                        <div class="form-group">
                            <label>Category:</label>
                            <input type="text" class="form-control" id="catelogy_id_del" name="category"  readonly>
                        </div>
                        <div class="form-group">
                            <label>Src:</label>
                            <input type="text" class="form-control" id="src_del" name="src"  readonly>
                        </div>
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="number" class="form-control" id="price_del" name="price" readonly>
                        </div>
                        <div class="form-group">
                            <label>Currency:</label>
                            <input type="text" class="form-control" id="currency_del" name="currency" readonly>
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <input type="text" class="form-control" id="description_del" name="description" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="deleteProduct" class="btn btn-danger">Delete Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->
    
    <!-- Content -->
    <h1 class="aboutus-title pricing-title title-admin">Products</h1>
    <div class="container">
        <button type="button" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            Add Product
        </button><br></br>
        <table class="table table-striped table-bordered dt-responsive nowrap table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Actions</th>
                    <th>Name</th>
                    <th>Catelogy ID</th>
                    <th>Catelogy Name</th>
                    <th>Src</th>
                    <th>View</th>
                    <th>Price</th>
                    <th>Currency</th>
                    <th>Desciption</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'connect_db.php';
                    $query = "SELECT  id,
                                      name,
                                      category_id,
                                      get_category_name(category_id) category_name,
                                      src,
                                      price,
                                      currency,
                                      description,
                                      created_date,
                                      updated_date
                              FROM    products 
                              WHERE   is_deleted = '0'";
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
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['category_id']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo $row['src']; ?></td>
                                <td><img style="width:50px;" src="<?php echo $row['src']; ?>" /></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['currency']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['created_date']; ?></td>
                                <td><?php echo $row['updated_date']; ?></td>                                        
                            </tr>
                <?php            
                        }
                    }
                    else
                    {
                        echo "Error query select products data: ".$connection->error;
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
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
                    searchPlaceholder: "Search Products"
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
                $('#name_edt').val(data[2]);
                $('#category_id_edt').val(data[3]);
                $('#src_edt').val(data[5]);
                $('#price_edt').val(data[7]);
                $('#currency_edt').val(data[8]);
                $('#description_edt').val(data[9]);
            });

            $('.table-admin').on('click', '.del-btn-admin', function(){
                $('#delModal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#id_del').val(data[0]);
                $('#name_del').val(data[2]);
                $('#catelogy_id_del').val(data[3]);
                $('#src_del').val(data[5]);
                $('#price_del').val(data[7]);
                $('#currency_del').val(data[8]);
                $('#description_del').val(data[9]);
            });
        });
    </script>
</body>
</html>
