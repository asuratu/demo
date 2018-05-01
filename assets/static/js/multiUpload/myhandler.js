
(function () {
  $.fn.multiUpload = function (arg) {
    arg = arg || {
          coverField: 'image_url', // 主表中封面字段名
          subTable: [// 副表中的字段, 需要录入的
            {fieldName: 'defUrl', display: '图片链接', type: 'input'},
            {fieldName: 'defTitle', display: '标题', type: 'input'},
          ],
          defaultVal: null,
          RecommendSize: null

        };

    var uploadContainer = $(this),
        selectPicCount = 0;

    var boxTpl = '<div class="multi-upload">\
                      <div class="header-bar">\
                         &nbsp;&nbsp;'+ arg.RecommendSize+' \
                      </div>\
                      <ul class="image-wrapper">\
                          <li class="item-box action" id="'+ arg.uploadAction +'">\
                              <input id="'+arg.imgAdd+'" type="file"/>\
                           </li>\
                      </ul>\
                </div>';

    var Base = Base || {
          tmpPath: '/data/tmp/',
            uploadPath: '/uploads/pics/s/',
          formDataTpl: '',
          fieldNames: [],
          init: function () {
            uploadContainer.html(boxTpl);
            uploadContainer.find('.set-cover').bind('click', Base.setCover);
            var _editorTpl = '';
            for (var k in arg.subTable) {
              var _v = arg.subTable[k];
              this.fieldNames.push(_v.fieldName);
              if (k == 0) // 第一个为图片的路径, 不显示
                continue;
              switch (_v.type) {
                case 'input':
                  _editorTpl += '<tr><td>' + _v.display + '</td><td><input class="fixed-input" type="text"></td></tr>';
                  break;
                case 'textarea':
                  _editorTpl += '<tr><td>' + _v.display + '</td><td><textarea class="fixed-input" rows="' + (_v.rows ? _v.rows : 5) + '" cols="' + (_v.cols ? _v.cols : 20) + '">\
                              </textarea></td></tr>';
                  break;
                default:
                  _editorTpl += '<tr><td>' + _v.display + '</td><td><input class="fixed-input" type="text"></td></tr>';
              }
            }

            _editorTpl += '<tr><td colspan="2" align="right"><button class="editor-cancel">取消</button><button class="editor-ok">确定</button></td></tr>';
            $('body').append('<div id="' + arg.multiEditorBox + '">\
                            <i class="arrow arrow_out"></i>\
                            <i class="arrow arrow_in"></i>\
                          <table>' + _editorTpl + ' </table></div>');
            // 绑定确认和取消按钮事件
            $('#' + arg.multiEditorBox + ' .editor-ok').bind('click', Base.saveInputVal);
            $('#'+ arg.multiEditorBox +' .editor-cancel').bind('click', function () {
              $('#' + arg.multiEditorBox).fadeOut(150);
            });
            // 初始化数据
            if (arg.defaultVal) {
              for (var k in arg.defaultVal) {
                var _i = 0;
                for (var j in arg.defaultVal[k]) {
                  if (_i == 0) {  // 第一个值为图片路径
                    Base.addImg(arg.defaultVal[k][j]);
                    //console.log(Base.getFormDataTpl());
                    //$('.item-box .formData').last().append(Base.getFormDataTpl()); // 初始化input框
                  } else {
                    $('.item-box .formData').last().find('input').eq(_i).val(arg.defaultVal[k][j]);
                  }
                  ++_i;
                }
              }
            }
            this.uploadifyInit();
            // 绑定选择封面的选中事件
            $('.item-box .img-item').unbind('click').bind('click', function () {
              $(this).parent().siblings().removeClass('click');
              $(this).parent().toggleClass('click');
            });
          },
          setCover: function () {  // 设置封面
            if (arg.coverField) {
              var _cover = $('input[name="' + arg.coverField + '"]');
              var _pic =$('.item-box.click .formData input').first().val(); //$('.item-box .formData').first().find('input').first().val();// 设置第一张为封面
              if (!_pic) {
                alert('请选择图片');
                return;
              }
              if (_cover.length > 0) {
                _cover.val(_pic);
                $('#return_' + arg.coverField).children('img').attr({'src': $('.item-box.click .img-item img').attr('src'), 'height': '50px'});  // 针对有另一个图片上传按钮的情况
              } else {
                $('#' + arg.imgAdd).after('<input type="hidden" name="' + arg.coverField + '" value="' + _pic + '"/>');
              }
              $('.item-box').removeClass('click');
            } else {
              alert('未设置封面字段');
            }
          },
          getFormDataTpl: function () {  // 获取待提交数据的intput 模板
            if (this.formDataTpl == '') {
              var _tpl = '';
              for (var k in this.fieldNames) {
                _tpl += '<input type="hidden" name="' + this.fieldNames[k] + '[]"/>';
              }
              this.formDataTpl = _tpl;
            }
            return this.formDataTpl;
          },
          resetBind: function () {
            uploadContainer.find('.handle-bar .del').last().bind('click', Base.del);
            uploadContainer.find('.handle-bar .edit').last().bind('click', Base.editClick);
            // 绑定选择封面的选中事件
            $('.item-box .img-item').unbind('click').bind('click', function () {
              $(this).parent().siblings().removeClass('click');
              $(this).parent().toggleClass('click');
            });
          },
          editClick: function (event) {
            // 保存修改
            Base.saveInputVal(true);
            //console.log(e);
            var X = $(this).offset().left, Y = $(this).offset().top;
            var _box = $('#' + arg.multiEditorBox);
            // 重新定位
            var _moreH = 40, _moreW = -25;
            if (_box.is(':hidden')) {
              _box.show().css({
                left: X + _moreW,
                top: Y + _moreH
              });
            } else {
              _box.animate({
                left: X + _moreW,
                top: Y + _moreH
                //opacity: 'show'
              }, 300);
            }
            var _dataBox = $(this).parent().next('.formData');
            $(this).parent().parent().addClass('action-cur').siblings().removeClass('action-cur');
            // 重置input内容
            _box.find('.fixed-input').each(function (i) {
              $(this).val(_dataBox.find('input').eq(i + 1).val());
            });
          },
          saveInputVal: function (notHide) {
            if (notHide !== true)
              $('#' + arg.multiEditorBox).fadeOut(150);
            //将浮动框中数据保存
            $('#' + arg.multiEditorBox).find('.fixed-input').each(function (i) {
              $('li.action-cur .formData input').eq(i + 1).val($(this).val());
            });
          },
          resetInput: function () {

          },
          resizeImg: function () {
            $('.item-box .img-item').last().find('img').on("load", function () {
              var max = 150, img = this;
              var width = 0, height = 0, percent, ow = img.width, oh = img.height;
              if (ow > max || oh > max) {
                if (ow >= oh) {
                  if (width = ow - max) {
                    percent = (width / ow).toFixed(2);
                    img.height = oh - oh * percent;
                    img.width = max;
                  }
                } else {
                  if (height = oh - max) {
                    percent = (height / oh).toFixed(2);
                    img.width = ow - ow * percent;
                    img.height = max;
                  }
                }
              }
              // 调整图片位置
              $(img).css({
                'left': (max - img.width) / 2,
                'top': (max - img.height) / 2
              });
            });
          },
          initForm: function (fileName) {
            //console.log(arg);
            $('#'+arg.imgDiv+' .item-box .formData').last().append(this.getFormDataTpl());
            $('#'+arg.imgDiv+' .item-box .formData').last().find('input').eq(0).val(fileName);
            //'<input name="tmpFileName" type="hidden" value="' + fileName + '"/>');
          },
          success: function (file, data, response) {
            //var data = JSON.parse(data);
            var data = eval('(' + data + ')');
            if (data.status && data.status == 'SUCCESS') {
              var _fileName = file.name.replace(file.type, '');
              Base.addImg(data.desc, true);
            } else {
              alert(data.desc ? data.desc : '上传图片出错');
            }
          },
          del: function () {
            var _fileName = $(this).parent().next('.formData').find('input[name="' + (Base.fieldNames ? Base.fieldNames[0] : 'defUrl') + '"]').val();
            $.post('/handler/Admin.System.DelFile', {delFileName: _fileName, uploadType: 'img'}, function (data) {
              console.log(data);
            }, 'json');
            $(this).parents('.item-box').remove();
          },
          addImg: function (fileName, isTmp) {
            var _tpl = '<li class="item-box">\
                        <input type="checkbox" class="handle-chk" />\
                        <div class="img-item">\
                            <img src="' + (isTmp ? Base.tmpPath : Base.uploadPath) + fileName + '">\
                        </div>\
                        <div class="handle-bar">\
                            <span class="edit" title="编辑详情"></span>\
                            <span class="del" title="删除图片"></span>\
                        </div>\
                        <div class="formData" style="dispaly:none">\
                        </div>\
                    </li>';
            $('#' + arg.uploadAction ).before(_tpl);

            Base.resizeImg();
            Base.initForm(fileName);
            Base.resetBind();
          },
          uploadifyInit: function () {

            $('#' + arg.imgAdd).uploadify({
              formData: {
                importMode: 'fileNameSysWrite',
                uploadType: 'img'
              },
              swf: '/assets/static/js/multiUpload/uploadify.swf',
              uploader: '/handler/Admin.System.Upload',
              file_post_name: 'getFileToUpload',
              buttonText: " ", // 按钮上方文字
              multi: true,
              width: 150,
              height: 150,
              onUploadProgress: function (file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {

                //$('#progress').html(totalBytesUploaded + ' bytes uploaded of ' + totalBytesTotal + ' bytes.');
              },
              onUploadStart: function (file) {

                $('.loading').show();
              },
              onSelect: function () {
                ++selectPicCount;
              },
              onUploadSuccess: Base.success,
              onQueueComplete: function (queueData) {
                //console.log(queueData);
                //console.log(queueData.uploadsSuccessful + ' files were successfully uploaded.');
                $('.loading').hide();
                var _fail = selectPicCount - queueData.uploadsSuccessful;
                if (_fail === 0) {
                  //alert('图片全部上传成功!');
                } else if (_fail > 0) {
                  alert('您有' + _fail + '张图片上传失败!');
                }
              }
            });
          }
        };
    Base.init();
    $('.ui_content').scroll(function () {
      $('#' + arg.multiEditorBox).hide();
    });
    var timer = null;
    uploadContainer.mouseleave(function () {
      timer = setTimeout(function () {
        $('#' + arg.multiEditorBox).hide();
      }, 200);
    });
    $('#' + arg.multiEditorBox).bind('mouseover', function () {
      clearTimeout(timer);
      $(this).show();
    });
  }


})();

