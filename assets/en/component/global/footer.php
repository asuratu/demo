<div class="main_foot all clearboth">
    <div class="foot_menu clearboth">


        <?php
        foreach ($this->aryCategoryDataView as $_k1 => $_v1):
            if ($_k1 > 0 && $_v1['language'] == 1):
                ?>
                    <dl>
                    	<?php
                        if ($_v1['root_id'] != 95):
                        ?>
                       		 <dt><?= $_v1['category_name'] ?></dt>
                            <?php
                        endif;
                        ?>
                        <?php
                        if ($_v1['root_id'] == 95):
                        ?>
                            <!-- <dd><a href="/en/encompany-news">Company notice</a></dd>
                            <dd><a href="/en/enknowledge">Products information</a></dd> -->
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


                </li>
                <?php
            endif;
        endforeach;
        ?>



    </div>
    <div class="foot_form">
            <h3><b>Online Inquiry</b></h3>
            <p><input class="w50 name" id="name" type="text" placeholder="*Your name"><input class="w50" id="phone" type="text" placeholder="*Tel"></p>
            <p><input type="text" id="email" placeholder="*Email"></p>
            <p><textarea id="content" placeholder="*Fill in what you inquiry"></textarea></p>
            <input type="hidden" value="<?= $this->contactHash?>" id="hash">
            <p class="Text_r"><input class="submit" id="subBtn" type="submit" value="Submit"></p>
    </div>
</div>
<div class="main_copay all">
    <p>2015 &copy; Shanghai Hengxiang Optical Electronics Co,ltd. all rights copyright <em>Address：R301,Building7,Lane 115,No.1276 Nanle Road,SongJiang,Shanghai,201600</em> <span><em>Tel：021-54613487 / 54351672 </em>Record number: No. 12023089, Shanghai ICP</span> </p>
</div>
<script type="text/javascript" src="<?= $this->__STATIC__?>js/jquery.js"></script>
<script type="text/javascript" src="<?= $this->__STATIC__?>js/fun.js"></script>
<script type="text/javascript" src="<?= $this->__STATIC__?>js/idangerous.swiper.min.js"></script>
<script>
    $(function () {
        $('#subBtn').click(function () {
            var name = trim($('#name').val());
            var content = trim($('#content').val());
            var phone = trim($('#phone').val());
            var email = trim($('#email').val());
            //验证电话邮箱
            var isMobile = /^1[3|4|5|7|8][0-9]\d{4,8}$/;
            var isPhone = /^(?:(?:0\d{2,3})-)?(?:\d{7,8})(-(?:\d{3,}))?$/;
            var isEmail = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/;
            if ((content) == '') {
                alert('Please fill in the contents!');
                $('#content').focus();
                return false;
            } else if (name == '' && name.length > 20) {
                alert('Please fill in the correct name!');
                $('#name').focus();
                return false;
            } else if (!isMobile.test(phone) && !isPhone.test(phone)) {
                alert('Please fill in the right phone!');
                $('#phone').focus();
                return false;
            } else if (!isEmail.test(email)) {
                alert('Please fill in the correct mailbox!');
                $('#email').focus();
                return false;
            } else {
                $.post('/api/form', {hash: $('#hash').val(), content : content, name : name, email : email, phone : phone},
                    function (data) {
                        switch (data.errcode) {
                            case 0:
                                alert('Submit of success!');
                                break;
                            default :
                                alert(data.errmsg);
                        }
                    },
                    'json');
            }

        });
        function trim(s){
            return s.replace(/(^\s*)|(\s*$)/g, "");
        }
    })
</script>