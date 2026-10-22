
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa icon-teacher"></i> <?=$this->lang->line('panel_title')?></h3>


        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("teacher/index")?>"><?=$this->lang->line('menu_teacher')?></a></li>
            <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_teacher')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-10">

                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                    <?php
                        if(form_error('name'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="name_id" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_name")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name_id" name="name" value="<?=set_value('name')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('name'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('designation'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="designation" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_designation")?> 
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="designation" name="designation" value="<?=set_value('designation')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('designation'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('dob'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="dob" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_dob")?> 
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="dob" name="dob" value="<?=set_value('dob')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('dob'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('sex'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="sex" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_sex")?>
                        </label>
                        <div class="col-sm-6">
                            <?php 
                                echo form_dropdown("sex", array($this->lang->line('teacher_sex_male') => $this->lang->line('teacher_sex_male'), $this->lang->line('teacher_sex_female') => $this->lang->line('teacher_sex_female')), set_value("sex"), "id='sex' class='form-control'"); 
                            ?>
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('sex'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('category'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="category" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_category")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="category" name="category" value="<?=set_value('category')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('category'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('cast'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="cast" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_cast")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="cast" name="cast" value="<?=set_value('cast')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('cast'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('religion'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="religion" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_religion")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="religion" name="religion" value="<?=set_value('religion')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('religion'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('aadhar'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="aadhar" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_aadhar")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="aadhar" name="aadhar" value="<?=set_value('aadhar')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('aadhar'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('email'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="email" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_email")?> 
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('email'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('uan'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="uan" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_uan")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="uan" name="uan" value="<?=set_value('uan')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('uan'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('epfo'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="epfo" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_epfo")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="epfo" name="epfo" value="<?=set_value('epfo')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('epfo'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('phone'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="phone" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_phone")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" value="<?=set_value('phone')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('phone'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('education'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="education" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_education")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="education" name="education" value="<?=set_value('education')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('education'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('address'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="address" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_address")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('address'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('pan'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="pan" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_pan")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="pan" name="pan" value="<?=set_value('pan')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('pan'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('jod'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="jod" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_jod")?> 
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="jod" name="jod" value="<?=set_value('jod')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('jod'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('bank_name'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="bank_name" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_bank_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?=set_value('bank_name')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('bank_name'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('branch_name'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="branch_name" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_branch_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="branch_name" name="branch_name" value="<?=set_value('branch_name')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('branch_name'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('account_name'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="account_name" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_account_name")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="account_name" name="account_name" value="<?=set_value('account_name')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('account_name'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('ifsc'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="ifsc" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_ifsc")?>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="ifsc" name="ifsc" value="<?=set_value('ifsc')?>" >
                        </div>
                        <span class="col-sm-4 control-label">
                            <?php echo form_error('ifsc'); ?>
                        </span>
                    </div>
                    <?php
                        if(form_error('photo'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="photo" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_photo")?>
                        </label>
                        <div class="col-sm-6">
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="fa fa-remove"></span>
                                        <?=$this->lang->line('teacher_clear')?>
                                    </button>
                                    <div class="btn btn-success image-preview-input">
                                        <span class="fa fa-repeat"></span>
                                        <span class="image-preview-input-title">
                                        <?=$this->lang->line('teacher_file_browse')?></span>
                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="photo"/>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <span class="col-sm-4">
                            <?php echo form_error('photo'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('username'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="username" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_username")?> 
                        </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username')?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('username'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('password'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="password" class="col-sm-2 control-label">
                            <?=$this->lang->line("teacher_password")?> 
                        </label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password')?>" >
                        </div>
                         <span class="col-sm-4 control-label">
                            <?php echo form_error('password'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-success" value="<?=$this->lang->line("add_teacher")?>" >
                        </div>
                    </div>

                </form>

            </div><!-- /col-sm-8 -->
        </div>
    </div>
</div>

<script type="text/javascript">
$('#username').keyup(function() {
    $(this).val($(this).val().replace(/\s/g, ''));
});

$('#dob').datepicker({ startView: 2 });
$('#jod').datepicker();

$(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
           $('.content').css('padding-bottom', '100px');
        },
         function () {
           $('.image-preview').popover('hide');
           $('.content').css('padding-bottom', '20px');
        }
    );
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("<?=$this->lang->line('teacher_file_browse')?>");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200,
            overflow:'hidden'
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("<?=$this->lang->line('teacher_file_browse')?>");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            $('.content').css('padding-bottom', '100px');
        }
        reader.readAsDataURL(file);
    });
});
</script>
