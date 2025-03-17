<!DOCTYPE html>
<html lang="en"> 
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Rizvi">
        <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
        <link rel="shortcut icon" href="uploads/favicon.png">
        <title><?php echo $this->router->fetch_class(); ?> | Pharmacy Management System</title>
        <!-- Bootstrap core CSS -->
        <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="common/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" href="common/assets/data-tables/DT_bootstrap.css" />
        <!-- Custom styles for this template -->
        <link href="common/css/style.css" rel="stylesheet">
        <link href="common/css/style-responsive.css" rel="stylesheet" />
        <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link href="common/css/invoice-print.css" rel="stylesheet" media="print">
        <link href="common/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet">


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>  
    <?php $settings_title = explode(' ', $settings->title) ?>
    <body>
        <section id="container" class="">
            <!--header start-->
            <header class="header white-bg">
                <div class="sidebar-toggle-box">
                    <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-dedent tooltips"></div>
                </div>
                <!--logo start-->
                <a href="" class="logo"><strong><?php echo $settings_title[0]; ?><span><?php
                            if (!empty($settings_title[1])) {
                                echo $settings_title[1];
                            }
                            ?></strong></span></a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">

                        <!-- Payment notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?> 
                            <li id="header_inbox_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-money"></i>
                                    <span class="badge bg-important"> 
                                        <?php
                                        $query = $this->db->get('payment');
                                        $query = $query->result();
                                        foreach ($query as $payment) {
                                            $payment_date = date('y/m/d', $payment->date);
                                            if ($payment_date == date('y/m/d')) {
                                                $payment_number[] = '1';
                                            }
                                        }
                                        if (!empty($payment_number)) {
                                            echo $payment_number = array_sum($payment_number);
                                        } else {
                                            $payment_number = 0;
                                            echo $payment_number;
                                        }
                                        ?>        
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-red"></div>
                                    <li>
                                        <p class="red"> <?php
                                            echo $payment_number . ' ';
                                            if ($payment_number <= 1) {
                                                echo lang('payment_today');
                                            } else {
                                                echo lang('payments_today');
                                            }
                                            ?></p>
                                    </li>
                                    <li>
                                        <a href="finance/payment"><p class="green"> <?php echo lang('see_all_payments'); ?> </p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <!-- payment notification end -->  
                        <!-- patient notification start-->

                        <!-- patient notification end -->  

                        <!-- medicine notification start-->
                        <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor'))) { ?> 
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-medkit"></i>
                                    <span class="badge bg-success">                          
                                        <?php
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('medicine');
                                        $query = $query->result();
                                        foreach ($query as $medicine) {
                                            $medicine_number[] = '1';
                                        }
                                        if (!empty($medicine_number)) {
                                            echo $medicine_number = array_sum($medicine_number);
                                        } else {
                                            $medicine_number = 0;
                                            echo $medicine_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                            echo $medicine_number . ' ';
                                            if ($medicine_number <= 1) {
                                                echo lang('medicine_registered_today');
                                            } else {
                                                echo lang('medicines_registered_today');
                                            }
                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="medicine"><p class="green"> <?php echo lang('see_all_medicines'); ?> </p></a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?> 
                        <!-- medicine notification end -->  

                    </ul>
                </div>
                <div class="top-nav ">
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($message)) {
                        ?>
                        <div class="flashmessage pull-left"><i class="fa fa-check"></i> <?php echo $message; ?></div>
                    <?php } ?> 
                    <ul class="nav pull-right top-menu">
                        <!-- user login dropdown start-->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <img alt="" src="uploads/favicon.png" width="21" height="23">
                                <span class="username"><?php echo $this->ion_auth->user()->row()->username; ?></span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <?php if (!$this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href=""><i class="fa fa-dashboard"></i>  <?php echo lang('dashboard'); ?> </a></li>
                                <?php } ?>
                                <li><a href="profile"><i class=" fa fa-suitcase"></i> <?php echo lang('profile'); ?> </a></li>
                                <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                    <li><a href="settings"><i class="fa fa-cog"></i>  <?php echo lang('settings'); ?> </a></li>
                                <?php } ?>

                                <li><a><i class="fa fa-user"></i> <?php echo $this->ion_auth->get_users_groups()->row()->name ?></a></li>
                                <li><a href="auth/logout"><i class="fa fa-key"></i>  <?php echo lang('log_out'); ?> </a></li>
                            </ul>
                        </li>
                        <!-- user login dropdown end -->
                    </ul>
                </div>
            </header>
            <!--header end-->
            <!--sidebar start-->

            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a href="">
                                <i class="fa fa-dashboard"></i>
                                <span> <?php echo lang('dashboard'); ?> </span>
                            </a>
                        </li>

                        <li>
                            <a href="finance/addPaymentView">
                                <i class="fa fa-money"></i>
                                <span> <?php echo lang('pos'); ?> </span>
                            </a>
                        </li>




                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa  fa-medkit"></i>
                                    <span> <?php echo lang('medicine'); ?> </span>
                                </a>
                                <ul class="sub">
                                    <li><a  href="medicine"><i class="fa fa-medkit"></i> <?php echo lang('medicine_list'); ?> </a></li>
                                    <li><a  href="medicine/addMedicineView"><i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine'); ?> </a></li>
                                    <li><a  href="medicine/medicineCategory"><i class="fa fa-edit"></i> <?php echo lang('medicine_category'); ?> </a></li>
                                    <li><a  href="medicine/addCategoryView"><i class="fa fa-plus-circle"></i> <?php echo lang('add_medicine_category'); ?> </a></li>

                                </ul>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="finance/payment">
                                <i class="fa fa-money"></i>
                                <span> <?php echo lang('all_sales'); ?> </span>
                            </a>
                        </li>





                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <i class="fa fa-dollar"></i> <i class="fa fa-dollar dollar"></i>
                                    <span> <?php echo lang('expenses'); ?> </span>
                                </a>
                                <ul class="sub">

                                    <li><a  href="finance/expense"><i class="fa fa-money"></i> <?php echo lang('expense'); ?> </a></li>
                                    <li><a  href="finance/addExpenseView"><i class="fa fa-plus-circle"></i> <?php echo lang('add_expense'); ?> </a></li>
                                    <li><a  href="finance/expenseCategory"><i class="fa fa-edit"></i> <?php echo lang('expense'); ?>   <?php echo lang('category'); ?>  </a></li>

                                </ul>
                            </li> 
                        <?php } ?>


                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li>
                                <a href="finance/financialReport">
                                    <i class="fa fa-money"></i>
                                    <span> <?php echo lang('financial_report'); ?> </span>
                                </a>
                            </li>


                            <li>
                                <a href="accountant">
                                    <i class="fa fa-dashboard"></i>
                                    <span> <?php echo lang('staff'); ?> </span>
                                </a>
                            </li>


                            <li>
                                <a href="settings" >
                                    <i class="fa fa-gears"></i>
                                    <span>  <?php echo lang('settings'); ?>  </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($this->ion_auth->in_group('Accountant')) { ?>
                            <li>
                                <a href="finance/expense" >
                                    <i class="fa fa-money"></i>
                                    <span>  <?php echo lang('expense'); ?>  </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/addExpenseView" >
                                    <i class="fa fa-plus-circle"></i>
                                    <span>  <?php echo lang('add_expense'); ?>  </span>
                                </a>
                            </li>
                        <?php } ?>

                        <li>
                            <a href="profile" >
                                <i class="fa fa-user"></i>
                                <span>  <?php echo lang('profile'); ?>  </span>
                            </a>
                        </li>

                        <!--multi level menu start-->

                        <!--multi level menu end-->

                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->




