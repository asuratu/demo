<?php
require $this->__RAD__ . 'component/global/head.php';
?>
<body>
<?php
require $this->__RAD__ . 'component/global/header.php';
?>
    <div class="container">
        <div class="sub_banner">
            <?php
            if ($this->aryCategoryDataView[$this->rootId]['landscape'] != ''):
                echo App\Tools\UrlHelper::getUploadImg($this->aryCategoryDataView[$this->rootId]['landscape'], 'l');
            else:
                echo '<img src="' . $this->__STATIC__ . 'images/about/banner.jpg">';
            endif;
            ?>
            <div class="fix">
                <i><?= $this->rootName ?></i><?= $this->rootEnglishName ?> <p>当前位置：<?= $this->getNoaBreadcrumb ?></p>
            </div>
        </div>
        <div class="sub_menu all">
            <?php
            foreach ($this->aryCategoryDataView[$this->rootId] as $_k1 => $_v1):
                if ($_k1 > 0):
                    $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v1['id_tree']);
                    //去除最后一个斜杠
                    $_tmpLink = rtrim($_tmpLink, "/");
                    $_sltMenu = App\Tools\Auxi::compareSelect($_k1, intval($this->navArr[2]), 'active', '');
                    ?>
                    <a <?= $_sltMenu ?> href="<?= $_tmpLink ?>"><?= $_v1['category_name'] ?></a>
                    <?php
                endif;
            endforeach;
            ?>
        </div>
        <div class="news_det">
            <div class="all clearboth">
                <div class="title">
                    <h3><?= $this->title ?></h3>
                    <span></span>
                    <p><?= $this->releaseDate ?> <i>分享：</i></p>
                    <?= $this->getPrevNext ?>
                </div>
                <div class="right">
                    <div class="html">
                        <?= $this->substance ?>
                    </div>
                    <a href="javascript:history.back(-1);" class="back">返回列表 ></a>
                </div>
            </div>
        </div>
    </div>
<?php
require $this->__RAD__ . 'component/global/footer.php';
?>
    <script>
        $(function () {
            $('body').on('click','.min img',function(){
                var src = $(this).attr('src');
                $('.big img').attr('src',src);
            })

            var mySwiper = new Swiper('.swiper-container',{
                slidesPerView: 4,
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
        })
    </script>
</body>
</html>
