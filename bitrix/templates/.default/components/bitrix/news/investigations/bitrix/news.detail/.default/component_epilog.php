<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

itc\CUncachedArea::startCapture();
?>
    <a href="<?=INVESTIGATIONS_URL?>" class="newsItem__backlink">
        <?
        // проблема с кешем
        //=GetMessage("NEWS_DETAIL_BACK")
        ?>
        вернуться к списку исследований
    </a>
<?
$showInvestigationsBackLink = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent("showInvestigationsBackLink", $showInvestigationsBackLink);
?>