<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

itc\CUncachedArea::startCapture();
?>
    <a href="<?=SCIENCE_REVIEWS_URL?>" class="newsItem__backlink">
        <?
        // проблема с кешем
        //=GetMessage("NEWS_DETAIL_BACK")
        ?>
        вернуться к отзывам
    </a>
<?
$showScienceReviewsBackLink = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent("showScienceReviewsBackLink", $showScienceReviewsBackLink);
?>