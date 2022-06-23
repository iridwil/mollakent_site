<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div style="display:none; margin: 0 auto" class="html5gallery" data-skin="light" data-width="340" data-height="400">
<?foreach($arResult as $element_id=>$element){
    if($img_path = $element['PREVIEW_PICTURE']['SRC']){?>
        <a href="<?=$img_path?>"><img alt="<?=$element['NAME']?>" src="<?=$img_path?>"></a>
    <?}?>
    <?if($element['PROPERTY_YOUTUBE_VALUE']){
        $url = $element['PROPERTY_YOUTUBE_VALUE'];
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);?>
        <a href="https://www.youtube.com/watch?v=<?=$params['v']?>"><img alt="<?=$element['NAME']?>" src="http://img.youtube.com/vi/<?=$params['v']?>/1.jpg"></a>
    <?}?>
    <?/*
    <!-- Add videos to Gallery --> <a href="/images/Big_Buck_Bunny.mp4"><img alt="Big Buck Bunny, Copyright Blender Foundation" src="/images/Big_Buck_Bunny.jpg"></a>
    <!-- Add Youtube video to Gallery --> <a href="http://www.youtube.com/embed/YE7VzlLtp-4"><img alt="Youtube Video" src="http://img.youtube.com/vi/YE7VzlLtp-4/2.jpg"></a>
    <!-- Add Vimeo video to Gallery --> <a href="http://player.vimeo.com/video/1084537?title=0&byline=0&portrait=0"><img alt="Vimeo Video" src="images/Big_Buck_Bunny.jpg"></a>
    */?>
<?}?>
   </div>
<br>
<br>
<br>