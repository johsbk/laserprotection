<?php

/* main\index.tpl */
class __TwigTemplate_654c41797299ad512caf5590e9e83080 extends Twig_Template
{
    protected $parent;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
        );
    }

    public function getParent(array $context)
    {
        if (null === $this->parent) {
            $this->parent = $this->env->loadTemplate("layout.tpl");
        }

        return $this->parent;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_head($context, array $blocks = array())
    {
        // line 3
        echo "\t";
        echo twig_escape_filter($this->env, $this->renderParentBlock("head", $context, $blocks), "html");
        echo "
\t<script type=\"text/javascript\">
\t\tvar points = [];
\t\t";
        // line 6
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context['vs']) ? $context['vs'] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context['_key'] => $context['v']) {
            // line 7
            echo "\t\t\tpoints[";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['loop']) ? $context['loop'] : null), "index0", array(), "any", false), "html");
            echo "] = { x: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['v']) ? $context['v'] : null), "x", array(), "any", false), "html");
            echo "*3-1, y: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['v']) ? $context['v'] : null), "y", array(), "any", false), "html");
            echo "*3-1 };
\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 9
        echo "\t\tvar testpoints = [];
\t\t";
        // line 10
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context['testpts']) ? $context['testpts'] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context['_key'] => $context['v']) {
            // line 11
            echo "\t\t\ttestpoints[";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['loop']) ? $context['loop'] : null), "index0", array(), "any", false), "html");
            echo "] = { x: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['v']) ? $context['v'] : null), "x", array(), "any", false), "html");
            echo "*3-1, y: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['v']) ? $context['v'] : null), "y", array(), "any", false), "html");
            echo "*3-1 };
\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 13
        echo "\t\tvar ch = [];
\t\t";
        // line 14
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context['ch']) ? $context['ch'] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context['_key'] => $context['v']) {
            // line 15
            echo "\t\t\tch[";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['loop']) ? $context['loop'] : null), "index0", array(), "any", false), "html");
            echo "] = { x: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['v']) ? $context['v'] : null), "x", array(), "any", false), "html");
            echo "*3, y: ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['v']) ? $context['v'] : null), "y", array(), "any", false), "html");
            echo "*3 };
\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 17
        echo "\t\tvar defense = [];
\t\t";
        // line 18
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context['defense']) ? $context['defense'] : null));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context['_key'] => $context['l']) {
            // line 19
            echo "\t\t\tdefense[";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context['loop']) ? $context['loop'] : null), "index0", array(), "any", false), "html");
            echo "] = { x1: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['l']) ? $context['l'] : null), "v1", array(), "any", false), "x", array(), "any", false), "html");
            echo "*3, y1: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['l']) ? $context['l'] : null), "v1", array(), "any", false), "y", array(), "any", false), "html");
            echo "*3, x2: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['l']) ? $context['l'] : null), "v2", array(), "any", false), "x", array(), "any", false), "html");
            echo "*3, y2: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context['l']) ? $context['l'] : null), "v2", array(), "any", false), "y", array(), "any", false), "html");
            echo "*3 };
