<script>
	$(function(){
		PageAction.editor.create(['substance'], { width : '100%', height : '320px' });

		PageAction.currentPageActionClassName = '<?= $_GET['currentPageActionClassName'] ?>';
		PageAction.currentPageAction = '<?= ucfirst($_GET['action']) ?>';

		if (typeof PageAction[PageAction.currentPageActionClassName].doContentAction == 'undefined') {
			PageAction[PageAction.currentPageActionClassName].doContentAction = function() {

                //关联下载文件json
                var _linkArr = {};
                var _i = 0;
                $("#link_goods tr").each(function () {
                    console.log($(this));
                    _linkArr[_i] = $(this).find('button').attr('data-id');
//                    alert(_linkArr[_i]);
                    _i++;
                });
                var _str = JSON.stringify(_linkArr);
                $('#link_json').val(_str);

                //关联下载文件json2
                var _linArrLin = {};
                var _iLin = 0;
                $("#lin_goodsLin tr").each(function () {
                    console.log($(this));
                    _linArrLin[_iLin] = $(this).find('button').attr('data-id');
                    _iLin++;
                });
                var _strnLin = JSON.stringify(_linArrLin);
                $('#link_jsonLin').val(_strnLin);

				var _test = Tools.checkNull('title', '请输入产品标题') && Tools.checkNull('sort', '请输入排序') &&
					Tools.compare('category_id', 0, '请选择所属类别');
				if (_test) {
					$.dialog.locking('系统已启动，请稍候。。。');

					PageAction.editor.sync();

					var _this = this;
					$.post(this.handlerUrl + PageAction.currentPageAction,
					Tools.addEditPageLoader().DOM.form.serializeArray(),
					function(data) {
						switch (data.status) {
							case 'SUCCESS' :
								$(_this.grid).dataGridReload();

								$.dialog.locking.confirm('success', '编辑成功，您还需要继续添加吗？', function(){

									Tools.addEditPageLoader()
									.resetConfig({
										content : 'load:' + _this.addEditPage + '&action=add'
											+ '&parentId=' + $('#category_id').val()
									}, true);

									return true;
								}, function(){
									Tools.addEditPageLoader().close();
									return true;
								});

								break;
							case 'NO_CHANGES' :
								$.dialog.locking.alert('ndash', data.desc);
								break;
							case 'DB_ERROR' :
							case 'INTERCEPTOR' :
							case 'SEO_URL_IS_EXISTS' :
								$.dialog.locking.alert('error', data.desc);
								break;
							default :
								$.dialog.locking.alert('error', '系统繁忙，请稍候再试');
								break;
						}
					}, 'json');
				}
			};
		}

		Tools.addEditPageLoader()
		.title('<?= $this->adminMap[$this->security]['title'] ?> » <?= $this->adminMap[$this->security]['menu'][$_GET['parentPageId']]['name'] ?> » <?= App\Admin\Helper::getActionName($_GET['action']) ?>');

		<?php
		if ($this->pageControl) {
		?>
		Tools.addEditPageLoader().button({
			id : 'ok',
			name : Tools.addEditPageLoader().config.okVal,
			callback : function(){
				
				PageAction[PageAction.currentPageActionClassName]
				.doContentAction
				.call(PageAction[PageAction.currentPageActionClassName]);
				
				return false;
			},
			unshift : true,
			type : 'submit',
			focus: true
		});
		<?php
		}
		?>
		Tools.switchDiv('.switch > ul > li', 'slt_switch', '.switch_list');

		$('.tags > ol > li > span').click(function(){
			var _archivesTags = $('#archives_tags').val();
			var _tag = $(this).text();

			if (_archivesTags.indexOf(_tag) == -1) {
				if (_archivesTags.trim().length > 0) {
					_archivesTags += ',';
				}
				_archivesTags += _tag;
			}
			$('#archives_tags').val(_archivesTags);
		});
	});
</script>

