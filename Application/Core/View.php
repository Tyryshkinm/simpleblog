<?php

class View
{
    public $data;
    public $contentView;
    public $msgError;
    public function generateView($templateView, $contentView, $data = NULL, $msgError = NULL)
    {
        include 'Application/Views/' . $templateView;
    }

    public function generatePagination($paginationView, $currentPage = NULL, $lastPage = NULL, $url = NULL)
    {
        include 'Application/Views/' . $paginationView;
    }
}