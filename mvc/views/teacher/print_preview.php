<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
</head>

<body>
  <table width="100%" class="testimonial">
    <tr>
      <td>
        <table width="100%">
          <tr>
            <td rowspan="5">
              <img width="200px" src="<?= base_url('uploads/images/' . $siteinfos->photo) ?>"></span>
            </td>
            <td class="center-text f-10">Shri Balaji Yuvak Krida Mandal, Wadegaon (Reg. No. F2451)
            </td>
            <td rowspan="5">
              <img class="studentImg" src="<?= pdfimagelink($teacher->photo) ?>" alt="">
            </td>
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
              Register No - शा. सा. आदेश .नमाशा -1004 / (407/04) दि. 21/07/2004
            </td>
          </tr>
          <tr>
            <td class="center-text  f-10">
              Udise No - 27050308508 / 27050308509
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%" class="table table-bordered ">
          <tr>
            <td><?= $this->lang->line('teacher_name') ?></td>
            <td>: <?= $teacher->name ?></td>
          </tr>
          <tr>
            <td><?= $this->lang->line('teacher_designation') ?></td>
            <td>: <?= $teacher->designation ?>
            </td>
          </tr>
          <tr>
            <td><?= $this->lang->line('teacher_sex') ?></td>
            <td>: <?= $teacher->sex ?></td>
          </tr>
          <tr>
            <td><?= $this->lang->line('teacher_dob') ?></td>
            <td>: <?php if ($teacher->dob) {
                    echo date("d M Y", strtotime($teacher->dob));
                  } ?></td>
          </tr>
          <tr>
            <td><?= $this->lang->line('teacher_phone') ?></td>
            <td>: <?= $teacher->phone ?></td>
          </tr>
          <tr>
            <td><?= $this->lang->line('teacher_cast') ?></td>
            <td width="70%"><?= $teacher->cast ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_category') ?></td>
            <td width="70%"><?= $teacher->category ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_aadhar') ?></td>
            <td width="70%"><?= $teacher->aadhar ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_uan') ?></td>
            <td width="70%"><?= $teacher->uan ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_epfo') ?></td>
            <td width="70%"><?= $teacher->epfo ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_education') ?></td>
            <td width="70%"><?= $teacher->education ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_pan') ?></td>
            <td width="70%"><?= $teacher->pan ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_bank_name') ?></td>
            <td width="70%"><?= $teacher->bank_name ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_branch_name') ?></td>
            <td width="70%"><?= $teacher->branch_name ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_account_name') ?></td>
            <td width="70%"><?= $teacher->account_name ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_ifsc') ?></td>
            <td width="70%"><?= $teacher->ifsc ?></td>
          </tr>


          <tr>
            <td width="30%"><?= $this->lang->line('teacher_jod') ?></td>
            <td width="70%"><?php if ($teacher->jod) {
                              echo date("d M Y", strtotime($teacher->jod));
                            } ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_religion') ?></td>
            <td width="70%"><?= $teacher->religion ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_email') ?></td>
            <td width="70%"><?= $teacher->email ?></td>
          </tr>
          <tr>
            <td width="30%"><?= $this->lang->line('teacher_address') ?></td>
            <td width="70%"><?= $teacher->address ?></td>
          </tr>
          <tr>
            <td width="30%">Leaving Date</td>
            <td width="70%"><?= $teacher->leaving_date ?></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>