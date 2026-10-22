<?php
/*
 * Website popup managed from the portal (Frontend > Website Popup).
 * Shows the newest active popup whose dates include today. Any database
 * problem is ignored so the public site always renders.
 */
function load_website_popup()
{
    $configFile = __DIR__ . '/../../mvc/config/production/database.php';
    if (!is_file($configFile)) {
        $configFile = __DIR__ . '/../../mvc/config/database.php';
    }
    if (!is_file($configFile)) {
        return null;
    }

    if (!defined('BASEPATH')) {
        define('BASEPATH', __DIR__);
    }
    $db = array();
    include $configFile;
    if (empty($db['default'])) {
        return null;
    }
    $c = $db['default'];

    mysqli_report(MYSQLI_REPORT_OFF);
    $mysqli = mysqli_init();
    $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 3);
    if (!@$mysqli->real_connect($c['hostname'], $c['username'], $c['password'], $c['database'])) {
        return null;
    }
    $mysqli->set_charset('utf8mb4');

    $stmt = $mysqli->prepare(
        "SELECT websitepopupID, title, badge, message, image, button_text, button_link, frequency, show_on, modify_date
         FROM websitepopup
         WHERE status = 1
           AND (start_date IS NULL OR start_date <= CURDATE())
           AND (end_date IS NULL OR end_date >= CURDATE())
         ORDER BY websitepopupID DESC LIMIT 1"
    );
    if (!$stmt || !$stmt->execute()) {
        return null;
    }
    $popup = $stmt->get_result()->fetch_object();
    $mysqli->close();
    return $popup ?: null;
}

function website_popup_link($link)
{
    // Same rule as the portal form: site pages, /paths, tel:, mailto:, http(s) URLs.
    return preg_match('#^(https?://|/|tel:|mailto:|[a-z0-9_\-]+\.(php|html|pdf)(\#[\w\-]*)?$|\#[\w\-]+$)#i', (string) $link) ? $link : '';
}

$websitePopup = load_website_popup();
if ($websitePopup && ($websitePopup->show_on === 'all' || $activePage === 'home')) {
    $popupLink = website_popup_link($websitePopup->button_link);
    $popupKey  = 'sbs-popup-' . $websitePopup->websitepopupID . '-' . strtotime((string) $websitePopup->modify_date);
?>
<div class="site-popup" id="site-popup" hidden data-site-popup data-key="<?= e($popupKey) ?>" data-frequency="<?= e($websitePopup->frequency) ?>">
    <div class="site-popup__backdrop" data-popup-close></div>
    <div class="site-popup__dialog" role="dialog" aria-modal="true" aria-labelledby="site-popup-title" tabindex="-1">
        <button class="site-popup__close" type="button" aria-label="Close" data-popup-close><i class="ri-close-line" aria-hidden="true"></i></button>
        <?php if ($websitePopup->image) { ?>
            <div class="site-popup__media"><img src="../uploads/images/<?= e(rawurlencode($websitePopup->image)) ?>" alt=""></div>
        <?php } ?>
        <div class="site-popup__body">
            <?php if ($websitePopup->badge) { ?>
                <span class="site-popup__badge"><i class="ri-star-line" aria-hidden="true"></i> <?= e($websitePopup->badge) ?></span>
            <?php } ?>
            <h2 id="site-popup-title"><?= e($websitePopup->title) ?></h2>
            <?php if ($websitePopup->message) { ?>
                <div class="site-popup__message"><?= nl2br(e($websitePopup->message)) ?></div>
            <?php } ?>
            <div class="site-popup__actions">
                <?php if ($websitePopup->button_text && $popupLink) { ?>
                    <a class="btn btn--primary" href="<?= e($popupLink) ?>"><?= e($websitePopup->button_text) ?> <i class="ri-arrow-right-line" aria-hidden="true"></i></a>
                <?php } ?>
                <button class="btn btn--ghost" type="button" data-popup-close>Maybe later</button>
            </div>
        </div>
    </div>
</div>
<?php
}
