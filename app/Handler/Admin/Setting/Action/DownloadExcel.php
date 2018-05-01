<?php

namespace App\Handler\Admin\Setting\Action;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;
use App\Tools\Auxi;
use Phoenix\Log\Log4p;

/**
 * 修改
 */
class DownloadExcel extends AbstractCommon {

    public function processRequest(Array & $context) {
        header("Content-Type:text/html;charset=utf-8");
        require_once(ROOT_PATH . 'vendor/PHPExcel/PHPExcel.php'); //引入读取excel的类文件

        $objPHPExcel = new \PHPExcel(); //实例化PHPExcel类， 等同于在桌面上新建一个excel
        $objPHPExcel->setActiveSheetIndex(0); //把新创建的sheet设定为当前活动sheet

        $_where = '0 = 0';
        $_bindParam = array();

        if (isset($_GET['sltDateA']) && $_GET['sltDateA'] && $_GET['sltDateB']) {
            $_where .= ' AND (sa.`add_date` BETWEEN :sltDateA AND :sltDateB)';
            $_bindParam[':sltDateA'] = $_GET['sltDateA'];
            $_bindParam[':sltDateB'] = $_GET['sltDateB'];
        }
        if (isset($_GET['strSearchKeyword']) && $_GET['strSearchKeyword'] != '') {
            $_where .= ' AND (mu.`real_name` LIKE :strSearchKeyword)';
            $_bindParam[':strSearchKeyword'] = '%' . trim($_GET['strSearchKeyword']) . '%';
        }

        $_table = '`#@__@syslog_action` sa, `#@__@manager_user` mu';
        $_where .= ' AND sa.`user_id` = mu.`user_id`';

        $_rs = $this->db->select('sa.*, mu.`real_name`')
            ->table($_table)
            ->where($_where)
            ->bind($_bindParam)
            ->findAll();

        //供应商信息
            if ($_rs) {

                $objSheet = $objPHPExcel->getActiveSheet();//获取当前活动sheet
                $objSheet->setTitle('会 员');//给当前活动sheet起个名称

                $objSheet = $objPHPExcel->getActiveSheet(); //获得当前活动单元格
                $objSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //设置excel文件默认水平垂直方向居中
                $objSheet->getDefaultStyle()->getFont()->setSize(14)->setName("微软雅黑"); //设置默认字体大小和格式
//            $objSheet->getStyle("A3:AF3")->getFont()->setSize(12)->setBold(true); //设置第二行字体大小和加粗
                $objSheet->getDefaultRowDimension()->setRowHeight(17.25); //设置默认行高

                $_vCell = 0; //Vertical 垂直
                $_hCell = 2; //Horizontal 水平
                $_excel = array(
                    '序号', //A
                    '用户编号',//B
                    '用户名称',//C
                    '模块名',//D
                    '操作',//F
                    '请求地址',//F
                    '操作内容',//G
                    '操作时间',//H
                );

                $objSheet->setCellValue("A1", $_excel[0])
                    ->setCellValue("B1", $_excel[1])
                    ->setCellValue("C1", $_excel[2])
                    ->setCellValue("D1", $_excel[3])
                    ->setCellValue("E1", $_excel[4])
                    ->setCellValue("F1", $_excel[5])
                    ->setCellValue("G1", $_excel[6])
                    ->setCellValue("H1", $_excel[7]);
                //填充数据

                $allModel = array_keys($context['adminMap']);
                foreach ($_rs as $_o => $_ov) {
                    $_vCell++;
                    $action = explode('.', $_ov->title);
                    $mode = lcfirst($action[1]);
                    $submode = lcfirst($action[2]);
                    if(in_array($mode, $allModel)){
                        $option = lcfirst(isset($action[3]) ? $action[3] : '');
                        $model = $context['adminMap'][$mode]['title'] . '-' . $context['adminMap'][$mode]['menu'][$submode]['name'];
                        $operation = $option ? $this->setting['aryOption'][strtolower($option)] : '';
                    }else {
                        $submode = strtolower($submode);
                        switch($mode){
                            case 'system':
                                $model = '系统';
                                $operation = $this->setting['aryOption'][$submode];
                                break;
                            case 'editor':
                                $model = '编辑器';
                                $operation =  $this->setting['aryOption'][$submode];
                                break;
                            default:
                                $model = '';
                                $operation = '';
                                break;

                        }
                    }
                    $objSheet->setCellValue('A' . $_hCell, $_vCell);
                    $objSheet->setCellValue('B' . $_hCell, $_ov->id);
                    $objSheet->setCellValue('C' . $_hCell, $_ov->real_name );
                    $objSheet->setCellValue('D' . $_hCell, $model);
                    $objSheet->setCellValue('E' . $_hCell, $operation);
                    $objSheet->setCellValue('F' . $_hCell, $_ov->url);
                    $objSheet->setCellValue('G' . $_hCell, htmlspecialchars(stripslashes($_ov->content)));
                    $objSheet->setCellValue('H' . $_hCell, Auxi::getTime($_ov->add_date));
                    $_hCell++;
                }
            }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//生成excel文件
        //$objWriter->save($dir."/export_1.xls");//保存文件
//        browser_export('Excel5','browser_excel03.xls');//输出到浏览器
        $_saveName = date("YmdHis", time()) . '.xls';  //获取当前时间当做文件名存放
        header('Content-Type: application/vnd.ms-excel');//告诉浏览器将要输出excel03文件
        header('Content-Disposition: attachment;filename="' . $_saveName . '"');//告诉浏览器将输出文件的名称
        header('Cache-Control: max-age=0');//禁止缓存
        $objWriter->save("php://output");
    }
}