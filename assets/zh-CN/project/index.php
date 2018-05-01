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

        <div class="project_cont">
            <div class="all">
                <div class="item_menu">
                    <div class="swiper-container">
                        <div class="swiper-scrollbar"></div>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <span class="<?= $this->level == 2 ? 'active' : ''?>"><a href="/<?= $this->rootListDir?>"><?= $this->rootName ?></a><em></em></span>
                                <?php
                                foreach($this->oneList as $key => $val):
                                    $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $val->id_tree);
                                    ?>
                                    <span class="<?= intval($this->navArr[3]) == intval($val->category_id) ? 'active' : ''?>"><a href="<?= $_tmpLink ?>"><?= $val->category_name?></a><em></em></span>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="left"></div>
                    <div class="right"></div>
                </div>
                <?php
                if ($this->level == 4):
                ?>
                <div class="second_menu">
                    <?php
                    foreach($this->twoList as $key => $val):
                        $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $val->id_tree);
                        ?>
                        <a class="<?= intval($this->navArr[4]) == intval($val->category_id) ? 'active' : ''?>" href="<?= $_tmpLink ?>"><?= $val->category_name?></a>
                        <?php
                    endforeach;
                    ?>
                </div>
                <?php
                endif;
                ?>
                <div class="list">
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
