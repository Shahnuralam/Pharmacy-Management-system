
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>   <?php  echo lang('today_sales'); ?> 
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a href="finance/addPaymentView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php  echo lang('new_sale'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php  echo lang('print'); ?> </button>     
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('invoice_id'); ?> </th>
                                <th> <?php  echo lang('date'); ?> </th>
                                <th> <?php  echo lang('sub_total'); ?> </th>
                                <th> <?php  echo lang('discount'); ?> </th>
                                <th> <?php  echo lang('grand_total'); ?> </th>
                                <th> <?php  echo lang('amount_received'); ?> </th>
                                <th> <?php  echo lang('due_amount'); ?> </th>
                                <th class="option_th"> <?php  echo lang('options'); ?> </th>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                            .option_th{
                                width:18%;
                            }

                        </style>

                        <?php foreach ($payments as $payment) { ?>
                            <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                            <tr class="">
                                <td><?php echo '00'.$payment->id; ?></td>
                                <td><?php echo date('d/m/y', $payment->date); ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->amount; ?></td>              
                                <td><?php echo $settings->currency; ?> <?php
                                    if (!empty($payment->flat_discount)) {
                                        echo $payment->flat_discount;
                                    } else {
                                        echo '0';
                                    }
                                    ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                <td><?php
                                    echo $payment->amount_received;
                                    ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total - $payment->amount_received; ?></td>
                                <td> 
                                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                                        <a class="btn btn-info btn-xs editbutton width_auto" href="finance/editPayment?id=<?php echo $payment->id; ?>"><i class="fa fa-edit"> </i> <?php  echo lang('edit'); ?></a>
                                    <?php } ?>

                                    <a class="btn btn-xs invoicebutton width_auto" style="color: #fff;" href="finance/invoice?id=<?php echo $payment->id; ?>"><i class="fa fa-file-text"></i>  <?php  echo lang('invoice'); ?></a>
                                    <?php if ($this->ion_auth->in_group('admin')) { ?> 
                                        <a class="btn btn-info btn-xs delete_button width_auto" href="finance/delete?id=<?php echo $payment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  <?php  echo lang('delete'); ?></a>
                                    <?php } ?>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
                                            $(document).ready(function () {
                                                $(".flashmessage").delay(3000).fadeOut(100);
                                            });
</script>