<input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
<input type="hidden" name="link_json" id="link_json" value="">
<input type="hidden" name="link_jsonLin" id="link_jsonLin" value="">
<div class="switch">
	<ul>
		<li class="slt_switch">基本信息</li>
		<li>高级功能</li>
        <li>多图上传</li>
        <li>关联文件</li>
        <li>关联产品</li>
	</ul>
	<div class="switch_list">
		<table width="100%" cellpadding="0" cellspacing="0" class="data_input">
			<tr>
				<th width="15%">语言</th>
				<td width="35%"><?= App\Tools\Html::radio($this->pageControl, 'language', $this->rs, $this->__LANGUAGE_CONFIG__, $this->__LANGUAGE_ID__) ?></td>
				<th width="15%">修改时间</th>
				<td><?= App\Tools\Html::setDate($this->pageControl, 'release_date', App\Tools\Auxi::getTime(time()), '90%') ?></td>
			</tr>
			<tr>
				<th>产品标题</th>
				<td><?= App\Tools\Html::text($this->pageControl, 'title', $this->rs) ?></td>
				<th>所属类别</th>
				<td><?= $this->sltIDTree ?></td>
			</tr>
			<tr>
				<th>英文名</th>
				<td><?= App\Tools\Html::text($this->pageControl, 'title_english', $this->rs) ?></td>
				<th>排序<br/>(数值越大越靠前)</th>
				<td><?= App\Tools\Html::text($this->pageControl, 'sort', $this->rs ? $this->rs : $this->getSort) ?></td>
			</tr>
            <tr style="display: none">
                <th>相关文件</th>
                <td colspan="3"><?= App\Tools\Html::text($this->pageControl, 'link_archives', $this->rs) ?></td>
            </tr>
			<tr>
				<th>产品介绍</th>
				<td><?= App\Tools\Html::textarea($this->pageControl, 'synopsis', $this->rs, null, 7, null, ' onpropertychange="if(value.length>500) value=value.substr(0,500)"') ?></td>
                <th rowspan="2">产品列表图<br />
                    建议尺寸（488 * 488）</th>
                <td rowspan="2"><?= App\Admin\Helper::createUpFile('img', 'cover', $this->rs ? $this->rs->cover : null, $this->setting['aryPicExtName'], $this->setting['aryFileExtName'], $this->__CDN__, $this->__ASSETS__) ?></td>
			</tr>
			<tr>
				<th rowspan="3">Seo Description</th>
				<td rowspan="3"><?= App\Tools\Html::textarea($this->pageControl, 'seo_description', $this->rs, null, 4) ?></td>
			</tr>
			<tr>
				<th>Seo Title</th>
				<td><?= App\Tools\Html::text($this->pageControl, 'seo_title', $this->rs) ?></td>
			</tr>
			<tr>
				<th>Seo Keywords</th>
				<td><?= App\Tools\Html::textarea($this->pageControl, 'seo_keywords', $this->rs) ?></td>
			</tr>
            <th>seo url</th>
            <td colspan="3"><?= App\Tools\Html::text($this->pageControl, 'seo_url', $this->rs) ?></td>
		</table>
	</div>
	<div class="switch_list hide">
		<table width="100%" cellpadding="0" cellspacing="0" class="data_input">
			<tr>
				<th width="15%">文档内容</th>
				<td height="320"><?= App\Tools\Html::editor($this->pageControl, 'substance', $this->rs) ?></td>
			</tr>
		</table>
	</div>
    <div class="switch_list hide">
        <div class="multi-upload-container" id="multi-upload-container1">
        </div>
    </div>
    <div class="switch_list hide">
        <table width="100%" cellpadding="0" cellspacing="0" class="data_input">
            <tr>
                <td colspan="4">
                    关联文件:
                    <table width="100%" cellpadding="0" cellspacing="0" class="data_input" id="link_goods">
                        <?php if ($this->link_archives) : ?>
                        <?php
                        foreach($this->link_archives as $val):
                        $val->release_date = date('Y-m-d H:i:s', $val->release_date);
                        ?>
                        <tr><td><?= $val->file_name ?></td><td><?= $val->release_date ?></td><td><button class="del_link" data-id="<?= $val->file_id ?>">删除文件</button></td><tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                    </table>
                    <input type="search" placeholder="请输入下载的文件名" size="30" id="searchKey"/>
                    <button id="search">搜索</button>
                    <table width="100%" cellpadding="0" cellspacing="0" class="data_input" id="search_goods">
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="switch_list hide">
        <table width="100%" cellpadding="0" cellspacing="0" class="data_input">
            <tr>
                <td colspan="4">
                    关联产品:
                    <table width="100%" cellpadding="0" cellspacing="0" class="data_input" id="lin_goodsLin">
                        <?php if ($this->lin_archives) : ?>
                        <?php
                        foreach($this->lin_archives as $val):
                        $val->release_date = date('Y-m-d H:i:s', $val->release_date);
                        ?>
                        <tr><td><?= $val->title ?></td><td><?= $val->release_date ?></td><td><button class="del_linLin" data-id="<?= $val->archives_id ?>">删除产品</button></td><tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                    </table>
                    <input type="searchLin" placeholder="请输入关联的产品名" size="30" id="searchKeyLin"/>
                    <button id="searchLin">搜索</button>
                    <table width="100%" cellpadding="0" cellspacing="0" class="data_input" id="search_Lin">
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>
<script>
    $(function () {
        //关联下载
        $("#search").click(function () {
            var key = $("#searchKey").val();
            if (key) {
                ajaxSearch(key);
            }
        });

        function ajaxSearch(key) {
            $.post("/handler/Admin.Structure.Archives.SearchArchives",
                {key: key},
                function (data) {
                    if (data.status == 'SUCCESS') {
                        var _out = '';
                        for (var i in data.rsp.rs) {
                            var m = data.rsp.rs[i];
                            _out += '<tr><td>' + m.file_name + '</td><td>' + getLocalTime(m.release_date) + '</td><td><button class="add_link" data-id="' + m.file_id + '">添加关联</button></td><tr>';
                        }
                        $("#search_goods").empty();
                        $("#search_goods").append(_out);
                    }
                }, 'json');
        }

        function getLocalTime(nS) {
            return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/, ' ');
        }


        $('body').on('click', '.add_link', function () {
            var html = $(this).parent().parent().html();
            html = html.replace('add_link', 'del_link');
            html = html.replace('添加关联', '删除关联');
            html = '<tr>' + html + '</tr>';
            var link_html = ($("#link_goods").html());
            if (link_html.indexOf(html) < 0) {
                $("#link_goods").append(html);
            }
        })

        $('body').on('click', '.del_link', function () {
            $(this).parent("td").parent("tr").remove();
        })

        //关联产品
        $("#searchLin").click(function () {
            var keyLin = $("#searchKeyLin").val();
            if (keyLin) {
                ajaxSearchLin(keyLin);
            }
        });

        function ajaxSearchLin(key) {
            $.post("/handler/Admin.Structure.Archives.SearchArchivesLin",
                {key: key},
                function (data) {
                    if (data.status == 'SUCCESS') {
                        var _out = '';
                        for (var i in data.rsp.rs) {
                            var m = data.rsp.rs[i];
                            _out += '<tr><td>' + m.title + '</td><td>' + getLocalTime(m.release_date) + '</td><td><button class="add_linLin" data-id="' + m.archives_id + '">添加关联</button></td><tr>';
                        }
                        $("#search_Lin").empty();
                        $("#search_Lin").append(_out);
                    }
                }, 'json');
        }

        $('body').on('click', '.add_linLin', function () {
            var html = $(this).parent().parent().html();
            html = html.replace('add_linLin', 'del_linLin');
            html = html.replace('添加关联', '删除关联');
            html = '<tr>' + html + '</tr>';
            var link_html = ($("#lin_goodsLin").html());
            if (link_html.indexOf(html) < 0) {
                $("#lin_goodsLin").append(html);
            }
        })

        $('body').on('click', '.del_linLin', function () {
            $(this).parent("td").parent("tr").remove();
        })
    })
