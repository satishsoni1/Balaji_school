<div class="row">
    

    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><i class="fa iniicon-productpurchaseitem"></i> <?=$this->lang->line('productsale_saleitem')?> - <?= $productsale->template_name ?></h3>
                <ol class="breadcrumb">
                    <li><a href="<?=base_url("home/index")?>"><i class="fa fa-laptop"></i> <?=$this->lang->line('menu_dashboard')?></a></li>
                    <li><a href="<?=base_url("productsale/index")?>"><?=$this->lang->line('menu_productsale')?></a></li>
                    <li class="active"><?=$this->lang->line('menu_edit')?> <?=$this->lang->line('menu_productsale')?></li>
                </ol>
            </div><!-- /.box-header -->
            <div class="box-body">
                <form class="" role="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
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
                        <div class="col-sm-6">
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
                            <?php 
                                $productpurchasequintityobj =  json_decode($productpurchasequintity, TRUE);
                                $productsalequintityobj = json_decode($productsalequintity, TRUE);

                                $totalQuantity = 0;
                                $totalSubtotal = 0;
                                $totalProductStockQuantity = [];
                                $totalEditQuantity = [];
                                if(customCompute($products)) {
                                    foreach ($products as $productID => $product) { 
                                        if(isset($productpurchasequintityobj[$productID])) {
                                            $totalProductQuantity = $productpurchasequintityobj[$productID]['quantity'];
                                        } else {
                                            $totalProductQuantity = 0;
                                        }

                                        if(isset($productsalequintityobj[$productID])) {
                                            $totalSaleQuantity = $productsalequintityobj[$productID]['quantity'];
                                        } else {
                                            $totalSaleQuantity = 0;
                                        }

                                        $totalProductStockQuantity[$productID] = ($totalProductQuantity - $totalSaleQuantity);
                                    }
                                }

                                if(customCompute($productsaleitems)) {
                                    foreach ($productsaleitems as $productsaleitem) {
                                        if(isset($totalEditQuantity[$productsaleitem->productID])) {
                                            $totalEditQuantity[$productsaleitem->productID] += $productsaleitem->productsalequantity;
                                        } else {
                                            $totalEditQuantity[$productsaleitem->productID] = $productsaleitem->productsalequantity;
                                        }
                                    }
                                }

                                if(customCompute($productsaleitems)) {
                                    $i=1; 
                                    $CI =& get_instance();
                                    foreach ($productsaleitems as $productsaleitem) {
                                        $randID = rand(1, 9999999999);
                                        $subtotal = ($productsaleitem->qty * $productsaleitem->productsellingprice);
                                        $totalSubtotal += $subtotal; 

                                        echo '<tr id="tr_'.$randID.'" saleproductid="'.$productsaleitem->productID.'">';
                                            echo '<td>';
                                                echo $i;
                                            echo '</td>';

                                            echo '<td>';
                                                echo $productsaleitem->productname;
                                            echo '</td>';

                                            echo '<td>';
                                                echo '<input type="text" class="form-control change-productprice" id="productunitprice_'.$randID.'" data-productprice-id="'.$randID.'" value="'.$productsaleitem->productsellingprice.'">';
                                            echo '</td>';

                                            echo '<td>';
                                                echo '<input type="text" class="form-control change-productquantity" id="productquantity_'.$randID.'" data-productquantity-id="'.$randID.'" value="'.$productsaleitem->qty.'">';
                                            echo '</td>';

                                            echo '<td id="producttotal_'.$randID.'">';
                                                echo number_format($subtotal, 2);
                                            echo '</td>';

                                            echo '<td>';
                                                echo '<a style="margin-top:3px" href="#" class="btn btn-danger btn-sm deleteBtn" id="productaction_'.$randID.'" data-productaction-id="'.$randID.'"><i class="fa fa-trash-o"></i></a>';
                                            echo '</td>';
                                        echo '</tr>';
                                        $i++; 
                                    }
                                } 
                            ?>
                        </tbody>

                        <tfoot id="productListFooter">
                            <tr>
                                <td colspan="3" style="font-weight: bold">Sub Total</td>
                                <td id="totalQuantity" style="font-weight: bold"><?=number_format($totalQuantity, 2)?></td>
                                <td id="totalSubtotal" style="font-weight: bold"><?=number_format($totalSubtotal, 2)?></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td colspan="3" style="font-weight: bold">Discount (%)</td>
                                <td style="font-weight: bold"></td>
                                <td>
                                    <input type="text" class="form-control" id="discount_per" value="<?=$productsale->discount?>" placeholder="0.00">
                                    <input type="hidden" id="discount" value="<?=($totalSubtotal*$productsale->discount)/100?>">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight: bold">Discount</td>
                                <td style="font-weight: bold"></td>
                                <td id="discount_value" style="font-weight: bold"><?=number_format(round(($totalSubtotal*$productsale->discount)/100), 2)?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight: bold">Total</td>
                                <td style="font-weight: bold"></td>
                                <td id="total" style="font-weight: bold"><?=number_format($totalSubtotal-(($totalSubtotal*$productsale->discount)/100), 2)?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <a href="<?=base_url('productsaletemplate/index')?>" class="btn btn-danger pull-left"><?=$this->lang->line("cancel")?></a>
                                    <input id="updatePurchaseButton" type="button" class="btn btn-primary pull-right" value="Update" >
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?= $totalSubtotal ?>" id="totalSubtotal_value">
<script type="text/javascript">
    $('.select2').select2();
