<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>

<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">

<head>
	<?$APPLICATION->ShowHead();?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?$APPLICATION->ShowTitle();?></title>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145094080-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-145094080-1');
	</script>
	
    <!-- Custom Theme files -->
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/bootstrap.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/blast.min.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/lightbox.min.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/portfolio.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/font-awesome.min.css");?>
    <?$APPLICATION->AddHeadString("<link href='https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' rel='stylesheet' type='text/css'>");?>
    
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" style="background-color: white">
<?if($USER->IsAdmin()):?><br><br><br><?endif;?>
<?$APPLICATION->ShowPanel();?>
   <?/*
	<div class="blast-box">
        <div class="blast-frame">
            <p>color schemes</p>
            <div class="blast-colors d-flex justify-content-center">
                <div class="blast-color">#25e0ff</div>
                <div class="blast-color">#feb800</div>
                <div class="blast-color">#f25050</div>
                <div class="blast-color">#18e7d3</div>
                <!-- you can add more colors here -->
            </div>
            <p class="blast-custom-colors">Choose Custom color</p>
            <input type="color" name="blastCustomColor" value="#cf2626">

        </div>
        <div class="blast-icon"><i class="fa fa-cog" aria-hidden="true"></i></div>

    </div>
	*/?>
	 
    <div id="home" class="banner" data-blast="bgColor">
	
	
        <!-- header -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light navbar-fixed-top">
            <div class="container">
                <h1 class="wthree-logo">
                    <a href="/" id="logoLink" data-blast="color">mollakent&nbsp;</a>
                </h1>
                <div class="nav-item  position-relative">
                    <a href="/#menu" id="toggle">
                        <span></span>
                    </a>
                    <div id="menu">
                        <ul>
                            <li><a data-blast="color" href="/">Кьилин чин</a></li>
                            <?//<li><a data-blast="color" href="#about" class="scroll">About</a></li>?>
                            <?//<li><a data-blast="color" href="#portfolio" class="scroll">Малуматар</a></li>?>
                            <?//<li><a data-blast="color" href="#services" class="scroll">Services</a></li>?>
							<li><a data-blast="color" href="/news/" >Хабарар</a></li>
                            <?if($APPLICATION->GetCurPage(false) === '/'):?>
							<li><a data-blast="color" href="#services2" class="scroll">Реклама це</a></li>
                            <?endif;?>
                            <li><a data-blast="color" href="/chaz-kkhikh.php" >Чаз кхьихь</a></li>
                            <li><a data-blast="color" href="/tiebiat/" >TIебиат</a></li>
                            <li><a data-blast="color" href="/lezgi-translit/" >Lezgi translit</a></li>
                            <?//<li><a data-blast="color" href="#testi" class="scroll">Testimonials</a></li>?>
                            <?//<li><a data-blast="color" href="#contact" class="scroll">Contact</a></li>?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- //header -->
	</div>
	<?if($APPLICATION->GetCurPage(false) !== '/'):?>
		<div class="mycont">
	<?endif;?>
