<?php
$navLinks = [
    'home'         => ['Home',         'index.php'],
    'about'        => ['About',        'index.php#about'],
    'achievements' => ['Achievements', 'index.php#achievements'],
    'leadership'   => ['Leadership',   'index.php#leadership'],
    'contact'      => ['Contact',      'contact-us.php'],
];
?>
<header class="site-header" data-header>
    <div class="container site-header__inner">
        <a class="brand" href="index.php" aria-label="<?= e($school['short_name']) ?> home">
            <img src="assets/images/logo_shri2.png" alt="" width="48" height="51">
            <span class="brand__text">
                <strong>Shri Balaji</strong>
                <small>English Primary &amp; Secondary School</small>
            </span>
        </a>

        <nav class="nav" aria-label="Main">
            <ul class="nav__list">
                <?php foreach ($navLinks as $key => $link) { ?>
                    <li><a class="nav__link<?= $activePage === $key ? ' is-active' : '' ?>" href="<?= $link[1] ?>"<?= $activePage === $key ? ' aria-current="page"' : '' ?>><?= $link[0] ?></a></li>
                <?php } ?>
            </ul>
        </nav>

        <div class="site-header__actions">
            <a class="btn btn--ghost btn--sm hide-sm" href="<?= e($school['prospectus']) ?>" target="_blank" rel="noopener">
                <i class="ri-file-download-line" aria-hidden="true"></i> Prospectus
            </a>
            <a class="btn btn--primary btn--sm" href="<?= e($school['portal']) ?>">
                <i class="ri-login-circle-line" aria-hidden="true"></i> Portal login
            </a>
            <button class="menu-toggle" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu" data-menu-toggle>
                <i class="ri-menu-line" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>

<div class="drawer" id="mobile-menu" hidden data-drawer>
    <div class="drawer__backdrop" data-menu-close></div>
    <div class="drawer__panel" role="dialog" aria-modal="true" aria-label="Menu">
        <div class="drawer__head">
            <a class="brand" href="index.php">
                <img src="assets/images/logo_shri2.png" alt="" width="40" height="43">
                <span class="brand__text"><strong>Shri Balaji</strong><small><?= e($school['place']) ?></small></span>
            </a>
            <button class="icon-btn" type="button" aria-label="Close menu" data-menu-close><i class="ri-close-line" aria-hidden="true"></i></button>
        </div>
        <ul class="drawer__list">
            <?php foreach ($navLinks as $key => $link) { ?>
                <li><a class="<?= $activePage === $key ? 'is-active' : '' ?>" href="<?= $link[1] ?>" data-menu-link><?= $link[0] ?> <i class="ri-arrow-right-line" aria-hidden="true"></i></a></li>
            <?php } ?>
        </ul>
        <div class="drawer__cta">
            <a class="btn btn--primary btn--block" href="<?= e($school['portal']) ?>"><i class="ri-login-circle-line" aria-hidden="true"></i> Portal login</a>
            <a class="btn btn--ghost btn--block" href="<?= e($school['prospectus']) ?>" target="_blank" rel="noopener"><i class="ri-file-download-line" aria-hidden="true"></i> Download prospectus</a>
        </div>
        <ul class="drawer__contact">
            <?php foreach ($contact['phones'] as $phone) { ?>
                <li><i class="ri-phone-line" aria-hidden="true"></i><a href="tel:<?= e($phone['tel']) ?>"><?= e($phone['display']) ?></a></li>
            <?php } ?>
            <li><i class="ri-mail-line" aria-hidden="true"></i><a href="mailto:<?= e($contact['email']) ?>"><?= e($contact['email']) ?></a></li>
            <li><i class="ri-map-pin-2-line" aria-hidden="true"></i><span><?= e(implode(', ', $contact['address'])) ?></span></li>
        </ul>
    </div>
</div>
