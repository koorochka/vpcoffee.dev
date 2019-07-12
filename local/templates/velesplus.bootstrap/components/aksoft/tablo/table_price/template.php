<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<div id="table-price">
    <div id="service-controls" class="table-controls">
        <a href="<?=SITE_DIR?>prices/" class="service-control table-control table-control-first <?=$arParams["ACTIVE"] > 1 ? "" : "active"?>"><?=Loc::getMessage("VP_LINK_COFFEE")?></a>
        <a href="<?=SITE_DIR?>prices/witout.coffee/" class="service-control table-control table-control-last <?=$arParams["ACTIVE"] > 1 ? "active" : ""?>"><?=Loc::getMessage("VP_LINK_MACHINE")?></a>
        <div class="clearfix"></div>
    </div>
    <div class="table-price-tabs">
        <div class="service-tab table-price-tab active">
            <?if($arParams["ACTIVE"] > 1):?>
                <?
                // <editor-fold defaultstate="collapsed" desc="Machine">
                if(count($arResult["machine"]) > 1):
                    echo '<div class="row padding-top-20">';
                endif;
                $i = 0;
                foreach ($arResult["machine"] as $machine):

                    if(count($arResult["machine"]) > 1):
                        echo '<div class="col-xs-12 col-sm-6 col-md-6">';
                    endif;
                    ?>
                    <label class="row padding-top-20">

                        <div class="col-xs-5 col-sm-5 col-md-4 <?=count($arResult["machine"]) > 1 ? "text-right" : "width-auto"?>">
                            <?if(empty($machine["PREVIEW_PICTURE"])):?>
                                <img class="img-responsive img-thumbnail" src="<?=$this->GetFolder()?>/images/machine.jpg">
                            <?else:?>
                                <img class="img-responsive img-thumbnail" src="<?=$machine["PREVIEW_PICTURE"]?>">
                            <?endif;?>
                        </div>
                        <div class="col-xs-7 col-sm-7 col-md-8">
                            <a class="h4" href="<?=$machine["DETAIL_PAGE_URL"]?>?com=y" target="_blank"><?=$machine["NAME"]?></a>
                            <?if($machine["PROPERTY_CONDITION_ENUM_ID"] == 10):?>
                                <h5><?=Loc::getMessage("VP_MACHINE_WITOUT_TYPE", array("NUM" => $machine["PROPERTY_TYPE_VALUE"]))?></h5>
                                <h5><?=Loc::getMessage("VP_MACHINE_WITOUT_VOLUME", array("NUM" => $machine["PROPERTY_WITOUT_MIN_ORDER_VALUE"]))?></h5>
                                <?if(is_array($machine["PROPERTY_WITOUT_FILE_VALUE"])):?>
                                    <div class="file">
                                        <a href="<?=$machine["PROPERTY_WITOUT_FILE_VALUE"]["SRC"]?>" target="_blank" class="pdf-link"><?=Loc::getMessage("VP_MACHINE_WITOUT_FILE")?></a>
                                    </div>
                                <?endif;?>
                            <?else:?>
                                <h5><?=Loc::getMessage("VP_MACHINE_TYPE", array("NUM" => $machine["PROPERTY_TYPE_VALUE"]))?></h5>
                                <h5><?=Loc::getMessage("VP_MACHINE_VOLUME", array("NUM" => $machine["PROPERTY_VOLUME_VALUE"]))?></h5>
                            <?endif;?>

                        </div>
                        <div class="informer"></div>
                    </label>
                    <?
                    if(count($arResult["machine"]) > 1):
                        echo '</div>';
                        if($i%2)
                            echo '</div><div class="row margin-bottom-10">';
                        $i++;
                    endif;
                endforeach;
                if(count($arResult["machine"]) > 1):
                    echo '</div>';
                endif;


                // </editor-fold>
                ?>
            <?else:?>
                <div id="table-price-controls" class="table-controls">
                    <div class="price-control table-control table-control-first active"
                         onclick="priceTabs.showTab(this, 0)"><?=Loc::getMessage("VP_LOCATION_MOSCOW")?></div>
                    <div class="price-control table-control table-price-control-last"
                         onclick="priceTabs.showTab(this, 1)"><?=Loc::getMessage("VP_LOCATION_ALL")?></div>
                    <div class="clearfix"></div>
                </div>
                <div id="price-tabs" class="table-price-tabs">
                    <div class="price-tab table-price-tab active">
                        <?require_once "inc/tab.php"?>
                    </div>
                    <div class="price-tab table-price-tab">
                        <?require_once "inc/tab1.php"?>
                    </div>
                </div>
            <?endif;?>
        </div>
    </div>
</div>