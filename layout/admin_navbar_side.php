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
                        <a href="../index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>

                    <li class="<?= ($selected =='adm_statistic')?'selected':''?>">
                        <a href="adm_statistic.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Statistic</a>
                    </li>

                    <li class="<?= ($selected =='adm_orders')?'selected':''?>">
                        <a href="adm_orders.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Orders</a>
                    </li>

                    <li class="<?= ($selected =='adm_games')?'selected':''?>">
                        <a href="adm_games.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Games</a>
                    </li>

                    <li class="<?= ($selected =='adm_photoes')?'selected':''?>">
                        <a href="adm_photoes.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Photoes</a>
                    </li>

                    <li class="<?= ($selected =='adm_albums')?'selected':''?>">
                        <a href="adm_albums.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Albums</a>
                    </li>

                    <li class="<?= ($selected =='adm_videos')?'selected':''?>">
                        <a href="adm_videos.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Videos</a>
                    </li> 

                    <li class="<?= ($selected =='adm_places')?'selected':''?>">
                        <a href="adm_places.php"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Places</a>
                    </li>

                    <li class="<?= ($selected =='adm_users')?'selected':''?>" style="<?=($user['email']!='picnic@gmail.com')?'display: none':''; ?>">
                        <a href="adm_users.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i>Users</a>
                    </li>

                    <li class="<?= ($selected =='adm_category')?'selected':''?>">
                        <a href="adm_category.php"><i class="fa fa-angle-double-right" aria-hidden="true" style="margin-right: 5px;"></i> Category</a>
                    </li>

                    <li class="<?= ($selected =='adm_change_password')?'selected':''?>">
                        <a href="adm_change_password.php"><i class="fa fa-shield" aria-hidden="true"></i> Change Password</a>
                    </li>

                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>