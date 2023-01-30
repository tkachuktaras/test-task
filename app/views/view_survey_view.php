
<div class="container">
    <div class="mt-5 mb-5" style="width: 100%; display: flex; justify-content: space-between">
        <h1>Question: <?php echo $survey['s_title']?></h1>
    </div>
    <?php foreach($survey['answers'] as $answer): ?>
        <?php $isLike = in_array($_SESSION['u_id'], $answer['u_ids'])?>
        <p>
            Answer:<br>
            <?php echo count($answer['u_ids'])?>
            <a href="<?php echo url('/profile/' . ($isLike ? 'unlike/':  'like/') . $answer['id']) ?>">
                <i class="<?php echo $isLike ? 'fas' : 'far' ?> fa-heart"></i>
            </a>
            <?php echo $answer['text']?>
        </p>
    <?php endforeach;?>
</div>

<script src="https://kit.fontawesome.com/23fbf8c415.js" crossorigin="anonymous"></script>