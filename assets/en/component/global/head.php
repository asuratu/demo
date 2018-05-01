<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport">
    <meta name="format-detection" content="telephone=no">
    <title>Shanghai Hengxiang Optical Electronics Co,ltd</title>
    <link rel="stylesheet" href="<?= $this->__STATIC__?>encss/css/default.css" />
    <?php
    if (in_array($this->url, array('/en', '/en/index'))):
    ?>
    <link rel="stylesheet" href="<?= $this->__STATIC__?>encss/css/index.css" />
        <?php
        else:
        ?>
            <link rel="stylesheet" href="<?= $this->__STATIC__?>encss/css/zi.css" />
    <?php
    endif;
    ?>
    <link rel="stylesheet" href="<?= $this->__STATIC__?>encss/css/idangerous.swiper.css" />
</head>