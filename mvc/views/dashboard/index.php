<div class="row">
    <?php if(config_item('demo')) { ?>
        <div class="col-sm-12" id="resetDummyData">
            <div class="callout callout-danger">
                <h4>Reminder!</h4>
                <p>Dummy data will be reset in every <code>30</code> minutes</p>
            </div>
        </div>

        <script type="text/javascript"> 
            $(document).ready(function() {
                var count = 7;
                var countdown = setInterval(function(){
                    $("p.countdown").html(count + " seconds remaining!");
                    if (count == 0) {
                        clearInterval(countdown);
                        $('#resetDummyData').hide();
                    }
                    count--;
                }, 1000);
            });
        </script>
    <?php } ?>

    <?php if((config_item('demo') === FALSE) && ($siteinfos->auto_update_notification == 1) && ($versionChecking != 'none')) { ?>
        <?php if($this->session->userdata('updatestatus') === null) { ?>
            <div class="col-sm-12" id="updatenotify">
                <div class="callout callout-success">
                    <h4>Dear Admin</h4>
                    <p>INIlabs school management system has released a new update.</p>
                    <p>Do you want to update it now <?=config_item('ini_version')?> to <?=$versionChecking?> ?</p>
                    <a href="<?=base_url('dashboard/remind')?>" class="btn btn-danger">Remind me</a>
                    <a href="<?=base_url('dashboard/update')?>" class="btn btn-success">Update</a>
                </div>
            </div>
        <?php } ?> 
    <?php } ?>

    <?php
        $arrayColor = array(
            'bg-orange-dark',
            'bg-teal-light',
            'bg-pink-light',
            'bg-purple-light'
        );

        function allModuleArray($usertypeID, $dashboardWidget) {
          $userAllModuleArray = array(
            $usertypeID => array(
                'student'   => $dashboardWidget['students'],
                'classes'   => $dashboardWidget['classes'],
                'teacher'   => $dashboardWidget['teachers'],
                // 'parents'   => $dashboardWidget['parents'],
                'subject'   => $dashboardWidget['subjects'],
                'book'     => $dashboardWidget['books'],
                'feetypes'  => $dashboardWidget['feetypes'],
                'lmember'   => $dashboardWidget['lmembers'],
                'event'     => $dashboardWidget['events'],
                'issue'     => $dashboardWidget['issues'],
                'holiday'   => $dashboardWidget['holidays'],
                'invoice'   => $dashboardWidget['invoices'],
            )
          );
          return $userAllModuleArray;
        }

        $userArray = array(
            '1' => array(
                'student'   => $dashboardWidget['students'],
                'teacher'   => $dashboardWidget['teachers'],
                // 'parents'   => $dashboardWidget['parents'],
                'subject'   => $dashboardWidget['subjects']
            ),
            '2' => array(
                'student'   => $dashboardWidget['students'],
                'teacher'   => $dashboardWidget['teachers'],
                'classes'   => $dashboardWidget['classes'],
                'subject'   => $dashboardWidget['subjects'],
            ),
            '3' => array(
                'teacher'   => $dashboardWidget['teachers'],
                'subject'   => $dashboardWidget['subjects'],
                'issue'     => $dashboardWidget['issues'],
                'invoice'   => $dashboardWidget['invoices'],
            ),
            '4' => array(
                'teacher'   => $dashboardWidget['teachers'],
                'book'     => $dashboardWidget['books'],
                'event'     => $dashboardWidget['events'],
                'holiday'   => $dashboardWidget['holidays'],
            ),
            '5' => array(
                'teacher'   => $dashboardWidget['teachers'],
                'parents'   => $dashboardWidget['parents'],
                'feetypes'  => $dashboardWidget['feetypes'],
                'invoice'   => $dashboardWidget['invoices'],
            ),
            '6' => array(
                'teacher'   => $dashboardWidget['teachers'],
                'lmember'   => $dashboardWidget['lmembers'],
                'book'      => $dashboardWidget['books'],
                'issue'     => $dashboardWidget['issues'],
            ),
            '7' => array(
                'teacher'       => $dashboardWidget['teachers'],
                'event'         => $dashboardWidget['events'],
                'holiday'       => $dashboardWidget['holidays'],
                'visitorinfo'  => $dashboardWidget['visitors'],
            ),
        );

        $generateBoxArray = array();
        $counter = 0;
        $getActiveUserID = $this->session->userdata('usertypeID');
        $getAllSessionDatas = $this->session->userdata('master_permission_set');
        foreach ($getAllSessionDatas as $getAllSessionDataKey => $getAllSessionData) {
            if($getAllSessionData == 'yes') {
                if(isset($userArray[$getActiveUserID][$getAllSessionDataKey])) {
                    if($counter == 4) {
                      break;
                    }

                    $generateBoxArray[$getAllSessionDataKey] = array(
                        'icon' => $dashboardWidget['allmenu'][$getAllSessionDataKey],
                        'color' => $arrayColor[$counter],
                        'link' => $getAllSessionDataKey,
                        'count' => $userArray[$getActiveUserID][$getAllSessionDataKey],
                        'menu' => $dashboardWidget['allmenulang'][$getAllSessionDataKey],
                    );
                    $counter++;
                }

            }
        }

        $icon = '';
        $menu = '';
        if($counter < 4) {
            $userArray = allModuleArray($getActiveUserID, $dashboardWidget);
            foreach ($getAllSessionDatas as $getAllSessionDataKey => $getAllSessionData) {
                if($getAllSessionData == 'yes') {
                    if(isset($userArray[$getActiveUserID][$getAllSessionDataKey])) {
                        if($counter == 4) {
                            break;
                        }

                        if(!isset($generateBoxArray[$getAllSessionDataKey])) {
                            $generateBoxArray[$getAllSessionDataKey] = array(
                                'icon' => $dashboardWidget['allmenu'][$getAllSessionDataKey],
                                'color' => $arrayColor[$counter],
                                'link' => $getAllSessionDataKey,
                                'count' => $userArray[$getActiveUserID][$getAllSessionDataKey],
                                'menu' => $dashboardWidget['allmenulang'][$getAllSessionDataKey]
                            );
                            $counter++;
                        }
                    }
                }
            }
        }

        $isManager = in_array($getActiveUserID, array(1, 5));
        $currency  = $siteinfos->currency_code;
        $hour      = (int) date('G');
        $greeting  = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');

        $quickActions = array();
        foreach (array(
            array('student_add',    'student/add',    'fa-user-plus',         'Add student'),
            array('sattendance_add','sattendance/add','fa-check-square-o',    'Take attendance'),
            array('invoice_add',    'invoice/add',    'fa-file-text-o',       'Create invoice'),
            array('mark_add',       'mark/add',       'fa-pencil-square-o',   'Enter marks'),
            array('notice_add',     'notice/add',     'fa-bullhorn',          'Post notice'),
            array('event_add',      'event/add',      'fa-calendar-plus-o',   'Add event'),
        ) as $action) {
            if (permissionChecker($action[0])) {
                $quickActions[] = $action;
            }
        }
