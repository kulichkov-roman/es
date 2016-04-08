<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

itc\CUncachedArea::startCapture();
?>
    <a href="<?=PATENTS_URL?>" class="newsItem__backlink">
        <?
        // проблема с кешем
        //=GetMessage("NEWS_DETAIL_BACK")
        ?>
        вернуться к списку патентов
    </a>
<?
$showPatentsBackLink = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent("showPatentsBackLink", $showPatentsBackLink);
?>