<?php

/* index.phtml */
class __TwigTemplate_520a8f6fa7503612907a67d9793e0b82d0df11817a9ca339bc0caad0947ed46c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\"/>
        <title>Slim 3</title>
        <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
        <style>
            body {
                margin: 50px 0 0 0;
                padding: 0;
                width: 100%;
                font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif;
                text-align: center;
                color: #aaa;
                font-size: 18px;
            }

            h1 {
                color: #719e40;
                letter-spacing: -3px;
                font-family: 'Lato', sans-serif;
                font-size: 100px;
                font-weight: 200;
                margin-bottom: 0;
            }
        </style>
    </head>
    <body>
        <h1>Slim</h1>
        <div>a microframework for PHP</div>

        ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["eventos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["evento"]) {
            // line 33
            echo "            <li>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["evento"], "name", array()), "html", null, true);
            echo "</li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['evento'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        echo "    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "index.phtml";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 35,  56 => 33,  52 => 32,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.phtml", "/home/angelo/www/inter/templates/index.phtml");
    }
}
