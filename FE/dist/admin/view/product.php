<?php include('inc/header.php') ?>
    <!-- Popup Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name:</label><span id="nameErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label>SRC:</label><span id="srcErr" class="error-msg-admin"> *</span>
                            <input type="url" class="form-control" name="src" id="src" required>
                        </div>
                        <div class="form-group">
                            <label>Price:</label><span id="priceErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="price" id="price">
                        </div>
                        <div class="form-group">
                            <label>Currency:</label><span id="currencyErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="currency" id="currency" required>
                        </div>
                        <div class="form-group">
                            <label>Description:</label><span id="descriptionErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="add_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="add_save" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Add -->

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
                <form id="edtForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label><span id="id_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" id="id_edt" name="id" readonly required>
                        </div>
                        <div class="form-group">
                            <label>Name:</label><span id="name_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="name_edt" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>SRC:</label><span id="src_edtErr" class="error-msg-admin"> *</span>
                            <input type="url" class="form-control" id="src_edt" name="src" required>
                        </div>
                        <div class="form-group">
                            <label>Price:</label><span id="price_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" id="price_edt" name="price" required>
                        </div>
                        <div class="form-group">
                            <label>Currency:</label><span id="currency_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="currency_edt" name="currency" required>
                        </div>
                        <div class="form-group">
                            <label>Description:</label><span id="description_edtErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="description_edt" name="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="edt_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="edt_save" class="btn btn-success">Update Product</button>
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
                <form id="delForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label><span id="id_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" id="id_del" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name:</label><span id="name_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="name_del" name="name" readonly>
                        </div>
                        <div class="form-group">
                            <label>SRC:</label><span id="src_delErr" class="error-msg-admin"> *</span>
                            <input type="url" class="form-control" id="src_del" name="src" readonly>
                        </div>
                        <div class="form-group">
                            <label>Price:</label><span id="price_delErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" id="price_del" name="price" readonly>
                        </div>
                        <div class="form-group">
                            <label>Currency:</label><span id="currency_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="currency_del" name="currency" readonly>
                        </div>
                        <div class="form-group">
                            <label>Description:</label><span id="description_delErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="description_del" name="description" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="del_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="del_save" class="btn btn-danger">Delete Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->

    <h1 class="aboutus-title pricing-title title-admin">Products</h1>
    <div class="container">
        <button type="button" id="addData" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            <span class="fas fa-plus"></span > Add Product
        </button>
        <table id="table-admin" class="table table-striped table-bordered dt-responsive nowrap shadow">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Action</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SRC</th>
                    <th>Price</th>
                    <th>Currency</th>
                    <th>Description</th>
                    <th>Categories</th>
                    <th>Tags</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php include('inc/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/product_data.js"></script>
</body>
</html>