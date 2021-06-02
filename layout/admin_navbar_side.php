<nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <img src="<?= $user['avatar']?>" alt="">
                            </div>
                            <div class="user-info">
                                <div><strong style="font-size: 18px;"><?= $user['fullname']?></strong></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="sidebar-search">
                        <!-- search section-->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!--end search section-->
                    </li>

<!-- admintrations -->
                    <li class="">
                        <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>

                    <li class="">
                        <a href="adm_games.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Games</a>
                    </li>

                    <li class="">
                        <a href="adm_places.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Places</a>
                    </li>

                    <li class="">
                        <a href="adm_users.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i>Users</a>
                    </li>

                    <li class="">
                        <a href="adm_category.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Category</a>
                    </li>

                    <li class="">
                        <a href="adm_change_password.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Change Password</a>
                    </li>

                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>