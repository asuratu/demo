<?php
require $this->__RAD__ . 'component/global/head.php';
?>
<body>
<?php
require $this->__RAD__ . 'component/global/header.php';
?>
    <div class="container">
<?php
require $this->__RAD__ . 'component/global/landscape.php';
?>
        <div class="about_cont">
            <div class="all">
                <div class="about">
                    <h2>Enterprise introduction</h2>
                    <div class="clearboth">
                        <img src="<?= $this->__STATIC__?>images/about/img1.jpg" alt="">
                        <div class="text">
                            <h3>Shanghai Hengxiang Optical Electronics Co,ltd.</h3>
                            <p>It is a production enterprise specializing in R &amp; D, production, sales and optical cold processing of rotary encoders.</p>
                            <p>Our company's main products include rotary encoder, grating encoder, infrared lens, filter, optical lens, metal germanium and so on.</p>
                            <p>After more than ten years of continuous development and efforts, the products of Heng Xiang brand have been sold to all over the country and all over the world, and are widely used in various automation control, scientific research institutions, military industry and other industries, which are deeply trusted and praised by the broad masses of customers.</p>
                            <p>The company has established a complete quality management system and process standard through ISO9001-2000 quality system certification. Excellent manufacturing equipment, advanced processing technology and perfect quality assurance system provide a fundamental guarantee for the development and trust of users.</p>
                            <p>Our goal: let's work hand in hand, win win win and win the future.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="honor">
                <div class="all">
                    <h2>OUR CERTIFICATE</h2>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ($this->paper as $val):
                                ?>
                                <div class="swiper-slide"><div class="relative"><img src="<?= $this->__CDN__?>pics/l/<?= $val->ad_img ?>" alt=""><img class="border" src="<?= $this->__STATIC__?>images/about/border.png" alt=""></div></div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require $this->__RAD__ . 'component/global/footer.php';
?>
    <script>
        $(function () {
            resize();
            $(window).resize(function(){
                resize();
            })
        })
        function resize(){
            if($(window).width()<=1366 && $(window).width()>1024){
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 4,
                    loop:true
                });
                $('.swiper-button-prev').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipePrev()
                })
                $('.swiper-button-next').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipeNext()
                })
            }else if($(window).width()<=1024 && $(window).width()>510){
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 3,
                    loop:true
                });
                $('.swiper-button-prev').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipePrev()
                })
                $('.swiper-button-next').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipeNext()
                })
            }else if($(window).width()<=510){
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 2,
                    loop:true
                });
                $('.swiper-button-prev').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipePrev()
                })
                $('.swiper-button-next').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipeNext()
                })
            }else{
                var mySwiper = new Swiper('.swiper-container',{
                    slidesPerView: 5,
                    loop : true
                });
                $('.swiper-button-prev').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipePrev()
                })
                $('.swiper-button-next').on('click', function(e){
                    e.preventDefault()
                    mySwiper.swipeNext()
                })
            }
        }
    </script>
</body>
</html>
