<div class="box dash-card">
    <div class="box-header"><h3 class="box-title"><i class="fa fa-calendar-check-o"></i> Upcoming events &amp; holidays</h3></div>
    <div class="box-body dash-list-body">
        <?php if (customCompute($widgetUpcoming)) { ?>
            <ul class="dash-list">
                <?php foreach ($widgetUpcoming as $item) {
                    $from = strtotime($item->fdate);
                    $to   = strtotime($item->tdate);
                    $isToday = $item->fdate <= date('Y-m-d');
                ?>
                    <li>
                        <a href="<?=base_url($item->link)?>" class="dash-list__item">
                            <span class="dash-list__date dash-list__date--<?=$item->type?>"><strong><?=date('d', $from)?></strong><?=date('M', $from)?></span>
                            <span class="dash-list__body">
                                <strong><?=htmlspecialchars(namesorting(strip_tags($item->title), 48))?></strong>
                                <small>
                                    <?=$item->type == 'holiday' ? 'Holiday' : 'Event'?>
                                    &middot; <?=$from == $to ? date('D, j M', $from) : date('j M', $from).' – '.date('j M', $to)?>
                                    <?php if ($isToday) { ?><span class="dash-pill">Ongoing</span><?php } ?>
                                </small>
                            </span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p class="dash-empty"><i class="fa fa-calendar-o"></i><br>Nothing scheduled ahead.</p>
        <?php } ?>
    </div>
</div>
