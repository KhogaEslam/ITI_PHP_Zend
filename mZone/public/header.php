<?php
if(!isset($_SESSION['username'])){
    //header('Location: login.php');
}
require_once "./fixed_sidebar.php";
?>
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a  class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src='<?php $this->baseUrl() ?>/images/user.png'>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?php $this->baseUrl() ?>/user/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src= '<?php $this->baseUrl() ?>/images/user.png' alt="Profile Image" /></span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src= '<?php $this->baseUrl() ?>/images/user.png' alt="Profile Image" /></span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <?php
                        $auth=Zend_Auth::getInstance();
                        $storage=$auth->getStorage();
                        $userdata=$storage->read();
                        $fbsession = new Zend_Session_Namespace('facebook');
                        if(!empty($userdata)|| isset($fbsession->first_name))
                        {
                            if(empty($userdata))
                            {
                                echo 'Welcome'." " . $fbsession->first_name ." ".$fbsession->last_name ." " .$fbsession->gender;
                                echo"<br>";
                                echo' <a href="'.$this->baseUrl().'/User/logout">Logout</a>';
                            }
                            else
                            {
                                // if authenticated and logged in
                                echo 'Welcome'." " . $userdata->username ;
                                echo"<br>";
                                echo' <a href="'.$this->baseUrl().'/User/logout">Logout</a>';
                            }

                        }

                        // else
                        // {// if not logged in
                        //   echo' <a href="/user/login">Login</a>';

                        // }
                        ?>
