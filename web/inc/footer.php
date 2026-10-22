<footer class="site-footer">
    <div class="container site-footer__grid">
        <div class="site-footer__about">
            <a class="brand brand--light" href="index.php">
                <img src="assets/images/logo_shri2.png" alt="" width="52" height="55" loading="lazy">
                <span class="brand__text"><strong>Shri Balaji</strong><small>English Primary &amp; Secondary School</small></span>
            </a>
            <p><?= e($school['about']) ?></p>
        </div>

        <div>
            <h3 class="site-footer__title">Explore</h3>
            <ul class="site-footer__links">
                <li><a href="index.php#about">About the school</a></li>
                <li><a href="index.php#institutes">Our institutes</a></li>
                <li><a href="index.php#achievements">Achievements</a></li>
                <li><a href="index.php#leadership">Leadership &amp; staff</a></li>
                <li><a href="<?= e($school['prospectus']) ?>" target="_blank" rel="noopener">Prospectus (PDF)</a></li>
                <li><a href="<?= e($school['portal']) ?>">Portal login</a></li>
            </ul>
        </div>

        <div>
            <h3 class="site-footer__title">Get in touch</h3>
            <ul class="site-footer__contact">
                <?php foreach ($contact['phones'] as $phone) { ?>
                    <li><i class="ri-phone-line" aria-hidden="true"></i><a href="tel:<?= e($phone['tel']) ?>"><?= e($phone['display']) ?></a></li>
                <?php } ?>
                <li><i class="ri-mail-line" aria-hidden="true"></i><a href="mailto:<?= e($contact['email']) ?>"><?= e($contact['email']) ?></a></li>
                <li><i class="ri-map-pin-2-line" aria-hidden="true"></i><span><?= e(implode(', ', $contact['address'])) ?></span></li>
            </ul>
        </div>
    </div>

    <div class="container site-footer__bottom">
        <p>&copy; <?= date('Y') ?> <?= e($school['name']) ?>, <?= e($school['place']) ?>. Run by <?= e($school['trust']) ?>.</p>
        <p>Website by Duobytes Technologies Pvt Ltd</p>
    </div>
</footer>

<a class="back-to-top" href="#top" aria-label="Back to top" data-back-to-top><i class="ri-arrow-up-line" aria-hidden="true"></i></a>

<?php include __DIR__ . "/popup.php"; ?>
