<?php

class Login_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new User_Model();
    }

    function index()
    {
        $this->view->generate('login_view.php');
    }

    function auth()
    {
        $error = "Email and password fields are required.";
        if ($_POST['u_email'] && $_POST['u_pass']) {
            $u_email = $_POST['u_email'];
            $u_pass = $_POST['u_pass'];

            $result = $this->model->get_user_by_email($u_email);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (md5(md5($u_pass) . get_salt()) == $row['u_pass']) {
                    setcookie("u_email", $row['u_email'], time() + 50000, '/');
                    setcookie("u_pass", md5($row['u_email'] . $row['u_pass']), time() + 50000, '/');
                    $_SESSION['u_id'] = $row['u_id'];

                    $id = $_SESSION['u_id'];
                    $this->model->lastAction($id);
                    header('Location: ' . url());
                    return true;
                }
            }

            $error = "Email or password are incorrect";
        }

        setcookie('error', $error, time() + 1, $_SERVER['HTTP_REFERER']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return false;
    }

    function check_auth()
    {
        ini_set("session.use_trans_sid", true);
        if (isset($_SESSION['u_id'])) {
            if (isset($_COOKIE['u_email']) && isset($_COOKIE['u_pass'])) {
                SetCookie("u_email", "", time() - 1, '/');
                SetCookie("u_pass", "", time() - 1, '/');

                setcookie("u_email", $_COOKIE['u_email'], time() + 50000, '/');
                setcookie("u_pass", $_COOKIE['u_pass'], time() + 50000, '/');

                $id = $_SESSION['u_id'];
                $this->model->lastAction($id);

                return true;
            } else {
                $result = $this->model->get_user_by_id($_SESSION['u_id']);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();

                    setcookie("u_email", $row['u_email'], time() + 50000, '/');
                    setcookie("u_pass", md5($row['u_email'] . $row['u_pass']), time() + 50000, '/');

                    $id = $_SESSION['u_id'];
                    $this->model->lastAction($id);
                    return true;
                }

                return false;
            }
        } else {
            if (isset($_COOKIE['u_email']) && isset($_COOKIE['u_pass'])) {
                $result = $this->model->get_user_by_email($_COOKIE['u_email']);
                $row = $result->fetch_assoc();

                if ($result->num_rows == 1 && md5($row['u_email'] . $row['u_pass']) == $_COOKIE['u_pass']) {
                    $_SESSION['u_id'] = $row['u_id'];
                    $id = $_SESSION['u_id'];

                    $this->model->lastAction($id);
                    return true;
                } else {
                    setcookie('u_email', null, -1, '/');
                    setcookie('u_pass', null, -1, '/');
                }
            }

            return false;
        }
    }

    function sign_out()
    {
        $id = $_SESSION['u_id'];

        $this->model->user_out($id);

        unset($_SESSION['u_id']);
        setcookie('u_email', null, -1, '/');
        setcookie('u_pass', null, -1, '/');

        header('Location: ' . url());
        return true;
    }
}