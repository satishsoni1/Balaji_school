
<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-beer"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li><a href="<?=base_url("manage_salary/index/$usertypeID")?>"><?=$this->lang->line('menu_manage_salary')?></a></li>
            <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_manage_salary')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
    <form class="form-horizontal" role="form" method="post" id="templateDataForm">
            <div class="row">
                <div class="col-sm-12" style="margin-bottom: 10px;">
                    

                    <?php
                        if(form_error('basic_salary'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="basic_salary" class="col-sm-2 control-label">
                            <?=$this->lang->line("salary_template_basic_salary")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="basic_salary" name="basic_salary" value="<?=set_value('basic_salary', $salary_template->basic_salary)?>">
                        </div>
                        <span class="col-sm-4 control-label" id="basic_salary_error">
                            <?php echo form_error('basic_salary'); ?>
                        </span>
                    </div>

                    <?php
                        if(form_error('EPFO'))
                            echo "<div class='form-group has-error' >";
                        else
                            echo "<div class='form-group' >";
                    ?>
                        <label for="EPFO" class="col-sm-2 control-label">
                            <?=$this->lang->line("salary_template_EPFO")?> <span class="text-red">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" id="EPFO" name="EPFO" value="<?=set_value('EPFO', $salary_template->EPFO)?>" >
                        </div>
                        <span class="col-sm-4 control-label" id="EPFO_error">
                            <?php echo form_error('EPFO'); ?>
                        </span>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="box" style="border: 1px solid #eee">
                        <div class="box-header" style="background-color: #fff;border-bottom: 1px solid #eee;color: #000;">
                            <h3 class="box-title" style="color: #1a2229"><?=$this->lang->line('salary_template_allowances')?></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12" id="allowances">
                                    
                                    <?php
                                        $i = 1;
                                        if(customCompute($grosssalarylist)) {
                                            $grosssalarylistcount = customCompute($grosssalarylist);
                                            foreach ($grosssalarylist as $grosssalarylistKey => $grosssalarylistValue) {
                                    ?>
                                                <div class='form-group allowancesfield'>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" id="<?php echo 'allowanceslabel'.$i; ?>" name="<?='allowanceslabel'.$i?>" value="<?=$grosssalarylistKey?>" placeholder="<?=$this->lang->line("salary_template_allowances_label")?>">
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control allowancesamount" id="<?='allowancesamount'.$i?>" name="<?='allowancesamount'.$i?>" value="<?=$grosssalarylistValue?>" placeholder="<?=$this->lang->line("salary_template_allowances_value")?>">
                                                    </div>

                                                    <div class="col-sm-2" >
                                                        <?php if($grosssalarylistcount == 1) { ?>
                                                            <button type="button" class="btn btn-success btn-xs salary-btn salary-btn-allowances-add" id="salary-btn-allowances-add" onclick="addAllowances()">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        <?php } elseif($grosssalarylistcount == $i && $grosssalarylistcount != 1) { ?>
                                                            <button id="<?=$i?>" class="btn btn-danger btn-xs salary-btn salary-btn-allowances-remove" type="button" onclick="removeAllowances(this)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-success btn-xs salary-btn salary-btn-allowances-add" id="salary-btn-allowances-add" onclick="addAllowances()">
                                                                <i class="fa fa-plus"></i>
                                                            </button>

                                                        <?php } else { ?>
                                                            <button id="<?=$i?>" class="btn btn-danger btn-xs salary-btn salary-btn-allowances-remove" type="button" onclick="removeAllowances(this)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        <?php } ?>


                                                    </div>

                                                    <span class="col-sm-12 errorpointallowances" id="<?='allowanceserror'.$i?>">
                                                        <?php echo form_error('amount'.$i); ?>
                                                    </span>
                                                </div>
                                    <?php 
                                                $i++;                                       
                                            }                                                
                                        } else {
                                    ?>
                                        <div class='form-group allowancesfield'>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="allowanceslabel1" name="allowanceslabel1" value="House Rent" placeholder="<?=$this->lang->line("salary_template_allowances_label")?>">
                                            </div>

                                            <div class="col-sm-5">
                                                <input type="text" class="form-control allowancesamount" id="allowancesamount1" name="allowancesamount1" value="" placeholder="<?=$this->lang->line("salary_template_allowances_value")?>">
                                            </div>

                                            <div class="col-sm-2" >
                                                <button type="button" class="btn btn-success btn-xs salary-btn salary-btn-allowances-add" id="salary-btn-allowances-add" onclick="addAllowances()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>

                                            <span class="col-sm-12 errorpointallowances" id="allowanceserror1">
                                                <?php echo form_error('amount1'); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="box" style="border: 1px solid #eee;">
                        <div class="box-header" style="background-color: #fff;border-bottom: 1px solid #eee;color: #000;">
                            <h3 class="box-title" style="color: #1a2229"><?=$this->lang->line('salary_template_deductions')?></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12" id="deductions">

                                    <?php
                                        $j = 1;
                                        if(customCompute($totaldeductionlist)) {
                                            $totaldeductionlistcount = customCompute($totaldeductionlist);
                                            foreach ($totaldeductionlist as $totaldeductionlistKey => $totaldeductionlistValue) {
                                    ?>

                                                <div class='form-group deductionsfield'>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" id="<?='deductionslabel'.$j?>" name="<?='deductionslabel'.$j?>" value="<?=$totaldeductionlistKey?>" placeholder="<?=$this->lang->line("salary_template_deductions_label")?>">
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control deductionsamount" id="<?='deductionsamount'.$j?>" name="<?='deductionsamount'.$j?>" value="<?=$totaldeductionlistValue?>" placeholder="<?=$this->lang->line("salary_template_deductions_value")?>">
                                                    </div>

                                                    <div class="col-sm-2" >

                                                        <?php if($totaldeductionlistcount == 1) { ?>
                                                            <button type="button" class="btn btn-success btn-xs salary-btn salary-btn-deductions-add" id="salary-btn-deductions-add" onclick="addDeductions()">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        <?php } elseif($totaldeductionlistcount == $j && $totaldeductionlistcount != 1) { ?>
                                                            <button id="<?=$j?>" type="button" class="btn btn-danger btn-xs salary-btn salary-btn-deductions-remove" onclick="removeDeductions(this)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-success btn-xs salary-btn salary-btn-deductions-add" id="salary-btn-deductions-add" onclick="addDeductions()">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        <?php } else { ?>
                                                            <button id="<?=$j?>" type="button" class="btn btn-danger btn-xs salary-btn salary-btn-deductions-remove" onclick="removeDeductions(this)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        <?php } ?>

                                                    </div>

                                                    <span class="col-sm-12 errorpointdeductions" id="<?='deductionserror'.$j?>">
                                                        <?php echo form_error('amount'.$j); ?>
                                                    </span>
                                                </div>

                                    <?php 
                                                $j++;                                       
                                            }                                                
                                        } else {
                                    ?>
                                        <div class='form-group deductionsfield'>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="deductionslabel1" name="deductionslabel1" value="Provident Fund" placeholder="<?=$this->lang->line("salary_template_deductions_label")?>">
                                            </div>

                                            <div class="col-sm-5">
                                                <input type="text" class="form-control deductionsamount" id="deductionsamount1" name="deductionsamount1" value="" placeholder="<?=$this->lang->line("salary_template_deductions_value")?>">
                                            </div>

                                            <div class="col-sm-2" >
                                                <button type="button" class="btn btn-success btn-xs salary-btn salary-btn-deductions-add" id="salary-btn-deductions-add" onclick="addDeductions()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>

                                            <span class="col-sm-12 errorpointdeductions" id="deductionserror1">
                                                <?php echo form_error('amount1'); ?>
                                            </span>
                                        </div>
                                    <?php } ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8 col-sm-offset-4">
                    <div class="box" style="border: 1px solid #eee;">
                        <div class="box-header" style="background-color: #fff;border-bottom: 1px solid #eee;color: #000;">
                            <h3 class="box-title" style="color: #1a2229"><?=$this->lang->line('salary_template_total_salary_details')?></h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="col-sm-8" style="line-height: 36px"><?=$this->lang->line('salary_template_gross_salary')?></td>

                                            <td class="col-sm-4"><input class="form-control" id="gross_salary" type="text" value="<?=$grosssalary?>" disabled="disabled" name="gross_salary"></td>
                                        </tr>

                                        <tr>
                                            <td class="col-sm-8" style="line-height: 36px"><?=$this->lang->line('salary_template_total_deduction')?></td>

                                            <td class="col-sm-4"><input class="form-control" id="total_deduction" type="text" value="<?=$totaldeduction?>" disabled="disabled" name="total_deduction"></td>
                                        </tr>

                                        <tr>
                                            <td class="col-sm-8" style="line-height: 36px"><?=$this->lang->line('salary_template_net_salary')?></td>

                                            <td class="col-sm-4"><input class="form-control" id="net_salary" type="text" value="<?=$netsalary?>" disabled="disabled" name="net_salary"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <input class="btn btn-success pull-right col-sm-3 col-xs-12 " type="button" id="addSalaryTemplate" value="<?=$this->lang->line('update_salary_template')?>">
                </div>

            </div>
        </form>
       
    </div>
</div>
<script type="text/javascript">

$('#basic_salary').keyup(function(){
    var val = $(this).val();
    $('#EPFO').val(parseInt(val)*0.12)
})

function zeroOrNull(value, error, status=true) {
        if(value != '') {
            if($.isNumeric(value)) {
                $(error).html('');
                $(error).parent().removeClass('has-error');

                if(value >= 0) {
                    $(error).html('');
                    $(error).parent().removeClass('has-error');
                    return true;
                } else {
                    if(status) {
                        $(error).html('The Basic Salary field is not negative number.');
                        $(error).parent().addClass('has-error');
                    }
                }
            } else {
                if(status) {
                    $(error).html('The Basic Salary field is only number.');
                    $(error).parent().addClass('has-error');
                }
            }
        } else {
            $(error).html('');
            $(error).parent().removeClass('has-error');
        }
    }

    function zeroOrNullExtend(value, errorID, errorField='field', status=true) {
        if(value != '') {
            if($.isNumeric(value)) {
                $(errorID).html('');
                $(errorID).parent().removeClass('has-error');

                if(value >= 0) {
                    $(errorID).html('');
                    $(errorID).parent().removeClass('has-error');
                    return true;
                } else {
                    if(status) {
                        $(errorID).html('The '+errorField+' field is not negative number.');
                        $(errorID).parent().addClass('has-error');
                        $(errorID).addClass('text-red');
                    }
                }
            } else {
                if(status) {
                    $(errorID).html('The '+errorField+' field is only number.');
                    $(errorID).parent().addClass('has-error');
                    $(errorID).addClass('text-red');
                }
            }
        } else {
            $(errorID).html('');
            $(errorID).parent().removeClass('has-error');
        }
    }

    jQuery(document).ready(function(){
        jQuery("#basic_salary").focus(function(){   
            var basic_salary = $(this).val();
            
            if($.isNumeric(basic_salary)) {
                if(basic_salary >= 0) {
                    if(basic_salary == '') {
                        var basic_salary = 0;
                    } else {
                        if(basic_salary.length > 11) {
                            var basic_salary = parseFloat(0);
                        } else {
                            var basic_salary = parseFloat($(this).val());
                        }
                    }

                    var epfo = $('#EPFO').val();
                    if(epfo == '') {
                        var epfo = 0;
                    } else {
                        var epfo = parseFloat($('#EPFO').val());
                    }
                    var net_salary = $('#net_salary').val();
                    if(net_salary == '') {
                        var net_salary = 0;
                    } else {
                        var net_salary = parseFloat($('#net_salary').val());
                    }

                    var gross_salary = $('#gross_salary').val();
                    if(gross_salary == '') {
                        var gross_salary = 0;
                    } else {
                        var gross_salary = parseFloat($('#gross_salary').val());
                    }

                    equ = net_salary - basic_salary - epfo;
                    $('#net_salary').val(parseFloat(equ));

                    gross_salary_equ = gross_salary - basic_salary - epfo;
                    $('#gross_salary').val(parseFloat(gross_salary_equ));
                }
            }   
        })
        .blur(function(){   
            var basic_salary = $(this).val();
            if(zeroOrNull(basic_salary, '#basic_salary_error')) {
                var net_salary = $('#net_salary').val();
                var epfo = $('#EPFO').val();
                var gross_salary = $('#gross_salary').val();
                
                if(basic_salary == '') {
                    var basic_salary = 0;
                } else {
                    if(basic_salary.length > 11) {
                        var basic_salary = '';
                        $(this).val('');
                    } else {
                        var basic_salary = parseFloat($(this).val());
                    }
                }

                if(epfo == '') {
                    var epfo = 0;
                } else {
                    var epfo = parseFloat($('#EPFO').val());
                }

                if(net_salary == '') {
                    var net_salary = 0;
                } else {
                    var net_salary = parseFloat($('#net_salary').val());
                }

                if(gross_salary == '') {
                    var gross_salary = 0;
                } else {
                    var gross_salary = parseFloat($('#gross_salary').val());
                }

                equ = net_salary + basic_salary - epfo;
                $('#net_salary').val(parseFloat(equ));

                gross_salary_equ = gross_salary + basic_salary - epfo;
                $('#gross_salary').val(parseFloat(gross_salary_equ));
            }
        });


        jQuery("#EPFO").blur(function(){   
            var EPFO = $(this).val(); 
            if(EPFO.length > 11) {
                $(this).val('');
            } else {
                zeroOrNull(EPFO, '#EPFO_error');
            } 
        }); 

        jQuery("#basic_salary").blur(function(){   
            var basic_salary = $(this).val();
            if(basic_salary !='') {
                $('#basic_salary_error').html('');
                $('#basic_salary_error').parent().removeClass('has-error');
            } 
        }); 
    });

    $(document).on('focus', '.allowancesamount', function () {
        var allowancesamount = $(this).val();

        var errorID = $(this).parent().parent().children('.errorpointallowances').attr('id');

        if(zeroOrNullExtend(allowancesamount, errorID, 'label', false)) {
            if(allowancesamount == '') {
                var allowancesamount = 0;
            } else {
                if(allowancesamount.length > 11) {
                    var allowancesamount = '';
                    $(this).val('');
                } else {
                    var allowancesamount = parseFloat($(this).val());
                }
            }

            var net_salary = $('#net_salary').val();
            if(net_salary == '') {
                var net_salary = 0;
            } else {
                var net_salary = parseFloat($('#net_salary').val());
            }

            var gross_salary = $('#gross_salary').val();

            if(gross_salary == '') {
                var gross_salary = 0;
            } else {
                var gross_salary = parseFloat($('#gross_salary').val());
            }

            var equ = net_salary - allowancesamount;
            $('#net_salary').val(equ);

            var equfg = gross_salary - allowancesamount;
            $('#gross_salary').val(equfg);
        }
    });

    $(document).on('blur', '.allowancesamount', function () {
        var allowancesamount = $(this).val();

        var errorID = $(this).parent().parent().children('.errorpointallowances').attr('id');
        var errorID = '#'+errorID;

        if(zeroOrNullExtend(allowancesamount, errorID, "<?=$this->lang->line('salary_template_allowances_val')?>")) {

            if(allowancesamount == '') {
                var allowancesamount = 0;
            } else {
                if(allowancesamount.length > 11) {
                    var allowancesamount = '';
                    $(this).val('');
                } else {
                    var allowancesamount = parseFloat($(this).val());
                }
            }

            var net_salary = $('#net_salary').val();
            if(net_salary == '') {
                var net_salary = 0;
            } else {
                var net_salary = parseFloat($('#net_salary').val());
            }

            var gross_salary = $('#gross_salary').val();

            if(gross_salary == '') {
                var gross_salary = 0;
            } else {
                var gross_salary = parseFloat($('#gross_salary').val());
            }

            var equ = net_salary + allowancesamount;
            $('#net_salary').val(equ);

            var equfg = gross_salary + allowancesamount;
            $('#gross_salary').val(equfg);
        }
    });


    $(document).on('focus', '.deductionsamount', function () {
        var deductionsamount = $(this).val();

        var errorID = $(this).parent().parent().children('.errorpointallowances').attr('id');

        if(zeroOrNullExtend(deductionsamount, errorID, 'label', false)) {
            if(deductionsamount == '') {
                var deductionsamount = 0;
            } else {
                if(deductionsamount.length > 11) {
                    var deductionsamount = '';
                    $(this).val('');
                } else {
                    var deductionsamount = parseFloat($(this).val());
                }
            }

            var net_salary = $('#net_salary').val();
            if(net_salary == '') {
                var net_salary = 0;
            } else {
                var net_salary = parseFloat($('#net_salary').val());
            }

            var total_deduction = $('#total_deduction').val();

            if(total_deduction == '') {
                var total_deduction = 0;
            } else {
                var total_deduction = parseFloat($('#total_deduction').val());
            }

            var equ = net_salary + deductionsamount;
            $('#net_salary').val(equ);

            var equfg = total_deduction - deductionsamount;
            $('#total_deduction').val(equfg);
        }

    });

    $(document).on('blur', '.deductionsamount', function () {
        var deductionsamount = $(this).val();

        var errorID = $(this).parent().parent().children('.errorpointdeductions').attr('id');
        var errorID = '#'+errorID;

        if(zeroOrNullExtend(deductionsamount, errorID, "<?=$this->lang->line('salary_template_deductions_val')?>")) {

            if(deductionsamount == '') {
                var deductionsamount = 0;
            } else {
                if(deductionsamount.length > 11) {
                    var deductionsamount = '';
                    $(this).val('');
                } else {
                    var deductionsamount = parseFloat($(this).val());
                }
            }

            var net_salary = $('#net_salary').val();
            if(net_salary == '') {
                var net_salary = 0;
            } else {
                var net_salary = parseFloat($('#net_salary').val());
            }

            var total_deduction = $('#total_deduction').val();

            if(total_deduction == '') {
                var total_deduction = 0;
            } else {
                var total_deduction = parseFloat($('#total_deduction').val());
            }

            var equ = net_salary - deductionsamount;
            $('#net_salary').val(equ);

            var equfg = total_deduction + deductionsamount;
            $('#total_deduction').val(equfg);
        }

    });

    function removeAllowances(clickedElement) {
        var id = clickedElement.id;

        var label = [];
        var amount = [];
        var count = $(".allowancesfield").size();
        var removeAmount = 0;

        var totalOption= count-1;

        for(k=1; k<=count; k++) {
            if(k == id) {
                removeAmount = $('#allowancesamount'+k).val();
            }
        }

        for(j=1; j<=totalOption; j++) {

            if(j >= id) {
                var point = j + 1;
                label[j]    = $('#allowanceslabel'+point).val();
                amount[j]   = $('#allowancesamount'+point).val();
            } else {
                label[j]    = $('#allowanceslabel'+j).val();
                amount[j]   = $('#allowancesamount'+j).val();
            }
        }

        var type = 'allowances';       
        $('#allowances').children().remove();
        for(i=1; i<=totalOption; i++) {
            if(i != totalOption) {
                $('#allowances').append(formHtmlData(type, i, label[i], amount[i], add='', remove=1));
            } else if(i == 1) {
                $('#allowances').append(formHtmlData(type, i, label[i], amount[i], add=1, remove=''));
            } else {
                $('#allowances').append(formHtmlData(type, i, label[i], amount[i], add=1, remove=1));
            }
        }


        var net_salary = $('#net_salary').val();
        if(net_salary == '') {
            var net_salary = 0;
        } else {
            var net_salary = parseFloat($('#net_salary').val());
        }

        var gross_salary = $('#gross_salary').val();
        if(gross_salary == '') {
            var gross_salary = 0;
        } else {
            var gross_salary = parseFloat($('#gross_salary').val());
        }

        if(removeAmount == '' || removeAmount == 0) {
            var removeAmount = 0;
        } else {
            var removeAmount = parseFloat(removeAmount);
        }

        var equ = net_salary - removeAmount;
        $('#net_salary').val(equ);

        var equfg = gross_salary - removeAmount;
        $('#gross_salary').val(equfg);
    }

    function removeDeductions(clickedElement) {
        var id = clickedElement.id;

        var label = [];
        var amount = [];
        var count = $(".deductionsfield").size();
        var removeAmount = 0;
        var totalOption= count-1;

        for(k=1; k<=count; k++) {
            if(k == id) {
                removeAmount = $('#deductionsamount'+k).val();
            }
        }

        for(j=1; j<=totalOption; j++) {
            if(j >= id) {
                var point = j + 1;
                label[j]    = $('#deductionslabel'+point).val();
                amount[j]   = $('#deductionsamount'+point).val();
            } else {
                label[j]    = $('#deductionslabel'+j).val();
                amount[j]   = $('#deductionsamount'+j).val();
            }
        }

        var type = 'deductions';       
        $('#deductions').children().remove();
        for(i=1; i<=totalOption; i++) {
            if(i != totalOption) {
                $('#deductions').append(formHtmlData(type, i, label[i], amount[i], add='', remove=1));
            } else if(i == 1) {
                $('#deductions').append(formHtmlData(type, i, label[i], amount[i], add=1, remove=''));
            } else {
                $('#deductions').append(formHtmlData(type, i, label[i], amount[i], add=1, remove=1));
            }
        }

        var net_salary = $('#net_salary').val();
        if(net_salary == '') {
            var net_salary = 0;
        } else {
            var net_salary = parseFloat($('#net_salary').val());
        }

        var total_deduction = $('#total_deduction').val();
        if(total_deduction == '') {
            var total_deduction = 0;
        } else {
            var total_deduction = parseFloat($('#total_deduction').val());
        }

        if(removeAmount == '' || removeAmount == 0) {
            var removeAmount = 0;
        } else {
            var removeAmount = parseFloat(removeAmount);
        }

        var equ = net_salary + removeAmount;

        $('#net_salary').val(equ);

        var equfg = total_deduction - removeAmount;
        $('#total_deduction').val(equfg);
    }

    function addAllowances() {
        var label = [];
        var amount = [];
        var count = $(".allowancesfield").size();

        for(j=1; j<=count; j++) {
            label[j]    = $('#allowanceslabel'+j).val();
            amount[j]   = $('#allowancesamount'+j).val();
        }

        var totalOption= count+1;
        
        var type = 'allowances';       
        $('#allowances').children().remove();
        for(i=1; i<=totalOption; i++) {
            if(i <= count) {
                $('#allowances').append(formHtmlData(type, i, label[i], amount[i], add='', remove=1));
            }
            else {
                $('#allowances').append(formHtmlData(type, i, label="", amount="", add=1, remove=1));
            }
        }
    }


    function addDeductions() {
        var label = [];
        var amount = [];
        var count = $(".deductionsfield").size();

        for(j=1; j<=count; j++) {
            label[j]    = $('#deductionslabel'+j).val();
            amount[j]   = $('#deductionsamount'+j).val();
        }

        var totalOption= count+1;
        
        var type = 'deductions';       
        $('#deductions').children().remove();
        for(i=1; i<=totalOption; i++) {
            if(i <= count) {
                $('#deductions').append(formHtmlData(type, i, label[i], amount[i], add='', remove=1));
            }
            else {
                $('#deductions').append(formHtmlData(type, i, label="", amount="", add=1, remove=1));
            }
        }
    }


    function formHtmlData(type, id, label, amount, add, remove) {
        if(type == 'allowances') {
            var langLabel = "<?=$this->lang->line('salary_template_allowances_label')?>";
            var langValue = "<?=$this->lang->line('salary_template_allowances_value')?>"; 
        } else {
            var langLabel = "<?=$this->lang->line('salary_template_deductions_label')?>";
            var langValue = "<?=$this->lang->line('salary_template_deductions_value')?>";
        }
        
        var button = '';
        if(add == 1 && remove == 1) {
            var button = '<button type="button" class="btn btn-danger btn-xs salary-btn salary-btn-'+type+'-remove" id="'+id+'" onclick="remove'+capitalize(type)+'(this)"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-success btn-xs salary-btn salary-btn-'+type+'-add" id="salary-btn-'+type+'-add" onclick="add'+capitalize(type)+'()"><i class="fa fa-plus"></i></button>';
        } else if(remove == 1) {
            var button = '<button type="button" class="btn btn-danger btn-xs salary-btn salary-btn-'+type+'-remove" id="'+id+'" onclick="remove'+capitalize(type)+'(this)"><i class="fa fa-trash"></i></button>';
        } else if(add == 1) {
            var button = '<button type="button" class="btn btn-success btn-xs salary-btn salary-btn-'+type+'-add" id="salary-btn-'+type+'-add" onclick="add'+capitalize(type)+'()"><i class="fa fa-plus"></i></button>';
        }

        var html = '<div class="form-group '+type+'field" ><div class="col-sm-5"><input type="text" class="form-control" id="'+type+'label'+id+'" name="'+type+'label'+id+'" value="'+label+'" placeholder="'+langLabel+'"></div><div class="col-sm-5"><input type="text" class="form-control '+type+'amount" id="'+type+'amount'+id+'" name="'+type+'amount'+id+'" value="'+amount+'" placeholder="'+langValue+'"></div><div class="col-sm-2" >'+button+'</div><span class="col-sm-12 errorpoint'+type+'" id="'+type+'error'+id+'"><?php echo form_error('amount1'); ?></span></div>';

        return html;
    }

    function capitalize(s){
        return s.toLowerCase().replace( /\b./g, function(a){ return a.toUpperCase(); } );
    };


    $('#addSalaryTemplate').click(function() {
        
        var basic_salary        = $('#basic_salary').val();
        var EPFO       = $('#EPFO').val();
        var error               = 0;
        var allowances_number   = $(".allowancesfield").size();
        var deductions_number   = $(".deductionsfield").size();

        for (i = 1;  i <= allowances_number; i++) {
            if($('#allowancesamount'+i).val() != '') {
                if($.isNumeric($('#allowancesamount'+i).val())) {
                    $('#allowanceserror'+i).html('');
                    $('#allowanceserror'+i).parent().removeClass('has-error');
                } else {
                    error++;
                    $('#allowanceserror'+i).html("The <?=$this->lang->line('salary_template_allowances_val')?> field is only number.");
                    $('#allowanceserror'+i).parent().addClass('has-error');
                    $('#allowanceserror'+i).addClass('text-red');
                }
            }
        }

        for (j = 1;  j <= deductions_number; j++) {
            if($('#deductionsamount'+j).val() != '') {
                if($.isNumeric($('#deductionsamount'+j).val())) {
                    $('#deductionserror'+j).html('');
                    $('#deductionserror'+j).parent().removeClass('has-error');
                } else {
                    error++;
                    $('#deductionserror'+j).html("The <?=$this->lang->line('salary_template_deductions_val')?> field is only number.");
                    $('#deductionserror'+j).parent().addClass('has-error');
                    $('#deductionserror'+j).addClass('text-red');
                }
            }
        }

        

        if(basic_salary == '') {
            $('#basic_salary_error').html('The Basic Salary field is required.');
            $('#basic_salary_error').parent().addClass('has-error');
            error++;
        } else {
            if($.isNumeric(basic_salary)) {
                if(basic_salary.length > 11) {
                    error++;
                    $('#basic_salary_error').html('The Basic Salary field cannot exceed 11 characters in length.');
                    $('#basic_salary_error').parent().addClass('has-error');
                } else {
                    $('#basic_salary_error').html('');
                    $('#basic_salary_error').parent().removeClass('has-error');
                }
            } else {
                error++;
                $('#basic_salary_error').html('The Basic Salary field is only number.');
                $('#basic_salary_error').parent().addClass('has-error');
            }
        }


        if(EPFO == '') {
            $('#EPFO_error').html('The EPFO field is required.');
            $('#EPFO_error').parent().addClass('has-error');
            error++;
        } else {
            if($.isNumeric(EPFO)) {
                if(EPFO.length > 11) {
                    error++;
                    $('#EPFO_error').html('The EPFO field cannot exceed 11 characters in length.');
                    $('#EPFO_error').parent().addClass('has-error');
                } else {
                    $('#EPFO_error').html('');
                    $('#EPFO_error').parent().removeClass('has-error');
                }
            } else {
                error++;
                $('#EPFO_error').html('The EPFO field is only number.');
                $('#EPFO_error').parent().addClass('has-error');
            }
        }


        if(error == 0) {
            var formData = new FormData($('#templateDataForm')[0]);
            formData.append("allowances_number", allowances_number);
            formData.append("deductions_number", deductions_number);
            formData.append("id", "<?=$setid?>");
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "<?=base_url('manage_salary/edit/'.$userID.'/'.$usertypeID)?>",
                data: formData,
                async: false,
                dataType: "html",
                success: function(data) { 
                    var response = jQuery.parseJSON(data);
                    if(response.status == 'success') {
                        window.location = "<?=base_url("manage_salary/index")?>";
                    } else {
                        if(response.errors['basic_salary']) {
                            $('#basic_salary_error').html(response.errors['basic_salary']);
                            $('#basic_salary_error').parent().addClass('has-error');
                        }
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
        
    });

</script>
