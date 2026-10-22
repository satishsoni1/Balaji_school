<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
  <div>
    <!-- <table width="100%">
      <tr>
        <td widht="5%">
          <h2>
            <?php
              if($siteinfos->photo) {
                  $array = array(
                      "src" => base_url('uploads/images/'.$siteinfos->photo),
                      'width' => '25px',
                      'height' => '25px',
                      'style' => 'margin-top:-8px'
                  );
                  echo img($array);
              }
              ?>
          </h2>
        </td>
        <td widht="75%">
          <h3 class="top-site-header-title"><?php  echo $siteinfos->sname; ?></h3>
        </td>
      </tr>
    </table> -->
    <!-- <br> -->
    <table width="100%" class="table table-bordered">
      <tr>
        <td colspan="5" style="width:100%">
          <table style="width:100%" border="0">
            
                <!-- <tr>
                    <th class="site-header-title-float"><?php  echo $this->lang->line("productpurchase_from"); ?></th>
                </tr> -->
                <?php if(customCompute($productsupplier)) { ?>
                    <tr>
                        <td style="vertical-align: text-top;text-align:left;border:0px"><?=$productsupplier->productsuppliercompanyname?><br/>  <?=$productsupplier->productsupplieraddress?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: text-top;text-align:left;border:0px"><?=$this->lang->line("productpurchase_phone"). " : ". $productsupplier->productsupplierphone?> <?=$this->lang->line("productpurchase_email"). " : ". $productsupplier->productsupplieremail?></td>
                    </tr>
                <?php } ?>
            
          </table>
        </td>
      </tr>
      <tr>

        <td colspan="3">
            <table width="100%">
              
                  <tr>
                      <td style="vertical-align: text-top;text-align:left;border:0px"><b><?php  echo $this->lang->line("productpurchase_to"); ?></b> Shri Balaji English Primary & Secondary School, Wadegaon<br/>Tg. Balapur, Dist. Akola<br/>Office Mob. No. 7058262032, 9763757391(H.M.)</td>
                  </tr>
                  <!-- <?php if(customCompute($productwarehouse)) { ?>
                      <tr>
                          <td><?=$this->lang->line("productpurchase_warehouse_name"). " : ". $productwarehouse->productwarehousename?></td>
                      </tr>
                      <tr>
                          <td><?=$productwarehouse->productwarehouseaddress?></td>
                      </tr>
                      <tr>
                          <td><?=$this->lang->line("productpurchase_phone"). " : ". $productwarehouse->productwarehousephone?></td>
                      </tr>
                      <tr>
                          <td><?=$this->lang->line("productpurchase_email"). " : ". $productwarehouse->productwarehouseemail?></td>
                      </tr>
                  <?php } ?> -->
              
            </table>
        </td>
        <td  colspan="2" style="vertical-align: text-top;text-align:left">
          <table width="100%">
            
              <tr>
                <td style="vertical-align: text-top;text-align:left;border:0px"><?php echo $this->lang->line("productpurchase_referenceno"). " : " . $productpurchase->productpurchasereferenceno; ?></td>
              </tr>
              <tr>
                <td style="vertical-align: text-top;text-align:left;border:0px">
                <?php  echo $this->lang->line("productpurchase_create_date")." : ". date("d M Y"); ?>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: text-top;text-align:left;border:0px">
                  <?php 
                      $status = $productpurchase->productpurchasestatus;
                      $setButton = '';
                      if($status == 0) {
                          $status = $this->lang->line('productpurchase_pending');
                          $setButton = 'text-red';
                      } elseif($status == 1) {
                          $status = $this->lang->line('productpurchase_partial_paid');
                          $setButton = 'text-yellow';
                      } elseif($status == 2) {
                          $status = $this->lang->line('productpurchase_fully_paid');
                          $setButton = 'text-green';
                      }
                      echo $this->lang->line('productpurchase_payment_status'). " : ".$status;
                  ?>
                  <?php if($productpurchase->productpurchaserefund == 1) { ?>
                      <p class="refund"><?=$this->lang->line('productpurchase_refund')?></p>
                  <?php } ?>
                </td>
              </tr>
            
          </table>
        </td>
      </tr>
        
        <tr>
            <th><?=$this->lang->line('slno')?></th>
            <th><?=$this->lang->line('productpurchase_description')?></th>
            <th><?=$this->lang->line('productpurchase_quantity')?></th>
            <th><?=$this->lang->line('productpurchase_unit_price')?></th>
            
            <th><?=$this->lang->line('productpurchase_subtotal')?></th>
        </tr>
      
          <?php $subtotal = 0; $totalsubtotal = 0; if(customCompute($productpurchaseitems)) { $i=1; foreach ($productpurchaseitems as $productpurchaseitem) { $subtotal = ($productpurchaseitem->productpurchaseunitprice * $productpurchaseitem->productpurchasequantity); $totalsubtotal += $subtotal; ?>
            <tr>
                <td data-title="<?=$this->lang->line('slno')?>">
                    <?php echo $i; ?>
                </td>
                
                <td data-title="<?=$this->lang->line('productpurchase_description')?>">
                    <?=isset($products[$productpurchaseitem->productID]) ? $products[$productpurchaseitem->productID] : ''?>
                </td>
                <td data-title="<?=$this->lang->line('productpurchase_quantity')?>">
                    <?=number_format($productpurchaseitem->productpurchasequantity, 2)?>
                </td>
                
                <td data-title="<?=$this->lang->line('productpurchase_unit_price')?>">
                    <?=number_format($productpurchaseitem->productpurchaseunitprice, 2)?>
                </td>

                
                <td data-title="<?=$this->lang->line('productpurchase_subtotal')?>">
                    <?=number_format($subtotal, 2)?>
                </td>
            </tr>
          <?php $i++; } } ?>
      
          <tr>
              <td class="pull-right" colspan="4"><b><?=$this->lang->line('productpurchase_total_amount')?> <?=!empty($siteinfos->currency_code) ? '('.$siteinfos->currency_code.')' : ''?></b></td>
              <td><b><?=number_format($totalsubtotal, 2)?></b></td>
          </tr>
          <tr>
              
              <td class="pull-right" colspan="4"><b><?= ($productpurchase->discount>0)?("(".($productpurchase->discount*100/$totalsubtotal)."%)"):"" ?> Discount <?=!empty($siteinfos->currency_code) ? '('.$siteinfos->currency_code.')' : ''?></b></td>
              <td><b><?=number_format($productpurchase->discount, 2)?></b></td>
          </tr>
          <tr>
              <td class="pull-right" colspan="4"><b><?=$this->lang->line('productpurchase_paid')?> <?=!empty($siteinfos->currency_code) ? '('.$siteinfos->currency_code.')' : ''?></b></td>
              <td><b><?=number_format($productpurchasepaid->productpurchasepaidamount, 2)?></b></td>
          </tr> 
          <tr>
              <td class="pull-right" colspan="4"><b><?=$this->lang->line('productpurchase_balance');?> <?=!empty($siteinfos->currency_code) ? '('.$siteinfos->currency_code.')' : ''?></b></td>
              <td><b><?=number_format(($totalsubtotal - $productpurchasepaid->productpurchasepaidamount-$productpurchase->discount), 2)?></b></td>
          </tr>
      
    </table>
   
    <table width="100%">
        <tr>
            <td width="65%" >
                Sign
            </td>
            <td width="35%">
                <table>
                    <!-- <tr>
                        <td><?=$this->lang->line('productpurchase_create_by')?> : <?=$createuser?></td>
                    </tr> -->
                    <tr>
                        <td><?=$this->lang->line('productpurchase_date')?> : <?=date('d M Y', strtotime($productpurchase->create_date))?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
  </div>
</body>
</html>