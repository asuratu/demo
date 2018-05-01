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
                    <h2>企业简介<p>Enterprise introduction</p></h2>
                    <div class="clearboth">
                        <img src="<?= $this->__STATIC__?>images/about/img1.jpg" alt="">
                        <div class="text">
                            <h3>上海恒祥光学电子有限公司</h3>
                            <p>是一家专业从事旋转编码器研发、生产、销售和光学冷加工的生产型企业。</p>
                            <p>本公司主要生产经营的产品有旋转编码器、光栅码盘、红外透镜、滤光片、光学透镜、金属锗产品等。</p>
                            <p>公司经十几年不断的发展和努力，恒祥品牌的产品已经销往全国和世界各地，广泛应用于各种自动化控制、科研单位学校、军工等行业中，深得广大客户的信赖和好评。</p>
                            <p>公司通过ISO9001-2000质量体系认证，建立了完整的品质管理体系和工艺标准。 精良的生产设备，先进的加工工艺齐全的检测手段，完善的质保体系，为企业发展和取信于用户提供了根本保证。</p>
                            <p>我们的目标：让我们携手合作，利益双赢走向未来!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="honor">
                <div class="all">
                    <h2>荣誉证书<p>Our certificate</p></h2>
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
