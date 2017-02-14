<?php

class post_controller extends controller
{
    //index()
    function index()
    {
        $data = $this->post_model->post_output($current_page = 1, $last_page);
        $this->view->generate_view('template_view.php', 'main_view.php', $data, $current_page, $last_page);
    }

    //post()
    function view()
    {
        $data = $this->post_model->post_page_output();
        $this->view->generate_view('template_view.php', 'post_view.php', $data);
    }

    //addPost()
    function add()
    {
        $this->view->generate_view('template_view.php', 'addpost_view.php');
        if (isset($_SESSION['logged_user']))
        {
            if (isset($_POST['add'])) {
                $data['title'] = $_POST['post_title'];
                $data['text'] = $_POST['post_text'];
                $this->post_model->post_add($data);
                header('Location:/');
            }
        }
        else header('Location:/login');
    }

    //editPost()
    function edit()
    {
        if (isset($_SESSION['user_id'])) {
            $author_id = $this->post_model->verificationAuthorOfPost($numpost);
            if ($_SESSION['user_id'] == $author_id['author'])
            {
                $data = $this->post_model->post_page_output();
                $this->view->generate_view('template_view.php', 'post_edit_view.php', $data);
            }
            elseif ($_SESSION['role'] == 1)
            {
                $data = $this->post_model->post_page_output();
                $this->view->generate_view('template_view.php', 'post_edit_view.php', $data);
            }
            else
            {
                $error = "You have not permissions";
                $this->view->generate_view('template_view.php', '404_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
            }
        }
        else
        {
            $error = "You have not permissions";
            $this->view->generate_view('template_view.php', '404_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
        }
        if (isset($_POST['save']))
        {
            $data['title'] = $_POST['post_title'];
            $data['text'] = $_POST['post_text'];
            $this->post_model->post_edit($data);
        }
    }

    //deletePost()
    function delete()
    {
        if (isset($_SESSION['user_id']))
        {
            $author_id = $this->post_model->verificationAuthorOfPost($numpost);
            if ($_SESSION['user_id'] == $author_id['author'])
            {
                $this->post_model->post_delete($numpost);
                header('Location:/');
            }
            elseif ($_SESSION['role'] == 1)
            {
                $this->post_model->post_delete($numpost);
                header('Location:/');
            }
            else $error = "You have not permissions";
            $this->view->generate_view('template_view.php', 'post_view.php', $data = NULL, $current_page = NULL, $last_page = NULL, $error);
        }
    }

}