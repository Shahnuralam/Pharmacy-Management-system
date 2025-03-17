<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($expense->id))
                    echo '<i class="fa fa-edit"></i> '.lang('edit_expense');
                else
                    echo '<i class="fa fa-plus-circle"></i> '.lang('add_expense');
                ?>
            </header>
            <div class="panel">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-6">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="finance/addExpense" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('category'); ?> </label>
                                            <select class="form-control m-bot15" name="category" value=''>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->category; ?>" <?php
                                                    if (!empty($expense->category)) {
                                                        if ($category->category == $expense->category) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $category->category; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('amount'); ?> </label>
                                            <input type="text" class="form-control" name="amount" id="exampleInputEmail1" value='<?php
                                            if (!empty($expense->amount)) {
                                                echo $expense->amount;
                                            }
                                            ?>' placeholder="<?php echo $settings->currency; ?>">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($expense->id)) {
                                            echo $expense->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?> </button>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