</script>
<script>
    //多图上传
    function loadCss(url) {
        var s = document.createElement("LINK");
        s.rel = "stylesheet";
        s.type = "text/css";
        s.href = url;
        document.getElementsByTagName("HEAD")[0].appendChild(s);
    }

    // 加载一次js,css
    if (PageAction[PageAction.currentPageActionClassName].UPLOADSWF_LOAD_FLAG === false) {
        PageAction[PageAction.currentPageActionClassName].UPLOADSWF_LOAD_FLAG = true;
        loadCss('<?= $this->__STATIC__ ?>js/multiUpload/style/css/default.css');
        $.getScript("<?= $this->__STATIC__ ?>js/multiUpload/jquery.uploadify.min.js");
        $.getScript("<?= $this->__STATIC__ ?>js/multiUpload/myhandler.js");
    }
    setTimeout(function () {
        var banners = <?= $this->banners ? $this->banners : '[]' ?>;

        $('#multi-upload-container1').multiUpload({
            'coverField': 'src', // 主表中封面字段名
            subTable: [// 副表中的字段, 需要录入的
                {fieldName: 'src', display: 'Banner标题', type: 'input'},
            ],
            defaultVal: banners,
            RecommendSize: '推荐尺寸(488*488)',
            type : 2,
            uploadAction: 'upload-action',
            imgAdd: 'img-add',
            imgDiv: 'multi-upload-container1',
            multiEditorBox: 'multi-editor-box'

        });

    }, 500);
</script>
