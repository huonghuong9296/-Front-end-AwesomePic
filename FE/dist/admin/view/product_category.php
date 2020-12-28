<?php include('inc/header.php') ?>
    <!-- Popup Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Product:</label><span id="product_idErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="product_id" name="product_id" required>
                                <option selected value="">Select Product</option>
                                <?php include('inc/load_product.php'); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category:</label><span id="category_idErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="category_id" name="category_id" required>
                                <option selected value="">Select Category</option>
                                <?php include('inc/load_category.php'); ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="add_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="add_save" class="btn btn-primary">Save Product Category</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edtForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Old Product:</label><span id="product_id_oldErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="product_old" id="product_old" required readonly>
                            <input type="hidden" class="form-control" name="product_id_old" id="product_id_old" required readonly>
                            <span id="product_id_newErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="product_id_new" name="product_id_new" required>
                                <option selected value="">Change Product</option>
                                <?php include('inc/load_product.php'); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Old Category:</label><span id="category_id_oldErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="category_old" id="category_old" required readonly>
                            <input type="hidden" class="form-control" name="category_id_old" id="category_id_old" required readonly>
                            <span id="category_id_newErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="category_id_new" name="category_id_new" required>
                                <option selected value="">Change Category</option>
                                <?php include('inc/load_category.php'); ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="edt_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="edt_save" class="btn btn-success">Update Product Category</button>
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
                <form id="delForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Product:</label><span id="product_id_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="product_del" name="product_del" required readonly>
                            <input type="hidden" class="form-control" id="product_id_del" name="product_id" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Category:</label><span id="category_id_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="category_del" name="category_del" required readonly>
                            <input type="hidden" class="form-control" id="category_id_del" name="category_id" required readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="del_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="del_save" class="btn btn-danger">Delete Product Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->

    <h1 class="aboutus-title pricing-title title-admin">Product Categories</h1>
    <div class="container">
        <button type="button" id="addData" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            <span class="fas fa-plus"></span > Add Product Category
        </button>
        <table id="table-admin" class="table table-striped table-bordered dt-responsive nowrap shadow">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php include('inc/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/product_category_data.js"></script>
</body>
</html>