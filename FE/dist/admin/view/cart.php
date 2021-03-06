<?php include('inc/header.php') ?>
    <!-- Popup Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>User:</label><span id="user_idErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="user_id" name="user_id" required>
                                <option selected value="">Select User</option>
                                <?php include('inc/load_user.php'); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Total Price:</label><span id="total_priceErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="total_price" id="total_price" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Total quantity:</label><span id="total_quantityErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="total_quantity" id="total_quantity" required readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="add_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="add_save" class="btn btn-primary">Save Cart</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Cart</h5>
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
                            <label>Old User:</label><span id="user_id_oldErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="user_old" id="user_old" required readonly>
                            <input type="hidden" class="form-control" name="user_id_old" id="user_id_old" required readonly>
                            <span id="user_id_newErr" class="error-msg-admin"> *</span>
                            <select class="form-control selectpicker show-tick" data-live-search="true" id="user_id_new" name="user_id_new" required>
                                <option selected value="">Change User</option>
                                <?php include('inc/load_user.php'); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Total Price:</label><span id="total_price_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="total_price" id="total_price_edt" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Total quantity:</label><span id="total_quantity_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="total_quantity" id="total_quantity_edt" required readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="edt_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="edt_save" class="btn btn-success">Update Cart</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Cart</h5>
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
                            <label>User ID:</label><span id="user_id_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" id="user_id_del" name="user_id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Total Price:</label><span id="total_price_delErr" class="error-msg-admin"> *</span>
                            <input type="number" step="0.01" class="form-control" name="total_price" id="total_price_del" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Total quantity:</label><span id="total_quantity_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="total_quantity" id="total_quantity_del" required readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="del_action" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="del_save" class="btn btn-danger">Delete Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->

    <div class="content-amdin">
    <h1 class="aboutus-title pricing-title title-admin">Carts</h1>
    <div class="container">
        <button type="button" id="addData" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            <span class="fas fa-plus"></span > Add Cart
        </button>
        <table id="table-admin" class="table table-striped table-bordered dt-responsive nowrap shadow">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Action</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Total Price</th>
                    <th>Total Quantity</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
    <?php include('inc/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/cart_data.js"></script>
</body>
</html>