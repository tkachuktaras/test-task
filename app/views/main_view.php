<div class="container">
    <?php foreach($surveys as $survey): ?>
        <?php if($survey['s_status'] == 'active'):?>
            <div class="mt-5 mb-5">
                <a href="<?php echo url('/survey/view/' . $survey['s_id'])?>">
                    <h2><?php echo $survey['s_title']?></h2>
                </a>
            </div>
        <?php endif ?>
    <?php endforeach; ?>
</div>
