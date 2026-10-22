<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fa iniicon-accountcashbook"></i> Ledger Book</h3>
        <ol class="breadcrumb">
            <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
            <li class="active"> Ledger Book</li>
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
                <div class="form-group col-sm-4" id="accountIDDiv">
                    <label>Account</label>
                    <?php
                        $array = [];
                        
                        if(customCompute($accounts)) {
                            foreach ($accounts as $account) {
                                $array[$account->bankaccountID] = $account->bankaccountbankname;
                            }
                        }
                        echo form_dropdown("accountID", $array , set_value("accountID"), "id='accountID' class='form-control select2'");
                     ?>
                </div>
                <div class="form-group col-sm-4" id="ledgersIDDiv">
                    <label>Ledger Head</label>
                    <?php
                        $array = [];
                        $array[0] = "All Ledgers";
                        if(customCompute($ledgers)) {
                            foreach ($ledgers as $ledger) {
                                $array[$ledger->ledgersID] = $ledger->ledgers;
                            }
                        }
                        echo form_dropdown("ledgersID", $array , set_value("ledgersID"), "id='ledgersID' class='form-control select2'");
                     ?>
                </div>
            </div>
            <div class="col-sm-8">
                    <button id="get_accountledger" class="btn btn-success"> Ledger Book Report</button>
                    <button id="get_accountledger_audit" class="btn btn-success"> Ledger Audit Report</button>
                    <a href="<?= base_url('accountcashbook/incomeadd') ?>" class="btn btn-success"> Add Income/Receipt</a>
                    <a href="<?= base_url('accountcashbook/expenseadd') ?>" class="btn btn-success"> Add Expense</a>
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



    
    $(document).on('click','#get_accountledger_audit', function() {
        $('#load_accountcashbook').html('');
        var passData;
        var error = 0;
        var field = {
            'schoolyearID': $("#schoolyearID").val(),
            'accountID': $("#accountID").val(),
            'ledgersID': $("#ledgersID").val(),
        };

        if(error == 0) {
            makingPostDataPreviousofAjaxCall2(field);
        }
    });
    $(document).on('click','#get_accountledger', function() {
        $('#load_accountcashbook').html('');
        var passData;
        var error = 0;
        var field = {
            'schoolyearID': $("#schoolyearID").val(),
            'accountID': $("#accountID").val(),
            'ledgersID': $("#ledgersID").val(),
        };

        if(error == 0) {
            makingPostDataPreviousofAjaxCall1(field);
        }
    });
    function makingPostDataPreviousofAjaxCall1(field) {
        passData = field;
        ajaxCall1(passData);
    }
    function makingPostDataPreviousofAjaxCall2(field) {
        passData = field;
        ajaxCall2(passData);
    }

    function ajaxCall1(passData) {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('accountledgerbook/getaccountledger')?>",
            data: passData,
            dataType: "html",
            success: function(data) {
                var response = JSON.parse(data);
                renderLoder(response, passData);
            }
        });
    }
    function ajaxCall2(passData) {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('accountledgerbook/getaccountledgeraudit')?>",
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


