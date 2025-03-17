<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <header class="panel-heading">
            <i class="fa fa-money"></i>   <?php echo lang('financial_report'); ?> 
        </header>
        <div class="col-md-12">
            <div class="col-md-7">  
                <section>
                    <form role="form" class="f_report" action="finance/financialReport" method="post" enctype="multipart/form-data">
                        <label class="range">Date Range</label> 
                        <div class="form-group">

                            <div class="col-md-6">
                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                    if (!empty($from)) {
                                        echo $from;
                                    }
                                    ?>" placeholder=" <?php echo lang('date_from'); ?> ">
                                    <span class="input-group-addon"> <?php echo lang('to'); ?> </span>
                                    <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                    if (!empty($to)) {
                                        echo $to;
                                    }
                                    ?>" placeholder=" <?php echo lang('date_to'); ?> ">
                                </div>
                                <div class="row"></div>
                                <span class="help-block"></span> 
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-info range_submit"> <?php echo lang('submit'); ?> </button>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="">
                    <div class="col-md-3 panel-body">
                        <label class="">Date From</label> 
                        <div class="paanel"><?php
                            if (!empty($from)) {
                                echo $from;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3 panel-body">
                        <label class="">Date To</label> 
                        <div class="paanel"> <?php
                            if (!empty($to)) {
                                echo $to;
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-5">
            </div>
        </div>

        <?php
        if (!empty($payments)) {
            $paid_number = 0;
            foreach ($payments as $payment) {
                $paid_number = $paid_number + 1;
            }
        }
        ?>
        <div class="row">
            <div class="col-lg-7">

                <section class="panel">
                    <header class="panel-heading">
                        <i class="fa fa-money"></i>  <?php echo lang('sales'); ?> <?php echo lang('report'); ?>
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th><?php echo lang('item_name'); ?> </th>
                                <th><?php echo lang('quantity'); ?> </th>
                                <th class="hidden-phone"><?php echo lang('amount'); ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medicines as $category) { ?>
                                <tr class="">
                                    <td><?php echo $category->name ?></td>
                                    <?php
                                    foreach ($payments as $payment) {
                                        $category_names_and_amounts = $payment->category_name;
                                        $category_names_and_amounts = explode(',', $category_names_and_amounts);
                                        foreach ($category_names_and_amounts as $category_name_and_amount) {
                                            $category_name = explode('*', $category_name_and_amount);
                                            if (($category->id == $category_name[0])) {
                                                $amount_per_category[] = $category_name[1] * $category_name[2];
                                                $quantity[] = $category_name[2];
                                            }
                                        }
                                    }
                                    ?>
                                    <td>
                                        <?php
                                        if (!empty($quantity)) {
                                            echo array_sum($quantity);
                                            $quantity[] = array_sum($quantity);
                                        } else {
                                            echo '0';
                                        }

                                        $quantity = NULL;
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $settings->currency; ?> 
                                        <?php
                                        if (!empty($amount_per_category)) {
                                            echo array_sum($amount_per_category);
                                            $total_payment_by_category[] = array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                        <tbody>
                            <tr>
                                <td><h3> <?php echo lang('sub_total'); ?>  </h3></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($total_payment_by_category)) {
                                        echo array_sum($total_payment_by_category);
                                    } else {
                                        echo '0';
                                    }
                                    ?> 
                                </td>
                            </tr>

                            <tr>
                                <td><h5> <?php echo lang('total'); ?>   <?php echo lang('discount'); ?> </h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $discount[] = $payment->flat_discount;
                                        }
                                        if ($paid_number > 0) {
                                            echo array_sum($discount);
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5> <?php echo lang('total'); ?>   <?php echo lang('vat'); ?> </h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $vat[] = $payment->flat_vat;
                                        }
                                        if ($paid_number > 0) {
                                            echo array_sum($vat);
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5><?php echo lang('gross'); ?> <?php echo lang('sales'); ?> </h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        if ($paid_number > 0) {
                                            $gross = array_sum($total_payment_by_category) - array_sum($discount) + array_sum($vat);
                                            echo $gross;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5> <?php echo lang('due_amount'); ?>  </h5></td>
                                <td></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $amount_received[] = $payment->amount_received;
                                        }
                                        if ($paid_number > 0) {
                                            $amount_received = array_sum($amount_received);
                                            echo $gross - $amount_received;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section></section>
                <section class="panel">
                    <header class="panel-heading">
                        <i class="fa fa-money"></i>   <?php echo lang('expense'); ?>   <?php echo lang('report'); ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th><?php echo lang('category'); ?> </th>
                                <th class="hidden-phone"><?php echo lang('amount'); ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expense_categories as $category) { ?>
                                <tr class="">
                                    <td><?php echo $category->category ?></td>
                                    <td>
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        foreach ($expenses as $expense) {
                                            $category_name = $expense->category;


                                            if (($category->category == $category_name)) {
                                                $amount_per_category[] = $expense->amount;
                                            }
                                        }
                                        if (!empty($amount_per_category)) {
                                            $total_expense_by_category[] = array_sum($amount_per_category);
                                            echo array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </section>
            </div>

            <div class="col-lg-5">
                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross'); ?> <?php echo lang('sales'); ?> 
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($payments)) {
                                            if (($paid_number > 0)) {
                                                $gross = $gross;
                                                echo $gross;
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                    <?php echo lang('gross_expense'); ?> 
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($total_expense_by_category)) {
                                            echo array_sum($total_expense_by_category);
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
