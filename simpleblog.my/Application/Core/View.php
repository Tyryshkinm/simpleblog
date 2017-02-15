<?php

class View
{
    public function generateView($templateView, $contentView, $data = NULL,
        $currentPage = NULL, $lastPage = NULL, $error = NULL
    ) {
        include 'Application/Views/' . $templateView;
    }
}