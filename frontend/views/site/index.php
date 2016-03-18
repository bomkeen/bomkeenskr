

<div class="page-header"></div>
<div class="row">
    <div class="col-md-6">

        <div class="list-group">
            <a href="#" class="list-group-item active">
                ข่าวประกาศ
            </a>
            <?php foreach ($model as $model_rs) { ?>           
            <a href='<?php echo $model_rs['pr_link'] ?>' target="_blank" class="list-group-item">  <?php echo $model_rs['pr_desc'] ?></a>
            <?php } ?>

        </div>

    </div>

</div>
