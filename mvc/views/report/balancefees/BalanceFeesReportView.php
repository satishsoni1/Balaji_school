<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa iniicon-balancefeesreport"></i> <?=$this->lang->line('panel_title')?></h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"> <?=$this->lang->line('menu_balancefeesreport')?></li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">

            <div class="col-sm-12">
                <div class="form-group col-sm-4" id="classesDiv">
                    <label><?=$this->lang->line("balancefeesreport_class")?></label>
                    <?php
                        $classesArray = array(
                            "0" => $this->lang->line("balancefeesreport_please_select"),
                        );
                        foreach ($classes as $classaKey => $classa) {
                            $classesArray[$classa->classesID] = $classa->classes;
                        }
                        echo form_dropdown("classesID", $classesArray, set_value("classesID"), "id='classesID' class='form-control select2'");
                     ?>
                </div>

                <div class="form-group col-sm-4" id="sectionDiv">
                    <label><?=$this->lang->line("balancefeesreport_section")?></label>
                    <?php
                        $sectionArray = array(
                            "0" => $this->lang->line("balancefeesreport_please_select"),
                        );
                        echo form_dropdown("sectionID", $sectionArray, set_value("sectionID"), "id='sectionID' class='form-control select2'");
                     ?>
                </div>

                <div class="form-group col-sm-4" id="studentDiv">
                    <label><?=$this->lang->line("balancefeesreport_student")?></label>
                    <?php
                        $studentArray = array(
                            "0" => $this->lang->line("balancefeesreport_please_select"),
                        );
                        echo form_dropdown("studentID", $studentArray, set_value("studentID"), "id='studentID' class='form-control select2'");
                     ?>
                </div>
                <!-- <div class="form-group col-sm-4" id="feeDiv">
                    <label>Select Fee limit</label>
                    <?php
                        $feeArray = array(
                            "0" => "Select fee limit",
                            "100" => "Less then 1000",
                            "1000"=>"More then 1000",
                            "2000"=>"More then 2000",
                            "3000"=>"More then 3000",
                            "4000"=>"More then 4000",
                            "5000"=>"More then 5000",
                            "6000"=>"More then 6000",
                            "7000"=>"More then 7000",
                            "8000"=>"More then 8000",
                            "9000"=>"More then 9000",
                            "10000"=>"More then 10000",
                            "11000"=>"More then 11000",
                            "12000"=>"More then 12000",
                            "13000"=>"More then 13000",
                            "14000"=>"More then 14000",
                            "15000"=>"More then 15000",
                            "16000"=>"More then 16000",
                            "17000"=>"More then 17000",
                            "18000"=>"More then 18000",
                            "19000"=>"More then 19000",
                            "20000"=>"More then 20000",
                        );
                        echo form_dropdown("feeValue", $feeArray, set_value("feeValue"), "id='feeValue' class='form-control select2'");
                     ?>
                </div> -->

                <div class="form-group col-sm-4" id="minfeeDiv">
                    <label>Min Balance Fee</label>
                    <input type="text" id="minfeeValue" value='<?= set_value("feeValue",0) ?>' class="form-control"/>
                </div>
                <div class="form-group col-sm-4" id="maxfeeDiv">
                    <label>Upto Balance Fee</label>
                    <input type="text" id="maxfeeValue" value='<?= set_value("feeValue",50000) ?>' class="form-control"/>
                </div>
                <div class="col-sm-4">
                    <button id="get_duefeesreport" class="btn btn-success" style="margin-top:23px;"> <?=$this->lang->line("balancefeesreport_submit")?></button>
                </div>

            </div>

        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<div id="load_balancefeesreport"></div>


<script type="text/javascript">

    function printDiv(divID) {
        var oldPage = document.body.innerHTML;
        $('#headerImage').remove();
        $('.footerAll').remove();
        var divElements = document.getElementById(divID).innerHTML;
        var footer = "<center><img src='<?=base_url('uploads/images/'.$siteinfos->photo)?>' style='width:30px;' /></center>";
        var copyright = "<center><?=$siteinfos->footer?> | <?=$this->lang->line('balancefeesreport_hotline')?> : <?=$siteinfos->phone?></center>";
        document.body.innerHTML =
          "<html><head><title></title></head><body>" +
          "<center><img src='<?=base_url('uploads/images/'.$siteinfos->photo)?>' style='width:50px;' /></center>"
          + divElements + footer + copyright + "</body>";

        window.print();
        document.body.innerHTML = oldPage;
        window.location.reload();
    }

    $('.select2').select2();
    $(function(){
        $('#sectionDiv').hide('slow');
        $('#studentDiv').hide('slow');
    });

    $(document).on('change', "#classesID", function() {
        $('#load_balancefeesreport').html("");
        var classesID = $(this).val();
        
        $('#sectionID').val(0);
        $('#studentID').html("<option value='0'>" + "<?=$this->lang->line("balancefeesreport_please_select")?>" +"</option>");
        $('#studentID').val(0);
        
        if(classesID == '0'){
            $("#sectionDiv").hide('slow');
            $("#studentDiv").hide('slow');
        } else {
            $("#sectionDiv").show('slow');
            $("#studentDiv").show('slow');
        }

        if(classesID !=0) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('balancefeesreport/getSection')?>",
                data: {"classesID" : classesID},
                dataType: "html",
                success: function(data) {
                   $('#sectionID').html(data);
                }
            });
        }
    });

    $(document).on('change', "#sectionID", function() {
        $('#load_balancefeesreport').html("");
        var sectionID = $(this).val();
        
        $('#studentID').html("<option value='0'>" + "<?=$this->lang->line("balancefeesreport_please_select")?>" +"</option>");
        $('#studentID').val(0);

        var classesID = $('#classesID').val();
        if(sectionID != 0 && classesID != 0) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('balancefeesreport/getStudent')?>",
                data: {"classesID":classesID, "sectionID" : sectionID},
                dataType: "html",
                success: function(data) {
                   $('#studentID').html(data);
                }
            });
        }
    });

    $(document).on('click','#get_duefeesreport', function() {
        $('#load_balancefeesreport').html("");
        var classesID = $('#classesID').val();
        var sectionID = $('#sectionID').val();
        var studentID = $('#studentID').val();
        var minfeeValue = $('#minfeeValue').val();
        var maxfeeValue = $('#maxfeeValue').val();
        
        var error = 0;

        var field = {
            "classesID" : classesID,
            "sectionID" : sectionID,
            "studentID" : studentID,
            "minfeeValue" : minfeeValue,
            "maxfeeValue" : maxfeeValue,
            
        };

        if(error == 0 ) {
            makingPostDataPreviousofAjaxCall(field);
        }
    });

    function makingPostDataPreviousofAjaxCall(field) {
        passData = field;
        ajaxCall(passData);
    }

    function ajaxCall(passData) {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('balancefeesreport/getBalanceFeesReport')?>",
            data: passData,
            dataType: "html",
            success: function(data) {
                var response = JSON.parse(data);
                renderLoder(response, passData);
            }
        });
    }

    function renderLoder(response, passData) {
        if(response.status) {
            $('#load_balancefeesreport').html(response.render);
            for (var key in passData) {
                if (passData.hasOwnProperty(key)) {
                    $('#'+key).parent().removeClass('has-error');
                }
            }
        } else {
            for (var key in passData) {
                if (passData.hasOwnProperty(key)) {
                    $('#'+key).parent().removeClass('has-error');
                }
            }

            for (var key in response) {
                if (response.hasOwnProperty(key)) {
                    $('#'+key).parent().addClass('has-error');
                }
            }
        }
    }
</script>