$(function() {
        $('#discount_per').change(function(){
            
            var totalSubtotal_value = $('#totalSubtotal_value').val();
            var discount_per = $(this).val();
            var discount = (parseFloat(totalSubtotal_value) * parseFloat(discount_per))/100;
            $('#discount').val(discount.toFixed(2));
            $('#discount_value').text(currencyConvert(discount));
            $('#total').text(currencyConvert(totalSubtotal_value-discount));
        })
        })

    function getRandomInt() {
      return Math.floor(Math.random() * Math.floor(9999999999999999));
    }

    function productItemDesign(productID, productText) {
        var productpurchasequintity = <?=$productpurchasequintity?>;
        var productsalequintity = <?=$productsalequintity?>;
        var productsalequintityforedit = <?=$productsalequintityforedit?>;
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

        if(typeof(productsalequintityforedit) == 'object') {
            if(typeof(productsalequintityforedit[productID]) == 'object') {
                var productsalequintityforeditinfo = productsalequintityforedit[productID];
            } else {
                productsalequintityforeditinfo = {'quantity' : '0', 'productID' : productID};            
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
                text += ('<input type="text" class="form-control change-productquantity" id="productquantity_'+randID+'" max="'+ (parseFloat(productpurchasequintityinfo.quantity) - parseFloat(productsalequintityinfo.quantity) + parseFloat(productsalequintityforeditinfo.quantity)) +'"  data-productquantity-id="'+randID+'">' );
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

        if(productsalecustomertypeID === '3') {
            $('.productsaleclassesDiv').removeClass('hide');
        } else {
            $('.productsaleclassesDiv').addClass('hide');
        }

        if(productsalecustomertypeID === '0') {
            $('#productID').html('<option value="0"><?=$this->lang->line('productsale_select_user')?></option>');
        } else {
            $.ajax({
                type: 'POST',
                url: "<?=base_url('productsale/getuser')?>",
                data: {'productsalecustomertypeID' : productsalecustomertypeID, 'productsaleclassesID' : productsaleclassesID, 'productsaleusercalltype' : 'edit'},
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
                url: "<?=base_url('productsaletemplate/getproductsale')?>",
                data: "productcategoryID=" + productcategoryID,
                dataType: "html",
                success: function(data) {
                    $('#productID').html(data);
                }
            });
        }
    });

    $('#productID').change(function(e) {
        var productID   = $(this).val();
        if(productID != 0) {
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

    $(document).on('click', '#updatePurchaseButton', function() {
        var error=0;;
        var field = {
            'discount'    : $('#discount').val(), 
        };

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
            formData.append("editID", <?=$productsaleID?>);
            formData.append("discount", $('#discount_per').val());
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
            url: "<?=base_url('productsaletemplate/saveproductsale')?>",
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
           window.location = "<?=base_url("productsaletemplate/index")?>";
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

    $(document).ready(function() {
        totalInfo();
    });
</script>

