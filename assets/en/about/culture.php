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
        <div class="culture_cont">
            <div class="all">
                <h2>corporate culture</h2>
                <ul class="clearboth">
                    <li>
                        <div class="imgbox"><img src="<?= $this->__STATIC__?>images/about/img3.jpg" alt=""><span>Mission</span></div>
                        <p>Market oriented, attention to customer needs, through continuous improvement, to improve product quality beyond the expectations of customers, to establish an open concept, continuous learning and use of advanced management concepts, methods and means, to enhance the core competitiveness, to create a Heng Xiang brand.</p>
                    </li>
                    <li>
                        <div class="imgbox"><img src="<?= $this->__STATIC__?>images/about/img4.jpg" alt=""><span>Vision</span></div>
                        <p>Innovation is our pursuit. Pragmatism is our style. We will continue to work hard to provide users with high quality and reliable products.</p>
                    </li>
                    <li>
                        <div class="imgbox"><img src="<?= $this->__STATIC__?>images/about/img5.jpg" alt=""><span>Target</span></div>
                        <p>Our goal: let's work hand in hand, win win win and win the future.</p>
                    </li>
                </ul>
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
                });
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
            }
            else{
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
