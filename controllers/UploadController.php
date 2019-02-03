<?php

class UploadController extends AppController
{
    private $message = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function upload()
    {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $this->message[] = 'File uploaded.';
        }

        $this->render('upload', [ 'message' => $this->message]);
    }

    private function validate(array $file): bool
    {

        return true;
    }
}