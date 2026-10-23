<?php
$activePage = 'home';
include("inc/head.php");
include("inc/header.php");
include("inc/nav.php");
?>
<main id="main">

    <!-- Hero -->
    <section class="hero" aria-roledescription="carousel" aria-label="Highlights" data-hero>
        <div class="hero__slides">
            <?php foreach ($heroSlides as $i => $slide) { ?>
                <article class="hero__slide<?= isset($slide['layout']) ? ' hero__slide--' . e($slide['layout']) : '' ?><?= $i === 0 ? ' is-active' : '' ?>" aria-roledescription="slide" aria-label="<?= $i + 1 ?> of <?= count($heroSlides) ?>"<?= $i === 0 ? '' : ' aria-hidden="true"' ?> data-hero-slide>
                    <img class="hero__img" src="<?= e($slide['image']) ?>"<?= isset($slide['position']) ? ' style="object-position: ' . e($slide['position']) . '"' : '' ?> alt="" <?= $i === 0 ? 'fetchpriority="high"' : 'loading="lazy"' ?>>
                    <div class="container hero__content">
                        <span class="eyebrow eyebrow--light"><i class="ri-government-line" aria-hidden="true"></i> Est. <?= e($school['founded']) ?> &middot; <?= e($school['place']) ?></span>
                        <?php if ($i === 0) { ?>
                            <h1 class="hero__title"><?= e($slide['title']) ?></h1>
                        <?php } else { ?>
                            <h2 class="hero__title"><?= e($slide['title']) ?></h2>
                        <?php } ?>
                        <p class="hero__text"><?= e($slide['text']) ?></p>
                        <div class="hero__actions">
                            <a class="btn btn--gold btn--lg" href="contact-us.php">Start your journey <i class="ri-arrow-right-line" aria-hidden="true"></i></a>
                            <a class="btn btn--glass btn--lg" href="<?= e($school['prospectus']) ?>" target="_blank" rel="noopener"><i class="ri-file-download-line" aria-hidden="true"></i> Prospectus</a>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>

        <div class="container hero__controls">
            <div class="hero__dots" role="tablist" aria-label="Choose slide">
                <?php foreach ($heroSlides as $i => $slide) { ?>
                    <button class="hero__dot<?= $i === 0 ? ' is-active' : '' ?>" type="button" role="tab" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" data-hero-dot="<?= $i ?>">
                        <span class="hero__dot-bar"><span></span></span>
                        <span class="hero__dot-label"><?= e($slide['tag']) ?></span>
                    </button>
                <?php } ?>
            </div>
            <div class="hero__arrows">
                <button class="icon-btn icon-btn--glass" type="button" aria-label="Previous slide" data-hero-prev><i class="ri-arrow-left-line" aria-hidden="true"></i></button>
                <button class="icon-btn icon-btn--glass" type="button" aria-label="Next slide" data-hero-next><i class="ri-arrow-right-line" aria-hidden="true"></i></button>
            </div>
        </div>
    </section>

    <!-- Quick facts strip -->
    <section class="facts" aria-label="Quick facts">
        <div class="container facts__grid">
            <div class="fact"><i class="ri-government-line" aria-hidden="true"></i><div><strong>Nursery to 10th</strong><span>Full English medium</span></div></div>
            <div class="fact"><i class="ri-shield-check-line" aria-hidden="true"></i><div><strong>Government approved</strong><span>Recognised since 2004</span></div></div>
            <div class="fact"><i class="ri-computer-line" aria-hidden="true"></i><div><strong>Free computer lab</strong><span>&amp; digital classroom</span></div></div>
            <div class="fact"><i class="ri-football-line" aria-hidden="true"></i><div><strong>Spacious playground</strong><span>State-level athletes</span></div></div>
        </div>
    </section>

    <!-- Institutes -->
    <section class="section" id="institutes">
        <div class="container">
            <div class="section-head section-head--center reveal">
                <span class="eyebrow">Our institutes</span>
                <h2 class="section-title">Government approved institutes run by <?= e($school['trust']) ?></h2>
            </div>
            <div class="cards-3">
                <?php foreach ($institutes as $i => $inst) { ?>
                    <article class="inst-card reveal" style="--delay: <?= $i * 90 ?>ms">
                        <div class="inst-card__icon"><i class="<?= e($inst['icon']) ?>" aria-hidden="true"></i></div>
                        <h3><?= e($inst['title']) ?></h3>
                        <p><?= e($inst['name']) ?></p>
                        <span class="badge"><i class="ri-award-line" aria-hidden="true"></i> Recognition &mdash; <?= e($inst['year']) ?></span>
                    </article>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- About / Campus -->
    <section class="section section--tint" id="about">
        <div class="container about">
            <div class="about__media reveal">
                <img src="assets/images/opt/campus.jpg" alt="Shri Balaji English Primary & Secondary School building, Wadegaon" loading="lazy">
                <div class="about__badge">
                    <strong><?= e($school['founded']) ?></strong>
                    <span>Founded by<br><?= e($school['trust']) ?></span>
                </div>
            </div>
            <div class="about__body reveal">
                <span class="eyebrow">Campus information</span>
                <h2 class="section-title">A caring, child-centred English medium school for rural Wadegaon</h2>
                <p class="lead"><?= e($school['about']) ?></p>

                <ul class="facility-grid">
                    <?php foreach ($facilities as $f) { ?>
                        <li><span class="facility-grid__icon"><i class="<?= e($f['icon']) ?>" aria-hidden="true"></i></span><?= e($f['text']) ?></li>
                    <?php } ?>
                </ul>

                <dl class="stats">
                    <?php foreach ($stats as $s) { ?>
                        <div class="stat">
                            <dt><?= e($s['label']) ?></dt>
                            <dd><span data-count="<?= (int) $s['value'] ?>"><?= (int) $s['value'] ?></span><?= e($s['suffix']) ?></dd>
                        </div>
                    <?php } ?>
                </dl>

                <a class="btn btn--primary btn--lg" href="contact-us.php">Start your application <i class="ri-arrow-right-line" aria-hidden="true"></i></a>
            </div>
        </div>
    </section>

    <!-- Achievements -->
    <section class="section" id="achievements">
        <div class="container">
            <div class="section-head section-head--split reveal">
                <div>
                    <span class="eyebrow">Sports Bharari</span>
                    <h2 class="section-title">Our champions on the field</h2>
                    <p class="muted">Students who represented the school at state and division level competitions.</p>
                </div>
                <?php $years = array_values(array_unique(array_column($achievements['division'], 'year'))); ?>
                <div class="chips" role="group" aria-label="Filter by year" data-filter-group>
                    <button class="chip is-active" type="button" aria-pressed="true" data-filter="all">All years</button>
                    <?php foreach ($years as $y) { ?>
                        <button class="chip" type="button" aria-pressed="false" data-filter="<?= e($y) ?>"><?= e($y) ?></button>
                    <?php } ?>
                </div>
            </div>

            <?php foreach ($achievements['state'] as $a) { ?>
                <article class="champion reveal">
                    <div class="champion__icon"><i class="ri-trophy-line" aria-hidden="true"></i></div>
                    <div class="champion__body">
                        <span class="badge badge--gold">State level</span>
                        <h3><?= e($a['name']) ?></h3>
                        <p><?= e($a['sport']) ?> &middot; <?= e($a['year']) ?></p>
                    </div>
                </article>
            <?php } ?>

            <h3 class="subhead reveal">Division level</h3>
            <ul class="achieve-grid" data-filter-list>
                <?php foreach ($achievements['division'] as $a) { ?>
                    <li class="achieve reveal" data-year="<?= e($a['year']) ?>">
                        <span class="achieve__icon"><i class="ri-medal-line" aria-hidden="true"></i></span>
                        <div>
                            <strong><?= e($a['name']) ?></strong>
                            <span><?= e($a['sport']) ?></span>
                        </div>
                        <span class="achieve__year"><?= e($a['year']) ?></span>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>

    <!-- Leadership -->
    <section class="section section--tint" id="leadership">
        <div class="container">
            <div class="section-head section-head--center reveal">
                <span class="eyebrow">Leadership</span>
                <h2 class="section-title">Principal &amp; Supervisor</h2>
            </div>
            <div class="cards-3">
                <?php foreach ($leaders as $i => $p) { ?>
                    <article class="leader reveal" style="--delay: <?= $i * 90 ?>ms">
                        <div class="leader__photo"><img src="<?= e($p['photo']) ?>" alt="<?= e($p['name']) ?>" loading="lazy"></div>
                        <div class="leader__body">
                            <span class="badge"><?= e($p['role']) ?></span>
                            <h3><?= e($p['name']) ?></h3>
                            <p class="muted"><?= e($p['qual']) ?> &middot; Higher Primary &amp; Secondary</p>
                            <a class="leader__call" href="tel:+91<?= e($p['phone']) ?>"><i class="ri-phone-line" aria-hidden="true"></i> <?= e($p['phone']) ?></a>
                        </div>
                    </article>
                <?php } ?>
            </div>

            <div class="section-head section-head--center reveal mt-xl">
                <span class="eyebrow">Our management</span>
                <h2 class="section-title"><?= e($school['trust']) ?></h2>
            </div>
            <ul class="people">
                <?php foreach ($management as $i => $m) { ?>
                    <li class="person reveal" style="--delay: <?= ($i % 5) * 60 ?>ms">
                        <div class="person__photo"><img src="<?= e($m['photo']) ?>" alt="<?= e($m['name']) ?>" loading="lazy"></div>
                        <strong><?= e($m['name']) ?></strong>
                        <span><?= e($m['role']) ?></span>
                    </li>
                <?php } ?>
            </ul>

            <div class="section-head section-head--center reveal mt-xl">
                <span class="eyebrow">Office staff</span>
                <h2 class="section-title">We're here to help</h2>
            </div>
            <ul class="staff">
                <?php foreach ($officeStaff as $s) { ?>
                    <li class="staff__item reveal">
                        <span class="avatar" aria-hidden="true"><?= e(initials($s['name'])) ?></span>
                        <div>
                            <strong><?= e($s['name']) ?></strong>
                            <span>Higher Primary &amp; Secondary</span>
                        </div>
                        <a class="icon-btn" href="tel:+91<?= e($s['phone']) ?>" aria-label="Call <?= e($s['name']) ?> on <?= e($s['phone']) ?>" title="<?= e($s['phone']) ?>"><i class="ri-phone-line" aria-hidden="true"></i></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="container cta__inner reveal">
            <div>
                <h2>Admissions &amp; enquiries</h2>
                <p>Visit our campus in <?= e($school['place']) ?> or reach the school office — we'd love to meet you.</p>
            </div>
            <div class="cta__actions">
                <a class="btn btn--gold btn--lg" href="contact-us.php">Contact the office <i class="ri-arrow-right-line" aria-hidden="true"></i></a>
                <a class="btn btn--glass btn--lg" href="tel:<?= e($contact['phones'][0]['tel']) ?>"><i class="ri-phone-line" aria-hidden="true"></i> <?= e($contact['phones'][0]['display']) ?></a>
            </div>
        </div>
    </section>

</main>
<?php
include("inc/footer.php");
include("inc/foot.php");
