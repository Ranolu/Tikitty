<?php require('layout/layout_top.php') ?>
<link rel="stylesheet" href="assets/css/profile.css">

<section class="mt-3 pt-3 sectionContainer" >
    <div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div>
            <header class="container p-5">
                <div class="mt-3 d-flex flex-column text-center align-items-center">
                    <?php if($_SESSION['role'] == '3') {?>
                        <img src="assets/images/2.png" class="rounded-circle m-3" alt="profile" style="width: 10rem;">
                    <?php } else {?>
                        <img src="assets/images/1.png" class="rounded-circle m-3" alt="profile" style="width: 10rem;">
                    <?php }?>
                    <div class="d-flex flex-wrap align-items-center">
                        <h2 class="mx-3" style="color: white">Welcome, <?php echo $_SESSION['username']?></h2>
                    </div>
                    <p class="lead" style="color: white">Manage your profile to make Tikitty fit you.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateUserModal">Edit Profile</button>
                </div>
            </header>

            <main class="container mb-5">
                <div class="card m-auto">
                    <div class="card-header bg-body">
                        <p class="fs-5">Username: <?php echo $_SESSION['username']?></p>
                        <p class="fs-5">Name: <?php echo $data['name']?></p>
                        <p class="fs-5">Birthday: <?php echo $data['birthdate']?></p>
                        <?php if($data['affiliation'] != null) {?>
                            <p class="fs-5">Affiliation: <?php echo $data['affiliation']?></p>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div>
                            <h3 class="lead">Contact</h3>
                            <p class="fs-5">Email: <?php echo $data['email']?></p>
                            <p class="fs-5">Phone: <?php echo $data['contact_num']?></p>
                        </div>
                        <div>
                            <h3 class="lead">Password</h3>
                            <a href="#" class="text-decoration-none text-danger h5" data-bs-toggle="modal" data-bs-target="#changePassModal">Change Password</a>
                        </div>
                    </div>
                    <div class="card-footer list-group px-3">
                        <a href="#" class="text-decoration-none text-danger h5 list-item" data-bs-target="#deleteModal" data-bs-toggle="modal">Delete Account</a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-body p-md-3">
                <h3 class="text-center">Update Profile</h3>
                <form id="userUpdate" action="profile.php?updateUser=true" method="post">
                    <div class="mb-4 mt-4 mx-md-3">
                        <label for="user-name">Name: </label>
                        <input type="text" name="name" id="user-name" class="form-control p-3" pattern="[a-zA-Z\s\.\-]*[a-zA-Z][a-zA-Z\s\.\-]*" placeholder="Name" value="<?php echo $data['name']?>" required>
                    </div>
                    <div class="mb-4 mx-md-3">
                        <label for="user-birthdate">Birthdate: </label>
                        <input type="date" class="form-control p-3" name="birthdate" id="user-birthdate" value="<?php echo $data['birthdate']?>" required>
                    </div>
                    <div class="mb-4 mx-md-3">
                        <label for="user-contact_num">Contact Number: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">+63</span>
                            <input class="form-control p-3" type="number" name="contact_num" id="user-contact_num" placeholder="Contact No." min="9000000000" max="9999999999" value="<?php echo substr($data['contact_num'], 3)?>" required>
                        </div>
                    </div>
                    <?php if(!empty($data['affiliation'])) {?>
                        <div class="mb-4 mx-md-3">
                            <label for="organizer-affiliation">Affiliation: </label>
                            <input type="text" name="affiliation" id="organizer-affiliation" class="form-control p-3" placeholder="Affiliation" maxlength="50" value="<?php echo $data['affiliation']?>" required>
                        </div>
                    <?php }?>
                    <div class="mb-4 mx-md-3">
                        <label for="new_user-email">Email: </label>
                        <input type="email" name="email" id="new_user-email" class="form-control p-3" placeholder="Email" value="<?php echo $data['email']?>" required>
                    </div>
                    <div class="mx-md-3">
                        <p name="emailStatus" id="new_emailStatus" style="display: none; color: red;" class="text-start">Email already in use!</p>
                    </div>
                    <div class="mb-4 mt-4 mx-md-3">
                        <label for="new_user-username">Email: </label>
                        <input type="text" name="username" id="new_user-username" class="form-control p-3" minlength="5" maxlength="20" pattern="[a-zA-Z0-9]*" placeholder="Username" value="<?php echo $_SESSION['username']?>" required>
                    </div>
                    <div class="mx-md-3">
                        <p name="usernameStatus" id="new_usernameStatus" style="display: none; color: red;" class="text-start">Username already in use!</p>
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-primary" name="updateUser">Update</button></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="changePassModal" tabindex="-1" aria-labelledby="changePassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-body text-center p-md-3">
                <h3>Change Password</h3>
                <form id="passwordForm" action="profile.php?user_id=<?php echo $_SESSION['user_id']?>&passReset=true" method="post" onsubmit="return checkPasswordMatch()">
                    <div class="mb-3 mt-3">
                        <label for="new_pass" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_pass" name="password" minlength="8" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_pass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" required>
                    </div>
                    <div class="mx-md-3 mb-3">
                        <p id="new_passStatus" style="display: none; color: red;" class="text-start">Passwords do not match!</p>
                    </div>
                    <button type="submit" class="btn btn-primary" name="resetPass">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-md-5">
        <div class="modal-body text-center">
            <h3>Are you sure you want to delete your account?</h3>
            <a id="deleteLink" href="profile.php?deleteAcc=true"><button class="btn btn-danger btn-lg mt-5">DELETE</button></a>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="profileUpdateModal" tabindex="-1" aria-labelledby="profileUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Profile has been updated.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="passwordUpdateModal" tabindex="-1" aria-labelledby="passwordUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>Password has been updated.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<script src="js/profile.js"></script>
<?php require('layout/layout_bot.php') ?>