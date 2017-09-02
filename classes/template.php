<?php

class Template
{
    private $vars = array();
    private $rendered = "";
    private $template = "";

    /**
     * Page constructor.
     * @param string $templateName
     */
    public function __construct(string $templateName)
    {
        $this->template = $templateName . ".php";
    }

    /**
     *  Renders the result
     */
    public function render()
    {
        ob_start();
        foreach ($this->vars as $varName => $varValue)
            $$varName = $varValue;

        include(TEMPLATE . $this->template);
        $this->rendered = ob_get_contents();

        foreach ($this->vars as $varName => $varValue)
            unset($$varName);
        ob_clean();
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name): mixed
    {
        return $this->vars[$name];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->rendered;
    }
}