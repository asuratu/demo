<script>
	$(function(){
		PageAction.editor.create(['substance', 'substance_home'], { width : '100%', height : '380px' });

		PageAction.currentPageActionClassName = '<?= $_GET['currentPageActionClassName'] ?>';
		PageAction.currentPageAction = '<?= ucfirst($_GET['action']) ?>';

		if (typeof PageAction[PageAction.currentPageActionClassName].doContentAction == 'undefined') {
			PageAction[PageAction.currentPageActionClassName].doContentAction = function() {
				var _test = Tools.checkNull('name', '请输入栏目名称') &&
					Tools.checkNull('sort', '栏目排序不能为空') &&
					Tools.checkZero('category_id', '请选择根栏目') &&
					Tools.checkDigit('sort', '排序只能填入数字');
				if (_test) {
					$.dialog.locking('系统已启动，请稍候。。。');

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
											+ '&parentChannelType=' + $('#channel_type').val()
											+ '&parentIsPart=' + $(':radio[name=is_part]:checked').val()
											+ '&parentNavType=' + $(':radio[name=nav_type]:checked').val()
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
	});
</script>

<input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
<div class="switch">
	<ul>
		<li class="slt_switch">基本信息</li>
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
				<th>所属根栏目</th>
				<td><?= $this->sltIDTree ?></td>
                <th>所属父级栏目</th>
                <td><?= $this->sltSeriesIDTree ?></td>
			</tr>
			<tr>
                <th>栏目名称</th>
                <td><?= App\Tools\Html::text($this->pageControl, 'name', $this->rs) ?></td>
				<th>栏目排序<br/>从大到小</th>
				<td><?= App\Tools\Html::text($this->pageControl, 'sort', $this->rs ? $this->rs : $this->getSort) ?></td>
			</tr>
			<tr>
                <th>是否显示</th>
                <td><?= App\Tools\Html::radio($this->pageControl, 'is_display', $this->rs, $this->setting['aryDisplay'], '1', 'horizontal') ?></td>
			</tr>
		</table>
	</div>
</div>
