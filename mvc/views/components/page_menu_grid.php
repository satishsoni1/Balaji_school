<div class="row">
<?php
    if(customCompute($dbMenus)) {
        $menuDesign = '';
        display_grid_menu($dbMenus, $menuDesign);
        echo $menuDesign;
        
    }
?>
</div>
                