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
        <div class="service_cont">
            <div class="all">
                <div class="bg_cont clearboth">
                    <div class="imgbox">
                        <?php
                        if ($this->categoryId == 17):
                            ?>
                            <img src="<?= $this->__STATIC__?>images/service/img1.jpg" alt="">

                            <?php
                        elseif ($this->categoryId == 31):
                            ?>
                            <img src="<?= $this->__STATIC__?>images/service/img2.jpg" alt="">

                            <?php
                        else:
                            ?>
                            <img src="<?= $this->__STATIC__?>images/service/img1.jpg" alt="">

                            <?php
                        endif;
                        ?>
                    </div>
                    <div class="text">
                        <div class="tit"><span></span>
                            <?php
                            if ($this->categoryId == 17):
                            ?>
                            说明
                            <?php
                            elseif ($this->categoryId == 31):
                            ?>
                            售后说明
                            <?php
                            else:
                            ?>
                            订货指南
                            <?php
                            endif;
                            ?>
                        </div>
                        <div class="html">
                           <?= $this->substance?>
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
