<?php

class View
{
    public function generateView($templateView, $contentView, $data = NULL, $error = NULL)
    {
        include 'Application/Views/' . $templateView;
    }

    public function generatePagination($paginationView, $currentPage = NULL, $lastPage = NULL, $url = NULL)
    {
        include 'Application/Views/' . $paginationView;
    }
}