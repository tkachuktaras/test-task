<div class="container">
    <div class="mt-5 mb-5">
        <h1>Update Survey</h1>
    </div>

    <?php if(isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_COOKIE['error']; ?>
        </div>
    <? endif; ?>

    <form action="<?php echo url('/profile/update/' . $survey['s_id'])?>" method="POST" class="mb-5">
        <div class="form-group">
            <label for="s_title">Title</label>
            <input type="text" class="form-control" name="s_title" value="<?php echo $survey['s_title'] ?>" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="s_status">Status</label>
            <select class="form-control" name="s_status">
                <option value="0" <?php echo $survey['s_status'] == 'inactive' ? 'selected' : '' ?>>Draft</option>
                <option value="1" <?php echo $survey['s_status'] == 'active' ? 'selected' : '' ?>>Published</option>
            </select>
        </div>
        <div id="answers-container"></div>
        <div style="width: 100%; display: flex; justify-content: space-between">
            <button type="submit" class="btn btn-primary">Submit</button>
            <div style="display: flex; align-items: center">
                <button type="button" onclick="addAnswer()" class="btn btn-info">Add answer</button>
            </div>
        </div>
    </form>
</div>

<script src="<?php echo url('/js/survey.js')?>"></script>

<script>
    $(document).ready( function () {
        <?php foreach($survey['answers'] as $answer): ?>
            addAnswer('<?php echo $answer ?>')
        <?php endforeach; ?>
    });
</script>