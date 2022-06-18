<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4 col-xl-4">
                    <div class="card-box text-center">
                        <img src="<?= base_url('assets') ?>/images/users/user.png" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                        <h4 class="mb-0"><?= $session->first_name ?> <?= $session->last_name ?></h4>
                        <p class="text-muted"><?= $session->username ?></p>

                        <div class="text-left mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2"><?= $session->first_name ?> <?= $session->last_name ?></span></p>

                            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2"><?= $session->phone ?></span></p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "><?= $session->email ?></span></p>

                            <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ml-2">IDN</span></p>
                        </div>
                    </div> <!-- end card-box -->

                </div> <!-- end col-->

                <div class="col-lg-8 col-xl-8">
                    <div class="card-box">
                        <ul class="nav nav-pills navtab-bg nav-justified">
                            <li class="nav-item">
                                <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Edit Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                    Edit Password
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="aboutme">

                                <?= form_open('user/profile') ?>
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
                                <input type="hidden" name="id" value="<?= $session->id ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Enter first name" value="<?= $session->first_name ?>">
                                            <small class="text-danger"><?= form_error('first_name') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Enter last name" value="<?= $session->last_name ?>">
                                            <small class="text-danger"><?= form_error('last_name') ?></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="userbio">Company name</label>
                                            <textarea class="form-control" id="userbio" name="company" rows="4" placeholder="Write something..."><?= $session->company ?></textarea>
                                            <small class="text-danger"><?= form_error('company') ?></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="useremail">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="useremail" placeholder="Enter email" value="<?= $session->email ?>">
                                            <small class="text-danger"><?= form_error('email') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter phone" value="<?= $session->phone ?>">
                                            <small class="text-danger"><?= form_error('phone') ?></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                </div>
                                <?= form_close() ?>

                            </div> <!-- end tab-pane -->
                            <!-- end about me section content -->

                            <div class="tab-pane " id="timeline">

                                <?= form_open('user/profile/edit_password') ?>
                                <input type="hidden" name="id" value="<?= $session->id ?>">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Akses Password</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                                            <small class="text-danger"><?= form_error('password') ?></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userpassword">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control" id="userpassword" placeholder="Enter password">
                                            <small class="text-danger"><?= form_error('confirm_password') ?></small>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="text-right">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                </div>
                                <?= form_close() ?>

                            </div>
                            <!-- end timeline content-->

                        </div> <!-- end tab-content -->
                    </div> <!-- end card-box-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->