?>
</div>

<!-- Welcome banner -->
<div class="dash-hero">
    <div class="dash-hero__text">
        <p class="dash-hero__date"><i class="fa fa-calendar-o"></i> <?=date('l, j F Y')?></p>
        <h1><?=$greeting?>, <?=htmlspecialchars(customCompute($user) ? $user->name : $this->session->userdata('name'))?></h1>
        <p><?=htmlspecialchars($usertype)?> &middot; <?=htmlspecialchars($siteinfos->sname)?></p>
    </div>
    <?php if (customCompute($quickActions)) { ?>
        <div class="dash-hero__actions">
            <?php foreach ($quickActions as $action) { ?>
                <a class="dash-action" href="<?=base_url($action[1])?>"><i class="fa <?=$action[2]?>"></i><span><?=$action[3]?></span></a>
            <?php } ?>
        </div>
    <?php } ?>
</div>

<!-- Key numbers -->
<div class="row dash-row">
    <?php if (customCompute($generateBoxArray)) { foreach ($generateBoxArray as $generateBoxValue) { ?>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box">
                <a class="small-box-footer <?=$generateBoxValue['color']?>" href="<?=base_url($generateBoxValue['link'])?>">
                    <div class="icon <?=$generateBoxValue['color']?>"><i class="fa <?=$generateBoxValue['icon']?>"></i></div>
                    <div class="inner">
                        <h3 class="text-white"><?=$generateBoxValue['count']?></h3>
                        <p class="text-white"><?=$this->lang->line('menu_'.$generateBoxValue['menu'])?></p>
                    </div>
                </a>
            </div>
        </div>
    <?php } } ?>
