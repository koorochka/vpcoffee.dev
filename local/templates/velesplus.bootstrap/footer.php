<?
/**
 * @var CMain $APPLICATION
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $page;
?>
<?
if(
    $page !== SITE_DIR . "order/index.php" &&
    $page !== SITE_DIR . "prices/witout.coffee/index.php"
):?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "content.block",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_TEMPLATE_PATH . "/include_areas/content_block.php",
            "EDIT_TEMPLATE" => ""
        ),
        false
    );?>
<?endif?>

</div>
</div>
</div>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png"
                     class="img-responsive"
                     width="184"
                     height="93" />
                <div class="margin-top-10">
                    <?$APPLICATION->IncludeFile(
                        $APPLICATION->GetTemplatePath("include_areas/footer_copyright.php"),
                        Array(),
                        Array("MODE"=>"html")
                    );?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3" id="dotted-col">
                <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", array(
                    "ROOT_MENU_TYPE" => "bottom",
                    "MENU_CACHE_TYPE" => "Y",
                    "MENU_CACHE_TIME" => "3600000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "bottom",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                    false
                );?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
                <?$APPLICATION->IncludeFile(
                    $APPLICATION->GetTemplatePath("include_areas/footer_block.php"),
                    Array(),
                    Array("MODE"=>"html")
                );?>

                <p><a href="http://beloglazov.su">Разработка сайта</a></p>
            </div>
        </div>
    </div>
</footer>

</div><!-- layout-swipe -->
<div class="header-top visible-xs">
    <a onclick="return layoutSwipe.toggle()"
       title="Close"
       class="pull-right text-24 text-nonunderline margin-right-20">x</a>
    <?$APPLICATION->IncludeComponent("bitrix:menu", "mobile", array(
        "ROOT_MENU_TYPE" => "mobile",
        "MENU_CACHE_TYPE" => "Y",
        "MENU_CACHE_TIME" => "3600000000",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(
        ),
        "MAX_LEVEL" => "2",
        "CHILD_MENU_TYPE" => "left",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N"
    ),
        false
    );?>
</div>
</div><!-- layout -->

<?if($APPLICATION->GetCurDir() !== "/order/"):?>
    <form class="modal fade"
          action="<?=SITE_DIR?>local/ajax/shopping.cart.php"
          method="post"
          data-ajax="<?=SITE_DIR?>local/ajax/shopping.cart.php"
          data-guest="<?=SITE_DIR?>order/guest_form.php"
          data-order="<?=SITE_DIR?>order/order_form.php"
          onsubmit="return velesCalculator.submit(this)"
          id="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="order_form">
            </div>
        </div>
    </form>
<?endif;?>

</body>
</html>