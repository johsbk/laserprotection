<?php

/* views/layouts/main.twig */
class __TwigTemplate_19e5cc2495c02b6b76aa284054488bbe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'menu' => array($this, 'block_menu'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html>
<head>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
";
        // line 5
        $this->displayBlock('head', $context, $blocks);
        // line 10
        echo "</head>
<body>
<table>
<tr><td valign=\"top\">
";
        // line 14
        $this->displayBlock('menu', $context, $blocks);
        // line 17
        echo "</td><td valign=\"top\">
\t";
        // line 18
        $this->displayBlock('content', $context, $blocks);
        // line 20
        echo "</td></tr>
</table>
</body>
</html>";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        echo "<link rel=\"stylesheet\" href=\"";
        if (isset($context["App"])) { $_App_ = $context["App"]; } else { $_App_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_App_, "request"), "baseUrl"), "html", null, true);
        echo "/css/standard.css\" />
<script src=\"";
        // line 7
        if (isset($context["App"])) { $_App_ = $context["App"]; } else { $_App_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_App_, "request"), "baseUrl"), "html", null, true);
        echo "/js/jquery.js\"></script>
<title>Laser protection</title>
";
    }

    // line 14
    public function block_menu($context, array $blocks = array())
    {
        // line 15
        echo "
";
    }

    // line 18
    public function block_content($context, array $blocks = array())
    {
        // line 19
        echo "\t";
    }

    public function getTemplateName()
    {
        return "views/layouts/main.twig";
    }

}
