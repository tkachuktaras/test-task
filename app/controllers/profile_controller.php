<?php

class Profile_Controller extends Controller
{
    protected $survey_model;

    public function __construct()
    {
        parent::__construct();

        if(!get_auth_status()){
            header('Location: ' . url());
        }

        $this->model = new User_Model();
        $this->survey_model = new Survey_Model();
    }

    function index()
    {
        $result = $this->survey_model->get_surveys($_SESSION['u_id']);
        $surveys = $result->fetch_all(MYSQLI_ASSOC);

        $this->view->generate('profile_view.php', null, ['surveys' => $surveys]);
    }

    function create()
    {
        $this->view->generate('create_survey_view.php');
    }

    function save(){
        $error = "Title, status and at least 1 answer are required.";

        if ($_POST['s_title'] && $_POST['s_status'] != '' && !empty($_POST['answers'])) {
            $data = [
                's_title' => $_POST['s_title'],
                's_status' => $_POST['s_status'] ? 'active' : 'inactive',
                'answers' => $_POST['answers'],
                'u_id' => $_SESSION['u_id']
            ];

            $result = $this->survey_model->create($data);
            if ($result) {
                header('Location: ' . url('/profile'));
                return true;
            }
            $error = "Some error occurred.";
        }

        setcookie('error', $error, time() + 1, $_SERVER['HTTP_REFERER']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return false;
    }

    function edit($id)
    {
        $result = $this->survey_model->get_survey($id, $_SESSION['u_id']);

        if($result->num_rows > 0){
            $survey = $result->fetch_all(MYSQLI_ASSOC)[0];
            $answers = [];
            $survey['answers'] = explode('¦', $survey['answers']);
            foreach($survey['answers'] as $answer){
                $answer = explode('‖', $answer);
                array_push($answers, $answer[1]);
            }
            $survey['answers'] = $answers;

            $this->view->generate('edit_survey_view.php', null, ['survey' => $survey]);
        } else {
            Route::ErrorPage404();
        }
    }

    function update($id)
    {
        $error = "Title, status and at least 1 answer are required.";

        if($_POST['s_title'] && $_POST['s_status'] != '' && !empty($_POST['answers']) && $id){
            $result = $this->survey_model->get_survey($id, $_SESSION['u_id']);
            if($result->num_rows > 0){
                $data = [
                    's_title' => $_POST['s_title'],
                    's_status' => $_POST['s_status'] ? 'active' : 'inactive',
                    'answers' => $_POST['answers']
                ];

                $result = $this->survey_model->update($id, $data);

                header('Location: ' . url('/profile'));
                return true;
            } else {
                Route::ErrorPage404();
            }
        }

        setcookie('error', $error, time() + 1, '/');
        header("Location:javascript://history.go(-1)");
        return false;
    }

    function delete($id)
    {
        $this->survey_model->delete($id);
        header('Location: ' . url('/profile'));
        return true;
    }

    function like($id)
    {
        $this->survey_model->like($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return true;
    }

    function unlike($id)
    {
        $this->survey_model->unlike($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return true;
    }
}