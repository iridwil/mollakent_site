<?if($APPLICATION->GetCurPage(false) !== '/'):?>
    </div>
<?endif;?>

<!-- footer -->
<footer class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h2 class="agile-title"><a href="/" class="text-capitalize" data-blast="color">Mollakent</a></h2>
            </div>
            <div class="col-lg-3  mt-lg-0 mt-4">
                <ul class="list-agileits">
                    <li>
                        <a href="/" class="text-secondary">
                            Кьилин чин
                        </a>
                    </li>
                    <li class="my-3">
                        <a href="#services2" class="scroll text-secondary">
                            Реклама це
                        </a>
                    </li>
                    <li>
                        <a href="/chaz-kkhikh.php" class="text-secondary">
                            Чаз кхьихь
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 mt-lg-0 my-4">
                <div class="fv3-contact">
                    <span class="fa fa-envelope-open mr-2" data-blast="color"></span>
                    <p>
                        <a href="mailto:example@email.com" class="text-secondary">r.magomed.i@mail.ru</a>
                    </p>
                </div>
                <div class="fv3-contact my-3">
                    <span class="fa fa-phone mr-2" data-blast="color"></span>
                    <p class="text-secondary">+7(929) 945-97-99</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="subscribe-grid">
                    <h6 class="footer-wthree text-secondary">ЦIийивилерикай хабарар</h6>
                    <form action="#" method="post" class="form-inline mt-3 border-bottom">
                        <input type="email" placeholder="Куь почта" name="Subscribe" required="">
                        <button class="btn1">
                            <i class="fa fa-paper-plane" data-blast="color"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- //footer -->
<div class="cpy-right text-center py-2" data-blast="bgColor">
    <p class="text-dark">© 2018 Palette. All rights reserved | Design by
        <a href="http://w3layouts.com" class="text-white"> W3layouts.</a>
    </p>
</div>


<script src="/js/menu.js"></script>
<script src="/js/blast.min.js"></script>

<script src="/js/jquery-2.2.3.min.js"></script>
<script src="/js/lightbox-plus-jquery.min.js"></script>

<script src="/js/scrolling-nav.js"></script>
<script src="/js/move-top.js"></script>
<script src="/js/easing.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();

            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 1000);
        });
    });
</script>
<!-- //end-smooth-scrolling -->
<!-- smooth-scrolling-of-move-up -->
<script>
    $(document).ready(function () {


        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>


<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/SmoothScroll.min.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/bootstrap.js");?>

<script src="/js/SmoothScroll.min.js"></script>
<script src="/js/bootstrap.js"></script>

<!--  menu toggle -->
<script src="/js/menu.js"></script>

<!-- слайдер html5gallery -->
<?//$APPLICATION->AddHeadScript("/html5gallery/jquery.js");?>
<?//$APPLICATION->AddHeadScript("/html5gallery/html5gallery.js");?>
<script type="text/javascript" src="/html5gallery/jquery.js"></script>
<script type="text/javascript" src="/html5gallery/html5gallery.js"></script>

</body>

</html>