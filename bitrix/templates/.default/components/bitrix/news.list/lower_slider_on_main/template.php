<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if($arResult["ITEMS"]){?>
	<div class="page__section">
	    <div class="carousel">
	        <div class="carousel__wrapper">
	            <ul class="carousel__list">
	            	<?foreach ($arResult["ITEMS"] as $key => $arItem){
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
						<li class="carousel__listItem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>" class="carousel__listItemLink">
							    <?
							    $pictId = $arItem["PREVIEW_PICTURE"]["ID"];
							    if(!$pictId){
							    	$pictId = NO_PHOTO_ID;
							    }
							    $pictExt = GetFileExtension(CFile::GetPath($pictId));
							    ?>
							    <img src="<?=itc\Resizer::get($pictId, 'crop', '184', '113', $pictExt)?>" alt="" title="<?=$arItem["NAME"]?>" class="carousel__listItemImg"/>
							    <div class="carousel__listItemTitle"><?=$arItem["NAME"]?></div>
							</a>
						</li>
	            	<?}?>
	            </ul>
	        </div>
	        <a href="#" class="carousel__control _prev"></a>
	        <a href="#" class="carousel__control _next"></a>
	    </div>
    </div>
<?}?>