</div>

<?php if ($isManager || $getActiveUserID == 2) { ?>
<!-- Today at a glance -->
<div class="row dash-row">
    <div class="col-md-4 col-sm-6">
        <div class="box dash-card">
            <div class="box-header"><h3 class="box-title"><i class="fa fa-check-square-o"></i> Today's attendance</h3>
                <?php if (permissionChecker('sattendance')) { ?><a class="dash-link" href="<?=base_url('sattendance/index')?>">View all</a><?php } ?>
            </div>
            <div class="box-body">
                <?php $att = $widgetAttendance; ?>
                <div class="dash-ring-wrap">
                    <div class="dash-ring" style="--value: <?=$att['rate']?>;"><span><strong><?=$att['marked'] ? $att['rate'].'%' : '—'?></strong><small>present</small></span></div>
                    <ul class="dash-legend">
                        <li><i class="dot dot--green"></i> Present <strong><?=$att['present']?></strong></li>
                        <li><i class="dot dot--red"></i> Absent <strong><?=$att['absent']?></strong></li>
                        <li><i class="dot dot--grey"></i> Not marked <strong><?=max(0, $att['total'] - $att['marked'])?></strong></li>
                    </ul>
                </div>
                <?php if (!$att['marked']) { ?>
                    <p class="dash-note"><i class="fa fa-info-circle"></i> Attendance hasn't been taken yet today.</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php if ($isManager) { ?>
    <div class="col-md-4 col-sm-6">
        <div class="box dash-card">
            <div class="box-header"><h3 class="box-title"><i class="fa fa-inr"></i> Fee invoices</h3>
                <?php if (permissionChecker('invoice')) { ?><a class="dash-link" href="<?=base_url('invoice/index')?>">View all</a><?php } ?>
            </div>
            <div class="box-body">
                <?php
                    $inv = $widgetInvoices;
                    $pct = function ($n) use ($inv) { return $inv['total'] ? round($n * 100 / $inv['total'], 1) : 0; };
                ?>
                <div class="dash-figure"><strong><?=$inv['total']?></strong><span>invoices this academic year</span></div>
                <div class="dash-stack" role="img" aria-label="<?=$inv['paid']?> paid, <?=$inv['partial']?> partially paid, <?=$inv['unpaid']?> unpaid">
                    <span class="seg seg--green" style="width: <?=$pct($inv['paid'])?>%"></span>
                    <span class="seg seg--amber" style="width: <?=$pct($inv['partial'])?>%"></span>
                    <span class="seg seg--red" style="width: <?=$pct($inv['unpaid'])?>%"></span>
                </div>
                <ul class="dash-legend dash-legend--row">
                    <li><i class="dot dot--green"></i> Paid <strong><?=$inv['paid']?></strong></li>
                    <li><i class="dot dot--amber"></i> Partial <strong><?=$inv['partial']?></strong></li>
                    <li><i class="dot dot--red"></i> Unpaid <strong><?=$inv['unpaid']?></strong></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="box dash-card">
            <div class="box-header"><h3 class="box-title"><i class="fa fa-line-chart"></i> <?=date('F')?> finances</h3></div>
            <div class="box-body">
                <div class="dash-money">
                    <div class="dash-money__item">
                        <span class="dash-money__icon dash-money__icon--in"><i class="fa fa-arrow-down"></i></span>
                        <div><small>Collected</small><strong><?=$currency?> <?=number_format($widgetMonth['income'], 2)?></strong></div>
                    </div>
                    <div class="dash-money__item">
                        <span class="dash-money__icon dash-money__icon--out"><i class="fa fa-arrow-up"></i></span>
                        <div><small>Spent</small><strong><?=$currency?> <?=number_format($widgetMonth['expense'], 2)?></strong></div>
                    </div>
                </div>
                <?php $net = $widgetMonth['income'] - $widgetMonth['expense']; ?>
                <p class="dash-net <?=$net < 0 ? 'is-negative' : ''?>">Net this month: <strong><?=$net < 0 ? '−' : ''?><?=$currency?> <?=number_format(abs($net), 2)?></strong></p>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-md-8 col-sm-6">
        <?php $this->load->view('dashboard/widgets_upcoming'); ?>
    </div>
    <?php } ?>
</div>
<?php } ?>

