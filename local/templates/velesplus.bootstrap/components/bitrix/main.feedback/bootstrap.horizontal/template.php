<?
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
?>
<form action="<?=POST_FORM_ACTION_URI?>"
      class="form-horizontal"
      method="POST">
    <?=bitrix_sessid_post()?>
    <input type="hidden"
           name="PARAMS_HASH"
           value="<?=$arResult["PARAMS_HASH"]?>">

    <?if(!empty($arResult["ERROR_MESSAGE"])):?>
        <div class="form-group">
            <div class="col-md-offset-3 col-sm-12 col-md-7">
                <div class="alert alert-danger"><?=implode("<br>", $arResult["ERROR_MESSAGE"])?></div>
            </div>
        </div>
    <?endif;?>

    <?if(strlen($arResult["OK_MESSAGE"]) > 0):?>
        <div class="form-group">
            <div class="col-md-offset-3 col-sm-12 col-md-7">
                <div class="alert alert-success"><?=$arResult["OK_MESSAGE"]?></div>
            </div>
        </div>
    <?endif;?>


    <div class="form-group">
        <label for="mf-name"
               class="col-sm-2 col-md-3 col-lg-3 control-label">
            <?=Loc::getMessage("MFT_NAME")?>
            <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>
                <span class="text-danger">*</span>
            <?endif?>
        </label>
        <div class="col-sm-10 col-md-7 col-lg-7">
            <input type="text"
                   name="user_name"
                   value="<?=$arResult["AUTHOR_NAME"]?>"
                   class="form-control"
                   id="mf-name"
                   placeholder="<?=Loc::getMessage("MFT_NAME")?>">

            <input type="text"
                   name="user_last_name"
                   class="form-control hidden"
                   id="mf-last_name"
                   value=""
                   placeholder="<?=Loc::getMessage("MFT_NAME")?>">
        </div>
    </div>

    <div class="form-group">
        <label for="mf-email"
               class="col-sm-2 col-md-3 col-lg-3 control-label">
            <?=Loc::getMessage("MFT_EMAIL")?>
            <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>
                <span class="text-danger">*</span>
            <?endif?>
        </label>
        <div class="col-sm-10 col-md-7 col-lg-7">
            <input type="text"
                   name="user_email"
                   value="<?=$arResult["AUTHOR_EMAIL"]?>"
                   class="form-control"
                   id="mf-email"
                   placeholder="<?=Loc::getMessage("MFT_EMAIL")?>">
        </div>
    </div>

    <div class="form-group">
        <label for="mf-message"
               class="col-sm-2 col-md-3 col-lg-3 control-label">
            <?=Loc::getMessage("MFT_MESSAGE")?>
            <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>
                <span class="text-danger">*</span>
            <?endif?>
        </label>
        <div class="col-sm-10 col-md-7 col-lg-7">
            <textarea name="MESSAGE"
                      class="form-control"
                      placeholder="<?=Loc::getMessage("MFT_MESSAGE")?>"
                      rows="5"><?=$arResult["MESSAGE"]?></textarea>
        </div>
    </div>

    <?if($arParams["USE_CAPTCHA"] == "Y"):?>
        <div class="form-group">
            <label for="mf-captcha"
                   class="col-sm-2 col-md-3 col-lg-3 control-label">
                <?=Loc::getMessage("MFT_CAPTCHA_CODE")?><span class="text-danger">*</span>
            </label>
            <div class="col-sm-10 col-md-7 col-lg-7">
                <input type="hidden"
                       name="captcha_sid"
                       value="<?=$arResult["capCode"]?>">

                <div class="input-group">
                    <span class="input-group-addon">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" height="20" alt="CAPTCHA">
                    </span>
                    <input type="text"
                           class="form-control"
                           name="captcha_word"
                           size="30"
                           maxlength="50"
                           value="">
                </div>

                <span class="help-block"><?=Loc::getMessage("MFT_CAPTCHA")?></span>
            </div>
        </div>
    <?endif;?>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-7">
            <div class="checkbox">
                <label>
                    <input type="checkbox"
                        <?
                        if($_REQUEST["AGREE"] == "Y" || !$_POST){
                            echo "checked";
                        }
                        ?>
                           name="AGREE" value="Y"> <?=Loc::getMessage("MFT_AGREE_TEXT")?>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-3 col-md-7">
            <input type="submit"
                   name="submit"
                   class="btn btn-primary"
                   value="<?=GetMessage("MFT_SUBMIT")?>">
        </div>
    </div>
</form>