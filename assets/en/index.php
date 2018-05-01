<?php
require $this->__RAD__ . 'component/global/head.php';
?>
<body>
<?php
require $this->__RAD__ . 'component/global/header.php';
?>
<div class="container">
    <div class="main_banner swiper-container">
        <div class="swiper-wrapper">
            <?php
            foreach ($this->aryAd as $val):
            ?>
            <div class="swiper-slide"><img src="<?= $this->__CDN__?>pics/l/<?= $val->ad_img ?>" alt=""></div>
            <?php
            endforeach;
            ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div class="phone_banner swiper-container3">
        <div class="swiper-wrapper">
            <?php
            foreach ($this->aryAdMb as $val):
                ?>
                <div class="swiper-slide"><img src="<?= $this->__CDN__?>pics/l/<?= $val->ad_img ?>" alt=""></div>
                <?php
            endforeach;
            ?>
        </div>
        <div class="swiper-pagination3"></div>
    </div>
    <div class="margin">
        <div class="product">
            <div class="main-tit all clearboth">
                <h2>PRODUCT</h2>
                <p>The products include rotary encoder, grating encoder, infrared lens, filter, optical lens and metal germanium products.</p>
            </div>
            <div class="list swiper-container2">
                <div class="swiper-wrapper clearboth">
                   <?php
                    foreach ($this->code as $val):
                    ?>
                        <div class="swiper-slide">
                                <a href="<?= $val->ad_url ?>">
                                    <div class="imgbox hoverscal">
                                        <img src="<?= $this->__CDN__?>pics/l/<?= $val->ad_img?>" alt="">
                                    </div>
                                    <div class="mask"><?= $val->ad_title ?></div>
                                </a>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <div class="swiper-button-next2"></div>
                <div class="swiper-button-prev2"></div>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="margin">
            <div>
                <img src="<?= $this->__STATIC__?>images/img2.jpg" alt="">
                <div class="textbox">
                    <table>
                        <tr>
                            <td>
                                <h3>About Us</h3>
                                <p>It is a production enterprise specializing in R &amp; D, production, sales and optical cold processing of rotary encoders.<span>Our company's main products include rotary encoder, grating encoder, infrared lens and filter.</span><span>Optical lens, metal germanium products and so on.</span></p>
                                <a href="/en/enabout">View More</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="margin">
        <div class="apply">
            <div class="main-tit all clearboth">
                <h2>INDUSTRY</h2>
            </div>
            <div class="rel">
                <div class="clearboth">
                    <div class="float_l w48">
                        <div class="text text1">
                            <img class="img" src="<?= $this->__STATIC__?>images/img7.jpg" alt="">
                            <div class="table">
                                <table>
                                    <tr>
                                        <td>
                                            <h3>Our mission</h3>
                                            <p>Market oriented, focus on customer needs, and continuous improvement to enhance product quality and exceed customer expectations.<span>Establish an open concept and constantly learn and make use of advanced management concepts....</span></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="imgbox hoverscal">
                            <a href="/en/enculture"><img src="<?= $this->__STATIC__?>images/img8.jpg" alt=""></a>
                            <div class="mask">corporate culture</div>
                        </div>
                    </div>
                    <div class="float_r w48">
                        <div class="imgbox big hoverscal">
                            <a href="/en/encompany-news"><img src="<?= $this->__STATIC__?>images/img4.jpg" alt=""></a>
                            <div class="mask">News information</div>
                        </div>
                    </div>
               </div>
                <div class="clearboth">
                    <div class="clearboth float_l w48">
                        <div class="imgbox float_l min hoverscal">
                           <a href="/en/enafter-sale/"><img src="<?= $this->__STATIC__?>images/img5.jpg" alt=""></a>
                            <div class="mask">After-sale service</div>
                        </div>
                        <div class="imgbox float_r min hoverscal">
                            <a href="/en/enterms"><img src="<?= $this->__STATIC__?>images/img6.jpg" alt=""></a>
                            <div class="mask">Technical terms</div>
                        </div>
                    </div>
                    <div class="text text2 float_r w48">
                        <img class="img" src="<?= $this->__STATIC__?>images/img7.jpg" alt="">
                        <div class="table">
                            <table>
                                <tr>
                                    <td>
                                        <a href="/en/eninformation">
                                            <img src="<?= $this->__STATIC__?>images/icon3.png" alt="">
                                            <em>Contact us</em>
                                            <i>Tel：021-54613487 / 54351672 <span>Address：R301,Building7,Lane 115,No.1276 Nanle Road,SongJiang,Shanghai,201600 </span></i>
                                        </a>  
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
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
        var mySwiper = new Swiper('.swiper-container',{
            pagination: '.swiper-pagination',
            autoplay : 8000,
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
        var mySwiper3 = new Swiper('.swiper-container3',{
            pagination: '.swiper-pagination3',
            autoplay : 4000,
            loop : true
        });
        var swiper2 = new Swiper('.swiper-container2',{
            autoplay : 4000,
            slidesPerView: 3,
            loop : true,
            onSlideChangeEnd: function(swiper){
                $('.product .swiper-slide').removeClass('active');
                $('.product .swiper-slide-active').next().addClass('active');
            }
        });
        $('.product .swiper-slide-active').next().addClass('active');
        $('.swiper-button-prev2').on('click', function(e){
            e.preventDefault()
            swiper2.swipePrev()
        })
        $('.swiper-button-next2').on('click', function(e){
            e.preventDefault()
            swiper2.swipeNext()
        })
    })
    function resize(){
        var ww = $(window).width(),
            wh = ww / 1920*720;
        ph = ww / 640*320;
        $('.main_banner').height(wh);
        $('.phone_banner').height(ph);
    }
</script>
</body>
</html>
