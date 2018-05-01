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
                <i><?= $this->rootName ?></i> <p>Position：<?= $this->getNoaBreadcrumb ?></p>
            </div>
        </div>
        <div class="sub_menu all">
            <div class="swiper-container10 menuSwiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($this->aryCategoryDataView[$this->rootId] as $_k1 => $_v1):
                        if ($_k1 > 0):
                            $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v1['id_tree']);
                            //去除最后一个斜杠
                            $_tmpLink = rtrim($_tmpLink, "/");
                            $_sltMenu = App\Tools\Auxi::compareSelect($_k1, intval($this->navArr[2]), 'active', '');
                            ?>
                            <div class="swiper-slide">
                                <a <?= $_sltMenu ?> href="<?= $_tmpLink ?>"><?= $_v1['category_name'] ?></a>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="project_det">
            <div class="all clearboth">
                <div class="pic_cont">
                    <div class="big"><img src="<?= $this->__CDN__ ?>pics/l/<?= $this->src[0]->src ?>" alt=""></div>
                    <div class="min">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($this->src as $val):
                                ?>
                                <div class="swiper-slide"><img src="<?= $this->__CDN__ ?>pics/l/<?= $val->src ?>" alt=""></div>
                                <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <div class="text_cont">
                    <div class="tit">
                        <h3><?= $this->title ?><span></span></h3>
                    </div>
                    <div class="text">
                        <?php
                        $strArr = explode('|', $this->synopsis);
                        foreach ($strArr as $key =>$val):
                        ?>
                        <p><?= $key == 0 ? '<i>Product introduction：</i><br/><br/>' : ''?><?= $val?></p>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="tit">
                        Data download<span></span>
                    </div>
                    <div class="down">
                        <ul>
                            <?php
                            foreach ($this->files as $val):
                            ?>
                            <li><?= $val->file_name ?> <a href="/uploads/files/<?= $val->file_url ?>">Download</a></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                    <div class="tit">
                        Detail display<span></span>
                    </div>
                    <div class="html">
                        <?= $this->substance ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="abProduct">
            <div class="all">
                <div class="top">
                    <p>
                        Related Products
                    </p>
                </div>
            </div>
        </div>
        <div class="project_cont">
            <div class="all">
                    <ul class="clearboth">
                        <?php
                        foreach ($this->currentListRs as $val):
                            $strArr = explode('|', $val->synopsis);
                            ?>
                            <li>
                                <a href="/project/detail/<?= $val->archives_id ?>">
                                    <div class="imgbox">
                                        <i></i>
                                        <img src="<?= $this->__CDN__?>pics/l/<?= $val->cover ?>">
                                    </div>
                                    <div class="pro-name">
                                        <h3><?= $val->title ?></h3>
                                    </div>
                                </a>
                                <!--  <div class="imgbox">
                                    <a href="/project/detail/<?= $val->archives_id ?>"><img src="<?= $this->__CDN__?>pics/l/<?= $val->cover ?>" alt=""></a>
                                </div>
                                <h3><?= $val->title ?></h3>
                                <p><?= App\Tools\Html::getLenStr($strArr[0], 30)?></p>
                                <a class="more" href="/project/detail/<?= $val->archives_id ?>">查看详情>></a> -->
                            </li>
                            <?php
                        endforeach;
                        ?>
                    </ul>
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
