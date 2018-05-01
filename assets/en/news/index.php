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
        <div class="news_cont">
            <div class="all">
                <div class="list">
                    <ul class="clearboth">

                        <?php
                        foreach ($this->currentListRs as $val):
                            ?>
                            <li>
                                <a href="/en/news/detail/<?= $val->archives_id ?>">
                                    <div class="imgbox"><img src="<?= $this->__CDN__?>pics/l/<?= $val->cover ?>" alt=""></div>
                                    <h3><?= $val->title ?></h3>
                                    <p><?= App\Tools\Html::getLenStr($val->synopsis, 30)?></p>
                                    <div class="time">
                                        <span><?= date('Y-m-d', $val->release_date )?></span><i></i>
                                    </div>
                                </a>
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
            var lis = $('.item_menu span'),
                p = 0;
            lis.each(function(){
                p += $(this).width()+84;
            });
            p = p-84;
            $('.item_menu .swiper-slide').width(p);
            var mySwiper = new Swiper('.swiper-container',{
                scrollContainer: true,
                scrollbar: {
                container: '.swiper-scrollbar'
                }
            })
        })
    </script>
</body>
</html>
