<?php include('inc/header.php') ?>
    <!-- Popup Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Order Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" method="POST">
                    <div class="modal-body">
                    <div class="form-group">
                            <label>Order:</label><span id="order_idErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="order_id" name="order_id" required>
                                <option selected value="">Select Order</option>
                                <?php include('inc/load_order.php'); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Product:</label><span id="product_idErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="product_id" name="product_id" required>
                                <option selected value="">Select Product</option>
                                <?php include('inc/load_product.php'); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price:</label><span id="priceErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="price" id="price" required>
                        </div>
                        <div class="form-group">
                            <label>Quantity:</label><span id="quantityErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="quantity" id="quantity" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="add_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="add_save" class="btn btn-primary">Save Order Detail</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Order Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edtForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Old Order:</label><span id="order_id_oldErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="order_old" id="order_old" required readonly>
                            <input type="hidden" class="form-control" name="order_id_old" id="order_id_old" required readonly>
                            <span id="order_id_newErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="order_id_new" name="order_id_new" required>
                                <option selected value="">Change Order</option>
                                <?php include('inc/load_order.php'); ?>
                            </select>
                        </div>
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
                            <label>Price:</label><span id="price_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="price" id="price_edt" required>
                        </div>
                        <div class="form-group">
                            <label>Quantity:</label><span id="quantity_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="quantity" id="quantity_edt" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="edt_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="edt_save" class="btn btn-success">Update Order Detail</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Order Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="delForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Order:</label><span id="order_id_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="order_del" name="order_del" required readonly>
                            <input type="hidden" class="form-control" id="order_id_del" name="order_id" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Product:</label><span id="product_id_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="product_del" name="product_del" required readonly>
                            <input type="hidden" class="form-control" id="product_id_del" name="product_id" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Total Price:</label><span id="total_price_delErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="total_price" id="total_price_del" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Total quantity:</label><span id="quantity_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="quantity" id="quantity_del" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Price:</label><span id="price_delErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="price" id="price_del" required readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="del_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="del_save" class="btn btn-danger">Delete Order Detail</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->

    <h1 class="aboutus-title pricing-title title-admin">Order Detail</h1>
    <div class="container">
        <button type="button" id="addData" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            <span class="fas fa-plus"></span > Add Order Detail
        </button>
        <table id="table-admin" class="table table-striped table-bordered dt-responsive nowrap shadow">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php include('inc/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/order_detail_data.js"></script>
</body>
</html>