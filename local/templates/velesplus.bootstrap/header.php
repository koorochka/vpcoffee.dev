<?
/**
 * @var CMain $APPLICATION
 */
use Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Page\Asset,
    \Bitrix\Main\Application;
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
Loc::loadLanguageFile(__FILE__);
global $page;
$page = $APPLICATION->GetCurPage(true);

$application = Application::getInstance();
$context = $application->getContext();
$request = $context->getRequest();
/**
 * Set styles
 */
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/bootstrap.min.css");
Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/shopping.cart.min.css");
/**
 * Set Js
 */
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.2.1.min.js");
Asset::getInstance()->addJs("//code.jquery.com/jquery-3.0.0.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/modal.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/script.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/shopping.cart.min.js");
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117408779-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-117408779-1');
	</script>
    <meta charset="<?=LANG_CHARSET?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>" />
    <meta name="format-detection" content="telephone=no">
    <title><?$APPLICATION->ShowTitle("title")?></title>
    <?$APPLICATION->ShowHead();?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- /Yandex.Metrika counter -->
<div class="layout">
    <div class="layout-swipe">
        <?$APPLICATION->ShowPanel();?>
        <header id="header">
            <div class="container">
                <div class="row margin-bottom-15 margin-top-10">
                    <div class="col-xs-4 col-sm-4 visible-xs navbar-toggle-block">
                        <button type="button"
                                onclick="return layoutSwipe.toggle()"
                                class="navbar-toggle">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="col-xs-8 col-sm-4 col-md-4">
                        <a href="<?=SITE_DIR?>">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png"
                                 id="site-logo"
                                 class="img-responsive"
                                 width="184"
                                 height="93" />
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 text-center">
                        <div class="margin-bottom-20 text-24"><?=Loc::getMessage("HEADER_ARENDA")?></div>
                        <div class="row">
                            <div class="col-md-6 margin-bottom-10"><a href="<?=SITE_DIR?>coffeem/" class="text-16 btn btn-<?=$page == SITE_DIR ."coffeem/index.php" ? "info" : "warning"?>">при покупке кофе</a></div>
                            <div class="col-md-6 margin-bottom-10"><a href="<?=SITE_DIR?>prices/witout.coffee/" class="text-16 btn btn-<?=$page == SITE_DIR ."prices/witout.coffee/index.php" ? "info" : "warning"?>">без покупки кофе</a></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 text-right">
                        <?$APPLICATION->IncludeFile(
                            $APPLICATION->GetTemplatePath("include_areas/header_phones.php"),
                            Array(),
                            Array("MODE"=>"html")
                        );?>
                    </div>
                </div>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
                    "ROOT_MENU_TYPE" => "top",
                    "MENU_CACHE_TYPE" => "Y",
                    "MENU_CACHE_TIME" => "3600000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                    false
                );?>
                <?if($page == "/index.php"):?>
                    <div class="row margin-bottom-25">
                        <div class="col-xs-12">
                            <a href="/order/">
                                <img src="/images/promo.png"
                                     class="img-responsive"
                                     width="100%">
                            </a>
                        </div>
                    </div>
                <?endif;?>
            </div>
        </header>

        <div class="container margin-top-25">
            <div class="row">
                <div class="hidden-xs col-sm-4 col-md-3 margin-bottom-50">
                    <div id="sidebur">
                        <?
                        $APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                            "AREA_FILE_SHOW" => "sect",
                            "AREA_FILE_SUFFIX" => "inc",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "standard.php"
                        ));
                        ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-9 margin-bottom-50">
                    <?if($APPLICATION->GetCurDir() !== "/order/"):?>
                        <div onclick="return velesCalculator.open()"
                             id="veles-calculator"
                             class="btn btn-warning pull-right margin-bottom-15 margin-top-0"><?=Loc::getMessage("HEADER_CALCULATOR_BTN")?></div>
                    <?endif;?>

                    <h1 class="text-24"><?$APPLICATION->ShowTitle(false)?></h1>

