<?php
require $this->__RAD__ . 'component/global/head.php';
?>
<body>
<?php
require $this->__RAD__ . 'component/global/header.php';
?>
<div class="container">
    <div class="sub_banner">
        <img src="<?= $this->__STATIC__ ?>images/about/banner.jpg">
    </div>
    <div class="sub_menu all">
        <div class="swiper-container10 menuSwiper">
            <div class="swiper-wrapper">

            </div>
        </div>
    </div>

    <div class="project_cont">
        <div class="all">
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
</script>
</body>
</html>
