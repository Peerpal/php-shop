<?php


class View
{
    protected $view;

    protected $vars;

    public function __construct($view)
    {
        $this->view = $view;
        $this->vars = [];
    }

    public function __get($name)
    {
        return $this->vars[$name];
    }

    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }


    public function __toString()
    {
        extract($this->vars);
        chdir(dirname($this->view));
        ob_start();
        include basename($this->view);

        return ob_get_clean();
    }

}