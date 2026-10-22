<div class="menu-home">
    <div class="menu-home__head">
        <div>
            <h1 class="menu-home__title">Welcome, <?=htmlspecialchars($this->session->userdata('name'))?></h1>
            <p class="menu-home__sub"><?=htmlspecialchars($this->session->userdata('usertype'))?> &middot; <?=date('l, j F Y')?></p>
        </div>
        <label class="menu-search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="search" placeholder="Search modules…" aria-label="Search modules" autocomplete="off" data-menu-search>
        </label>
    </div>

    <?php
        if(customCompute($dbMenus)) {
            $menuDesign = '';
            display_grid_menu($dbMenus, $menuDesign);
            echo $menuDesign;
        }
    ?>

    <div class="menu-empty" hidden data-menu-empty>
        <i class="fa fa-search" aria-hidden="true"></i>
        <p>No modules match your search.</p>
    </div>
</div>

<script type="text/javascript">
    (function () {
        var input = document.querySelector('[data-menu-search]');
        if (!input) return;
        var sections = document.querySelectorAll('[data-menu-section]');
        var empty = document.querySelector('[data-menu-empty]');
        input.addEventListener('input', function () {
            var q = input.value.trim().toLowerCase();
            var any = false;
            sections.forEach(function (section) {
                var title = section.querySelector('.menu-section__title').textContent.toLowerCase();
                var visible = 0;
                section.querySelectorAll('.menu-tile').forEach(function (tile) {
                    var show = !q || tile.getAttribute('data-menu-label').indexOf(q) !== -1 || title.indexOf(q) !== -1;
                    tile.style.display = show ? '' : 'none';
                    if (show) visible++;
                });
                section.style.display = visible ? '' : 'none';
                if (visible) any = true;
            });
            empty.hidden = any;
        });
        input.addEventListener('keydown', function (e) {
            if (e.key !== 'Enter') return;
            var first = Array.prototype.find.call(document.querySelectorAll('.menu-tile'), function (t) { return t.offsetParent !== null; });
            if (first) window.location.href = first.href;
        });
    })();
</script>
