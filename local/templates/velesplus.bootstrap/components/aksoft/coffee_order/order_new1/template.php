<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arResult */

if($_POST["count_marka"])
    $_POST["marka"] = $_POST["count_marka"];
?>
<div class="steps">
    <?
    if($arResult["STEP"] == 7):
    require_once "price.php";
    ?>
    <h3>Шаг <?=$arResult["STEP"]?>: проверка выбранных данных</h3>
    <h3>Выбранные параметры:</h3>
    <ul>
        <li>Местонахождение: <?=$arResult["location"][$_POST["location"]]?></li>
        <li>Количество кофе: <?=$_POST["coffe_count"]?> кг</li>
        <li>
            Кофемашина:
            <a href="/coffeem/kofemashiny-v-arendu-ot-<?=$arResult["VOLUME"][$arResult["MACHINE"][$_POST["machina_id"]]["PROPERTY_VOLUME_ENUM_ID"]]["VALUE"]?>-kg/<?=$arResult["MACHINE"][$_POST["machina_id"]]["CODE"]?>/" target="_blank">
                <?=$arResult["MACHINE"][$_POST["machina_id"]]["NAME"]?>
            </a>
        </li>
        <li>
            Кофе:
            <?
            $input_marka = "";
            $count_marka = "";
            $price = 0;
            foreach($_POST["marka"] as $marka=>$val):
                if(!$val)
                    continue;
                else
                    $price = $price + calculate_price($arResult["MACHINE"][$_POST["machina_id"]]["PROPERTY_TYPE_ENUM_ID"], $_POST["location"], /*$val*/ $_POST["coffe_count"], $arResult["COFFEE"][$marka], $val);
                $input_marka.= '<input type="hidden" name="marka['.$marka.']" value="'.$arResult["COFFEE"][$marka]["NAME"].'" />';
                $count_marka.= '<input type="hidden" name="count_marka['.$marka.']" value="'.$val.'" />';
                ?>
                <br />
                <a href="/coffee/<?=$arResult["SECTIONS"][$arResult["COFFEE"][$marka]["IBLOCK_SECTION_ID"]]["CODE"]?>/<?=$arResult["COFFEE"][$marka]["CODE"]?>/" target="_blank">
                    <?=$arResult["COFFEE"][$marka]["NAME"]?> &mdash; <?=$val?> кг.
                </a>
            <?endforeach;?>
        </li>
        <br />
        <li><i>Ваши расходы в месяц: <?=$_POST["price"] ? $_POST["price"] : $price?> руб.</i>
        </li>
    </ul>
    <hr>
    <?
    if($_POST["dop"]):
        $price_dop = 0;
        ?>
        <h3>Доп. товары:</h3>
        <?
        foreach($_POST["dop"] as $val):
            $count = intval($_POST["dop_count"][$arResult["DOP"][$val]["ID"]]);
            if(!$count)
                $count = 1;
            $result = $arResult["DOP"][$val]["PROPERTY_PRICE_VALUE"] * $count;
            $price_dop = $price_dop + $arResult["DOP"][$val]["PROPERTY_PRICE_VALUE"] * $count;
            ?>
            <a href="<?=$arResult["DOP"][$val]["DETAIL_PAGE_URL"]?>" target="_blank">
                <?=$arResult["DOP"][$val]["NAME"]?>
                – <?=$count?> уп
                – <?=$arResult["DOP"][$val]["PROPERTY_PRICE_VALUE"]?> руб.
                = <?=$result?> руб.
            </a><br>
        <?
        endforeach;
        ?>
        <br />
        <i>Сумма к оплате за доп. товары: <?=$price_dop?> руб.</i><br>
        <hr>
    <?
    endif;
    ?>
    <br />
    <h3>Итого: <?=$price?> руб.
        <?=$price_dop ? '+ ' . $price_dop . ' руб.' : ''?>
        <?
        if(!empty($price_dop))
        {
            $result = $price + $price_dop;
            echo ' = ' . $result . ' руб.';
        }
        ?>
        <br />
        <hr>
        <h3>Стоимость доставки:</h3>
        <ul>
            <li>&mdash;&nbsp;в&nbsp;пределах МКАД осуществляется бесплатно;</li>
            <li>&mdash;&nbsp;за&nbsp;пределы МКАД осуществляется по&nbsp;договоренности.</li>
        </ul>
        <hr>
        <table align="left">
            <tr>
                <td>
                    <form action="<?=$arParams["PAGE_URL"]?>" method="post">
                        <?=$input_marka?>
                        <?=$count_marka?>
                        <input type="hidden" name="coffe_count" value="<?=$_POST["coffe_count"]?>" />
                        <input type="hidden" name="machina" value="<?=$_POST["machina"]?>" />
                        <input type="hidden" name="machina_id" value="<?=$_POST["machina_id"]?>" />
                        <input type="hidden" name="location" value="<?=$_POST["location"]?>" />
                        <input type="submit"
                               class="btn btn-default"
                               value="&larr;&nbsp;Назад"
                               name="back" />
                    </form>
                </td>
                <td>
                    <form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
                        <?=$input_marka?>
                        <?=$count_marka?>
                        <?foreach($_POST["dop"] as $k=>$val):?>
                            <input type="hidden" name="dop[<?=$k?>]" value="<?=$val?>">
                        <?endforeach;?>
                        <?foreach($_POST["dop_count"] as $k=>$val):?>
                            <input type="hidden" name="dop_count[<?=$k?>]" value="<?=$val?>">
                        <?endforeach;?>
                        <input type="hidden" name="coffe_count" value="<?=$_POST["coffe_count"]?>" />
                        <input type="hidden" name="machina" value="<?=$arResult["MACHINE"][$_POST["machina_id"]]["NAME"]?>" />
                        <input type="hidden" name="machina_id" value="<?=$_POST["machina_id"]?>" />
                        <input type="hidden" name="location" value="<?=$_POST["location"]?>" />
                        <input type="hidden" name="price" value="<?=$_POST["price"] ? $_POST["price"] : $price?>" />
                        <input type="submit"
                               class="btn btn-primary"
                               value="Продолжить&nbsp;&rarr;" />
                    </form>

                </td>
            </tr>
        </table>
        <?elseif($arResult["STEP"] == 6):?>
            <h3>Шаг <?=$arResult["STEP"]?>: если необходимо, выберите чай и доп. товары</h3>
            <form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">

                <div class="margin-top-15 text-left margin-bottom-10">
                    <input type="hidden" name="dop_choose" value="Y">
                    <input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />
                    <input type="hidden" name="coffe_count" value="<?=$_POST["coffe_count"]?$_POST["coffe_count"]:$_POST["costom_coffe_count"]?>" />
                    <input type="hidden" name="machina" value="<?=$_POST["machina"]?>" />
                    <input type="hidden" name="machina_id" value="<?=$_POST["machina_id"]?>" />
                    <input type="hidden" name="location" value="<?=$_POST["location"]?>" />
                    <input type="submit"
                           class="btn btn-default"
                           value="&larr;&nbsp;Назад"
                           name="back" />&nbsp;
                    <input type="submit"
                           class="btn btn-primary"
                           value="Продолжить&nbsp;&rarr;"
                           id="next_step" />
                </div>

                <div class="row margin-top-10">
                    <?
                    $i = 0;
                    foreach($arResult["DOP"] as $machine):
                        if($i && $i%2 == 0)
                            echo '</div><div class="row">';
                        $i++;
                        ?>
                        <div class="col-xs-12 col-sm-6">
                            <div class="row margin-bottom-20">
                                <div class="col-xs-6 text-center">
                                    <label for="dop_<?=$machine["ID"]?>">
                                        <img src="<?=$machine["PREVIEW_PICTURE"]?>"
                                             class="img-responsive img-thumbnail" /></label>
                                    <div class="choose_count">
                                        <input type="checkbox" class="tea_checkbox" name="dop[]" value="<?=$machine["ID"]?>" id="dop_<?=$machine["ID"]?>" />
                                        <span onclick="count_down(this)">-</span>
                                        <input type="text"
                                               maxlength="2"
                                               name="dop_count[<?=$machine["ID"]?>]"
                                               onkeyup="count_input(this)"
                                               value="0"
                                               onfocus='$(this).val("")'
                                               onblur="if (this.value=='') this.value='0'"
                                               class="counter"
                                        />
                                        <span onclick="count_up(this)">+</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <h4>
                                        <a href="<?=$machine["DETAIL_PAGE_URL"]?>" target="_blank"><?=$machine["NAME"]?></a>
                                    </h4>
                                    <?=$machine["PREVIEW_TEXT"]?>

                                </div>
                            </div>
                        </div>
                    <?endforeach;?>
                </div>
                <?foreach($_POST["marka"] as $k=>$val):?>
                    <input type="hidden" name="marka[<?=$k?>]" value="<?=$val?>">
                <?endforeach;?>

            </form>
        <?elseif($arResult["STEP"] == 5):?>
            <h3>Шаг <?=$arResult["STEP"]?>: выберите кофе </h3>
            <form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
                <?foreach($arResult["SECTIONS"] as $section):?>
                    <h1><?=$section["NAME"]?></h1>
                    <div class="row">
                        <?
                        $i=1;
                        foreach($arResult["COFFEE"] as $coffee):
                            if($coffee["IBLOCK_SECTION_ID"] == $section["ID"]):
                                ?>

                                <div class="col-xs-6 col-sm-4 col-md-4 text-center margin-bottom-10">
                                    <img class="img-thumbnail img-thumbnail"
                                         src="<?=$coffee["PREVIEW_PICTURE"]?>" />
                                    <div class="margin-top-10">
                                        <a href="/coffee/<?=$arResult["SECTIONS"][$coffee["IBLOCK_SECTION_ID"]]["CODE"]?>/<?=$coffee["CODE"]?>/"
                                           class="h4"
                                           target="_blank">
                                            <?=$coffee["NAME"]?>
                                        </a>
                                    </div>
                                    <div class="margin-top-10">
                                        <span class="count_down" onclick="count_down(this)">&#8722;</span>
                                        <input type="text"
                                               class="marka_count"
                                               maxlength="2"
                                               name="marka[<?=$coffee["ID"]?>]"
                                               onkeyup="TextChanged(this, event)"
                                               value="0"
                                               onfocus='$(this).val("")'
                                               onblur="if (this.value=='') this.value='0'"
                                        />
                                        <span class="count_up" onclick="count_up(this)">+</span>
                                        <div class="informer"></div>
                                    </div>
                                </div>

                            <?
                            endif;
                        endforeach;
                        ?>
                    </div>
                <?endforeach;?>
                <input type="hidden" name="user" value="<?=$arResult["curent_user"]?>" />
                <input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />
                <input type="hidden" name="coffe_count" value="<?=$_POST["coffe_count"]?$_POST["coffe_count"]:$_POST["costom_coffe_count"]?>" />
                <input type="hidden" name="machina" value="<?=$_POST["machina"]?>" />
                <input type="hidden" name="machina_id" value="<?=$_POST["machina_id"]?>" />
                <input type="hidden" name="location" value="<?=$_POST["location"]?>" />
                <div class="text-left margin-top-10">
                    <input type="submit"
                           class="btn btn-default"
                           value="&larr;&nbsp;Назад"
                           name="back" />&nbsp;
                    <input type="submit"
                           class="btn btn-primary"
                           value="Продолжить&nbsp;&rarr;"
                           id="next_step"
                           disabled="disabled" />
                </div>
            </form>
        <?elseif($arResult["STEP"] == 4):?>
            <h3>Шаг <?=$arResult["STEP"]?>: выберите необходимое кол-во кофе, которое Вы планируете приобретать в месяц:</h3>
            <form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
                <?
                require_once $_SERVER["DOCUMENT_ROOT"] . "/local/inc/steps.php";
                step_3($_POST["machina"]);
                ?>
                <input type="hidden" name="user" value="<?=$arResult["curent_user"]?>" />
                <input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />
                <input type="hidden" name="machina" value="<?=$_POST["machina"]?>" />
                <input type="hidden" name="machina_id" value="<?=$_POST["machina_id"]?>" />
                <input type="hidden" name="location" value="<?=$_POST["location"]?>" />
                <div class="text-left">
                    <input type="submit"
                           class="btn btn-default"
                           value="&larr;&nbsp;Назад"
                           name="back" />&nbsp;
                    <input type="submit"
                           class="btn btn-primary"
                           value="Продолжить&nbsp;&rarr;"
                           id="next_step"
                           disabled="disabled" />
                </div>
            </form>
        <?elseif($arResult["STEP"] == 3):?>
            <h3>Шаг <?=$arResult["STEP"]?>: выберите кофемашину</h3>
            <form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
                <?foreach($arResult["MACHINE"] as $machine):?>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <label class="row margin-bottom-15"
                               onclick="nextStepInformer(this)">

                            <div class="col-xs-5 col-sm-5 col-md-4 text-right">
                                <img src="<?=$machine["PREVIEW_PICTURE"]?>"
                                     class="img-thumbnail img-responsive" />
                            </div>
                            <div class="col-xs-7 col-sm-7 col-md-8">
                                <h4 class="hidden-xs hidden-sm visible-md visible-lg">
                                    <input type="radio"
                                           name="machina"
                                           value="<?=$machine["PROPERTY_VOLUME_VALUE"]?>"
                                           onchange="check_machine(<?=$machine["ID"]?>)" />
                                    <a href="/coffeem/kofemashiny-v-arendu-ot-<?=$arResult["VOLUME"][$arResult["MACHINE"][$machine["ID"]]["PROPERTY_VOLUME_ENUM_ID"]]["VALUE"]?>-kg/<?=$machine["CODE"]?>/" target="_blank">
                                        <?=$machine["NAME"]?>
                                    </a>
                                </h4>
                                <div class="h4 visible-xs visible-sm hidden-md hidden-lg">
                                    <input type="radio"
                                           name="machina"
                                           value="<?=$machine["PROPERTY_VOLUME_VALUE"]?>"
                                           onchange="check_machine(<?=$machine["ID"]?>)" />
                                    <?=$machine["NAME"]?>
                                </div>
                                <h5>Тип кофемашины: <?=$machine["PROPERTY_TYPE_VALUE"]?></h5>
                                <h5>Минимальный заказ кофе в месяц (кг): <?=$machine["PROPERTY_VOLUME_VALUE"]?></h5>
                            </div>
                            <div class="informer">informer</div>
                        </label>
                    </div>
                <?endforeach;?>
                <input type="hidden" name="user" value="<?=$arResult["curent_user"]?>" />
                <input type="hidden" name="machina_id" value="<?=$_POST["machina_id"]?>" id="machina_id" />
                <input type="hidden" name="location" value="<?=$_POST["location"]?>" />
                <input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />
                <div class="text-left">
                    <input type="submit"
                           class="btn btn-default"
                           value="&larr;&nbsp;Назад"
                           name="back" />&nbsp;
                    <input type="submit"
                           class="btn btn-primary"
                           value="Продолжить&nbsp;&rarr;"
                           id="next_step"
                           disabled="disabled" />
                </div>
            </form>
        <?
        elseif($arResult["STEP"] == 2):
            ?>
            <h3>Шаг <?=$arResult["STEP"]?>: выбор местонахождения</h3>
            <form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">
                <?foreach($arResult["location"] as $k=>$val):?>
                    <div class="checkbox">
                        <label>
                            <input type="radio"
                                   name="location"
                                   value="<?=$k?>"
                                   onchange="order_step()" /> <?=$val?>
                        </label>
                    </div>
                <?endforeach;?>
                <input type="hidden" name="user" value="<?=$arResult["curent_user"]?>" />
                <input type="hidden" name="step" value="<?=$arResult["STEP"]?>" />

                <div class="text-left margin-top-10">
                    <input type="submit"
                           class="btn btn-default"
                           value="&larr;&nbsp;Назад"
                           name="back" />&nbsp;
                    <input type="submit"
                           class="btn btn-primary"
                           value="Продолжить&nbsp;&rarr;"
                           id="next_step"
                           disabled="disabled" />
                </div>
            </form>
        <?
        else:
            ?>
            <h3>Шаг 1: Вы уже являетесь нашим клиентом?</h3>
            <form action="<?=$arResult["RESULT"]["FURM_URL"]?>" method="post">

                <?foreach($arResult["user"] as $k=>$val):?>
                    <div class="checkbox">
                        <label>
                            <input type="radio"
                                   name="user"
                                   value="<?=$k?>"
                                   onchange="order_step()" /> <?=$val?>
                        </label>
                    </div>
                <?endforeach;?>

                <div class="text-left">
                    <input type="submit"
                           value="Продолжить&nbsp;&rarr;"
                           id="next_step"
                           class="btn btn-primary"
                           disabled="disabled" />
                </div>
            </form>
        <?endif;?>
</div>