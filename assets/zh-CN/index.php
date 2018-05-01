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
                <h2>产品展示</h2>
                <p>产品有旋转编码器、光栅码盘、红外透镜、滤光片、光学透镜、金属锗产品</p>
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
                                <h3>关于恒祥</h3>
                                <p>是一家专业从事旋转编码器研发、生产、销售和光学冷加工的生产型企业。<span>本公司主要生产经营的产品有旋转编码器、光栅码盘、红外透镜、滤光片</span><span>光学透镜、金属锗产品等。</span></p>
                                <a href="/about">查看更多</a>
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
                <h2>关于恒祥</h2>
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
                                            <h3>我们的使命</h3>
                                            <p>以市场为导向，关注顾客需求，通过持续改进，以提升产品质量超越顾客期望<span>树立开放观念，不断学习和利用先进管理理念...</span></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="imgbox hoverscal">
                            <a href="/culture"><img src="<?= $this->__STATIC__?>images/img8.jpg" alt=""></a>
                            <div class="mask">企业文化</div>
                        </div>
                    </div>
                    <div class="float_r w48">
                        <div class="imgbox big hoverscal">
                            <a href="/company-news"><img src="<?= $this->__STATIC__?>images/img4.jpg" alt=""></a>
                            <div class="mask">新闻动态</div>
                        </div>
                    </div>
               </div>
                <div class="clearboth">
                    <div class="clearboth float_l w48">
                        <div class="imgbox float_l min hoverscal">
                           <a href="/after-sale/"><img src="<?= $this->__STATIC__?>images/img5.jpg" alt=""></a> 
                            <div class="mask">售后服务</div>
                        </div>
                        <div class="imgbox float_r min hoverscal">
                            <a href="/terms"><img src="<?= $this->__STATIC__?>images/img6.jpg" alt=""></a> 
                            <div class="mask">技术术语</div>
                        </div>
                    </div>
                    <div class="text text2 float_r w48">
                        <img class="img" src="<?= $this->__STATIC__?>images/img7.jpg" alt="">
                        <div class="table">
                            <table>
                                <tr>
                                    <td>
                                        <a href="/information"><img src="<?= $this->__STATIC__?>images/icon3.png" alt=""></a>
                                        <h3>联系我们</h3>
                                        <p>电话：021-54613487 / 54351672 <span>地址：上海松江南乐路1276弄115号7栋301</span></p>
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
