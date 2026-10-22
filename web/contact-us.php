<?php
$activePage      = 'contact';
$pageTitle       = 'Contact us | Shri Balaji English Primary & Secondary School, Wadegaon';
$pageDescription = 'Phone, email, address and directions for Shri Balaji English Primary & Secondary School, Wadegaon, Tq. Balapur, Dist. Akola.';
include("inc/head.php");
include("inc/header.php");
include("inc/nav.php");
?>
<main id="main">

    <section class="page-hero">
        <div class="container">
            <nav class="crumbs" aria-label="Breadcrumb">
                <a href="index.php">Home</a>
                <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
                <span aria-current="page">Contact us</span>
            </nav>
            <h1>Contact us</h1>
            <p>Questions about admissions, fees or school timings? Call, email or send us a message and the office will get back to you.</p>
        </div>
    </section>

    <section class="section section--flush-top">
        <div class="container contact">
            <div class="contact__info">
                <div class="info-card">
                    <span class="info-card__icon"><i class="ri-phone-line" aria-hidden="true"></i></span>
                    <div>
                        <h2>Call the office</h2>
                        <?php foreach ($contact['phones'] as $phone) { ?>
                            <p><a href="tel:<?= e($phone['tel']) ?>"><?= e($phone['display']) ?></a></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="info-card">
                    <span class="info-card__icon"><i class="ri-mail-line" aria-hidden="true"></i></span>
                    <div>
                        <h2>Email</h2>
                        <p><a href="mailto:<?= e($contact['email']) ?>"><?= e($contact['email']) ?></a></p>
                    </div>
                </div>
                <div class="info-card">
                    <span class="info-card__icon"><i class="ri-map-pin-2-line" aria-hidden="true"></i></span>
                    <div>
                        <h2>Visit us</h2>
                        <p><?= implode('<br>', array_map('e', $contact['address'])) ?></p>
                        <p><a href="https://www.google.com/maps/search/?api=1&amp;query=<?= urlencode($contact['map_query']) ?>" target="_blank" rel="noopener">Get directions <i class="ri-arrow-right-up-line" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="info-card">
                    <span class="info-card__icon"><i class="ri-file-download-line" aria-hidden="true"></i></span>
                    <div>
                        <h2>Prospectus</h2>
                        <p><a href="<?= e($school['prospectus']) ?>" target="_blank" rel="noopener">Download the school prospectus (PDF)</a></p>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <h2>Send a message</h2>
                <p class="muted">Your message opens in WhatsApp (or your email app) addressed to the school office, ready to send.</p>
                <form class="form" id="contactForm" novalidate data-contact-form data-whatsapp="<?= e($contact['whatsapp']) ?>" data-email="<?= e($contact['email']) ?>">
                    <div class="form__row">
                        <div class="field">
                            <label for="name">Your name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required>
                            <span class="field__error" data-error-for="name">Please enter your name.</span>
                        </div>
                        <div class="field">
                            <label for="phone_number">Phone number</label>
                            <input id="phone_number" name="phone_number" type="tel" inputmode="tel" autocomplete="tel" required pattern="[0-9+\s\-]{10,15}">
                            <span class="field__error" data-error-for="phone_number">Please enter a valid phone number.</span>
                        </div>
                    </div>
                    <div class="form__row">
                        <div class="field">
                            <label for="email">Email <span class="optional">(optional)</span></label>
                            <input id="email" name="email" type="email" autocomplete="email">
                            <span class="field__error" data-error-for="email">Please enter a valid email address.</span>
                        </div>
                        <div class="field">
                            <label for="msg_subject">Subject</label>
                            <select id="msg_subject" name="msg_subject">
                                <option>Admission enquiry</option>
                                <option>Fees</option>
                                <option>School timings</option>
                                <option>Transfer certificate / documents</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="field">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                        <span class="field__error" data-error-for="message">Please write your message.</span>
                    </div>
                    <div class="form__actions">
                        <button class="btn btn--whatsapp btn--lg" type="submit" value="whatsapp"><i class="ri-whatsapp-line" aria-hidden="true"></i> Send on WhatsApp</button>
                        <button class="btn btn--ghost btn--lg" type="submit" value="email"><i class="ri-mail-line" aria-hidden="true"></i> Send by email</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="map-wrap" aria-label="Map">
        <iframe title="Map showing <?= e($school['place']) ?>" src="https://maps.google.com/maps?q=<?= urlencode($contact['map_query']) ?>&amp;z=13&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

</main>
<?php
include("inc/footer.php");
include("inc/foot.php");
