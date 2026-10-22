<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
</head>

<body>
		<table width="100%" >
			<tr>
				<td >
					<table width="100%" style="border:1px solid #000;" >
						<tr>
						<td class="border-bottom">
								<table width="100%">
									<tr>
										<td rowspan="6">
											<?php
											if ($siteinfos->photo) {
												$array = array(
													"src" => base_url('uploads/images/' . $siteinfos->photo),
													'width' => '50px',
													'style' => 'margin-top:-8px'
												);
												echo img($array);
											}
											?>
										</td>
										<td style="font-size: xx-small;" class="pull-right">OFFICE COPY</td>
									</tr>
									<tr>
										<td class="center-text f-10">Shri Balaji Yuvak Krida Mandal, Wadegaon (Reg. No. F2451)</td>
									</tr>
									<tr>
										<td class="center-text f-20">
											<b>Shri Balaji English Primary & Secondary School, Wadegaon</b>
										</td>
									</tr>
									
									
									<tr>
										<td class="center-text  f-10">
											Tq. Balapur, Dist.Akola Pin Code - 444502
										</td>
									</tr>
									<tr>
										<td class="center-text  f-10">
										School Permission No. : V.L.S.-1004 (532/04) 12-08-2004
										</td>
									</tr>
									<!-- <tr>
										<td class="center-text  f-10">
											Register No - शा. सा. आदेश .नमाशा -1004 / (407/04) दि. 21/07/2004
										</td>
									</tr> -->
									<tr>
										<td class="center-text  f-10">
											Udise No - 27050308508 / 27050308509
										</td>
									</tr>
								</table>
								<table width="100%">
									<tr>
										<td class="pull-left  f-10">
											Office Mob No - 7058262082 , 9763757391 (H .M )
										</td>
										<td class="pull-right f-10">Board - Amravati</td>
									</tr>
									<tr>
										<td class="pull-left f-10">Email - balajiconvent95@gmail.com</td>
										<td class="pull-right f-10">Medium - English</td>
									</tr>
									<!-- <tr>
										<td class="pull-left f-10" colspan="2">School Permission No. : V.L.S.-1004 (532/04) 12-08-2004</td>

									</tr> -->
									<!-- <tr>
										<td class="pull-center" style="font-size: 12px;font-weight:bold;">
											SHRI BALAJI ENGLISH PRIMARY <br />& SECONDARY SCHOOL <br />WADEGAON
										</td>
									</tr> -->
								</table>
							</td>
						</tr>
						<tr>
							<td class="pull-center">
								<b>FEES RECEIPT</b>
							</td>
						</tr>
						<tr>
							<td class="pull-center">
								<b>[<?= $schoolyear->schoolyear ?>]</b>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td class="pull-left">
											Date: <?= date('d M Y', strtotime($last_paid_date)) ?>
										</td>
										<td>
											Receipt No.: <?= $maininvoice->maininvoiceID ?>
										</td>
									</tr>
									<tr>
										<td>
											Name: <?php echo $maininvoice->srname; ?>
										</td>
										<td>
											Class: <?= $maininvoice->srclasses ?>
											
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%" >
									<tr>
										<td class="border-bottom border-top"><b>Sr.No.</b></td>
										<td class="border-bottom border-top"><b>Category Name</b></td>
										<td class="border-bottom border-top"><b>Amount</b></td>
									</tr>
									<?php $subtotal = 0;
									$totalsubtotal = 0;
									$i = 1;
									if (customCompute($invoices)) {
										foreach ($invoices as $invoice) {
											$discount = 0;
											if ($invoice->discount > 0) {
												$discount = (($invoice->amount / 100) * $invoice->discount);
											}
											$subtotal = ($invoice->amount - $discount);
											$totalsubtotal += $subtotal;  ?>
											<tr>
												<td class="border-bottom"><?php echo $i; ?></td>
												<td class="border-bottom"> <?= isset($feetypes[$invoice->feetypeID]) ? $feetypes[$invoice->feetypeID] : '' ?></td>
												<td class="border-bottom"><?= number_format($invoice->amount, 2) ?></td>
											</tr>
									<?php $i++;
										}
									} ?>
									<tr>
										<td></td>
										<td><b>Total Fees</b></td>
										<td class="border-bottom"><b><?= number_format($totalsubtotal, 2) ?></b></td>
									</tr>
									<?php
									if (customCompute($paymenttotal) && $paymenttotal > 0) {
										?>
										<tr>
										<td></td>
										<td><b>Amount Paid</b></td>
										<td><b><?= number_format($paymenttotal, 2) ?></b></td>
									</tr>
										<?php
									} else {
									?>
									<tr>
										<td></td>
										<td><b>Delay Fees(*)</b></td>
										<td><b><?= number_format($grandtotalandpayment['totalfine'], 2) ?></b></td>
									</tr>
									<?php 
									}
									?>
									
								</table>
							</td>
						</tr>
						<tr>
							<td  class="border-top">
								<table style="width:100%">
									<tr>
										<td><b>Total Amount Paid: </b></td><td class="pull-right"><b> INR <?= number_format($grandtotalandpayment['totalpayment'], 2) ?> /-</b></td>
									</tr>
									<tr>
										<td colspan=2><b>Rs. <?= convert_number($grandtotalandpayment['totalpayment']) ?> Only.</b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 1px solid #000;">
								<table width="100%">
									<tr>
										<td><b>Concession Fees:</b></td>
										<td>INR</td>
										<td><?= number_format($grandtotalandpayment['totalweaver'], 2) ?></td>
									</tr>
									<tr>
										<td><b>Total Due:</b></td>
										<td>INR</td>
										<td><?= number_format(($totalsubtotal - ($grandtotalandpayment['totalpayment'] + $grandtotalandpayment['totalweaver'])), 2) ?></td>
									</tr>
									<?php if($status) { ?>
									<tr>
										<td colspan="3"><?= $due_string ?></td>
									</tr>
									<?php } ?>
									<tr>
										<td><b>Total Other Fees Paid:</b></td>
										<td>INR</td>
										<td>0</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 1px solid #000;">
								<table width="100%">
									<tr>
										<td><b>Payment Mode : <?= $grandtotalandpayment['payment_mode'] ?></b></td>
									</tr>
									<tr>
										<td><b>
												<?php
												$status = $maininvoice->maininvoicestatus;
												$setButton = '';
												if ($status == 0) {
													$status = $this->lang->line('invoice_notpaid');
													$setButton = 'text-red';
												} elseif ($status == 1) {
													$status = $this->lang->line('invoice_partially_paid');
													$setButton = 'text-yellow';
												} elseif ($status == 2) {
													$status = $this->lang->line('invoice_fully_paid');
													$setButton = 'text-green';
												}

												echo $this->lang->line('invoice_status') . " : " . "<span class='" . $setButton . "'>" . $status . "</span>";;
												?>
											</b></td>
									</tr>
									<tr>
										<td><b>Transaction Details: Rec.No. <?= $all_globalpayment ?></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid #000;">
								<b>Note :</b> Fees once paid will not be refunded. This receipt should be produce at any time if required for verification by the School
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td width="33%" class="pull-left">Admin Officer</td>
										<td width="33%">Clerk</td>
										<td width="33%"  class="pull-right">H.M.</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

				</td>
				<td>
					<table width="100%" height="100%"  style="border-left:1px dotted #000;"><tr><td width="100%" height="100%"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td></tr></table>				
				</td>
				<td>
					<table width="100%"  style="border:1px solid #000;">
						<tr>
							<td class="border-bottom">
								<table width="100%">
									<tr>
										<td rowspan="6">
											<?php
											if ($siteinfos->photo) {
												$array = array(
													"src" => base_url('uploads/images/' . $siteinfos->photo),
													'width' => '50px',
													'style' => 'margin-top:-8px'
												);
												echo img($array);
											}
											?>
										</td>
										<td style="font-size: xx-small;" class="pull-right">STUDENT COPY</td>
									</tr>
									<tr>
										<td class="center-text f-10">Shri Balaji Yuvak Krida Mandal, Wadegaon (Reg. No. F2451)</td>
									</tr>
									<tr>
										<td class="center-text f-20">
											<b>Shri Balaji English Primary & Secondary School, Wadegaon</b>
										</td>
									</tr>
									<tr>
										<td class="center-text  f-10">
											Tq. Balapur, Dist.Akola Pin Code - 444502
										</td>
									</tr>
									<tr>
										<td class="center-text  f-10">
										School Permission No. : V.L.S.-1004 (532/04) 12-08-2004
										</td>
									</tr>
									<!-- <tr>
										<td class="center-text  f-10">
											Register No - शा. सा. आदेश .नमाशा -1004 / (407/04) दि. 21/07/2004
										</td>
									</tr> -->
									<tr>
										<td class="center-text  f-10">
											Udise No - 27050308508 / 27050308509
										</td>
									</tr>
								</table>
								<table width="100%">
									<tr>
										<td class="pull-left  f-10">
											Office Mob No - 7058262082 , 9763757391 (H .M )
										</td>
										<td class="pull-right f-10">Board - Amravati</td>
									</tr>
									<tr>
										<td class="pull-left f-10">Email - balajiconvent95@gmail.com</td>
										<td class="pull-right f-10">Medium - English</td>
									</tr>
									<!-- <tr>
										<td class="pull-left f-10" colspan="2">School Permission No. : V.L.S.-1004 (532/04) 12-08-2004</td>

									</tr> -->
									<!-- <tr>
										<td class="pull-center" style="font-size: 12px;font-weight:bold;">
											SHRI BALAJI ENGLISH PRIMARY <br />& SECONDARY SCHOOL <br />WADEGAON
										</td>
									</tr> -->
								</table>
							</td>
						</tr>
						<tr>
							<td class="pull-center">
								<b>FEES RECEIPT</b>
							</td>
						</tr>
						<tr>
							<td class="pull-center">
								<b>[<?= $schoolyear->schoolyear ?>]</b>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td class="pull-left">
											Date: <?= date('d M Y', strtotime($last_paid_date)) ?>
										</td>
										<td>
											Receipt No.: <?= $maininvoice->maininvoiceID ?>
										</td>
									</tr>
									<tr>
										<td>
											Name: <?php echo $maininvoice->srname; ?>
										</td>
										<td>
											Class: <?= $maininvoice->srclasses ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td class="border-bottom border-top"><b>Sr.No.</b></td>
										<td class="border-bottom border-top"><b>Category Name</b></td>
										<td class="border-bottom border-top"><b>Amount</b></td>
									</tr>
									<?php $subtotal = 0;
									$totalsubtotal = 0;
									$i = 1;
									if (customCompute($invoices)) {
										foreach ($invoices as $invoice) {
											$discount = 0;
											if ($invoice->discount > 0) {
												$discount = (($invoice->amount / 100) * $invoice->discount);
											}
											$subtotal = ($invoice->amount - $discount);
											$totalsubtotal += $subtotal;  ?>
											<tr>
												<td class="border-bottom"><?php echo $i; ?></td>
												<td class="border-bottom"> <?= isset($feetypes[$invoice->feetypeID]) ? $feetypes[$invoice->feetypeID] : '' ?></td>
												<td class="border-bottom"><?= number_format($invoice->amount, 2) ?></td>
											</tr>
									<?php $i++;
										}
									} ?>
									<tr>
										<td></td>
										<td><b>Total Fees</b></td>
										<td class="border-bottom"><b><?= number_format($totalsubtotal, 2) ?></b></td>
									</tr>
									<?php
									if (customCompute($paymenttotal) && $paymenttotal > 0) {
										?>
										<tr>
										<td></td>
										<td><b>Amount Paid</b></td>
										<td><b><?= number_format($paymenttotal, 2) ?></b></td>
									</tr>
										<?php
									} else {
									?>
									<tr>
										<td></td>
										<td><b>Delay Fees(*)</b></td>
										<td><b><?= number_format($grandtotalandpayment['totalfine'], 2) ?></b></td>
									</tr>
									<?php 
									}
									?>
								</table>
							</td>
						</tr>
						<tr>
							<td  class="border-top">
								<table style="width:100%">
									<tr>
										<td><b>Total Amount Paid: </b></td><td class="pull-right"><b> INR <?= number_format($grandtotalandpayment['totalpayment'], 2) ?> /-</b></td>
									</tr>
									<tr>
										<td colspan=2><b>Rs. <?= convert_number($grandtotalandpayment['totalpayment']) ?> Only.</b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 1px solid #000;">
								<table width="100%">
									<tr>
										<td><b>Concession Fees:</b></td>
										<td>INR</td>
										<td><?= number_format($grandtotalandpayment['totalweaver'], 2) ?></td>
									</tr>
									<tr>
										<td><b>Total Due:</b></td>
										<td>INR</td>
										<td><?= number_format(($totalsubtotal - ($grandtotalandpayment['totalpayment'] + $grandtotalandpayment['totalweaver'])), 2) ?></td>
									</tr>
									<tr>
										<td><b>Total Other Fees Paid:</b></td>
										<td>INR</td>
										<td>0</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 1px solid #000;">
								<table width="100%">
									<tr>
										<td><b>Payment Mode : <?= $grandtotalandpayment['payment_mode'] ?></b></td>
									</tr>
									<tr>
										<td><b>
												<?php
												$status = $maininvoice->maininvoicestatus;
												$setButton = '';
												if ($status == 0) {
													$status = $this->lang->line('invoice_notpaid');
													$setButton = 'text-red';
												} elseif ($status == 1) {
													$status = $this->lang->line('invoice_partially_paid');
													$setButton = 'text-yellow';
												} elseif ($status == 2) {
													$status = $this->lang->line('invoice_fully_paid');
													$setButton = 'text-green';
												}

												echo $this->lang->line('invoice_status') . " : " . "<span class='" . $setButton . "'>" . $status . "</span>";;
												?>
											</b></td>
									</tr>
									<tr>
										<td><b>Transaction Details: Rec.No. <?= $all_globalpayment ?></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid #000;">
								<b>Note :</b> Fees once paid will not be refunded. This receipt should be produce at any time if required for verification by the School
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
									<td width="33%" class="pull-left">Admin Officer</td>
										<td width="33%">Clerk</td>
										<td width="33%"  class="pull-right">H.M.</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

</body>

</html>