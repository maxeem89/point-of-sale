<?php

use Core\Models\User;

$user = new User();

$current_user = $user->get_by_id($_SESSION['user']->user_id);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice Management System</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php base_url('resources/css/AdminLTE.css'); ?>">

    <link rel="stylesheet" href="<?php base_url("resources/css/skin-green.css"); ?>">

    <!-- JS -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="<?php base_url("resources/js/moment.js"); ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="<?php base_url("resources/js/bootstrap.datetime.js"); ?>"></script>
    <script src="<?php base_url("resources/js/bootstrap.password.js"); ?>"></script>
    <script src="<?php base_url("resources/js/scripts.js"); ?>"></script>

    <!-- AdminLTE App -->
    <script src="<?php base_url("resources/js/app.min.js"); ?>"></script>
    <script src="<?php base_url("resources/js/app.min.js"); ?>"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="<?php base_url("resources/css/bootstrap.datetimepicker.css"); ?>">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php base_url("resources/css/styles.css"); ?>">

</head>

<body class="hold-transition skin-green sidebar-mini">

    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!--Logo -->
            <a href="" class="logo">
                <!--mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>IN</b>MS</span>
                <!--logo for regular state and mobile devices -->
                <span style="text-decoration:none;" class="logo-lg"><b>Invoice</b> System</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top d-block p-0" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php /*echo $_SESSION['login_username'];*/ ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Drop down list-->
                                <li><a href="logout.php" class="btn btn-default btn-flat">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>


        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">


                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">MENU</li>
                    <!-- Menu 0.1 -->
                    <li class="treeview">
                        <a href="/admin"><i class="fa fa-tachometer"></i> <span>Dashboard</span>

                        </a>

                    </li>
                    <!-- Menu 1 -->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-file-text"></i> <span>Invoices</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/invoices/add"><i class="fa fa-plus"></i>Create Invoice</a></li>
                            <li><a href="/admin/invoices"><i class="fa fa-cog"></i>Manage Invoices</a></li>
                        </ul>
                    </li>
                    <!-- Menu 2 -->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-archive"></i><span>Products</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/items/add"><i class="fa fa-plus"></i>Add Products</a></li>
                            <li><a href="/admin/items"><i class="fa fa-cog"></i>Manage Products</a></li>
                        </ul>
                    </li>

                    <!-- Menu 3 -->
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i><span>System Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/users/add"><i class="fa fa-plus"></i>Add User</a></li>
                            <li><a href="/admin/users"><i class="fa fa-cog"></i>Manage Users</a></li>
                        </ul>
                    </li>

                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content">

                <!-- Your Page Content Here -->