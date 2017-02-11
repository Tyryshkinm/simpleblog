<?php

class post_controller extends controller
{
    function index()
    {
        $data = $this->model->post_page_output();
        $this->view->generate_view('template_view.php', 'post_view.php', $data);
    }
    function edit()
    {
        $data = $this->model->post_page_output();
        $this->view->generate_view('template_view.php', 'post_edit_view.php', $data);
    }
    function save_changes()
    {
        if (isset($_POST['save']))
        {
            $data['title'] = $_POST['post_title'];
            $data['text'] = $_POST['post_text'];
            $this->model->post_edit($data);
        }
    }
    function delete()
    {
        if (isset($_SESSION['user_id']))
        {
            $author_id = $this->model->verificationAuthorOfPost($numpost);
            if ($_SESSION['user_id'] == $author_id['author'])
            {
                $this->model->post_delete($numpost);
                header('Location:/');
            }
            elseif ($_SESSION['role'] == 1)
            {
                $this->model->post_delete($numpost);
                header('Location:/');
            }
            else $error = "You have not permissions";
            $this->view->generate_view('template_view.php', 'post_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
        }
    }
}