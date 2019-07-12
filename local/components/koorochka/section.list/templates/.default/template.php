<?
/**
 * @var array $arResult
 */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult)):
?>
    <p>
        <b>
            <a href="/coffeem/"><?=Loc::getMessage("COFFE_MACHINE_NAME")?></a>,
            <?=Loc::getMessage("COFFE_MACHINE_DESC")?>
        </b>
    </p>


    <div class="row">
        <?
        $i = 0;
        $cols = 2;
        foreach($arResult as $arItem):
            $i++;
            if($i%$cols && $i > 1)
                echo "</div><div class=\"row\">";
            ?>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <a href="/coffeem/<?=$arItem["CODE"]?>/"
                   class="text-center thumbnail padding-top-15">
                    <p class="text-16"><?=$arItem["NAME"]?></p>
                    <?if(!empty($arItem["PICTURE"])):?>
                        <img src="<?=$arItem["PICTURE"]["SRC"]?>"
                             class="img-responsive img-thumbnail"
                             title="<?=$arItem["NAME"]?>"
                             alt="..." />
                    <?endif;?>
                </a>
            </div>
            <?
        endforeach;
        if($i%$cols)
            echo "<td>" . $i . "</td>";
        ?>
    </div>


<?endif;?>