<?php if ($isManager) { ?>
<div class="row dash-row">
    <div class="col-sm-12">
        <div class="box dash-card">
            <div class="box-body dash-chart"><div id="earningGraph"></div></div>
        </div>
    </div>
</div>

<div class="row dash-row">
    <div class="col-md-8">
        <div class="box dash-card">
            <div class="box-body dash-chart"><div id="attendanceGraph"></div></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box dash-card">
            <div class="box-header"><h3 class="box-title"><i class="fa fa-users"></i> Students</h3>
                <?php if (permissionChecker('student')) { ?><a class="dash-link" href="<?=base_url('student/index')?>">View all</a><?php } ?>
            </div>
            <div class="box-body">
                <?php
                    $g = $widgetGender;
                    $gTotal = array_sum($g);
                    $gPct = function ($n) use ($gTotal) { return $gTotal ? round($n * 100 / $gTotal) : 0; };
                ?>
                <div class="dash-gender">
                    <div><i class="fa fa-male"></i><strong><?=$g['Male']?></strong><small>Boys &middot; <?=$gPct($g['Male'])?>%</small></div>
                    <div><i class="fa fa-female"></i><strong><?=$g['Female']?></strong><small>Girls &middot; <?=$gPct($g['Female'])?>%</small></div>
                </div>
                <?php if ($g['Other']) { ?>
                    <p class="dash-note"><i class="fa fa-info-circle"></i> <?=$g['Other']?> student<?=$g['Other'] == 1 ? '' : 's'?> without gender recorded.</p>
                <?php } ?>
                <h4 class="dash-subtitle">Class strength</h4>
                <?php if (customCompute($widgetClassStrength)) {
                    $maxClass = max(array_map(function ($c) { return $c['count']; }, $widgetClassStrength)); ?>
                    <ul class="dash-bars">
                        <?php foreach ($widgetClassStrength as $c) { ?>
                            <li>
                                <span class="dash-bars__label"><?=htmlspecialchars($c['name'])?></span>
                                <span class="dash-bars__track"><span style="width: <?=round($c['count'] * 100 / $maxClass)?>%"></span></span>
                                <strong><?=$c['count']?></strong>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p class="dash-empty">No students in this academic year yet.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php $upcomingBelow = ($getActiveUserID != 2); ?>
<div class="row dash-row">
    <?php if ($upcomingBelow) { ?>
        <div class="col-md-4 col-sm-6">
            <?php $this->load->view('dashboard/widgets_upcoming'); ?>
        </div>
    <?php } ?>

    <?php if (permissionChecker('notice')) { ?>
    <div class="<?=$upcomingBelow ? 'col-md-4 col-sm-6' : 'col-md-8'?>">
        <div class="box dash-card">
            <div class="box-header"><h3 class="box-title"><i class="fa fa-bullhorn"></i> <?=$this->lang->line('dashboard_notice')?></h3>
                <a class="dash-link" href="<?=base_url('notice/index')?>">View all</a>
            </div>
            <div class="box-body dash-list-body">
                <?php if (customCompute($notices)) { ?>
                    <ul class="dash-list">
                        <?php foreach (array_slice($notices, 0, 5) as $notice) { ?>
                            <li>
                                <a href="<?=base_url('notice/view/'.$notice->noticeID)?>" class="dash-list__item">
                                    <span class="dash-list__date"><strong><?=date('d', strtotime($notice->date))?></strong><?=date('M', strtotime($notice->date))?></span>
                                    <span class="dash-list__body">
                                        <strong><?=htmlspecialchars(namesorting(strip_tags($notice->title), 48))?></strong>
                                        <small><?=htmlspecialchars(namesorting(strip_tags($notice->notice), 80))?></small>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p class="dash-empty">No notices yet.</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="<?=$upcomingBelow ? 'col-md-4 col-sm-12' : 'col-md-4'?>">
        <div class="box dash-card">
            <div class="box-header"><h3 class="box-title"><i class="fa fa-birthday-cake"></i> Birthdays today</h3></div>
            <div class="box-body dash-list-body">
                <?php if (customCompute($widgetBirthdays)) { ?>
                    <ul class="dash-people">
                        <?php foreach (array_slice($widgetBirthdays, 0, 8) as $b) { ?>
                            <li><img src="<?=imagelink($b->photo)?>" alt=""><span><strong><?=htmlspecialchars($b->name)?></strong><small><?=htmlspecialchars($b->class)?></small></span><i class="fa fa-gift"></i></li>
                        <?php } ?>
                    </ul>
                    <?php if (count($widgetBirthdays) > 8) { ?><p class="dash-note">+<?=count($widgetBirthdays) - 8?> more</p><?php } ?>
                <?php } else { ?>
                    <p class="dash-empty"><i class="fa fa-birthday-cake"></i><br>No student birthdays today.</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="row dash-row">
    <div class="col-md-4">
        <?php if (customCompute($user)) { ?>
            <div class="box dash-card dash-profile">
                <div class="dash-profile__head">
                    <a href="<?=base_url('profile/index')?>"><img src="<?=imagelink($user->photo)?>" alt=""></a>
                    <div><strong><?=htmlspecialchars($user->name)?></strong><small><?=htmlspecialchars($usertype)?></small></div>
                </div>
                <ul class="dash-profile__list">
                    <li><i class="fa fa-user"></i><span><?=$this->lang->line('dashboard_username')?></span><strong><?=htmlspecialchars($user->username)?></strong></li>
                    <li><i class="fa fa-envelope-o"></i><span><?=$this->lang->line('dashboard_email')?></span><strong><?=htmlspecialchars($user->email)?></strong></li>
                    <li><i class="fa fa-phone"></i><span><?=$this->lang->line('dashboard_phone')?></span><strong><?=htmlspecialchars($user->phone)?></strong></li>
                    <li><i class="fa fa-map-marker"></i><span><?=$this->lang->line('dashboard_address')?></span><strong><?=htmlspecialchars($user->address)?></strong></li>
                </ul>
                <div class="dash-profile__foot">
                    <a class="btn btn-default btn-sm" href="<?=base_url('profile/index')?>"><i class="fa fa-user"></i> My profile</a>
                    <a class="btn btn-default btn-sm" href="<?=base_url('signin/cpassword')?>"><i class="fa fa-lock"></i> Change password</a>
                </div>
            </div>
        <?php } ?>
        <?php if ($isManager) { ?>
            <div class="box dash-card">
                <div class="box-body dash-chart"><div id="visitor"></div></div>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-8">
        <div class="box dash-card">
            <div class="box-header"><h3 class="box-title"><i class="fa fa-calendar"></i> School calendar</h3></div>
            <div class="box-body"><div id="calendar"></div></div>
        </div>
    </div>
</div>

<?php
    if($attendanceSystem != 'subject') {
        $this->load->view("dashboard/AttendanceHighChartJavascript");
    } else {
        $this->load->view("dashboard/SubjectWiseAttendanceHighChartJavascript");
    }
?>
<?php $this->load->view("dashboard/EarningHighChartJavascript.php"); ?>
<?php $this->load->view("dashboard/CalenderJavascript"); ?>
<?php $this->load->view("dashboard/VisitorHighChartJavascript"); ?>
