<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<div class="container">
    <div class="mt-5 mb-5" style="width: 100%; display: flex; justify-content: space-between">
        <h1>Surveys</h1>
        <div style="display: flex; align-items: center">
            <a href="<?php echo url('/profile/create')?>" type="button" class="btn btn-success">Create Survey</a>
        </div>
    </div>

    <table id="selectedColumn" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="th-sm">Title
                </th>
                <th class="th-sm">Answers
                </th>
                <th class="th-sm">Status
                </th>
                <th class="th-sm">Created At
                </th>
                <th class="th-sm">Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($surveys as $KEY => $survey): ?>
                <?php
                    $survey['answers'] = explode('¦', $survey['answers']);
                ?>
                <tr>
                    <td><?php echo $survey['s_title'] ?></td>
                    <td>
                        <?php foreach($survey['answers'] as $answer){
                            echo $answer;
                            echo '<br>';
                        }?>
                    </td>
                    <td><?php echo ucfirst($survey['s_status']) ?></td>
                    <td><?php echo $survey['created_at'] ?></td>
                    <td>
                        <a href="<?php echo url('/survey/view/' . $survey['s_id'])?>" class="btn btn-info">View</a>
                        <a href="<?php echo url('/profile/edit/' . $survey['s_id'])?>" class="btn btn-primary">Edit</a>
                        <button type="button" onclick="delete_survey('<?php echo url('/profile/delete/' . $survey['s_id'])?>')" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Title
                </th>
                <th>Answers
                </th>
                <th>Status
                </th>
                <th>Created At
                </th>
                <th>Action
                </th>
            </tr>
        </tfoot>
    </table>
</div>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="<?php echo url('/js/profile.js')?>"></script>