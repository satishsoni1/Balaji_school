(function () {
    'use strict';

    var doc = document.documentElement;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    doc.classList.add('js');

    /* Sticky header shadow + back-to-top */
    var header = document.querySelector('[data-header]');
    var toTop = document.querySelector('[data-back-to-top]');
    function onScroll() {
        var y = window.scrollY;
        if (header) header.classList.toggle('is-scrolled', y > 8);
        if (toTop) toTop.classList.toggle('is-visible', y > 600);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* Mobile drawer */
    var drawer = document.querySelector('[data-drawer]');
    var toggle = document.querySelector('[data-menu-toggle]');
    if (drawer && toggle) {
        var openDrawer = function () {
            drawer.hidden = false;
            requestAnimationFrame(function () { drawer.classList.add('is-open'); });
            document.body.classList.add('no-scroll');
            toggle.setAttribute('aria-expanded', 'true');
            var first = drawer.querySelector('a, button');
            if (first) first.focus();
        };
        var closeDrawer = function () {
            drawer.classList.remove('is-open');
            document.body.classList.remove('no-scroll');
            toggle.setAttribute('aria-expanded', 'false');
            setTimeout(function () { drawer.hidden = true; }, reduceMotion ? 0 : 350);
            toggle.focus();
        };
        toggle.addEventListener('click', openDrawer);
        drawer.querySelectorAll('[data-menu-close], [data-menu-link]').forEach(function (el) {
            el.addEventListener('click', closeDrawer);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !drawer.hidden) closeDrawer();
        });
    }

    /* Hero slider */
    var hero = document.querySelector('[data-hero]');
    if (hero) {
        var slides = hero.querySelectorAll('[data-hero-slide]');
        var dots = hero.querySelectorAll('[data-hero-dot]');
        var interval = 7000;
        var current = 0;
        var timer = null;
        hero.style.setProperty('--hero-interval', interval + 'ms');

        var go = function (index) {
            current = (index + slides.length) % slides.length;
            slides.forEach(function (s, i) {
                var active = i === current;
                s.classList.toggle('is-active', active);
                s.setAttribute('aria-hidden', active ? 'false' : 'true');
                s.querySelectorAll('a').forEach(function (a) { a.tabIndex = active ? 0 : -1; });
            });
            dots.forEach(function (d, i) {
                var active = i === current;
                // Restart the progress-bar animation on the newly active dot.
                d.classList.remove('is-active');
                if (active) { void d.offsetWidth; d.classList.add('is-active'); }
                d.setAttribute('aria-selected', active ? 'true' : 'false');
            });
            schedule();
        };
        var schedule = function () {
            clearTimeout(timer);
            if (!reduceMotion && !hero.classList.contains('is-paused')) {
                timer = setTimeout(function () { go(current + 1); }, interval);
            }
        };
        var pause = function () { hero.classList.add('is-paused'); clearTimeout(timer); };
        var resume = function () { hero.classList.remove('is-paused'); schedule(); };

        dots.forEach(function (d) {
            d.addEventListener('click', function () { go(parseInt(d.getAttribute('data-hero-dot'), 10)); });
        });
        var prev = hero.querySelector('[data-hero-prev]');
        var next = hero.querySelector('[data-hero-next]');
        if (prev) prev.addEventListener('click', function () { go(current - 1); });
        if (next) next.addEventListener('click', function () { go(current + 1); });

        hero.addEventListener('mouseenter', pause);
        hero.addEventListener('mouseleave', resume);
        hero.addEventListener('focusin', pause);
        hero.addEventListener('focusout', resume);

        var startX = null;
        hero.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
        hero.addEventListener('touchend', function (e) {
            if (startX === null) return;
            var dx = e.changedTouches[0].clientX - startX;
            if (Math.abs(dx) > 50) go(current + (dx < 0 ? 1 : -1));
            startX = null;
        });

        if (reduceMotion) hero.classList.add('is-paused');
        go(0);
    }

    /* Reveal on scroll + count-up */
    var countUp = function (el) {
        var target = parseInt(el.getAttribute('data-count'), 10);
        if (reduceMotion || !target) return;
        var start = null;
        var duration = 1400;
        var step = function (t) {
            if (start === null) start = t;
            var p = Math.min((t - start) / duration, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        };
        el.textContent = '0';
        requestAnimationFrame(step);
    };

    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-in');
                entry.target.querySelectorAll('[data-count]').forEach(countUp);
                io.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
    } else {
        document.querySelectorAll('.reveal').forEach(function (el) { el.classList.add('is-in'); });
    }

    /* Achievement year filter */
    var filterGroup = document.querySelector('[data-filter-group]');
    var filterList = document.querySelector('[data-filter-list]');
    if (filterGroup && filterList) {
        filterGroup.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-filter]');
            if (!btn) return;
            var value = btn.getAttribute('data-filter');
            filterGroup.querySelectorAll('[data-filter]').forEach(function (b) {
                var on = b === btn;
                b.classList.toggle('is-active', on);
                b.setAttribute('aria-pressed', on ? 'true' : 'false');
            });
            filterList.querySelectorAll('[data-year]').forEach(function (item) {
                var show = value === 'all' || item.getAttribute('data-year') === value;
                item.classList.toggle('is-hidden', !show);
                if (show) item.classList.add('is-in');
            });
        });
    }

    /* Website popup: shown after a short delay; frequency comes from the portal setting */
    var popup = document.querySelector('[data-site-popup]');
    if (popup) {
        var key = popup.getAttribute('data-key');
        var frequency = popup.getAttribute('data-frequency');
        var store = frequency === 'session' ? 'sessionStorage' : 'localStorage';
        var today = new Date().toISOString().slice(0, 10);
        var seen = null;
        try { seen = window[store].getItem(key); } catch (err) {}
        var due = frequency === 'always' || !seen || (frequency === 'daily' && seen !== today);
        var lastFocus = null;

        var closePopup = function () {
            popup.classList.remove('is-open');
            document.body.classList.remove('no-scroll');
            setTimeout(function () { popup.hidden = true; }, reduceMotion ? 0 : 350);
            if (lastFocus) lastFocus.focus();
        };
        var openPopup = function () {
            lastFocus = document.activeElement;
            popup.hidden = false;
            requestAnimationFrame(function () { popup.classList.add('is-open'); });
            document.body.classList.add('no-scroll');
            popup.querySelector('.site-popup__dialog').focus();
            try { if (frequency !== 'always') window[store].setItem(key, today); } catch (err) {}
        };

        popup.querySelectorAll('[data-popup-close]').forEach(function (el) { el.addEventListener('click', closePopup); });
        document.addEventListener('keydown', function (e) {
            if (popup.hidden) return;
            if (e.key === 'Escape') closePopup();
            if (e.key === 'Tab') {
                var items = popup.querySelectorAll('a[href], button');
                var first = items[0], last = items[items.length - 1];
                if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
                else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
            }
        });
        if (due) setTimeout(openPopup, 1200);
    }

    /* Contact form: compose a WhatsApp or email message to the school office */
    var form = document.querySelector('[data-contact-form]');
    if (form) {
        var validate = function () {
            var ok = true;
            form.querySelectorAll('input, textarea').forEach(function (input) {
                var field = input.closest('.field');
                var valid = input.checkValidity() && (!input.required || input.value.trim() !== '');
                if (field) field.classList.toggle('has-error', !valid);
                if (!valid && ok) { input.focus(); ok = false; }
            });
            return ok;
        };
        form.querySelectorAll('input, textarea').forEach(function (input) {
            input.addEventListener('input', function () {
                var field = input.closest('.field');
                if (field && field.classList.contains('has-error') && input.checkValidity()) field.classList.remove('has-error');
            });
        });
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!validate()) return;
            var v = function (name) { return (form.elements[name].value || '').trim(); };
            var subject = v('msg_subject');
            var lines = [
                'Subject: ' + subject,
                'Name: ' + v('name'),
                'Phone: ' + v('phone_number')
            ];
            if (v('email')) lines.push('Email: ' + v('email'));
            lines.push('', v('message'));
            var body = lines.join('\n');
            var via = e.submitter ? e.submitter.value : 'whatsapp';
            if (via === 'email') {
                window.location.href = 'mailto:' + form.getAttribute('data-email') +
                    '?subject=' + encodeURIComponent(subject + ' - ' + v('name')) +
                    '&body=' + encodeURIComponent(body);
            } else {
                window.open('https://wa.me/' + form.getAttribute('data-whatsapp') + '?text=' + encodeURIComponent(body), '_blank', 'noopener');
            }
        });
    }
})();
