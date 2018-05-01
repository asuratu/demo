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
                <h2>企业文化<p>corporate culture</p></h2>
                <ul class="clearboth">
                    <li>
                        <div class="imgbox"><img src="<?= $this->__STATIC__?>images/about/img3.jpg" alt=""><span>使命</span></div>
                        <p>以市场为导向，关注顾客需求，通过持续改进，以提升产品质量超越顾客期望，树立开放观念，不断学习和利用先进管理理念、方法和手段，增强核心竞争力，全力打造恒祥品牌。</p>
                    </li>
                    <li>
                        <div class="imgbox"><img src="<?= $this->__STATIC__?>images/about/img4.jpg" alt=""><span>愿景</span></div>
                        <p>创新是我们的追求，务实是我们的作风，我们将继续努力为用户提供优质可靠的产品。</p>
                    </li>
                    <li>
                        <div class="imgbox"><img src="<?= $this->__STATIC__?>images/about/img5.jpg" alt=""><span>目标</span></div>
                        <p>我们的目标：让我们携手合作，利益双赢走向未来!</p>
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
