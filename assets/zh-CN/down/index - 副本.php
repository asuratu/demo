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
        <div class="down_cont">
            <div class="all">
                <h3>下载中心<span>请选择你需要下载的类型</span></h3>
                <div class="menu_cont">
                    <div class="item_menu">
                        <?php
                        foreach($this->oneList as $key => $val):
                            $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $val->id_tree);
                        ?>
                        <a class="<?= intval($this->navArr[3]) == intval($val->category_id) ? 'active' : ''?>" href="<?= $_tmpLink ?>"><?= $val->category_name?></a>
                        <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="second_menu">
                        <?php
                        foreach($this->twoList as $key => $val):
                            $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $val->id_tree);
                                ?>
                        <a class="<?= intval($this->navArr[4]) == intval($val->category_id) ? 'active' : ''?>" href="<?= $_tmpLink ?>"><?= $val->category_name?><span></span></a>
                                <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="last_menu">
                        <?php
                        foreach($this->threeList as $key => $val):
                            $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $val->id_tree);
                                ?>
                                <a class="<?= intval($this->navArr[5]) == intval($val->category_id) ? 'active' : ''?>" href="<?= $_tmpLink ?>"><?= $val->category_name?></a>
                                <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <div class="list">
                    <ul class="clearboth">
                        <?php
                        $i = 1;
                        foreach ($this->currentListRs as $val):
                            ?>
                            <li><span><?= $i+($this->currentPage - 1)*$this->currentPageSize?></span><em><?= $val->file_name?></em><a href="/uploads/files/<?= $val->file_url?>" target="_blank">立即下载</a></li>
                            <?php
                            $i++;
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
