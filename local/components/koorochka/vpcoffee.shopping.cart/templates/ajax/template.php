<?
/**
 * Povered by artem@koorochka.com
 * 18.06.2019 19:52
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var CBitrixComponent $component
 */

// <editor-fold defaultstate="collapsed" desc="Envirloment">
use Bitrix\Main\Localization\Loc;
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();
Loc::loadLanguageFile(__FILE__);
$this->setFrameMode(true);
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Correct step">
if(!$arResult["userData"]["ACTION"])
    $arResult["userData"]["STEP"] = 2;

switch ($arResult["userData"]["ACTION"]){
    case $arResult["prevBtn"]:
        if($arResult["userData"]["STEP"] <= 2)
            $arResult["userData"]["STEP"] = 1;
        break;
    case $arResult["nextBtn"]:
        if($arResult["userData"]["STEP"] <= 2)
            $arResult["userData"]["STEP"] = 3;
        break;
}
// </editor-fold>
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?
    // <editor-fold defaultstate="collapsed" desc="Header title">
    echo '<h4 class="modal-title">';
    switch ($arResult["userData"]["SERVICE"]){
        case "without_coffee":
            if($arResult["userData"]["STEP"] == 3){
                echo Loc::getMessage("VP_STEP", array("NUM" => 2));
                echo ": ";
                echo Loc::getMessage("VP_STEP_" . 3);
            }
            elseif($arResult["userData"]["STEP"] == 4){
                echo Loc::getMessage("VP_STEP", array("NUM" => 3));
                echo ": ";
                echo Loc::getMessage("VP_STEP_" . 4);
            }
            elseif($arResult["userData"]["STEP"] == 8){
                echo Loc::getMessage("VP_STEP", array("NUM" => 4));
                echo ": ";
                echo Loc::getMessage("VP_STEP_" . 8);
            }
            else{
                echo Loc::getMessage("VP_STEP", array("NUM" => $arResult["userData"]["STEP"]));
                echo ": ";
                echo Loc::getMessage("VP_STEP_" . $arResult["userData"]["STEP"]);
            }
            break;
        default:
            $step = $arResult["userData"]["STEP"];
            if($step > 1)
                $step--;
            echo Loc::getMessage("VP_STEP", array("NUM" => $step));
            echo ": ";
            echo Loc::getMessage("VP_STEP_" . $arResult["userData"]["STEP"]);
    }
    echo '</h4>';
    // </editor-fold>
    ?>
</div>
<div class="modal-body">

