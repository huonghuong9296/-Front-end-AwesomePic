<?php include('inc/header.php') ?>
    <!-- Popup Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username:</label><span id="usernameErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label>Password:</label><span id="passwordErr" class="error-msg-admin"> *</span>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label><span id="emailErr" class="error-msg-admin"> *</span>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label>First name:</label><span id="firstnameErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="firstname" id="firstname" required>
                        </div>
                        <div class="form-group">
                            <label>Last name:</label><span id="lastnameErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="lastname" id="lastname" required>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label><span id="phoneErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Address:</label><span id="addressErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                        <div class="form-group">
                            <label>City:</label><span id="cityErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
                        <div class="form-group">
                            <label>Country:</label><span id="countryErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="country" id="country">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="add_action" value="addData">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="add_save" class="btn btn-primary">Save User</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
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
                            <label>Username:</label><span id="username_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="username_edt" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Password:</label><span id="password_edtErr" class="error-msg-admin"> *</span>
                            <input type="password" class="form-control" id="password_edt" name="password" required>
                        </div>
                        <div class="form-group">
                            <label>Email:</label><span id="email_edtErr" class="error-msg-admin"> *</span>
                            <input type="email" class="form-control" id="email_edt" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>First name:</label><span id="firstname_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="firstname_edt" name="firstname" required>
                        </div>
                        <div class="form-group">
                            <label>Last name:</label><span id="lastname_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="lastname_edt" name="lastname" required>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label><span id="phone_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" id="phone_edt" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Adsress:</label><span id="address_edtErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="address_edt" name="address">
                        </div>
                        <div class="form-group">
                            <label>City:</label><span id="city_edtErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="city_edt" name="city">
                        </div>
                        <div class="form-group">
                            <label>Country:</label><span id="country_edtErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="country_edt" name="country">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="edt_action" value="edtData">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="edt_save" class="btn btn-success">Update User</button>
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
                <form id="delForm" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID:</label><span id="id_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" id="id_del" name="id" readonly>
                        </div>
                        <div class="form-group">
                            <label>Username:</label><span id="username_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="username_del" name="username" readonly>
                        </div>
                        <div class="form-group">
                            <label>Password:</label><span id="password_delErr" class="error-msg-admin"> *</span>
                            <input type="password" class="form-control" id="password_del" name="password" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email:</label><span id="email_delErr" class="error-msg-admin"> *</span>
                            <input type="email" class="form-control" id="email_del" name="email" readonly>
                        </div>
                        <div class="form-group">
                            <label>First name:</label><span id="firstname_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="firstname_del" name="firstname" readonly>
                        </div>
                        <div class="form-group">
                            <label>Last name:</label><span id="lastname_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" id="lastname_del" name="lastname" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label><span id="phone_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" id="phone_del" name="phone" readonly>
                        </div>
                        <div class="form-group">
                            <label>Adsress:</label><span id="address_delErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="address_del" name="address" readonly>
                        </div>
                        <div class="form-group">
                            <label>City:</label><span id="city_delErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="city_del" name="city" readonly>
                        </div>
                        <div class="form-group">
                            <label>Country:</label><span id="country_delErr" class="error-msg-admin"></span>
                            <input type="text" class="form-control" id="country_del" name="country" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="del_action" value="deleteData">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="del_save" class="btn btn-danger">Delete User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->

    <h1 class="aboutus-title pricing-title title-admin">Users</h1>
    <div class="container">
        <button type="button" id="addData" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            <span class="fas fa-plus"></span > Add User
        </button>
        <table id="table-admin" class="table table-striped table-bordered dt-responsive nowrap shadow">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Action</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php include('inc/footer.php') ?>
    <script src="../js/user_data.js"></script>
</body>
</html>