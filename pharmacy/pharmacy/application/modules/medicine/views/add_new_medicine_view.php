<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($medicine->id))
                    echo '<i class="fa fa-edit-circle"></i> ' . lang('edit_medicine');
                else
                    echo ' <i class="fa fa-plus-circle"></i> ' . lang('add_medicine');
                ?>
            </header>
            <div class="">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-6">
                            <section class="panel">
                                     <div class = "panel-body">
                                     <?php echo validation_errors(); ?>
                                <form role="form" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->name)) {
                                            echo $medicine->name;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                                        <select class="form-control m-bot15" name="category" value=''>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->category; ?>" <?php
                                                if (!empty($medicine->category)) {
                                                    if ($category->category == $medicine->category) {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo $category->category; ?> </option>
                                                    <?php } ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->price)) {
                                            echo $medicine->price;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                                        <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->s_price)) {
                                            echo $medicine->s_price;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                                        <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->box)) {
                                            echo $medicine->box;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->quantity)) {
                                            echo $medicine->quantity;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                                        <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->generic)) {
                                            echo $medicine->generic;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                                        <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->company)) {
                                            echo $medicine->company;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->effects)) {
                                            echo $medicine->effects;
                                        }
                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                                        <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='<?php
                                        if (!empty($medicine->e_date)) {
                                            echo $medicine->e_date;
                                        }
                                        ?>' placeholder="">
                                    </div>

                                    <input type="hidden" name="id" value='<?php
                                    if (!empty($medicine->id)) {
                                        echo $medicine->id;
                                    }
                                    ?>'>
                                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                </form>
                        
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
