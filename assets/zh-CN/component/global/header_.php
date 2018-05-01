<div class="main_header">
    <div class="all clearboth">
        <a class="main_logo" href="/"><img src="<?= $this->__STATIC__?>images/logo.png"></a>
        <div class="phone_btn">
            <span class="sp1"></span>
            <span class="sp2"></span>
            <span class="sp3"></span>
        </div>
        <div class="lan">
            <span>服务热线：<i>021-54613487</i></span><a class="cn" href="/">中文</a><a class="en" href="/en">English</a>
        </div>
    </div>
</div>

<div class="main_menu">
    <div class="all clearboth">
        <ul class="clearboth">
            <li class="<?= in_array($this->url, array('/', '/index')) ? 'active' : ''?>"><a class="tit" href="/">首页<i></i></a></li>
            <?php
            foreach ($this->aryCategoryDataView as $_k1 => $_v1):
                if ($_k1 > 0):
                    $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v1['id_tree']);
                    //去除最后一个斜杠
                    $_tmpLink = rtrim($_tmpLink, "/");
                    $_sltMenu = App\Tools\Auxi::compareSelect($_k1, $this->rootId, 'active', '');
                    $_hasChild = App\Tools\Auxi::typeHasChild($this->aryCategoryDataView[$_k1]);
                    ?>
                    <li <?= $_sltMenu ?>><a class="tit" href="<?= $_tmpLink ?>"><?= $_v1['category_name'] ?><i></i></a>
                    <?php
                    if ($_hasChild):
                    ?>
                        <dl class="<?= $_k1 == 12 ? 'pro_dl clearboth' : ''?>">
                        <?php
                        foreach ($this->aryCategoryDataView[$_k1] as $_k2 => $_v2):
                            if ($_k2 > 0):
                                $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v2['id_tree']);
                                ?>
                                <dd><a href="<?= $_tmpLink ?>"><?= $_v2['category_name'] ?></a></dd>
                                <?php
                            endif;
                        endforeach;
                            if($_k1 == 12):
                            ?>
                        <div class="imgbox"><img src="<?= $this->__STATIC__?>images/img3.jpg"></div>
                            <?php
                            endif;
                            ?>
                        </dl>
                            <?php
                            endif;
                            ?>
                    </li>
                    <?php
                endif;
            endforeach;
            ?>
        </ul>
        <?php
        if (in_array($this->url, array('/', '/index'))):
            ?>
            <div class="search">
                <input type="text">
                <a class="btn" href="javascript:void(0)"></a>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>
<div class="Mask animate"></div>
<div class="phone_menu animate">
    <ul>
        <li><a href="/">首页</a></li>
        <?php
        foreach ($this->aryCategoryDataView as $_k1 => $_v1):
            if ($_k1 > 0):
                $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v1['id_tree']);
                //去除最后一个斜杠
                $_tmpLink = rtrim($_tmpLink, "/");
                ?>
                <li><a href="<?= $_tmpLink ?>"><?= $_v1['category_name'] ?></a></li>
                <?php
            endif;
        endforeach;
        ?>
    </ul>
</div>
