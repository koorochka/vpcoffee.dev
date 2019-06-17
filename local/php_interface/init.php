<?
AddEventHandler("main", "OnBeforeEventAdd", array("MainHandlers", "OnBeforeEventAddHandler"));
class MainHandlers
{
   function OnBeforeEventAddHandler($event, $lid, $arFields)
   {
      if ($event == "ORDER" && $arFields["file"]) # && file_exists($_SERVER["DOCUMENT_ROOT"].$arFields["file"])
      {
		require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/mail_attach.php");
		SendAttache($event, $lid, $arFields, explode(",", $arFields["file"])); // "/aksoft/test.php"
		unlink($_SERVER["DOCUMENT_ROOT"].$arFields["file"]);
		 $event = 'null'; 
		 $lid = 'null';
      }
   }
}

if (!function_exists("d") )
{
    function d($value)
    {
        if ( is_array( $value ) || is_object( $value ) )
        {
            echo "<pre style=\"background:#363636; color:#fff\">".htmlspecialcharsbx( print_r($value, true) )."</pre>";
        }
        else
        {
            echo "<pre style=\"background:#363636; color:#fff\">".htmlspecialcharsbx($value)."</pre>";
        }
    }
}
?>
