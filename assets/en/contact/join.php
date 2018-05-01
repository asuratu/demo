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
        <div class="join_cont">
            <div class="all">
                <h3>Jobs being recruited<span>The mailbox of the personnel department： <a href="mailto:fang@shhxgd.cn">fang@shhxgd.cn</a></span></h3>
                <div class="list">
                    <ul>
                        <?php
                        foreach ($this->currentListRs as $val):
                        ?>
                        <li class="clearboth">
                            <div class="tit">
                                <img src="<?= $this->__STATIC__?>images/contact/bg.jpg" alt="">
                                <span><?= $val->position ?><a href="mailto:mailto:fang@shhxgd.cn">Resumes</a></span>
                            </div>
                            <div class="text clearboth">
                                <dl>
                                    <dt>Job description：</dt>
                                    <?php
                                    $descArr = explode('|', $val->desc);
                                    foreach ($descArr as $value):
                                    ?>
                                    <dd><?= $value ?></dd>
                                        <?php
                                    endforeach;
                                    ?>

                                </dl>
                                <dl>
                                    <dt>Post requirements：</dt>
                                    <?php
                                    $requArr = explode('|', $val->desc);
                                    foreach ($requArr as $value):
                                        ?>
                                        <dd><?= $value ?></dd>
                                        <?php
                                    endforeach;
                                    ?>
                                </dl>
                            </div>
                        </li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
                <?php
                require $this->__RAD__ . 'component/global/getPages.php';
                ?>
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
