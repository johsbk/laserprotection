<?php

/* head.tpl */
class __TwigTemplate_31ba7a0e006a63bae7384c6c9dbe6bdc extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

    }

    // line 1
    public function getjquery()
    {
        $context = array_merge($this->env->getGlobals(), array(
        ));

        ob_start();
        // line 2
        echo "\t<script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, (isset($context['MEDIA_PATH']) ? $context['MEDIA_PATH'] : null), "html");
        echo "/js/jquery.js\"></script>
";

        return ob_get_clean();
    }

    // line 4
    public function getfancybox()
    {
        $context = array_merge($this->env->getGlobals(), array(
        ));

        ob_start();
        // line 5
        echo "\t<script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "fancybox/jquery.fancybox-1.3.4.css\" />
";

        return ob_get_clean();
    }

    // line 8
    public function getcontextmenu()
    {
        $context = array_merge($this->env->getGlobals(), array(
        ));

        ob_start();
        // line 9
        echo "\t<script src=\"";
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "form/js/jquery.contextMenu.js\" type=\"text/javascript\"></script>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "form/styles/jquery.contextMenu.css\" />
";

        return ob_get_clean();
    }

    // line 12
    public function getdatebox()
    {
        $context = array_merge($this->env->getGlobals(), array(
        ));

        ob_start();
        // line 13
        echo "\t<script src=\"";
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "form/js/DateBox.js\" type=\"text/javascript\"></script>
";

        return ob_get_clean();
    }

    // line 15
    public function getcombobox()
    {
        $context = array_merge($this->env->getGlobals(), array(
        ));

        ob_start();
        // line 16
        echo "\t<script src=\"";
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "form/js/ComboBox.js\" type=\"text/javascript\"></script>
";

        return ob_get_clean();
    }

    // line 18
    public function getform()
    {
        $context = array_merge($this->env->getGlobals(), array(
        ));

        ob_start();
        // line 19
        echo "\t";
        echo twig_escape_filter($this->env, $this->getAttribute($this, "f", array(), "method", false), "html");
        echo "
\t<script src=\"";
        // line 20
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "swfupload/swfupload.js\" type=\"text/javascript\"></script>
\t<script src=\"";
        // line 21
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "form/js/Data.js\" type=\"text/javascript\"></script>
\t<script src=\"";
        // line 22
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "form/js/Filepicker.js\" type=\"text/javascript\"></script>
\t<script src=\"";
        // line 23
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "form/js/Form.js\" type=\"text/javascript\"></script>
";

        return ob_get_clean();
    }

    // line 25
    public function getf()
    {
        $context = array_merge($this->env->getGlobals(), array(
        ));

        ob_start();
        // line 26
        echo "\t<script src=\"";
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "common/js/F.js\" type=\"text/javascript\"></script>
";

        return ob_get_clean();
    }

    // line 28
    public function getrichtext($css = null)
    {
        $context = array_merge($this->env->getGlobals(), array(
            "css" => $css,
        ));

        ob_start();
        // line 29
        echo "<script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "tinymce/jquery.tinymce.js\"></script>
<script type=\"text/javascript\">
\t\$().ready(function() {
\t\t\$('textarea.richtext').tinymce({
\t\t\t// Location of TinyMCE script
\t\t\tscript_url : '";
        // line 34
        echo twig_escape_filter($this->env, (isset($context['TEMPLATE_MEDIA_PATH']) ? $context['TEMPLATE_MEDIA_PATH'] : null), "html");
        echo "tinymce/tiny_mce.js',

\t\t\t// General options
\t\t\ttheme : \"advanced\",
\t\t\tplugins : \"autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist\",

\t\t\t// Theme options
\t\t\ttheme_advanced_buttons1 : \"save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",
\t\t\ttheme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
\t\t\ttheme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
\t\t\ttheme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak\",
\t\t\ttheme_advanced_toolbar_location : \"top\",
\t\t\ttheme_advanced_toolbar_align : \"left\",
\t\t\ttheme_advanced_statusbar_location : \"bottom\",
\t\t\ttheme_advanced_resizing : true,

\t\t\t// Example content CSS (should be your site CSS)
\t\t\tcontent_css : \"";
        // line 51
        echo twig_escape_filter($this->env, (isset($context['css']) ? $context['css'] : null), "html");
        echo "\",

\t\t\t// Drop lists for link/image/media/template dialogs
\t\t\ttemplate_external_list_url : \"lists/template_list.js\",
\t\t\texternal_link_list_url : \"lists/link_list.js\",
\t\t\texternal_image_list_url : \"lists/image_list.js\",
\t\t\tmedia_external_list_url : \"lists/media_list.js\"

\t\t});
\t});
</script>
\t
";

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "head.tpl";
    }
}
