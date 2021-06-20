<?php
  require_once '../db/dbhelper.php';
  require_once '../utility/utils.php';

  $mess=executeResult("select * from message where status = 0 order by created_at desc");
  $number=count($mess);

  $user = checkLogin();
  $active = $user['active'];

?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <img src="https://hinoderoyalpark.com.vn/public/media/logo_hnd_rp.png" style="height: 62px;" alt="" />
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-danger">0</span><i class="fa fa-envelope-o fa-3x"></i>
                    </a>
                    <!-- dropdown-messages -->
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong><span class=" label label-danger">Thông báo mới</span></strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>khong co gi </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        
                    </ul>
                    <!-- end dropdown-messages -->
                </li>
<!--  -->
                <li class="dropdown" style="display: <?= ($active==0)?'none':'' ?>">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="top-label label label-warning"><?=$number?></span><i class="fa fa-bell fa-3x"></i>
                    </a>

                <!-- dropdown alerts-->
                    <ul class="dropdown-menu dropdown-messages">
                        <?php
                            $i=0;
                            foreach ($mess as $item) {
                                $i++;
                                if ($i<=5) {
                                    echo '<li onclick="seen('.$item['id'].')">
                                                <a href="'.$item['href'].'">
                                                    <div>
                                                        <strong><span class=" label label-danger">Thông báo mới</span></strong>
                                                        <span class="pull-right text-muted">
                                                            <em>'.timeAgo($item['created_at']).'</em>
                                                        </span>
                                                    </div>
                                                    <div>'.$item['content'].'</div>
                                                </a>
                                            </li>
                                            <li class="divider"></li>';
                                                    }
                                
                            }
                        ?>
                        
                        <li>
                            <a class="text-center" href="adm_message.php">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                <!-- end dropdown-alerts -->

                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>

        <script type="text/javascript">
            function seen(id) {
                $.post('adm_message.php',{change_id:id},function(data){
                   
                })
            }
        </script>