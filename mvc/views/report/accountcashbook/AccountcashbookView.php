<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa iniicon-accountcashbook"></i> Cash Book</h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"> Cash Book</li>
        </ol>
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group col-sm-4" id="schoolyearIDDiv">
                    <label><?=$this->lang->line("accountcashbook_academicyear")?></label>
                    <?php
                        $array = [];
                        if(customCompute($schoolyears)) {
                            foreach ($schoolyears as $schoolyear) {
                                $array[$schoolyear->schoolyearID] = $schoolyear->schoolyear;
                            }
                        }
                        echo form_dropdown("schoolyearID", $array , set_value("schoolyearID"), "id='schoolyearID' class='form-control select2'");
                     ?>
                </div>
            </div>
            <div class="col-sm-6">
                 <div class="col-sm-12">
                    <button id="get_accountcashbook" class="btn btn-success"> Cashbook Report</button>
                    <a href="<?= base_url('accountcashbook/incomeadd') ?>" class="btn btn-success"> Add Income/Receipt</a>
                    <a href="<?= base_url('accountcashbook/expenseadd') ?>" class="btn btn-success"> Add Expense</a>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- Body -->
</div><!-- /.box -->

<div id="load_accountcashbook"></div>

<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js">
</script>
<script type="text/javascript">
   

    $('.select2').select2();
     $(document).ready(function(){
                $(document).on('click','#dwnldBtn',function () {
        var msg = GetMimeTypes();
        //MS-Excel
        window.open('data:application/vnd.ms-excel,' + $('#accountledgerreport').html());
        e.preventDefault();
    });
});

function GetMimeTypes () {
    var message = "";
        // Internet Explorer supports the mimeTypes collection, but it is always empty
    if (navigator.mimeTypes && navigator.mimeTypes.length > 0) {
        var mimes = navigator.mimeTypes;
        for (var i=0; i < mimes.length; i++) {
            message += "<b>" + mimes[i].type + "</b> : " + mimes[i].description + "<br />";
        }
    }
    else {
        message = "Your browser does not support this ";
       //sorry!
    }

    return ( message);
}
    $(document).on('change',"#schoolyearID", function(event) {
        event.preventDefault();
        $('#load_accountcashbook').html('');
    });



    $(document).on('click','#get_accountcashbook', function() {
        $('#load_accountcashbook').html('');
        var passData;
        var error = 0;
        var field = {
            'schoolyearID': $("#schoolyearID").val(),
        };

        if(error == 0) {
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
            url: "<?=base_url('accountcashbook/getaccountcashbook')?>",
            data: passData,
            dataType: "html",
            success: function(data) {
                var response = JSON.parse(data);
                renderLoder(response, passData);
            }
        });
    }

    $(document).on('click','#get_accountledger', function() {
        $('#load_accountcashbook').html('');
        var passData;
        var error = 0;
        var field = {
            'schoolyearID': $("#schoolyearID").val(),
        };

        if(error == 0) {
            makingPostDataPreviousofAjaxCall1(field);
        }
    });
    function makingPostDataPreviousofAjaxCall1(field) {
        passData = field;
        ajaxCall1(passData);
    }

    function ajaxCall1(passData) {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('accountcashbook/getaccountledger')?>",
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
            $('#load_accountcashbook').html(response.render);
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


