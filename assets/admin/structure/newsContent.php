<script>
	$(function(){
		PageAction.editor.create(['substance'], { width : '100%', height : '320px' });

		PageAction.currentPageActionClassName = '<?= $_GET['currentPageActionClassName'] ?>';
		PageAction.currentPageAction = '<?= ucfirst($_GET['action']) ?>';

		if (typeof PageAction[PageAction.currentPageActionClassName].doContentAction == 'undefined') {
			PageAction[PageAction.currentPageActionClassName].doContentAction = function() {
				var _test = Tools.checkNull('title', '请输入新闻标题') && Tools.checkNull('sort', '请输入排序') &&
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
<div class="switch">
	<ul>
		<li class="slt_switch">基本信息</li>
		<li>高级功能</li>
<!--        <li>多图上传</li>-->
	</ul>
	<div class="switch_list">
		<table width="100%" cellpadding="0" cellspacing="0" class="data_input">
			<tr>
				<th width="15%">语言</th>
				<td width="35%"><?= App\Tools\Html::radio($this->pageControl, 'language', $this->rs, $this->__LANGUAGE_CONFIG__, $this->__LANGUAGE_ID__) ?></td>
				<th width="15%">发布时间</th>
				<td><?= App\Tools\Html::setDate($this->pageControl, 'release_date', App\Tools\Auxi::getTime($this->rs->release_date ?: time()), '90%') ?></td>
			</tr>
			<tr>
				<th>新闻标题</th>
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
			<tr>
				<th>新闻介绍</th>
				<td><?= App\Tools\Html::textarea($this->pageControl, 'synopsis', $this->rs, null, 7, null, ' onpropertychange="if(value.length>500) value=value.substr(0,500)"') ?></td>
                <th rowspan="2">新闻列表图<br />
                    建议尺寸（508 * 257）</th>
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
</div>
<script>
    $(function () {
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

    });
</script>
