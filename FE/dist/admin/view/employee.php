<?php include('inc/header.php') ?>
    <!-- Popup Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addForm" method="POST">
                    <div class="modal-body">
                        <!-- <div class="form-group">
                            <label>Company name:</label><span id="companynameErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="companyname" id="companyname" required>
                        </div> -->
                        <div class="form-group">
                            <label>First name:</label><span id="firstnameErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="firstname" id="firstname" required>
                        </div>
                        <div class="form-group">
                            <label>Last name:</label><span id="lastnameErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="lastname" id="lastname" required>
                        </div>
                        <div class="form-group">
                            <label>Job:</label><span id="jobErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="job" id="job" required>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label><span id="phoneErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Facebook:</label><span id="facebookErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="facebook" id="facebook">
                        </div>
                        <div class="form-group">
                            <label>Instagram:</label><span id="instagramErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="instagram" id="instagram">
                        </div>
                        <div class="form-group">
                            <label>Twitter:</label><span id="twitterErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="twitter" id="twitter">
                        </div>
                        <div class="form-group">
                            <label>Description:</label><span id="descriptionErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="add_action" value="addData">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="add_save" class="btn btn-primary">Save Employee</button>
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
                            <input type="number" class="form-control" name="id" id="id_edt" required readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label>Company name:</label><span id="companyname_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="companyname" id="companyname_edt" required>
                        </div> -->
                        <div class="form-group">
                            <label>First name:</label><span id="firstname_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="firstname" id="firstname_edt" required>
                        </div>
                        <div class="form-group">
                            <label>Last name:</label><span id="lastname_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="lastname" id="lastname_edt" required>
                        </div>
                        <div class="form-group">
                            <label>Job:</label><span id="job_edtErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="job" id="job_edt" required>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label><span id="phone_edtErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="phone" id="phone_edt" required>
                        </div>
                        <div class="form-group">
                            <label>Facebook:</label><span id="facebook_edtErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="facebook" id="facebook_edt">
                        </div>
                        <div class="form-group">
                            <label>Instagram:</label><span id="instagram_edtErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="instagram" id="instagram_edt">
                        </div>
                        <div class="form-group">
                            <label>Twitter:</label><span id="twitter_edtErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="twitter" id="twitter_edt">
                        </div>
                        <div class="form-group">
                            <label>Description:</label><span id="description_edtErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="description" id="description_edt">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="edt_action" value="edtData">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="edt_save" class="btn btn-success">Update Employee</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="delForm" method="POST">
                    <div class="modal-body">
                    <div class="form-group">
                            <label>ID:</label><span id="id_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="id" id="id_del" required readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label>Company name:</label><span id="companyname_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="companyname" id="companyname_del" required>
                        </div> -->
                        <div class="form-group">
                            <label>First name:</label><span id="firstname_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="firstname" id="firstname_del" required>
                        </div>
                        <div class="form-group">
                            <label>Last name:</label><span id="lastname_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="lastname" id="lastname_del" required>
                        </div>
                        <div class="form-group">
                            <label>Job:</label><span id="job_delErr" class="error-msg-admin"> *</span>
                            <input type="text" class="form-control" name="job" id="job_del" required>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label><span id="phone_delErr" class="error-msg-admin"> *</span>
                            <input type="number" class="form-control" name="phone" id="phone_del" required>
                        </div>
                        <div class="form-group">
                            <label>Facebook:</label><span id="facebook_delErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="facebook" id="facebook_del">
                        </div>
                        <div class="form-group">
                            <label>Instagram:</label><span id="instagram_delErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="instagram" id="instagram_del">
                        </div>
                        <div class="form-group">
                            <label>Twitter:</label><span id="twitter_delErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="twitter" id="twitter_del">
                        </div>
                        <div class="form-group">
                            <label>Description:</label><span id="description_delErr" class="error-msg-admin"> </span>
                            <input type="text" class="form-control" name="description" id="description_del">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="del_action" value="deleteData">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="save" id="del_save" class="btn btn-danger">Delete Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Popup Delete -->

    <h1 class="aboutus-title pricing-title title-admin">Employees</h1>
    <div class="container">
        <button type="button" id="addData" class="btn btn-primary add-btn-admin" data-toggle="modal" data-target="#addModal">
            <span class="fas fa-plus"></span > Add Employee
        </button>
        <table id="table-admin" class="table table-striped table-bordered dt-responsive nowrap shadow">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Action</th>
                    <!-- <th>Company</th> -->
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Job</th>
                    <th>Phone</th>
                    <th>Facebook</th>
                    <th>Instagram</th>
                    <th>Twitter</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php include('inc/footer.php') ?>
    <script src="../js/employee_data.js"></script>
</body>
</html>