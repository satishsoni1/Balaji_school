<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
</head>

<body>
	<div>
		<table width="100%">
			<tr>
				<td style="border: 1px solid #000;">
					<table width="100%">
						<tr>
							<td class="border-bottom">
								<table width="100%">
									<tr>
										<td>
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
										<td class="pull-center" style="font-size: 12px;font-weight:bold;">
											SHRI BALAJI ENGLISH PRIMARY <br />& SECONDARY SCHOOL <br />WADEGAON
										</td>
									</tr>
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
								<b>[2019-2020]</b>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td class="pull-left">
											<?= date("d M Y H:i:s") ?>
										</td>
										<td>
											Receipt No.: <?= $globalpayment->globalpaymentID ?>
										</td>
									</tr>
									<tr>
										<td>
											Name: <?php echo $studentrelation->srname; ?>
										</td>
										<td>
											Class: <?= $studentrelation->srclasses ?>
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
									<?php $totalamount = 0;
									$totalamount = 0;
									$totalweaver = 0;
									$totalfine = 0;
									$totalsubtotal = 0;
									$paymentDate = date('Y-m-d');
									$paymentUserTypeID = 0;
									$paymentUserID = 0;
									$i = 1;
									if (customCompute($payments)) {
										foreach ($payments as $payment) {
											if ($payment->paymentamount != '' || (isset($weaverandfines[$payment->paymentID]))) {
												$paymentDate = $payment->paymentdate;
												$paymentUserTypeID = $payment->usertypeID;
												$paymentUserID = $payment->userID;  ?>
												<tr>
													<td class="border-bottom"><?php echo $i; ?></td>
													<td class="border-bottom"><?php
																				if (isset($invoices[$payment->invoiceID])) {
																					if (isset($feetypes[$invoices[$payment->invoiceID]->feetypeID])) {
																						echo $feetypes[$invoices[$payment->invoiceID]->feetypeID];
																					}
																				}
																				?></td>
													<td class="border-bottom"><?php
																				$totalamount += $payment->paymentamount;
																				echo number_format($payment->paymentamount, 2);
																				?></td>
												</tr>
									<?php $i++;
											}
										}
									} ?>
									<tr>
										<td></td>
										<td><b>Total Fees</b></td>
										<td class="border-bottom"><b><?= number_format($totalamount, 2) ?></b></td>
									</tr>
									<tr>
										<td></td>
										<td><b>Delay Fees(*)</b></td>
										<td><b><?= number_format($totalfine, 2) ?></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table>
									<tr>
										<td class="border-top"><b>Total Amount Paid: INR <?= number_format($totalamount, 2) ?> /-</b></td>
									</tr>
									<tr>
										<td><b>Rs. <?= convert_number($totalamount) ?> Only.</b></td>
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
										<td><?= number_format($totalweaver, 2) ?></td>
									</tr>
									<tr>
										<td><b>Total Due:</b></td>
										<td>INR</td>
										<td>0</td>
									</tr>
									<tr>
										<td><b>Total Other Fees Paid:</b></td>
										<td>INR</td>
										<td><?= number_format($totalsubtotal, 2) ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 1px solid #000;">
								<table width="100%">
									<tr>
										<td><b>Payment Mode : <?= $paymenttype ?></b></td>
									</tr>
									<tr>
										<td><b>Transaction Details: Rec.No. <?= $globalpayment->globalpaymentID ?></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid #ddd;">
								<b>Note :</b> Fees once paid will not be refunded. This receipt should be produce at any time if required for verification by the School
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td>Admin Officer</td>
										<td>0</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

				</td>
				<td style="border-left: 1px dotted #000;">

				</td>
				<td style="border: 1px solid #000;">
				<table width="100%">
						<tr>
							<td class="border-bottom">
								<table width="100%">
									<tr>
										<td>
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
										<td class="pull-center" style="font-size: 12px;font-weight:bold;">
											SHRI BALAJI ENGLISH PRIMARY <br />& SECONDARY SCHOOL <br />WADEGAON
										</td>
									</tr>
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
								<b>[2019-2020]</b>
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td class="pull-left">
											<?= date("d M Y H:i:s") ?>
										</td>
										<td>
											Receipt No.: <?= $globalpayment->globalpaymentID ?>
										</td>
									</tr>
									<tr>
										<td>
											Name: <?php echo $studentrelation->srname; ?>
										</td>
										<td>
											Class: <?= $studentrelation->srclasses ?>
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
									<?php $totalamount = 0;
									$totalamount = 0;
									$totalweaver = 0;
									$totalfine = 0;
									$totalsubtotal = 0;
									$paymentDate = date('Y-m-d');
									$paymentUserTypeID = 0;
									$paymentUserID = 0;
									$i = 1;
									if (customCompute($payments)) {
										foreach ($payments as $payment) {
											if ($payment->paymentamount != '' || (isset($weaverandfines[$payment->paymentID]))) {
												$paymentDate = $payment->paymentdate;
												$paymentUserTypeID = $payment->usertypeID;
												$paymentUserID = $payment->userID;  ?>
												<tr>
													<td class="border-bottom"><?php echo $i; ?></td>
													<td class="border-bottom"><?php
																				if (isset($invoices[$payment->invoiceID])) {
																					if (isset($feetypes[$invoices[$payment->invoiceID]->feetypeID])) {
																						echo $feetypes[$invoices[$payment->invoiceID]->feetypeID];
																					}
																				}
																				?></td>
													<td class="border-bottom"><?php
																				$totalamount += $payment->paymentamount;
																				echo number_format($payment->paymentamount, 2);
																				?></td>
												</tr>
									<?php $i++;
											}
										}
									} ?>
									<tr>
										<td></td>
										<td><b>Total Fees</b></td>
										<td class="border-bottom"><b><?= number_format($totalamount, 2) ?></b></td>
									</tr>
									<tr>
										<td></td>
										<td><b>Delay Fees(*)</b></td>
										<td><b><?= number_format($totalfine, 2) ?></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table>
									<tr>
										<td class="border-top"><b>Total Amount Paid: INR <?= number_format($totalamount, 2) ?> /-</b></td>
									</tr>
									<tr>
										<td><b>Rs. <?= convert_number($totalamount) ?> Only.</b></td>
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
										<td><?= number_format($totalweaver, 2) ?></td>
									</tr>
									<tr>
										<td><b>Total Due:</b></td>
										<td>INR</td>
										<td>0</td>
									</tr>
									<tr>
										<td><b>Total Other Fees Paid:</b></td>
										<td>INR</td>
										<td><?= number_format($totalsubtotal, 2) ?></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border: 1px solid #000;">
								<table width="100%">
									<tr>
										<td><b>Payment Mode : <?= $paymenttype ?></b></td>
									</tr>
									<tr>
										<td><b>Transaction Details: Rec.No. <?= $globalpayment->globalpaymentID ?></b></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid #ddd;">
								<b>Note :</b> Fees once paid will not be refunded. This receipt should be produce at any time if required for verification by the School
							</td>
						</tr>
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td>Admin Officer</td>
										<td>0</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		
	</div>
</body>

</html>