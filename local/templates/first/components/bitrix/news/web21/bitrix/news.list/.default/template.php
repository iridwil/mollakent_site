
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
<h3 class="w3ls-title text-uppercase"><?$APPLICATION->ShowTitle(false);?></h3>
<div class="agileits-top-row row py-md-5">
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
		<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="col-lg-4 col-md-6 my-md-0 my-4">
			<div class="agileits-about-grids">
				 				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><h4><?echo $arItem["NAME"]?></h4></a>
<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="100%"
						/></a>
 <br>
 <br>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><p>
					 <?echo $arItem["PREVIEW_TEXT"];?>
				</p></a>
				<p align="right">
					 <?echo $arItem["DISPLAY_ACTIVE_FROM"]?>
				</p>
			</div>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>
</div>