<?
    // <editor-fold defaultstate="collapsed" desc="User-data recorder">
    echo bitrix_sessid_post();

    if(!empty($arResult["userData"]["STEP"])):?>
        <input type="hidden"
               name="step"
               value="<?=$arResult["userData"]["STEP"]?>">
    <?endif;?>
    <?if(!empty($arResult["userData"]["SERVICE"])):?>
        <input type="hidden"
               name="service"
               value="<?=$arResult["userData"]["SERVICE"]?>">
    <?endif;?>
    <?if(!empty($arResult["userData"]["CLIENT"])):?>
        <input type="hidden"
               name="client"
               value="<?=$arResult["userData"]["CLIENT"]?>">
    <?endif;?>
    <?if(!empty($arResult["userData"]["LOCATION"])):?>
        <input type="hidden"
               name="location"
               value="<?=$arResult["userData"]["LOCATION"]?>">
    <?endif;?>
    <?if(!empty($arResult["userData"]["MACHINE"])):?>
        <input type="hidden"
               name="machina"
               value="<?=$arResult["userData"]["MACHINE"]?>">
    <?endif;?>
    <?if(!empty($arResult["userData"]["COFFEE_COUNT"])):?>
        <input type="hidden"
               name="coffe_count"
               value="<?=$arResult["userData"]["COFFEE_COUNT"]?>">
    <?endif;?>
    <?if(!empty($arResult["userData"]["COFFEE_MARKA"])):?>
        <?
        foreach ($arResult["userData"]["COFFEE_MARKA"] as $key=>$value):
            if(!$value)
                continue;
            ?>
            <input type="hidden"
                   name="marka[<?=$key?>]"
                   value="<?=$value?>">
        <?endforeach;?>
    <?endif;?>
    <?
    if(!empty($arResult["userData"]["DOP"])):?>
        <?
        foreach ($arResult["userData"]["DOP"] as $key=>$value):
            if(!$value)
                continue;
            ?>
            <input type="hidden"
                   name="dop_count[<?=$key?>]"
                   value="<?=$value?>">
        <?endforeach;?>
    <?
    endif;
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Step 1: Choose type">
    if(!$arResult["userData"]["ACTION"] || $arResult["userData"]["STEP"] == 1):
        ?>
        <?foreach ($arResult["services"] as $key=>$value):?>
        <div class="checkbox">
            <label>
                <input type="radio"
                       onchange="order_step()"
                       name="service"
                       value="<?=$key?>">
                <?=Loc::getMessage("VP_SERVICE_" . $value)?>
            </label>
        </div>
    <?endforeach;?>
        <b class="text-danger">*</b> <?=Loc::getMessage("VP_CONTRACT_WARNING")?>
    <?
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Step 2: Choose client type">
    elseif($arResult["userData"]["STEP"] == 2):
        ?>
        <?foreach ($arResult["client"] as $key=>$value):?>
        <div class="checkbox">
            <label>
                <input type="radio"
                       onchange="order_step()"
                       name="client"
                       value="<?=$key?>">
                <?=Loc::getMessage("VP_" . $value)?>
            </label>
        </div>
    <?endforeach;?>
    <?
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Step 3: Choose Location">
    elseif($arResult["userData"]["STEP"] == 3):
        ?>
        <?foreach ($arResult["locations"] as $key=>$value):?>
        <div class="checkbox">
            <label>
                <input type="radio"
                       onchange="order_step()"
                       name="location"
                       value="<?=$key?>">
                <?=Loc::getMessage("VP_LOCATION_" . $value)?>
            </label>
        </div>
    <?endforeach;?>
    <?
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Step 4: Choose machine">
    elseif($arResult["userData"]["STEP"] == 4):

        if(count($arResult["machine"]) > 1):
            echo '<div class="row margin-bottom-10">';
        endif;
        $i = 0;
        foreach ($arResult["machine"] as $machine):
            if($arResult["userData"]["SERVICE"] == "without_coffee"){
                $machine["DETAIL_PAGE_URL"] .= "?com=y";
            }
            if(count($arResult["machine"]) > 1){
                echo '<div class="col-xs-12 col-sm-6 col-md-6">';
            }
            ?>
            <label class="row margin-bottom-15" onclick="nextStepInformer(this)">

                <div class="col-xs-5 col-sm-5 col-md-4 <?=count($arResult["machine"]) > 1 ? "text-right" : "width-auto"?>">
                    <?if(empty($machine["PREVIEW_PICTURE"])):?>
                        <img class="img-responsive img-thumbnail"
                             src="<?=$this->GetFolder()?>/images/machine.jpg">
                    <?else:?>
                        <img class="img-responsive img-thumbnail"
                             src="<?=$machine["PREVIEW_PICTURE"]?>">
                    <?endif;?>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-8">
                    <h4>
                        <input type="radio"
                               name="machina"
                               value="<?=$machine["ID"]?>"
                               onchange="order_step()" />
                        <a href="<?=$machine["DETAIL_PAGE_URL"]?>" target="_blank"><?=$machine["NAME"]?></a>
                    </h4>

                    <?if($arResult["userData"]["SERVICE"] == "without_coffee"):?>
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

    // <editor-fold defaultstate="collapsed" desc="Step 5: Choose coffee count">
    elseif($arResult["userData"]["STEP"] == 5):
        require_once $_SERVER["DOCUMENT_ROOT"] . "/local/inc/steps.php";
        step_3($arResult["machine"][$arResult["userData"]["MACHINE"]]["PROPERTY_VOLUME_VALUE"]);
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Step 6: Choose coffee">
    elseif($arResult["userData"]["STEP"] == 6):
        ?>

        <?foreach($arResult["coffeeSections"] as $section):?>
        <h1><?=$section["NAME"]?></h1>
        <div class="row">
            <?
            $i = 0;
            foreach ($arResult["coffee"] as $coffee):
                if($section["ID"] == $coffee["IBLOCK_SECTION_ID"]):
                    ?>
                    <div class="col-xs-6 col-sm-4 col-md-4 text-center margin-bottom-10">
                        <?if(empty($coffee["PREVIEW_PICTURE"])):?>
                            <img class="img-thumbnail img-thumbnail"
                                 src="<?=$this->GetFolder()?>/images/coffee.jpg" />
                        <?else:?>
                            <img class="img-thumbnail img-thumbnail"
                                 src="<?=$coffee["PREVIEW_PICTURE"]?>" />
                        <?endif;?>

                        <div class="margin-top-10">
                            <a href="/coffee/<?=$arResult["coffeeSections"][$coffee["IBLOCK_SECTION_ID"]]["CODE"]?>/<?=$coffee["CODE"]?>/"
                               class="h4"
                               target="_blank">
                                <?=$coffee["NAME"]?>
                            </a>
                        </div>
                        <div class="margin-top-10">
                            <span class="count_down" onclick="marka_count_down(this)">&#8722;</span>
                            <input type="text"
                                   class="marka_count"
                                   maxlength="2"
                                   name="marka[<?=$coffee["ID"]?>]"
                                   onkeyup="TextChanged(this, event)"
                                   value="0"
                                   onfocus='$(this).val("")'
                                   onblur="if (this.value=='') this.value='0'"
                            />
                            <span class="count_up" onclick="marka_count_up(this)">+</span>
                            <div class="informer"></div>

                        </div>
                    </div>
                    <?
                    $i++;
                endif;
            endforeach;
            ?>
        </div>
    <?endforeach;?>

    <?
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Step 7: Choose dop">
    elseif($arResult["userData"]["STEP"] == 7):
        ?>

        <div class="padding-bottom-35">
            <?if($arResult["userData"]["STEP"] > 2):?>
                <button type="submit"
                        name="action"
                        id="back_step"
                        onclick="velesCalculator.step(false)"
                        value="<?=$arResult["prevBtn"]?>"
                        class="btn btn-default">&larr;&nbsp;<?=$arResult["prevBtn"]?></button>

            <?endif;?>

            <button type="submit"
                    name="action"
                    value="<?=$arResult["nextBtn"]?>"
                    id="next_step"
                    onclick="velesCalculator.step(true)"
                <?if($arResult["userData"]["STEP"] < 7):?>
                    disabled="disabled"
                <?endif;?>
                    class="btn btn-primary"><?=$arResult["nextBtn"]?>&nbsp;&rarr;</button>
        </div>

        <div class="row">
            <?
            $i = 0;
            foreach($arResult["additionally"] as $tea):
                if($i && $i%2 == 0)
                    echo '</div><div class="row">';
                $i++;
                ?>
                <div class="col-xs-12 col-sm-6">
                    <div class="row margin-bottom-20">
                        <div class="col-xs-6 text-center">
                            <label for="dop_<?=$tea["ID"]?>">
                                <?if(empty($tea["PREVIEW_PICTURE"])):?>
                                <img src="<?=$this->GetFolder()?>/images/additionally.jpg" class="img-responsive img-thumbnail"></label>
                            <?else:?>
                                <img src="<?=$tea["PREVIEW_PICTURE"]?>" class="img-responsive img-thumbnail"></label>
                            <?endif;?>
                            <div class="choose_count">
                                <span onclick="count_down(this)">-</span>
                                <input type="text"
                                       maxlength="2"
                                       name="dop_count[<?=$tea["ID"]?>]"
                                       onkeyup="count_input(this)"
                                       value="0" onfocus="$(this).val(&quot;&quot;)" onblur="if (this.value=='') this.value='0'" class="marka_count">
                                <span onclick="count_up(this)">+</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <h4>
                                <a href="<?=$tea["DETAIL_PAGE_URL"]?>" target="_blank"><?=$tea["NAME"]?></a>
                            </h4>
                            <?=$tea["PREVIEW_TEXT"]?>
                        </div>
                    </div>
                </div>
            <?endforeach;?>
        </div>

    <?
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Step 8: Result user data">
    elseif($arResult["userData"]["STEP"] == 8):
        ?>
        <h3><?=Loc::getMessage("VP_RESULT_PARAMS")?></h3>
        <?
        if($arResult["userData"]["SERVICE"] == "without_coffee")
            include "inc/result2.php";
        else
            include "inc/result1.php";
        ?>
        <hr>

    <?
    endif;
    // </editor-fold>

?>

</div>
<div class="modal-footer">

    <?if($arResult["userData"]["STEP"] > 2):?>
        <button type="submit"
                name="action"
                id="back_step"
                onclick="velesCalculator.step(false)"
                value="<?=$arResult["prevBtn"]?>"
                class="btn btn-default">&larr;&nbsp;<?=$arResult["prevBtn"]?></button>

    <?endif;?>

    <button type="submit"
            name="action"
            value="<?=$arResult["nextBtn"]?>"
            id="next_step"
            onclick="velesCalculator.step(true)"
            <?if($arResult["userData"]["STEP"] < 7):?>
                disabled="disabled"
            <?endif;?>
            class="btn btn-primary"><?=$arResult["nextBtn"]?>&nbsp;&rarr;</button>

</div>