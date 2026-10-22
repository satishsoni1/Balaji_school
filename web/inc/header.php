<div class="topbar">
    <div class="container topbar__inner">
        <p class="topbar__motto"><i class="ri-star-line" aria-hidden="true"></i> <span>Motto:</span> <?= e($school['motto']) ?></p>
        <div class="topbar__links">
            <a href="tel:<?= e($contact['phones'][0]['tel']) ?>"><i class="ri-phone-line" aria-hidden="true"></i><?= e($contact['phones'][0]['display']) ?></a>
            <a href="mailto:<?= e($contact['email']) ?>"><i class="ri-mail-line" aria-hidden="true"></i><?= e($contact['email']) ?></a>
        </div>
    </div>
</div>
