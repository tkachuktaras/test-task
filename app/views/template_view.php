<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Главная</title>
</head>

<body>
    <style>
        a:hover {
            text-decoration: none!important;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; width: 100%">
        <div class="container">
            <a class="navbar-brand" href="<?php echo url()?>">Test Task</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url('/api/documentation/')?>">API Documentation</a>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <?php if(get_auth_status()):?>
                    <a class="nav-link" href="<?php echo url('/profile')?>">Profile</a>
                    <a class="nav-link" href="<?php echo url('/login/sign_out')?>">Sign Out</a>
                <?php else:?>
                    <a class="nav-link" href="<?php echo url('/login')?>">Log In</a>
                    <a class="nav-link" href="<?php echo url('/registration')?>">Sign In</a>
                <?php endif; ?>
            </form>
        </div>
    </nav>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <div style="padding-top: 57px">
        <?php include 'app/views/' . $content_view; ?>
    </div>
</body>

</html>