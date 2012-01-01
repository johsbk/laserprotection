<?php

/* layout.tpl */
class __TwigTemplate_22daf7334b0c797624001feb9331f8b8 extends Twig_Template
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
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        $context['head'] = $this->env->loadTemplate("head.tpl");
        // line 2
        echo "<html>
<head>
<META http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
";
        // line 5
        $this->displayBlock('head', $context, $blocks);
        // line 15
        echo "</head>
<body>
<table>
<tr><td valign=\"top\">
";
        // line 19
        $this->displayBlock('menu', $context, $blocks);
        // line 22
        echo "</td><td valign=\"top\">
\t";
        // line 23
        $this->displayBlock('content', $context, $blocks);
        // line 25
        echo "</td></tr>
</table>
</body>
</html>";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context['head']) ? $context['head'] : null), "jquery", array(), "method", false), "html");
        echo "
<script type=\"text/javascript\">
\tvar URL_PATH = '";
        // line 8
        echo twig_escape_filter($this->env, (isset($context['URL_PATH']) ? $context['URL_PATH'] : null), "html");
        echo "';
\tvar MEDIA_PATH = '";
        // line 9
        echo twig_escape_filter($this->env, (isset($context['MEDIA_PATH']) ? $context['MEDIA_PATH'] : null), "html");
        echo "';
\tvar TEMPLATE_PATH = '";
        // line 10
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_PATH']) ? $context['TEMPLATE_PATH'] : null), "html");
        echo "';
</script>
<link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, (isset($context['MEDIA_PATH']) ? $context['MEDIA_PATH'] : null), "html");
        echo "/styles/standard.css\" />
<title>Laser protection</title>
";
    }

    // line 19
    public function block_menu($context, array $blocks = array())
    {
        // line 20
        echo "
";
    }

    // line 23
    public function block_content($context, array $blocks = array())
    {
        // line 24
        echo "\t";
    }

    public function getTemplateName()
    {
        return "layout.tpl";
    }
}
