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
    <title>Product Categories Admin Page</title>
</head>
<body>
    <?php include 'header.php'; ?> 

    <!-- Popup Insert -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="add_product_category.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertProductCategory" class="btn btn-primary">Save Product Category</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit_product_category.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="number" class="form-control" id="id_edt" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" id="name_edt" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updateProductCategory" class="btn btn-success">Update Product Category</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete_product_category.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label>
                            <input type="number" class="form-control" id="id_del" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" id="name_del" name="name"  readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="deleteProductCategory" class="btn btn-danger">Delete Product Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->
    
    <!-- Content -->
    <h1 class="aboutus-title pricing-title title-admin">Product Categories</h1>
    <div class="container">
        <button type="button" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            Add Product Category
        </button><br></br>
        <table class="table table-striped table-bordered dt-responsive nowrap table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Active</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'connect_db.php';
                    $query = "SELECT  category_id,
                                      category_name
                              FROM    product_categories 
                              WHERE   is_deleted = '0'";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run)
                    {
                        foreach ($query_run as $row)
                        {
                ?>
                            <tr>
                                <td><?php echo $row['category_id']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info edt-btn-admin"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger del-btn-admin"><i class="fa fa-trash"></i></a>
                                </td>
                                <td><?php echo $row['category_name']; ?></td>       
                            </tr>
                <?php            
                        }
                    }
                    else
                    {
                        echo "Error query select product categories data: ".$connection->error;
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
            });
        });
    </script>
</body>
</html>