\t\t\t
\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['l'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 21
        echo "\t\t
\t\tvar ignore = [];
\t\tvar orgdefense = defense;
\t\tvar Draw = {
\t\t\tfirstclick : null,
\t\t\tinit : function () {
\t\t\t\tDraw.draw();
\t\t\t\t\$(\"#canvas\").click(Draw.click);
\t\t\t},
\t\t\tdraw : function () {
\t\t\t\tvar canvas = \$(\"#canvas\").get(0);
\t\t\t\tvar c = canvas.getContext('2d');
\t\t\t\tc.fillStyle = \"#FFFFFF\";
\t\t\t\tc.fillRect(0,0,canvas.width,canvas.height);
\t\t\t\tc.beginPath();
\t\t\t\tc.moveTo(ch[0].x,ch[0].y);
\t\t\t\tc.strokeStyle = \"#FF0000\"
\t\t\t\tfor (var i=1;i<ch.length;i++) {
\t\t\t\t\tc.lineTo(ch[i].x,ch[i].y);\t\t\t\t
\t\t\t\t}
\t\t\t\tc.lineTo(ch[0].x,ch[0].y);
\t\t\t\tc.stroke();
\t\t\t\tc.fillStyle=\"#000000\";
\t\t\t\tfor (var i=0;i<points.length;i++) {
\t\t\t\t\tc.fillRect(points[i].x,points[i].y,3,3);
\t\t\t\t}
\t\t\t\tc.fillStyle=\"#0000FF\"
\t\t\t\tfor (var i=0;i<testpoints.length;i++) {
\t\t\t\t\tc.fillRect(testpoints[i].x,testpoints[i].y,3,3);
\t\t\t\t}
\t\t\t\tc.strokeStyle = \"#00FF00\";
\t\t\t\tc.beginPath();
\t\t\t\tvar cost = 0;
\t\t\t\tvar html = \"\";
\t\t\t\tfor (var i=0;i<defense.length;i++) {
\t\t\t\t\tif (!ignore[i]) {
\t\t\t\t\t\tc.moveTo(defense[i].x1,defense[i].y1);
\t\t\t\t\t\tc.lineTo(defense[i].x2,defense[i].y2);
\t\t\t\t\t\tcost += Draw.distance(defense[i].x1/3,defense[i].y1/3,defense[i].x2/3,defense[i].y2/3);
\t\t\t\t\t}
\t\t\t\t\thtml += \"e\"+i+\" <input type=\\\"button\\\" onclick=\\\"Draw.hideEdge(\"+i+\")\\\" value=\\\"\";
\t\t\t\t\tif (ignore[i]) {
\t\t\t\t\t\thtml += \"show\";
\t\t\t\t\t} else {
\t\t\t\t\t\thtml += \"hide\";
\t\t\t\t\t}
\t\t\t\t\thtml += \"\\\" /><br />\";
\t\t\t\t}
\t\t\t\tc.stroke();
\t\t\t\t\$(\"#cost\").html(cost);
\t\t\t\t\$(\"#edges\").html(html);
\t\t\t},
\t\t\thideEdge : function (i) {
\t\t\t\t
\t\t\t\tignore[i] = !ignore[i];
\t\t\t\tDraw.draw();
\t\t\t},
\t\t\tdistance : function (x1,y1,x2,y2) {
\t\t\t\treturn Math.sqrt(Math.pow(x2-x1,2)+Math.pow(y2-y1,2));
\t\t\t},
\t\t\tclear : function () {
\t\t\t\tdefense = [];
\t\t\t\tignore = [];
\t\t\t\tDraw.draw();
\t\t\t},
\t\t\treset : function () {
\t\t\t\tdefense = orgdefense;
\t\t\t\tignore = [];
\t\t\t\tDraw.draw();
\t\t\t},
\t\t\tclick : function (e) {
\t\t\t\tvar canvas = \$(\"#canvas\").get(0);
\t\t\t\tvar c = canvas.getContext('2d');
\t\t\t\tvar v = {
\t\t\t\t\tx : e.pageX-\$(\"#canvas\").offset().left,
\t\t\t\t\ty: e.pageY-\$(\"#canvas\").offset().top
\t\t\t\t\t};
\t\t\t\tif (Draw.firstclick == null) {
\t\t\t\t\tDraw.firstclick = v;
\t\t\t\t} else {
\t\t\t\t\tvar v2 = Draw.firstclick;
\t\t\t\t\tdefense[defense.length]= {x1 : v.x, y1 : v.y, x2: v2.x, y2: v2.y}; 
\t\t\t\t\tDraw.firstclick = null;
\t\t\t\t\tDraw.draw();
\t\t\t\t}
\t\t\t}
\t\t};
\t\t\$(Draw.init);
\t</script>
";
    }

    // line 111
    public function block_content($context, array $blocks = array())
    {
        // line 112
        echo "\t<table>
\t<tr><td>
\t<canvas id=\"canvas\" height=\"600\" width=\"600\">No canvas support</canvas>
\t</td><td>
\t\t<div id=\"edges\"></div>
\t\t<input type=\"button\" onclick=\"Draw.clear()\" value=\"clear\" />
\t\t<input type=\"button\" onclick=\"Draw.reset()\" value=\"reset\" />
\t\t<div id=\"cost\"></div>
\t</td></tr>
\t</table>
\t
";
    }

    public function getTemplateName()
    {
        return "main\\index.tpl";
    }
}
