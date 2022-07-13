<?php
class Base
{
    protected $folder, $model;
    public function render($file, $data = array(),$template = true)
    {
        $baseUrl = $this->Base_Url();
        $data['baseUrl'] = $baseUrl;
        $view_file = "Views/" . $this->folder . "/" . $file . ".php";
        if (is_file($view_file)) {
            extract($data);
            ob_start();
            if ($template) {
                require_once("./Views/Layouts/navbar.php");
            }
            require_once($view_file);
            $content = ob_get_clean();
            require_once('./Views/Main/App.php');
        } else {
            require_once('./Views/Templates/error.php');
        }
    }
    public function Error()
    {
        return $this->render('error',true);
    }
    public function Base_Url()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else
            $link = "http";
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        $link .= "/Mai";
        return $link;
    }
}
