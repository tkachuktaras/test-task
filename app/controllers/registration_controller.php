<?php

class Registration_Controller extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new User_Model();
    }

    function index()
    {
        $this->view->generate('registration_view.php');
    }

    function save(){
        $error = "Email, password and password confirmation fields are required.";

        if ($_POST['u_email'] && $_POST['u_pass'] && $_POST['u_pass_confirm']) {
            $email = $_POST['u_email'];
            $password = $_POST['u_pass'];
            $password_confirmation = $_POST['u_pass_confirm'];

            if($password != $password_confirmation){
                setcookie('error', "Password Confirmation should match the Password", time() + 1, $_SERVER['HTTP_REFERER']);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                return false;
            }

            $result = $this->model->get_user_by_email($email);
            if ($result->num_rows == 0) {
                $result = $this->model->save_user($email, $password);

                setcookie ("u_email", $email, time() + 50000, '/');
                setcookie ("u_pass", md5($email . $password), time() + 50000, '/');
                $_SESSION['u_id'] = $result;

                $id = $_SESSION['u_id'];
                $this->model->lastAction($id);

                header('Location: ' . url());
                return true;
            }
            $error = "Email has already exists.";
        }

        setcookie('error', $error, time() + 1, $_SERVER['HTTP_REFERER']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return false;
    }
}