<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="d_galery">	
	<?foreach ($arResult["ITEMS"] as $arElement):?>
		<div class="img">
			<div class="wr">
				<a href="<?=$arElement["LINK"]?>" class="imgWrap fancybox" rel="group_id">
					<img src="<?=$arElement["THUMB"]?>" alt="">
				</a>
			</div>
		</div>
	<?endforeach;?>	
</div>
<div class="clear"></div>

<?//echo "<pre>"; print_r($arResult);?>