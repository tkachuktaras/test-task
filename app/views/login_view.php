<div class="container text-center" style="height: 100vh; display: flex; justify-content: center; align-items: center">
<form action="<?php echo current_url() ?>/auth" method="POST">
    <div class="form-group">
        <input type="email" name="u_email" class="form-control" placeholder="Enter email">
    </div>
    <div class="form-group">
        <input type="password" name="u_pass" class="form-control" placeholder="Password">
    </div>
    <?php if(isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_COOKIE['error']; ?>
        </div>
    <? endif; ?>
    <button style="width: 100%" type="submit" class="btn btn-primary">Log In</button>
</form>

</div>