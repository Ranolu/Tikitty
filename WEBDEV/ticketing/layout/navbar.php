    <nav class="navbar fixed-top navCss">
        <div class="container-fluid me-0 ms-sm-0 px-sm-0 mx-lg-5 px-lg-5 w-100 justify-items-center">
            <div class="row overflow-hidden justify-items-center align-items-center w-100 navRow">
                <div class="col-3 col-md-2 col-lg-2 xswidth">
                    <div class="navbar-brand w-100">
                        <a href="./">
                            <img class="img-fluid" style="max-height: 60px;" src="./assets/images/tikitty2.png" alt="Profile Picture">
                        </a>
                    </div>
                </div>
                <?php if($route === '/WEBDEV/ticketing/' || strpos($routeWithoutParams, '/WEBDEV/ticketing/index.php') === 0 || strpos($routeWithoutParams, '/WEBDEV/ticketing/eventView.php') === 0 || strpos($routeWithoutParams, '/WEBDEV/ticketing/eventList.php') === 0) {?>
                <?php if (!isset($_SESSION['role']) || $_SESSION['role'] == '3') {?>
                <div class="col-6 col-md-4 col-lg-8 text-center  overflow-hidden">
                    <div class="searchbar">
                        <form action="./eventList.php" method="get">
                            <input type="text" name="search" id="search" class="form-control text-white w-lg-100" placeholder="Search..." autocomplete="off">
                            <div class="searchIcon">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } else { ?> 
                    <div class="col-6 col-md-4 col-lg-8 text-center  overflow-hidden">
                    </div>
                    <?php }} else {?>
                    <div class="col-6 col-md-4 col-lg-8 text-center  overflow-hidden">
                    </div>
                <?php }?>
                <div class="col-2 col-md-2 col-lg-2  pe-sm-3 text-end overflow-hidden">
                    <button class="btn transparent-btn btn-lg" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" aria-controls="offcanvas" aria-expanded="false">
                        <i class="fa-solid fa-bars"></i>
                    </button>  
                </div>
            </div> 
        </div>
    </nav>
    <div class="offcanvas offcanvas-end overflow-hidden" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div class="row p-3 justify-content-center align-items-center">
                <div class="text-center">
                    <?php if(!isset($_SESSION['loggedIn'])) {?>
                    <h1 class="display-text mb-4">Welcome Visitor!</h1>
                    <img class="profile-image-nav" src="./assets/images/3.png" alt="Profile Picture"><br>
                    <?php } else {?> 
                        <h1 class="display-text mb-4">Welcome <?php echo $_SESSION['username']?>!</h1>
                        <?php if($_SESSION['role'] == '3'){?>
                            <img class="profile-image-nav" src="./assets/images/2.png" alt="Profile Picture"><br> 
                        <?php } else {?>
                            <img class="profile-image-nav" src="./assets/images/1.png" alt="Profile Picture"><br>
                        <?php }}?>
                    <div class="overflow-auto">
                        <?php if(!isset($_SESSION['loggedIn'])) {?>
                        <button type="button" id="loginButton" class="btn btn-primary btn-custom mb-4 mt-4" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button><br>            
                        <?php } ?>  
                        <?php if(isset($_SESSION['loggedIn']) && ($_SESSION['role'] == '2' || $_SESSION['role'] == '3')) {?> 
                            <a href="profile.php" class="btn btn-primary btn-custom mb-4 mt-4">Profile</a><br> 
                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == '3') {?> 
                                <a href="transactionHistory.php" class="btn btn-primary btn-custom mb-4 mt-4">Transactions</a><br>
                            <?php }?> 
                        <?php }?>        
                        <a href="about.php" class="btn btn-primary btn-custom mb-4 mt-4">About Us</a><br> 
                        <a href="contact.php" class="btn btn-primary btn-custom mb-4 mt-4">Contact Us</a><br>
                        <?php if(isset($_SESSION['loggedIn'])) {?>
                            <a href="feedback.php" class="btn btn-primary btn-custom mb-4 mt-4">Feedback</a><br> 
                        <?php } ?>  
                        <a href="partnership.php" class="btn btn-primary btn-custom mb-4 mt-4">Partners</a><br>
                        <a href="faqs.php" class="btn btn-primary btn-custom mb-4 mt-4">FAQs</a><br>
                        <?php if(isset($_SESSION['loggedIn'])) {?> 
                            <a href="./?logout=true"><button type="button" id="logoutButton" class="btn btn-danger btn-custom mb-4 mt-4">Logout</button></a>
                        <?php }?>  
                    </div>
                </div>
            </div>
            <div class="mt-auto">
                <div class="copyright-text text-center">
                    <p>&copy; 2024 Tikitty. All Right Reserved</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center my-3 text-center">
                        <div class="col-lg-8 col-xl-10">
                            <form action="./?formSubmit=true" method="post" >
                                <h2>Login</h2>
                                <div class="mb-4 mt-4">
                                    <input type="text" name="username" id="username" class="form-control p-3" placeholder="Username" required>
                                </div>
                                <div class="mb-4">
                                    <input type="password" name="password" id="password" class="form-control p-3" placeholder="Password" required>
                                </div>
                                <p class="mb-4">No account? <a href="" data-bs-target="#signUpModal" data-bs-toggle="modal">Sign Up</a></p>
                                <input type="submit" value="Login" id="login" name="login" class="btn btn-primary btn-lg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="signUpModal" aria-hidden="true" aria-labelledby="signUpModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center my-3">
                        <div class="col-lg-8 col-xl-10">
                            <form action="./?formSubmit=true" method="post" >
                                <h2 class="text-center">Sign Up</h2>
                                <div class="mb-4 mt-4 mx-md-3">
                                    <input type="text" name="name" id="user-name" class="form-control p-3" pattern="[a-zA-Z\s\.\-]*[a-zA-Z][a-zA-Z\s\.\-]*" placeholder="Name" required>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <label for="user-birthdate">Birthdate: </label>
                                    <input type="date" class="form-control p-3" name="birthdate" id="user-birthdate" required>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">+63</span>
                                        <input class="form-control p-3" type="number" name="contact_num" id="user-contact_num" placeholder="Contact No." min="9000000000" max="9999999999" required>
                                    </div>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <input type="email" name="email" id="user-email" class="form-control p-3" placeholder="Email" required>
                                </div>
                                <div class="mx-md-3">
                                    <p name="emailStatus" id="emailStatus" style="display: none; color: red;" class="text-start">Email already in use!</p>
                                </div>
                                <div class="mb-4 mt-4 mx-md-3">
                                    <input type="text" name="username" id="user-username" class="form-control p-3" minlength="5" maxlength="20" pattern="[a-zA-Z0-9]*" placeholder="Username" required>
                                </div>
                                <div class="mx-md-3">
                                    <p name="usernameStatus" id="usernameStatus" style="display: none; color: red;" class="text-start">Username already in use!</p>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <input type="password" name="password" id="user-password" class="form-control p-3" minlength="8" maxlength="20" placeholder="Password" required>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <input type="password" name="confirmpassword" id="user-confirmpassword" class="form-control p-3" placeholder="Confirm Password" required>
                                </div>
                                <div class="mx-md-3">
                                    <p name="passStatus" id="passStatus" style="display: none; color: red;" class="text-start">Passwords do not match!</p>
                                </div>
                                <div class="text-center mt-4">
                                    <p>Have an account? <a href="" data-bs-target="#loginModal"  data-bs-toggle="modal">Login</a></p>
                                    <div class="mb-4">
                                        <input type="submit" value="Sign Up" id="signUp-user" name="signUp-user" class="btn btn-primary btn-lg">
                                    </div>
                                    <p>Become a partner! <a href="" data-bs-target="#organizerSignUpModal"  data-bs-toggle="modal">Sign up as Organizer</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="organizerSignUpModal" aria-hidden="true" aria-labelledby="organizerSignUpModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row justify-content-center my-3">
                        <div class="col-lg-8 col-xl-10">
                            <form action="./?formSubmit=true" method="post" ">
                                <h2 class="text-center">Sign Up as Organizer</h2>
                                <div class="mb-4 mt-4 mx-md-3">
                                    <input type="text" name="name" id="organizer-name" class="form-control p-3" pattern="[a-zA-Z\s\.\-]*[a-zA-Z][a-zA-Z\s\.\-]*" placeholder="Name" required>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <label for="organizer-birthdate">Birthdate: </label>
                                    <input type="date" class="form-control p-3" name="birthdate" id="organizer-birthdate" required>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">+63</span>
                                        <input class="form-control p-3" type="number" name="contact_num" id="organizer-contact_num" placeholder="Contact No." min="9000000000" max="9999999999" required>
                                    </div>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <input type="text" name="affiliation" id="organizer-affiliation" class="form-control p-3" placeholder="Affiliation" maxlength="50" required>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <input type="email" name="email" id="organizer-email" class="form-control p-3" placeholder="Email" required>
                                </div>
                                <div class="mx-md-3">
                                    <p name="emailStatus" id="organizerEmailStatus" style="display: none; color: red;" class="text-start">Email already in use!</p>
                                </div>
                                <div class="mb-4 mt-4 mx-md-3">
                                    <input type="text" name="username" id="organizer-username" class="form-control p-3" minlength="5" maxlength="20" pattern="[a-zA-Z0-9]*" placeholder="Username" required>
                                </div>
                                <div class="mx-md-3">
                                    <p name="usernameStatus" id="organizerUsernameStatus" style="display: none; color: red;" class="text-start">Username already in use!</p>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <input type="password" name="password" id="organizer-password" class="form-control p-3" minlength="8" maxlength="20" placeholder="Password" required>
                                </div>
                                <div class="mb-4 mx-md-3">
                                    <input type="password" name="confirmpassword" id="organizer-confirmpassword" class="form-control p-3" placeholder="Confirm Password" required>
                                </div>
                                <div class="mx-md-3">
                                    <p name="passStatus" id="organizerPassStatus" style="display: none; color: red;" class="text-start">Passwords do not match!</p>
                                </div>
                                <div class="text-center mt-4">
                                    <p>Have an account? <a href="" data-bs-target="#loginModal"  data-bs-toggle="modal">Login</a></p>
                                    <div class="mb-4">
                                        <input type="submit" value="Sign Up" id="signUp-organizer" name="signUp-organizer" class="btn btn-primary btn-lg">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>