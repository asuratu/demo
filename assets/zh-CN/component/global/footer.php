<div class="main_foot all clearboth">
    <div class="foot_menu clearboth">

        <?php
        foreach ($this->aryCategoryDataView as $_k1 => $_v1):
            if ($_k1 > 0 && $_v1['language'] == 0):
                ?>
                    <dl>
                        <dt><?= $_v1['category_name'] ?></dt>
                        <?php
                        foreach ($this->aryCategoryDataView[$_k1] as $_k2 => $_v2):
                            if ($_k2 > 0 && $_v2['language'] == 0):
                                $_tmpLink = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v2['id_tree']);
                                ?>
                                <dd><a href="<?= $_tmpLink ?>"><?= $_v2['category_name'] ?></a></dd>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </dl>

                </li>
                <?php
            endif;
        endforeach;
        ?>



    </div>
    <div class="foot_form">
            <h3>在线提交需求</h3>
            <p><input class="w50 name" id="name" type="text" placeholder="*您的姓名"><input class="w50" id="phone" type="text" placeholder="*电话"></p>
            <p><input type="text" id="email" placeholder="*邮箱"></p>
            <p><textarea id="content" placeholder="*填写您需要的内容"></textarea></p>
            <input type="hidden" value="<?= $this->contactHash?>" id="hash">
            <p class="Text_r"><input class="submit" id="subBtn" type="submit" value="提   交"></p>
    </div>
</div>
<div class="main_copay all">
    <p>2015 &copy; 上海恒祥光学电子有限公司版权所有 <em>地址：上海市松江南乐路1276弄115号7栋301</em> <span><em>电话：021-54613487 / 54351672 </em>备案号：沪ICP备12023089号</span> </p>
</div>
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
                alert('请填写内容!');
                $('#content').focus();
                return false;
            } else if (name == '' && name.length > 20) {
                alert('请填写正确的姓名!');
                $('#name').focus();
                return false;
            } else if (!isMobile.test(phone) && !isPhone.test(phone)) {
                alert('请填写正确的电话!');
                $('#phone').focus();
                return false;
            } else if (!isEmail.test(email)) {
                alert('请填写正确的邮箱!');
                $('#email').focus();
                return false;
            } else {
                $.post('/api/form', {hash: $('#hash').val(), content : content, name : name, email : email, phone : phone},
                    function (data) {
                        switch (data.errcode) {
                            case 0:
                                alert('提交成功!');
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