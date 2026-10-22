<style>
    .warning-message {
  background-color: #fff3cd;
  color: #856404;
  border: 1px solid #ffeeba;
  padding: 15px 20px;
  margin: 20px 0;
  border-radius: 8px;
  font-family: Arial, sans-serif;
  font-size: 15px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
<div class="row">
    <div class="col-sm-12">
        
    <div class="alert fade in warning-message" id="is_record" style="display: none;">
   
   A sale record for the selected student already exists. Please check for duplicates before proceeding with a new entry.
</div>
           
    </div>
    <div class="col-sm-3">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa iniicon-productsale"></i> <?=$this->lang->line('panel_title')?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form role="form" method="post" enctype="multipart/form-data" id="productPurchaseDataForm"> 
                    <div class="productsalecustomertypeDiv form-group <?=form_error('productsalecustomertypeID') ? 'has-error' : '' ?>" >
                        <label for="productsalecustomertypeID">
                            <?=$this->lang->line("productsale_role")?> <span class="text-red">*</span>
                        </label>
                        <?php
                            $usertypeArray = array(0 => $this->lang->line("productsale_select_role"));
                            if(customCompute($usertypes)) {
                                foreach ($usertypes as $usertype) {
                                    if($usertype->usertypeID == 3 || $usertype->usertypeID == 2)
                                        $usertypeArray[$usertype->usertypeID] = $usertype->usertype;
                                }
                            }
                            echo form_dropdown("productsalecustomertypeID", $usertypeArray, set_value("productsalecustomertypeID",3), "id='productsalecustomertypeID' class='form-control select2'");
                        ?>
                        <span class="text-red">
                            <?php echo form_error('productsalecustomertypeID'); ?>
                        </span>
                    </div> 


                    <div class="productsaleclassesDiv form-group hide <?=form_error('productsaleclassesID') ? 'has-error' : '' ?>" >
                        <label for="productsaleclassesID">
                            <?=$this->lang->line("productsale_classes")?> <span class="text-red">*</span>
                        </label>
                        <?php
                            $classesArray = array(0 => $this->lang->line("productsale_select_classes"));
                            if(customCompute($classes)) {
                                foreach ($classes as $classa) {
                                    $classesArray[$classa->classesID] = $classa->classes."-".$classa->class_template_id;
                                }
                            }
                            echo form_dropdown("productsaleclassesID", $classesArray, set_value("productsaleclassesID"), "id='productsaleclassesID' class='form-control select2'");
                        ?>
                        <span class="text-red">
                            <?php echo form_error('productsaleclassesID'); ?>
                        </span>
                    </div>  

                    <div class="productsalecustomerDiv form-group <?=form_error('productsalecustomerID') ? 'has-error' : '' ?>" >
                        <label for="productsalecustomerID">
                            <?=$this->lang->line("productsale_user")?> <span class="text-red">*</span>
                        </label>
                        <?php
                            $productwarehouseArray = array(0 => $this->lang->line("productsale_select_user"));
                            echo form_dropdown("productsalecustomerID", $productwarehouseArray, set_value("productsalecustomerID"), "id='productsalecustomerID' class='form-control select2'");
                        ?>
                        <span class="text-red">
                            <?php echo form_error('productsalecustomerID'); ?>
                        </span>
                    </div>

                    <!-- <div class="productsalereferencenoDiv form-group <?=form_error('productsalereferenceno') ? 'has-error' : '' ?>" >
                        <label for="productsalereferenceno">
                            <?=$this->lang->line("productsale_referenceno")?> <span class="text-red">*</span>
                        </label>
                            <input type="text" class="form-control" id="productsalereferenceno" name="productsalereferenceno" value="<?=set_value('productsalereferenceno')?>" >
                        <span class="text-red">
                            <?php echo form_error('productsalereferenceno'); ?>
                        </span>
                    </div> -->

                    <div class="form-group <?=form_error('discount') ? 'has-error' : '' ?>" >
                        <label for="discount">
                            Discount %
                        </label>
                        <input type="hidden" value="<?=set_value('discount')?>" class="form-control" id="discount" name="discount">
                        <input type="number" value="<?=set_value('discount_per')?>" class="form-control" id="discount_per" name="discount_per">
                        <span class="text-red">
                            <?php echo form_error('discount'); ?>
                        </span>
                    </div>
                    <div class="productsaledateDiv form-group <?=form_error('productsaledate') ? 'has-error' : '' ?>" >
                        <label for="productsaledate">
                            <?=$this->lang->line("productsale_date")?> <span class="text-red">*</span>
                        </label>
                            <input type="text" class="form-control" id="productsaledate" name="productsaledate" value="<?=set_value('productsaledate',date('d-m-Y'))?>" >
                        <span class="text-red">
                            <?php echo form_error('productsaledate'); ?>
                        </span>
                    </div>  

                    <div class="productsalepaymentstatusDiv form-group <?=form_error('productsalepaymentstatusID') ? 'has-error' : '' ?>" >
                        <label for="productsalepaymentstatusID">
                            <?=$this->lang->line("productsale_payment_status")?> <span class="text-red">*</span>
                        </label>
                        <?php
                            $productwarehouseArray = array(
                                0 => $this->lang->line("productsale_select_payment_status"),
                                1 => $this->lang->line("productsale_due"),
                            );

                            if($siteinfos->school_year == $this->session->userdata('defaultschoolyearID')) {
                                $productwarehouseArray[2] = $this->lang->line("productsale_partial");
                                $productwarehouseArray[3] = $this->lang->line("productsale_paid");
                            }

                            echo form_dropdown("productsalepaymentstatusID", $productwarehouseArray, set_value("productsalepaymentstatusID",3), "id='productsalepaymentstatusID' class='form-control select2'");
                        ?>
                        <span class="text-red">
                            <?php echo form_error('productsalepaymentstatusID'); ?>
                        </span>
                    </div>

                    <div class="form-group <?=form_error('productsalefile') ? 'has-error' : '' ?>" >
                        <label for="productsalefile">
                            <?=$this->lang->line("productsale_file")?>
                        </label>
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="fa fa-remove"></span>
                                    <?=$this->lang->line('productsale_clear')?>
                                </button>
                                <div class="btn btn-success image-preview-input">
                                    <span class="fa fa-repeat"></span>
                                    <span class="image-preview-input-title">
                                    <?=$this->lang->line('productsale_browse')?></span>
                                    <input type="file" name="productsalefile"/>
                                </div>
                            </span>
                        </div>
                        <span class="text-red">
                            <?php echo form_error('productsale_file'); ?>
                        </span>
                    </div>

                    <div class="productsaledescriptionDiv form-group <?=form_error('productsaledescription') ? 'has-error' : '' ?>" >
                        <label for="productsaledescription">
                            <?=$this->lang->line("productsale_description")?>
                        </label>
                        <textarea class="form-control" style="resize:none;" id="productsaledescription" name="productsaledescription"><?=set_value('productsaledescription')?></textarea>
                        <span class="text-red">
                            <?php echo form_error('productsaledescription'); ?>
                        </span>
                    </div>

                    <input id="addPurchaseButton" type="button" class="btn btn-success" value="<?=$this->lang->line("add_productsale")?>" >
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa iniicon-productpurchaseitem"></i> <?=$this->lang->line('productsale_saleitem')?></h3>
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("productsale/index")?>"><?=$this->lang->line('menu_productsale')?></a></li>
                    <li class="active"><?=$this->lang->line('menu_add')?> <?=$this->lang->line('menu_productsale')?></li>
                </ol>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form class="" role="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group <?=form_error('producttemplateID') ? 'has-error' : '' ?>" >
                                <label for="productcategproducttemplateIDoryID" class="control-label">
                                    Sales Template <span class="text-red">*</span>
                                </label>
                                <?php
                                    $productcategoryArray = array(0 => "Select Sales Template");
                                    if(customCompute($productcategorys)) {
                                        foreach ($saletemplates as $saletemplate) {
                                            $productcategoryArray[$saletemplate->id] = $saletemplate->template_name;
                                        }
                                    }
                                    echo form_dropdown("producttemplateID", $productcategoryArray, set_value("producttemplateID"), "id='producttemplateID' class='form-control select2'");
                                ?>
                                <span class="control-label">
                                    <?php echo form_error('producttemplateID'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group <?=form_error('productcategoryID') ? 'has-error' : '' ?>" >
                                <label for="productcategoryID" class="control-label">
                                    <?=$this->lang->line("productsale_category")?> <span class="text-red">*</span>
                                </label>
                                <?php
                                    $productcategoryArray = array(0 => $this->lang->line("productsale_select_category"));
                                    if(customCompute($productcategorys)) {
                                        foreach ($productcategorys as $productcategory) {
                                            $productcategoryArray[$productcategory->productcategoryID] = $productcategory->productcategoryname;
                                        }
                                    }
                                    echo form_dropdown("productcategoryID", $productcategoryArray, set_value("productcategoryID"), "id='productcategoryID' class='form-control select2'");
                                ?>
                                <span class="control-label">
                                    <?php echo form_error('productcategoryID'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group <?=form_error('productID') ? 'has-error' : '' ?>" >
                                <label for="productID" class="control-label">
                                    <?=$this->lang->line("productsale_product")?> <span class="text-red">*</span>
                                </label>
                                <?php
                                    $productArray = array(0 => $this->lang->line("productsale_select_product"));
                                    echo form_dropdown("productID", $productArray, set_value("productID"), "id='productID' class='form-control select2'");
                                ?>
                                <span class="control-label">
                                    <?php echo form_error('productID'); ?>
                                </span>
                            </div>  
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered product-style" style="font-size: 16px;">
                        <thead>
                            <tr>
                                <th class="col-sm-1"><?=$this->lang->line('slno')?></th>
                                <th class="col-sm-4"><?=$this->lang->line('productsale_product')?></th>
                                <th class="col-sm-2" ><?=$this->lang->line('productsale_unit_price')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('productsale_quantity')?></th>
                                <th class="col-sm-2"><?=$this->lang->line('productsale_subtotal')?></th>
                                <th class="col-sm-1"><?=$this->lang->line('action')?></th>
                            </tr>
                        </thead>
                        <tbody id="productList">
                        </tbody>

                        <tfoot id="productListFooter">
                            <tr>
                                <td colspan="3" style="font-weight: bold"><?=$this->lang->line('productsale_total')?></td>
                                <td id="totalQuantity" style="font-weight: bold">0.00</td>
                                <td id="totalSubtotal" style="font-weight: bold">0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="box hide" id="payment-box" >
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12" id="summary_report">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group productsalepaidreferencenoDiv <?=form_error('productsalepaidreferenceno') ? 'has-error' : '' ?>" >
                            <label for="productsalepaidreferenceno" class="control-label">
                                <?=$this->lang->line("productsale_referenceno")?> <span class="text-red">*</span>
                            </label>
                            <input type="text" readonly class="form-control" id="productsalepaidreferenceno" name="productsalepaidreferenceno" value="<?=set_value('productsalepaidreferenceno',$this->productsalepaid_m->getInvoiceNummer())?>" >
                            <span class="control-label">
                                <?php echo form_error('productsalepaidreferenceno'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group productsalepaidamountDiv <?=form_error('productsalepaidamount') ? 'has-error' : '' ?>" >
                            <label for="productsalepaidamount" class="control-label">
                                <?=$this->lang->line("productsale_amount")?> <span class="text-red">*</span>
                            </label>
                            <input type="text" class="form-control" id="productsalepaidamount" name="productsalepaidamount" value="<?=set_value('productsalepaidamount')?>" >
                            <span class="control-label">
                                <?php echo form_error('productsalepaidamount'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group productsalepaidpaymentmethodDiv <?=form_error('productsalepaidpaymentmethod') ? 'has-error' : '' ?>" >
                            <label for="productsalepaidpaymentmethod" class="control-label">
                                <?=$this->lang->line("productsale_paymentmethod")?> <span class="text-red">*</span>
                            </label>
                            <?php
                                $paymentmethodArray = array(
                                    0 => $this->lang->line('productsale_select_paymentmethod'),
                                    1 => $this->lang->line('productsale_cash'),
                                    2 => $this->lang->line('productsale_cheque'),
                                    3 => $this->lang->line('productsale_credit_card'),
                                    4 => $this->lang->line('productsale_other'),
                                );
                                echo form_dropdown("productsalepaidpaymentmethod", $paymentmethodArray, set_value("productsalepaidpaymentmethod",1), "id='productsalepaidpaymentmethod' class='form-control select2'");
                            ?>
                            <span class="control-label">
                                <?php echo form_error('productsalepaidpaymentmethod'); ?>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="0" id="totalSubtotal_value">
<script type="text/javascript">
    $('.select2').select2();
    $('#productsaledate').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        startDate:'<?=$schoolyearsessionobj->startingdate?>',
        endDate:'<?=$schoolyearsessionobj->endingdate?>',
    });

    $(function() {
        $('#productsalecustomertypeID').val(3).trigger('change');
        $('#productsalepaymentstatusID').val(3).trigger('change');
        // var discount_per = 0;
        // var classtemp = $('#productsaleclassesID').val();
        // if(classtemp == 0){
        //     discount_per = 0;
        // }else if(classtemp>=1 && classtemp<=3){
        //     discount_per = 20;
        // }else if(classtemp>=5 && classtemp<=9){
        //     discount_per = 30;
        // }else if(classtemp>=10 && classtemp<=14){
        //     discount_per = 20;
        // }else{
        //     discount_per = 0;
        // }
        // $('#discount_per').val(discount_per).trigger("change");

        $('#discount_per').change(function(){
            
            var totalSubtotal_value = $('#totalSubtotal_value').val();
            var discount_per = $(this).val();
            var discount = (parseFloat(totalSubtotal_value) * parseFloat(discount_per))/100;
           
            var text = `<p>Total Amount: `+currencyConvert(parseFloat(totalSubtotal_value))+` - Discount: `+currencyConvert(discount)+` = Amount after discount: `+currencyConvert(totalSubtotal_value-discount)+` Payable amount after round: `+currencyConvert(Math.round((totalSubtotal_value-discount)/10)*10)+`</p>`;
            $('#summary_report').html(text);
             discount = parseFloat(totalSubtotal_value) - (Math.round((totalSubtotal_value-discount)/10)*10);
             $('#discount').val(discount.toFixed(2));
            $('#productsalepaidamount').val(Math.round((totalSubtotal_value-discount)/10)*10);
        })
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
            $(".image-preview-input-title").text("<?=$this->lang->line('productsale_browse')?>");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function (){
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("<?=$this->lang->line('productsale_browse')?>");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
            }
            reader.readAsDataURL(file);
        });
    });

    function getRandomInt() {
      return Math.floor(Math.random() * Math.floor(9999999999999999));
    }
    function productItemDesignQTY(productID, productText,qty) {
        var productpurchasequintity = <?=$productpurchasequintity?>;
        var productsalequintity = <?=$productsalequintity?>;
        var productobj = <?=$productobj?>;
        var randID = getRandomInt();
        if($('#productList tr:last').text() == '') {
            var lastTdNumber = 0;
        } else {
            var lastTdNumber = $("#productList tr:last td:eq(0)").text();
        }

        if(typeof(productpurchasequintity) == 'object') {
            if(typeof(productpurchasequintity[productID]) == 'object') {
                var productpurchasequintityinfo = productpurchasequintity[productID];
            } else {
                productpurchasequintityinfo = {'quantity' : '0', 'productID' : productID};            
            }
        }

        if(typeof(productsalequintity) == 'object') {
            if(typeof(productsalequintity[productID]) == 'object') {
                var productsalequintityinfo = productsalequintity[productID];
            } else {
                productsalequintityinfo = {'quantity' : '0', 'productID' : productID};            
            }
        }

        if(typeof(productobj) == 'object') {
            if(typeof(productobj[productID]) == 'object') {
                var productobjinfo = productobj[productID];
            } else {
                productobjinfo = {'productID' : productID, 'productbuyingprice' : '0', 'productsellingprice' : '0'};            
            }
        }

        lastTdNumber = parseInt(lastTdNumber);
        lastTdNumber++;

        var text = '<tr id="tr_'+randID+'" saleproductid="'+productID+'">';
            text += '<td>';
                text += lastTdNumber;
            text += '</td>';

            text += '<td>';
                text += productText;
            text += '</td>';

            text += '<td>';
                text += ('<input type="text" class="form-control change-productprice" id="productunitprice_'+randID+'" value="'+productobjinfo.productsellingprice+'" data-productprice-id="'+randID+'">');
            text += '</td>';

            text += '<td>';
                text += ('<input type="text" class="form-control change-productquantity" id="productquantity_'+randID+'" value="'+qty+'" data-productquantity-id="'+randID+'">' );
            text += '</td>';

            text += '<td id="producttotal_'+randID+'">';
                text += '0.00';
            text += '</td>';

            text += '<td>';
                text += ('<a style="margin-top:3px" href="#" class="btn btn-danger btn-sm deleteBtn" id="productaction_'+randID+'" data-productaction-id="'+randID+'"><i class="fa fa-trash-o"></i></a>');
            text += '</td>';
        text += '</tr>';

        return text; 
    }
    function productItemDesign(productID, productText) {
        var productpurchasequintity = <?=$productpurchasequintity?>;
        var productsalequintity = <?=$productsalequintity?>;
        var productobj = <?=$productobj?>;
        var randID = getRandomInt();
        if($('#productList tr:last').text() == '') {
            var lastTdNumber = 0;
        } else {
            var lastTdNumber = $("#productList tr:last td:eq(0)").text();
        }

        if(typeof(productpurchasequintity) == 'object') {
            if(typeof(productpurchasequintity[productID]) == 'object') {
                var productpurchasequintityinfo = productpurchasequintity[productID];
            } else {
                productpurchasequintityinfo = {'quantity' : '0', 'productID' : productID};            
            }
        }

        if(typeof(productsalequintity) == 'object') {
            if(typeof(productsalequintity[productID]) == 'object') {
                var productsalequintityinfo = productsalequintity[productID];
            } else {
                productsalequintityinfo = {'quantity' : '0', 'productID' : productID};            
            }
        }

        if(typeof(productobj) == 'object') {
            if(typeof(productobj[productID]) == 'object') {
                var productobjinfo = productobj[productID];
            } else {
                productobjinfo = {'productID' : productID, 'productbuyingprice' : '0', 'productsellingprice' : '0'};            
            }
        }

        lastTdNumber = parseInt(lastTdNumber);
        lastTdNumber++;

        var text = '<tr id="tr_'+randID+'" saleproductid="'+productID+'">';
            text += '<td>';
                text += lastTdNumber;
            text += '</td>';

            text += '<td>';
                text += productText;
            text += '</td>';

            text += '<td>';
                text += ('<input type="text" class="form-control change-productprice" id="productunitprice_'+randID+'" value="'+productobjinfo.productsellingprice+'" data-productprice-id="'+randID+'">');
            text += '</td>';

            text += '<td>';
                text += ('<input type="text" class="form-control change-productquantity" id="productquantity_'+randID+'" max="'+ (productpurchasequintityinfo.quantity - productsalequintityinfo.quantity) +'"  data-productquantity-id="'+randID+'">' );
            text += '</td>';

            text += '<td id="producttotal_'+randID+'">';
                text += '0.00';
            text += '</td>';

            text += '<td>';
                text += ('<a style="margin-top:3px" href="#" class="btn btn-danger btn-sm deleteBtn" id="productaction_'+randID+'" data-productaction-id="'+randID+'"><i class="fa fa-trash-o"></i></a>');
            text += '</td>';
        text += '</tr>';

        return text; 
    }
    
    $('#productsalecustomertypeID, #productsaleclassesID').change(function(event) {
        var productsalecustomertypeID = $('#productsalecustomertypeID').val();
        var productsaleclassesID = $('#productsaleclassesID').val();
        if(productsaleclassesID != 0){
            var productsaleclassesNameString = $('#productsaleclassesID option:selected').text();
            var productsaleclassesNameArray = productsaleclassesNameString.split("-");
            $("#producttemplateID").val(productsaleclassesNameArray[1]);
            $('#producttemplateID').trigger("change");
        }
        if(productsalecustomertypeID === '3') {
            $('.productsaleclassesDiv').removeClass('hide');
        } else {
            $('.productsaleclassesDiv').addClass('hide');
        }

        var discount_per = 0;
        var classtemp = $('#productsaleclassesID').val();
        if(classtemp == 0){
            discount_per = 0;
        }else if(classtemp==1){
            discount_per = 22;
        }else if(classtemp==2 || classtemp==3 || classtemp==11 || classtemp==12){
            discount_per = 30;
        }else if(classtemp==5 || classtemp==6){
            discount_per = 32;
        }
        else if(classtemp==7){
            discount_per = 32;
        }
        else if(classtemp==8){
            discount_per = 31;
        }else{
            discount_per = 0;
        }
        $('#discount_per').val(discount_per).trigger("change");

        if(productsalecustomertypeID === '0') {
            $('#productID').html('<option value="0"><?=$this->lang->line('productsale_select_user')?></option>');
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('productsale/getuser')?>",
                data: {'productsalecustomertypeID' : productsalecustomertypeID, 'productsaleclassesID' : productsaleclassesID},
                dataType: "html",
                success: function(data) {
                    $('#productsalecustomerID').html(data);
                }
            });
        }
    });

    $('#productcategoryID').change(function(event) {
        var productcategoryID = $(this).val();
        if(productcategoryID === '0') {
            $('#productID').html('<option value="0"><?=$this->lang->line('productsale_select_product')?></option>');
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('productsale/getproductsale')?>",
                data: "productcategoryID=" + productcategoryID,
                dataType: "html",
                success: function(data) {
                    $('#productID').html(data);
                }
            });
        }
    });

    $('#producttemplateID').change(function(e) {
        var templateID   = $(this).val();
        if(templateID !=0) {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('productsale/getsaletemplateproduct')?>",
                data: "templateID=" + templateID,
                dataType: "json",
                success: function(responseData) {
                    var templateInfo = responseData[1];
                    console.log(templateInfo.discount);
                    $('#discount_per').val(templateInfo.discount).trigger("change");
                    var data = responseData[0];
                    $('#productList').empty();
                    for(var i=0;i<data.length;i++){
                        var productText = data[i].productname;
                        var appendData  = productItemDesignQTY(data[i].productID, productText,data[i].qty);
                        $('#productList').append(appendData);
                    }
                    $('.change-productquantity').trigger('keyup');
                    
                }
            });
            
        }
    });

    $('#productID').change(function(e) {
        var productID   = $(this).val();
        if(productID !=0) {
            var productText = $(this).find(":selected").text();
            var appendData  = productItemDesign(productID, productText);
            $('#productList').append(appendData);
        }
    });

    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function floatChecker(value) {
        var val = value;
        if(isNumeric(val)) {
            return true;
        } else {
            return false;
        }
    }

    function parseSentenceForNumber(sentence) {
        var matches = sentence.replace(/,/g, '').match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/);
        return matches && matches[0] || null;
    }   

    function getRandomInt() {
      return Math.floor(Math.random() * Math.floor(9999999999999999));
    }


    function currencyConvert(data) {
        return data.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }

    function dotAndNumber(data) {
        var retArray = [];
        var fltFlag = true;
        if(data.length > 0) {
            for(var i = 0; i <= (data.length-1); i++) {
                if(i == 0 && data.charAt(i) == '.') {
                    fltFlag = false;
                    retArray.push(true);
                } else {
                    if(data.charAt(i) == '.' && fltFlag == true) {
                        retArray.push(true);
                        fltFlag = false;
                    } else {
                        if(isNumeric(data.charAt(i))) {
                            retArray.push(true);
                        } else {
                            retArray.push(false);
                        }
                    }

                }
            }
        }

        if(jQuery.inArray(false, retArray) ==  -1) {
            return true;
        }
        return false;
    }

    function sentanceLengthRemove(sentence) {
        sentence = sentence.toString();
        sentence = sentence.slice(0, -1);
        sentence = parseFloat(sentence);
        return sentence;
    }

    function toFixedVal(x) {
      if (Math.abs(x) < 1.0) {
        var e = parseFloat(x.toString().split('e-')[1]);
        if (e) {
            x *= Math.pow(10,e-1);
            x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
        }
      } else {
        var e = parseFloat(x.toString().split('+')[1]);
        if (e > 20) {
            e -= 20;
            x /= Math.pow(10,e);
            x += (new Array(e+1)).join('0');
        }
      }
      return x;
    }

    function lenCheckerWithoutParseFloat(data, len) {
        var retdata = 0;
        var lencount = 0;
        if(data.length > len) {
            lencount = (data.length - len);
            data = data.toString();
            data = data.slice(0, -lencount);
            retdata = data;
        } else {
            retdata = data;
        }

        return retdata;
    }

    // $(document).on('keyup', '#productsalereferenceno', function() {
    //     var productsalereferenceno =  $(this).val();
    //     if(productsalereferenceno.length > 99) {
    //         productsalereferenceno = lenCheckerWithoutParseFloat(productsalereferenceno, 99);
    //         $(this).val(productsalereferenceno);                    
    //     }
    // });

    $(document).on('keyup', '#productsalepaidreferenceno', function() {
        var productsalepaidreferenceno =  $(this).val();
        if(productsalepaidreferenceno.length > 99) {
            productsalepaidreferenceno = lenCheckerWithoutParseFloat(productsalepaidreferenceno, 99);
            $(this).val(productsalepaidreferenceno);                    
        }
    });

    var globalsubtotal = 0;
    function totalInfo() {
        var i = 1;
        var totalQuantity = 0;
        var totalSubtotal = 0;
        $('#productList tr').each(function(index, value) {
            if($(this).children().eq(3).children().val() != '' && $(this).children().eq(3).children().val() != null) {
                var quantity = parseFloat($(this).children().eq(3).children().val());
                var subtotal = parseFloat($(this).children().eq(4).text().replace(/,/gi, ''));
                totalQuantity += quantity;
                totalSubtotal += subtotal;
            } 
        });
        globalsubtotal = totalSubtotal;
        $('#totalQuantity').text(currencyConvert(totalQuantity));
        $('#totalSubtotal').text(currencyConvert(totalSubtotal));
        $('#totalSubtotal_value').val(totalSubtotal);
        $('#discount_per').trigger('change');
    }

    function totalUnitQuantity(gettrID, getproductID, getamount) {
        var totalQuantity = 0;
        var maxValue = 0;
        var quantity = 0;
        $('#productList tr').each(function(index, value) {
            var trID = $(value).attr('id');
            var productID = $(value).attr('saleproductid');
            if($(this).children().eq(3).children().val() != '' && $(this).children().eq(3).children().val() != null) {
                if((trID != gettrID) && (parseInt(productID) == parseInt(getproductID))) {
                    totalQuantity += parseFloat($(value).children().eq(3).children().val());
                }
            }
        });

        maxValue = parseFloat($('#'+gettrID).children().eq(3).children().attr('max'));
        
        quantity = (maxValue - totalQuantity);
        if(getamount > quantity) {
            // $('#'+gettrID).css('background-color', '#f5e1e1');
            $('#'+gettrID).children().eq(3).children().val(quantity);
        } else {
            // $('#'+gettrID).css('background-color', '#ffffff');
        }
    }

    function totalUnitQuantityAmount(gettrID, getproductID, getamount) {
        var totalQuantity = 0;
        var maxValue = 0;
        var quantity = 0;
        $('#productList tr').each(function(index, value) {
            var trID = $(value).attr('id');
            var productID = $(value).attr('saleproductid');
            if($(this).children().eq(3).children().val() != '' && $(this).children().eq(3).children().val() != null) {
                if((trID != gettrID) && (parseInt(productID) == parseInt(getproductID))) {
                    totalQuantity += parseFloat($(value).children().eq(3).children().val());
                }
            }
        });

        maxValue = parseFloat($('#'+gettrID).children().eq(3).children().attr('max'));
        quantity = (maxValue - totalQuantity);
        if(getamount > quantity) {
            return quantity;
        } else {
            return getamount;
        }
    }

    function lenChecker(data, len) {
        var retdata = 0;
        var lencount = 0;
        data = toFixedVal(data);
        if(data.length > len) {
            lencount = (data.length - len);
            data = data.toString();
            data = data.slice(0, -lencount);
            retdata = parseFloat(data);
        } else {
            retdata = parseFloat(data);
        }

        return toFixedVal(retdata);
    }

    $(document).on('keyup', '.change-productprice', function() {
        var productPrice =  toFixedVal($(this).val());
        var productPriceID = $(this).attr('data-productprice-id'); 
        var productQuantity = toFixedVal($('#productquantity_'+productPriceID).val());

        if(dotAndNumber(productPrice)) {
            if(productPrice.length > 15) {
                productPrice = lenChecker(productPrice, 15);
                $(this).val(productPrice);
            }
            
            if((productPrice != '' && productPrice != null) && (productQuantity != '' && productQuantity != null)) {
                if(floatChecker(productPrice)) {
                    if(productPrice.length > 15) {
                        productPrice = lenChecker(productPrice, 15);
                        $(this).val(productPrice);
                        $('#producttotal_'+productPriceID).text(currencyConvert(productPrice*productQuantity));
                        totalInfo();
                    } else {
                        $('#producttotal_'+productPriceID).text(currencyConvert(productPrice*productQuantity));
                        totalInfo();
                    }
                }
            } else {
                $('#producttotal_'+productPriceID).text('0.00');
                totalInfo();
            }
        } else {
            var productPrice = parseSentenceForNumber(toFixedVal($(this).val()));
            $(this).val(productPrice);
        }
    });

    $(document).on('keyup', '.change-productquantity', function() {
        var gettrID = $(this).parent().parent().attr('id');
        var getproductID = $(this).parent().parent().attr('saleproductid');
        var productQuantity =  toFixedVal($(this).val());
        var productQuantityID = $(this).attr('data-productquantity-id'); 
        var productPrice = toFixedVal($('#productunitprice_'+productQuantityID).val());

        if(dotAndNumber(productQuantity)) {
            if((productQuantity != '' && productQuantity != null) && (productPrice != '' && productPrice != null)) {
                if(floatChecker(productQuantity)) {
                    totalUnitQuantity(gettrID, getproductID, productQuantity);
                    productQuantity = totalUnitQuantityAmount(gettrID, getproductID, productQuantity);
                    $('#producttotal_'+productQuantityID).text(currencyConvert(productQuantity*productPrice));
                    totalInfo();
                }
            } else {
                $('#producttotal_'+productQuantityID).text('0.00');
                totalUnitQuantity(gettrID, getproductID, productQuantity);
                totalInfo();
            }
        } else {
            var productQuantity = parseSentenceForNumber(toFixedVal($(this).val()));
            $(this).val(productQuantity);
            totalUnitQuantity(gettrID, getproductID, productQuantity);
        }
    });

    $(document).on('click', '.deleteBtn', function(e) {
        e.preventDefault();
        var productItemID = $(this).attr('data-productaction-id');
        $('#tr_'+productItemID).remove();
        
        var i = 1;
        $('#productList tr').each(function(index, value) {
            $(this).children().eq(0).text(i);
            i++;
        });
        totalInfo();
        $('#productsalepaidamount').val('');
    });

    $('#productsalepaymentstatusID').change(function() {
        var productsalepaymentstatusID = $(this).val();
        if(productsalepaymentstatusID == 0 || productsalepaymentstatusID == 1) {
            $('#payment-box').addClass('hide');
        } else {
            $('#payment-box').removeClass('hide');
        }
    });

    $(document).on('keyup', '#productsalepaidamount', function() {
        var productsalepaidamount =  toFixedVal($(this).val());
        if(dotAndNumber(productsalepaidamount)) {
            if(productsalepaidamount != '' && productsalepaidamount != null) {
                if(floatChecker(productsalepaidamount)) {
                    if(productsalepaidamount.length > 15) {
                        $(this).val(globalsubtotal);                    
                    } else {
                        if(productsalepaidamount > globalsubtotal) {
                            $(this).val(globalsubtotal);
                        }
                    }
                }
            }
        } else {
            var productsalepaidamount = parseSentenceForNumber($(this).val());
            $(this).val(productsalepaidamount);
        }
    });
     $(document).on('change', '#productsalecustomerID', function() {
            var studentID = $(this).val();
            $.ajax({
                type: 'POST',
                url: "<?=base_url('productsale/is_sale_exist')?>",
                data: {'studentID' : studentID},
                dataType: "json",
                success: function(data) {
                    console.log(data.status);
                    if(data.status){
                        $("#is_record").show();
                    }else{
                        $("#is_record").hide();
                    }
                    
                }
            });
        });
    $(document).on('click', '#addPurchaseButton', function() {
        var error=0;;
        var field = {
            'productsalecustomertypeID'             : $('#productsalecustomertypeID').val(), 
            'productsalecustomerID'                 : $('#productsalecustomerID').val(), 
            'discount'    : $('#discount').val(), 
            // 'productsalereferenceno'                : $('#productsalereferenceno').val(), 
            'productsaledate'                       : $('#productsaledate').val(), 
            'productpurchasedescription'            : $('#productpurchasedescription').val(), 
            'productsalepaymentstatusID'            : $('#productsalepaymentstatusID').val(), 
        };

        if (field['productsalecustomertypeID'] === '0') {
            $('.productsalecustomertypeDiv').addClass('has-error');
            error++;
        } else {
            $('.productsalecustomertypeDiv').removeClass('has-error');
        }

        if (field['productsalecustomerID'] === '0') {
            $('.productsalecustomerDiv').addClass('has-error');
            error++;
        } else {
            $('.productsalecustomerDiv').removeClass('has-error');
        }

        // if (field['productsalereferenceno'] == '') {
        //     $('.productsalereferencenoDiv').addClass('has-error');
        //     error++;
        // } else {
        //     $('.productsalereferencenoDiv').removeClass('has-error');
        // }

        if (field['productsaledate'] == '') {
            $('.productsaledateDiv').addClass('has-error');
            error++;
        } else {
            $('.productsaledateDiv').removeClass('has-error');
        }

        if (field['productsalepaymentstatusID'] === '0') {
            $('.productsalepaymentstatusDiv').addClass('has-error');
            error++;
        } else {
            $('.productsalepaymentstatusDiv').removeClass('has-error');
        }

        if(parseInt($('#productsalepaymentstatusID').val()) > 1) {
            if($('#productsalepaidreferenceno').val() == '') {
                $('.productsalepaidreferencenoDiv').addClass('has-error');
                error++;
            } else {
                $('.productsalepaidreferencenoDiv').removeClass('has-error');
            }

            if($('#productsalepaidamount').val() == '') {
                $('.productsalepaidamountDiv').addClass('has-error');
                error++;
            } else {
                $('.productsalepaidamountDiv').removeClass('has-error');
            }

            if($('#productsalepaidpaymentmethod').val() === '0') {
                $('.productsalepaidpaymentmethodDiv').addClass('has-error');
                error++;
            } else {
                $('.productsalepaidpaymentmethodDiv').removeClass('has-error');
            }
        }

        var productitem = $('tr[id^=tr_]').map(function(){
            return { productID : $(this).attr('saleproductid'), unitprice: $(this).children().eq(2).children().val(), quantity : $(this).children().eq(3).children().val() };
        }).get();

        if (typeof productitem == 'undefined' || productitem.length <= 0) {
            error++;
            toastr["error"]('The product item is required.')
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "500",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }  
        }

        productitem = JSON.stringify(productitem);

        if(error === 0) {
            $(this).attr('disabled', 'disabled');
            var formData = new FormData($('#productPurchaseDataForm')[0]);
            formData.append("productitem", productitem);
            formData.append("productsalepaidreferenceno", $('#productsalepaidreferenceno').val());
            formData.append("productsalepaidamount", $('#productsalepaidamount').val());
            formData.append("productsalepaidpaymentmethod", $('#productsalepaidpaymentmethod').val());
            formData.append("editID", 0);
            makingPostDataPreviousofAjaxCall(formData);
        }
    });


    function makingPostDataPreviousofAjaxCall(field) {
        passData = field;
        ajaxCall(passData);
    }

    function ajaxCall(passData) {
        $.ajax({
            type: 'POST',
            url: "<?=base_url('productsale/saveproductsale')?>",
            data: passData,
            async: true,
            dataType: "html",
            success: function(data) {
                var response = JSON.parse(data);
                errrorLoader(response);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }

    function errrorLoader(response) {
        if(response.status) {
            window.location = "<?=base_url("productsale/index")?>";
        } else {
            $('#addPurchaseButton').removeAttr('disabled');
            $.each(response.error, function(index, val) {
                toastr["error"](val)
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "500",
                    "hideDuration": "500",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            });
        }
    }    
</script>

