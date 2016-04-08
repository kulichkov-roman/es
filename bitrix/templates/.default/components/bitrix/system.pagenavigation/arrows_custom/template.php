<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$ClientID = 'navigation_'.$arResult['NavNum'];

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>

<?
/*
<div class="news__toolbarPaginator">
    <div class="paginator">
        <span class="paginator__title">перейти на страницу:</span>
        <a href="#" class="paginator__arrow _prev"></a>
        <ul class="paginator__list">
            <li class="paginator__listItem">
                <a href="#" class="paginator__listItemLink _active">1</a>
            </li>
            <li class="paginator__listItem">
                <a href="#" class="paginator__listItemLink">2</a>
            </li>
            <li class="paginator__listItem">
                <a href="#" class="paginator__listItemLink">3</a>
            </li>
            <li class="paginator__listItem">
                <a href="#" class="paginator__listItemLink">...</a>
            </li>
            <li class="paginator__listItem">
                <a href="#" class="paginator__listItemLink">200</a>
            </li>
        </ul>
        <a href="#" class="paginator__arrow _next"></a>
    </div>
</div>
*/
?>

<div class="news__toolbarPaginator">
<?
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
if($arResult["bDescPageNumbering"] === true)
{
	// to show always first and last pages
	$arResult["nStartPage"] = $arResult["NavPageCount"];
	$arResult["nEndPage"] = 1;

	$sPrevHref = '';
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
	{
		$bPrevDisabled = false;
		if ($arResult["bSavePage"])
		{
			$sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
		}
		else
		{
			if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1))
			{
				$sPrevHref = $arResult["sUrlPath"].$strNavQueryStringFull;
			}
			else
			{
				$sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
			}
		}
	}
	else
	{
		$bPrevDisabled = true;
	}
	
	$sNextHref = '';
	if ($arResult["NavPageNomer"] > 1)
	{
		$bNextDisabled = false;
		$sNextHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
	}
	else
	{
		$bNextDisabled = true;
	}
	?>
		<div class="navigation-arrows">
			<span class="arrow">&larr;</span><span class="ctrl"> ctrl</span>&nbsp;<?if ($bPrevDisabled):?><span class="disabled"><?=GetMessage("nav_prev")?></span><?else:?><a href="<?=$sPrevHref;?>" id="<?=$ClientID?>_previous_page"><?=GetMessage("nav_prev")?></a><?endif;?>&nbsp;<?if ($bNextDisabled):?><span class="disabled"><?=GetMessage("nav_next")?></span><?else:?><a href="<?=$sNextHref;?>" id="<?=$ClientID?>_next_page"><?=GetMessage("nav_next")?></a><?endif;?>&nbsp;<span class="ctrl">ctrl </span><span class="arrow">&rarr;</span>
		</div>

		<div class="navigation-pages">
			<span class="navigation-title"><?=GetMessage("pages")?></span>
	<?
	$bFirst = true;
	$bPoints = false;
	do
	{
		$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
		if ($arResult["nStartPage"] <= 2 || $arResult["NavPageCount"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
		{

			if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
	?>
			<span class="nav-current-page"><?=$NavRecordGroupPrint?></span>
	<?
			elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
	?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
	<?
			else:
	?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
	<?
			endif;
			$bFirst = false;
			$bPoints = true;
		}
		else
		{
			if ($bPoints)
			{
	?>...<?
				$bPoints = false;
			}
		}
		$arResult["nStartPage"]--;
	} while($arResult["nStartPage"] >= $arResult["nEndPage"]);
}
else
{
	// to show always first and last pages
	$arResult["nStartPage"] = 1;
	$arResult["nEndPage"] = $arResult["NavPageCount"];

	$sPrevHref = '';

    if ($arResult["NavPageNomer"] > 1)
	{
		$bPrevDisabled = true;
		
		if ($arResult["bSavePage"] || $arResult["NavPageNomer"] > 2)
		{
			$sPrevHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1);
		}
		else
		{
			$sPrevHref = $arResult["sUrlPath"].$strNavQueryStringFull;
		}
	}
	else
	{
		$bPrevDisabled = false;
	}

	$sNextHref = '';
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
	{
		$bNextDisabled = true;
		$sNextHref = $arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1);
	}
	else
	{
		$bNextDisabled = false;
	}
	?>
        <div class="paginator">
            <span class="paginator__title"><?=GetMessage("PAGENAV_GOTO_PAGE");?></span>

            <?if ($bPrevDisabled){?>
                <a href="<?=$sPrevHref;?>" id="<?=$ClientID?>_previous_page" class="paginator__arrow _prev"></a>
            <?}?>
	<?
	$bFirst = true;
	$bPoints = false;
    ?>
    <ul class="paginator__list">
        <?
	    do
	    {
	    	if ($arResult["nStartPage"] <= 2 || $arResult["nEndPage"]-$arResult["nStartPage"] <= 1 || abs($arResult['nStartPage']-$arResult["NavPageNomer"])<=2)
	    	{
                ?>
                    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]) {?>
                        <li class="paginator__listItem">
                            <span class="paginator__listItemLink _active"><?=$arResult["nStartPage"]?></span>
                        </li>
                    <?} elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false) {?>
                        <li class="paginator__listItem">
                            <a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="paginator__listItemLink"><?=$arResult["nStartPage"]?></a>
                        </li>
	    		    <?} else {?>
                        <li class="paginator__listItem">
                            <a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="paginator__listItemLink"><?=$arResult["nStartPage"]?></a>
                        </li>
	                <?
                    }
	    		    $bFirst = false;
	    		    $bPoints = true;
	    	}
	    	else
	    	{
	    		if ($bPoints)
	    		{
	                ?>
                    <li class="paginator__listItem">
                        <a href="javascript:void(0);" class="paginator__listItemLink">...</a>
                    </li>
                    <?
	    			$bPoints = false;
	    		}
	    	}
	    	$arResult["nStartPage"]++;
	    } while($arResult["nStartPage"] <= $arResult["nEndPage"]);
        ?>
    </ul>
    <?
}
?>
        <?if ($bNextDisabled){?>
            <a href="<?=$sNextHref;?>" id="<?=$ClientID?>_next_page" class="paginator__arrow _next"></a>
        <?}?>
	</div>
</div>
<?CJSCore::Init();?>
<script type="text/javascript">
	BX.bind(document, "keydown", function (event) {

		event = event || window.event;
		if (!event.ctrlKey)
			return;

		var target = event.target || event.srcElement;
		if (target && target.nodeName && (target.nodeName.toUpperCase() == "INPUT" || target.nodeName.toUpperCase() == "TEXTAREA"))
			return;

		var key = (event.keyCode ? event.keyCode : (event.which ? event.which : null));
		if (!key)
			return;

		var link = null;
		if (key == 39)
			link = BX('<?=$ClientID?>_next_page');
		else if (key == 37)
			link = BX('<?=$ClientID?>_previous_page');

		if (link && link.href)
			document.location = link.href;
	});
</script>