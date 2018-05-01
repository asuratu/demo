<div class="main_header">
    <div class="all clearboth">
        <a class="main_logo" href="/"><i></i><img src="<?= $this->__STATIC__?>images/logo.png"></a>
        <a class="main_logo2" href="/"><i></i><img src="<?= $this->__STATIC__?>images/logo2.png"></a>
        <a class="main_logo3" href="/"><i></i><img src="<?= $this->__STATIC__?>images/logo3.png"></a>
        <div class="phone_btn">
            <span class="sp1"></span>
            <span class="sp2"></span>
            <span class="sp3"></span>
        </div>
        <div class="main_menu">
            <ul class="clearboth">
                <li class="<?= in_array($this->url, array('/en', '/en/index')) ? 'active' : ''?>"><a class="tit" href="/en">HOME</a></li>
                <?php
                foreach ($this->aryCategoryDataView as $_k1 => $_v1):
                    if ($_k1 > 0 && $_v1['language'] == 1):
                        $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v1['id_tree']);
                        //去除最后一个斜杠
                        $_tmpLink = rtrim($_tmpLink, "/");
                        $_sltMenu = App\Tools\Auxi::compareSelect($_k1, $this->rootId, 'active', '');
                        $_hasChild = App\Tools\Auxi::typeHasChild($this->aryCategoryDataView[$_k1]);
                        ?>
                        <li <?= $_sltMenu ?>><a class="tit" href="<?= $_tmpLink ?>"><?= $_v1['category_name'] ?></a>
                            <?php
                            if ($_hasChild):
                                ?>
                                <dl class="<?= $_k1 == 12 ? 'pro_dl clearboth' : ''?>">

                                    <?php
                                    if ($_v1['root_id'] == 95):
                                        ?>
                                        <dd><a href="/en/encompany-news">Company notice</a></dd>
                                        <dd><a href="/en/enknowledge">Products information</a></dd>
                                        <?php
                                    elseif ($_v1['root_id'] == 92):
                                        ?>
                                        <dd><a href="/en/endbzk1000">Encoder</a></dd>
                                        <dd><a href="/en/endbzk1000">Incremental encoder</a></dd>
                                        <dd><a href="/en/endbzk1000">Absolute encoder</a></dd>
                                        <dd><a href="/en/endbzk1000">Servo motor encoder</a></dd>
                                        <dd><a href="/en/endbzk1000">Flange encoder</a></dd>
                                        <?php
                                    elseif ($_v1['root_id'] == 99):
                                        ?>
                                        <dd><a href="/en/eninformation">Technical support</a></dd>
                                        <dd><a href="/en/eninformation">Feedback</a></dd>
                                        <?php
                                    else:
                                        foreach ($this->aryCategoryDataView[$_k1] as $_k2 => $_v2):
                                            if ($_k2 > 0 && $_v2['language'] == 1):
                                                $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v2['id_tree']);
                                                ?>
                                                <dd><a href="<?= $_tmpLink ?>"><?= $_v2['category_name'] ?></a></dd>
                                                <?php
                                            endif;
                                        endforeach;





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
        </div>
        <div class="lan">
            <a class="cn" href="/">中文</a><a class="en" href="/en">English</a><span class="search" href="javascript:;"><input id="key" placeholder="Please enter the name of the product" type="text"><i id="searchBtn"></i></span>
        </div>
    </div>
</div>
<div class="Mask animate"></div>
<div class="phone_menu animate">
    <ul>
        <li><a href="/en">HOME</a></li>
        <?php
        foreach ($this->aryCategoryDataView as $_k1 => $_v1):
            if ($_k1 > 0 && $_v1['language'] == 1):
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
<script type="text/javascript" src="<?= $this->__STATIC__?>js/jquery.js"></script>
<script>
    $('#searchBtn').click(function () {
        var keywords = $('#key').val();
        if (keywords == '') {
            alert('Please enter the name of the product!')
        } else {
            window.location.href = '/en/search?key=' + keywords;
        }
    })
</script>
