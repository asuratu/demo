<div class="sub_banner">
    <?php
    if ($this->aryCategoryDataView[$this->rootId]['landscape'] != ''):
        echo App\Tools\UrlHelper::getUploadImg($this->aryCategoryDataView[$this->rootId]['landscape'], 'l');
    else:
        echo '<img src="' . $this->__STATIC__ . 'images/about/banner.jpg">';
    endif;
    ?>
    <div class="fix">
        <i><?= $this->rootName ?></i> <p>Position：<?= $this->getEnNoaBreadcrumb ?></p>
    </div>
</div>
<div class="sub_menu all">
    <div class="swiper-container10">
        <div class="swiper-wrapper">
            <?php
            foreach ($this->aryCategoryDataView[$this->rootId] as $_k1 => $_v1):
                if ($_k1 > 0):
                    $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v1['id_tree']);
                    // 去除最后一个斜杠
                    $_tmpLink = rtrim($_tmpLink, "/");
                    $_sltMenu = App\Tools\Auxi::compareSelect($_k1, $this->categoryId, 'active', '');
                    ?>
                    <div class="swiper-slide">
                        <a <?= $_sltMenu ?> href="<?= $_tmpLink ?>">
                            <?= $_v1['category_name'] ?>
                        </a>
                    </div>
                    <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>
</div>