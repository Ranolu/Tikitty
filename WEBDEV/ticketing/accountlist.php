<?php require('layout/layout_top.php')?>
<link rel="stylesheet" href="assets/css/accountlist.css">
<section class="mt-5 pt-3 accountlistContainer pb-5">
    <main class="container mt-5">
        <form action="accountlist.php" method="get" class="mt-5 mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search User" id="search">
        </form>
        <div class="card mx-auto  mb-3 d-flex flex-wrap overflow-auto p-md-3">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                All Users
            </h5>
            <div class="text-center px-md-5 mx-md-5">
            </div>
            <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Affiliation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $perPage = 10;
            $totalOrders = count($data); 
            $totalPages = ceil($totalOrders / $perPage); 
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; 
            $start = ($currentPage - 1) * $perPage; 
            $end = min($start + $perPage, $totalOrders); 
            for ($i = $start; $i < $end; $i++) {
                ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php
                        if(empty($data[$i]['username'])) {
                            foreach ($data2 as $user) {
                                if ($user['profile_id'] == $data[$i]['profile_id']) {
                                    echo $user['username'];
                                }
                            } 
                        } else {
                            echo $data[$i]['username'];
                        }
                        
                        ?>
                    </td> 
                    <td><?php echo $data[$i]['name']; ?></td>
                    <td><?php echo $data[$i]['birthdate']; ?></td>
                    <td><?php echo $data[$i]['email']; ?></td>
                    <td><?php echo $data[$i]['contact_num']; ?></td>
                    <td><?php echo empty($data[$i]['affiliation']) ? 'none' : $data[$i]['affiliation']; ?></td>
                    <td><button class="btn btn-danger text-center deleteButton" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="updateDeleteLink(<?php echo $data[$i]['profile_id']?>)">Delete</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div>
        <nav aria-label="Page navigation py-3">
            <ul class="pagination justify-content-center mb-5">
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo $currentPage == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </main>
</section>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-md-5">
        <div class="modal-body text-center">
            <h3>Are you sure you want to delete this user?</h3>
            <a id="deleteLink" href="#"><button class="btn btn-danger btn-lg mt-5">DELETE</button></a>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-md-5">
            <div class="modal-body text-center">
                <h3>Success</h3>
                <p>User has been deleted.</p>
                <a href="#"><button class="btn btn-danger btn-lg mt-5" data-bs-dismiss="modal">CLOSE</button></a>
            </div>
        </div>
    </div>
</div>

<script src="js/acclist.js"></script>
<?php require('layout/layout_bot.php')?>