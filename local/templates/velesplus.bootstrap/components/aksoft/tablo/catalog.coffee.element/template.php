<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="table-price">
    <div id="table-price-controls">
        <div class="table-price-control table-price-control-first active"
             onclick="tablePrice.showTab(this, 0)">в пределах МКАД</div>
        <div class="table-price-control table-price-control-last"
             onclick="tablePrice.showTab(this, 1)">за пределами МКАД</div>
        <div class="clearfix"></div>
    </div>
    <div id="table-price-tabs">
        <div class="table-price-tab active">
            <?require_once "inc/tab.php"?>
        </div>
        <div class="table-price-tab">
            <?require_once "inc/tab1.php"?>
        </div>
    </div>
</div>
