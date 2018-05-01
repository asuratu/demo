<?php
require $this->__RAD__ . 'component/global/head.php';
?>
<body>
<?php
require $this->__RAD__ . 'component/global/header.php';
?>
    <div class="container">
        <?php
        require $this->__RAD__ . 'component/global/landscape.php';
        ?>
        <div class="contact_cont">
            <div class="all clearboth">
                <div class="map">
                    <iframe src="/contact/map.php" width="100%" height="100%" scrolling="no" frameborder="0"></iframe>
                    <a class="pic" href="http://j.map.baidu.com/gdVoO" target="_blank"><img src="<?= $this->__STATIC__?>images/contact/map.jpg" alt=""></a>
                </div>
                <div class="text_cont">
                    <h3>上海恒祥光学电子有限公司</h3>
                    <p>经理：吴先生</p>
                    <div class="clearboth">
                        <dl>
                            <dd class="dd1"><b>地址：</b>上海松江南乐路1276弄115号7栋301</dd>
                            <dd class="dd2"><b>网址：</b><a href="http://www.shhxgd.com/" target="_blank">http://www.shhxgd.com/</a>  <a href="http://www.shhxgd.cn/" target="_blank">http://www.shhxgd.cn/</a></dd>
                            <dd class="dd3"><b>电子信箱：</b><a href="mailto:mailto:fang@shhxgd.cn">fang@shhxgd.cn</a></dd>
                        </dl>
                        <dl>
                            <dd class="dd4"><b>电话：</b>021-54613487 / 54351672</dd>
                            <dd class="dd5"><b>阿里巴巴国际站：</b><a href="http://shhxgd.en.alibaba.com/" target="_blank">http://shhxgd.en.alibaba.com/</a></dd>
                        </dl>
                    </div>
                    <strong>在线留言</strong>
                    <div class="form">
                        <p><textarea id="content1" placeholder="*填写您需要的内容"></textarea></p>
                        <p class="p"><input id="name1" placeholder="*请填写您的姓名" type="text"><input id="phone1" placeholder="*请填写您的电话" type="text"></p>
                        <p><input id="email1" placeholder="*请填写您的邮箱" type="text"></p>
                        <p><input class="submit" id="submit" type="submit" value="提   交"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require $this->__RAD__ . 'component/global/footer.php';
?>
    <script>
        $(function () {
            $('#submit').click(function () {
                var name = trim($('#name1').val());
                var content = trim($('#content1').val());
                var phone = trim($('#phone1').val());
                var email = trim($('#email1').val());
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
