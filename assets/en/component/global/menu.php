<div class="page-list">
    <?php
    foreach ($this->aryCategoryDataView[$this->rootId] as $_k3 => $_v3) :
        if (is_array($_v3)):
            $_tmpLink2 = App\Tools\UrlHelper::getTypeUrl($this->aryCategoryDataView, $_v3['id_tree']);
            $_category =  $this->categoryId;
            switch ($this->categoryLevel) {
                case 1:
                    $_sltMenu2 = App\Tools\Auxi::compareSelect($this->categoryId, $_k3, 'cur');
                    break;
                case 2:
                    $_sltMenu2 = App\Tools\Auxi::compareSelect($_k3, $this->categoryId, 'cur');
                    break;
                case 3:
                    $_sltMenu2 = App\Tools\Auxi::compareSelect($this->parentId, $_k3, 'cur');
                    break;
            }
            ?>
            <a <?= $_sltMenu2 ?>href="<?= $_tmpLink2 ?>" ><span><?= $_v3['category_name'] ?></span></a>
            <?php
        endif;
    endforeach;?>
</div>
