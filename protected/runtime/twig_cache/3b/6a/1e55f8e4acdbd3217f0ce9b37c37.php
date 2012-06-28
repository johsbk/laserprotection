<?php

/* \views\site\index.twig */
class __TwigTemplate_3b6a1e55f8e4acdbd3217f0ce9b37c37 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "views/layouts/main.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_head($context, array $blocks = array())
    {
        // line 3
        echo "\t";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
\t<script type=\"text/javascript\">
\t\tvar points = [];
\t\t";
        // line 6
        if (isset($context["vs"])) { $_vs_ = $context["vs"]; } else { $_vs_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_vs_);
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
        foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
            // line 7
            echo "\t\t\tpoints[";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_loop_, "index0"), "html", null, true);
            echo "] = { x: ";
            if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_v_, "x"), "html", null, true);
            echo ", y: ";
            if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_v_, "y"), "html", null, true);
            echo " };
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
        echo "\t\tvar ch = [];
\t\t";
        // line 10
        if (isset($context["ch"])) { $_ch_ = $context["ch"]; } else { $_ch_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_ch_);
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
        foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
            // line 11
            echo "\t\t\tch[";
            if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_loop_, "index0"), "html", null, true);
            echo "] = { x: ";
            if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_v_, "x"), "html", null, true);
            echo ", y: ";
            if (isset($context["v"])) { $_v_ = $context["v"]; } else { $_v_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_v_, "y"), "html", null, true);
            echo " };
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
        echo "\t\tvar defense = [];\t
\t\tvar ignore = [];
\t\tvar orgdefense = defense;
\t\tvar Draw = {
\t\t\tclosesti : null,
\t\t\tgetstatus : 0,
\t\t\tinit : function () {
\t\t\t\t\$(\"#defense\").change(Draw.getDefense);
\t\t\t\tDraw.getDefense();
\t\t\t\t\$(\"#canvas\").mousedown(Draw.mousedown);
\t\t\t\t\$(\"#canvas\").bind('contextmenu',Draw.contextmenu);
\t\t\t},
\t\t\tgetDefense : function () {
\t\t\t\tif (Draw.getstatus==0) {
\t\t\t\t\tDraw.getstatus = 1;
\t\t\t\t\t\$.post(\"index.php?r=site/getDefense\",{defense: \$(\"#defense\").val(), points: points},function (txt) {
\t\t\t\t\t\tvar data = \$.parseJSON(txt);
\t\t\t\t\t\tdefense = data.defense;
\t\t\t\t\t\tch = data.ch;
\t\t\t\t\t\t\$(\"#lb\").html(data.lb);
\t\t\t\t\t\tDraw.draw();
\t\t\t\t\t\tif (Draw.getstatus==2) {
\t\t\t\t\t\t\tDraw.getstatus = 0;
\t\t\t\t\t\t\tDraw.getDefense();
\t\t\t\t\t\t} else {
\t\t\t\t\t\t\tDraw.getstatus = 0;
\t\t\t\t\t\t}
\t\t\t\t\t});
\t\t\t\t} else {
\t\t\t\t\tDraw.getstatus = 2;
\t\t\t\t}
\t\t\t},
\t\t\tdraw : function () {
\t\t\t\tvar canvas = \$(\"#canvas\").get(0);
\t\t\t\tvar c = canvas.getContext('2d');
\t\t\t\tc.fillStyle = \"#FFFFFF\";
\t\t\t\tc.fillRect(0,0,canvas.width,canvas.height);
\t\t\t\tc.beginPath();
\t\t\t\tc.moveTo(ch[0].x*3,ch[0].y*3);
\t\t\t\tc.strokeStyle = \"#FF0000\"
\t\t\t\tfor (var i=1;i<ch.length;i++) {
\t\t\t\t\tc.lineTo(ch[i].x*3,ch[i].y*3);\t\t\t\t
\t\t\t\t}
\t\t\t\tc.lineTo(ch[0].x*3,ch[0].y*3);
\t\t\t\tc.stroke();
\t\t\t\tc.fillStyle=\"#000000\";
\t\t\t\tvar html = \"\";
\t\t\t\tfor (var i=0;i<points.length;i++) {
\t\t\t\t\tc.fillRect(points[i].x*3-1,points[i].y*3-1,3,3);
\t\t\t\t\thtml += \"\"+(i+1)+\": (\"+points[i].x+\",\"+points[i].y+\")<input type=\\\"button\\\" value=\\\"remove\\\" onclick=\\\"Draw.removePoint(\"+i+\")\\\" /><br />\";
\t\t\t\t}
\t\t\t\t
\t\t\t\tc.strokeStyle = \"#00FF00\";
\t\t\t\tc.beginPath();
\t\t\t\tvar cost = 0;
\t\t\t\t
\t\t\t\tfor (var i=0;i<defense.length;i++) {
\t\t\t\t\tc.moveTo(defense[i].v1.x*3,defense[i].v1.y*3);
\t\t\t\t\tc.lineTo(defense[i].v2.x*3,defense[i].v2.y*3);
\t\t\t\t\tcost += Draw.distance(defense[i].v1.x,defense[i].v1.y,defense[i].v2.x,defense[i].v2.y);
\t\t\t\t\t
\t\t\t\t}
\t\t\t\tc.stroke();
\t\t\t\t\$(\"#cost\").html(cost);
\t\t\t\t\$(\"#vs\").html(html);
\t\t\t},
\t\t\tremovePoint: function (i) {
\t\t\t\tvar ps=[];
\t\t\t\tfor (var j=0;j<points.length;j++) {
\t\t\t\t\tif (j!=i) {
\t\t\t\t\t\tps[ps.length]=points[j];
\t\t\t\t\t}
\t\t\t\t}
\t\t\t\tpoints = ps;
\t\t\t\tDraw.getDefense();
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
\t\t\tcontextmenu : function (e) {
\t\t\t\tvar pos = {
\t\t\t\t\tx : Math.round((e.pageX-\$(\"#canvas\").offset().left)/3),
\t\t\t\t\ty: Math.round((e.pageY-\$(\"#canvas\").offset().top)/3)
\t\t\t\t};
\t\t\t\tpoints[points.length] = pos;
\t\t\t\tDraw.getDefense();
\t\t\t\treturn false;
\t\t\t},
\t\t\tmousedown : function (e) {
\t\t\t\tif (e.which==1) {
\t\t\t\t\tvar pos = {
\t\t\t\t\t\tx : Math.round((e.pageX-\$(\"#canvas\").offset().left)/3),
\t\t\t\t\t\ty: Math.round((e.pageY-\$(\"#canvas\").offset().top)/3)
\t\t\t\t\t};
\t\t\t\t\t
\t\t\t\t\tvar distance;
\t\t\t\t\tfor (var i=0;i<points.length;i++) {
\t\t\t\t\t\tvar p = points[i];
\t\t\t\t\t\tvar d = Draw.distance(p.x,p.y,pos.x,pos.y);
\t\t\t\t\t\tif (Draw.closesti==null || distance > d) {
\t\t\t\t\t\t\tDraw.closesti = i;
\t\t\t\t\t\t\tdistance = d;
\t\t\t\t\t\t}
\t\t\t\t\t}
\t\t\t\t\t\$(document).mouseup(Draw.mouseup);
\t\t\t\t\t\$(document).mousemove(Draw.mousemove);
\t\t\t\t}
\t\t\t\t
\t\t\t},
\t\t\tmouseup : function (e) {
\t\t\t\t\$(document).unbind('mouseup');
\t\t\t\t\$(document).unbind('mousemove');
\t\t\t\tDraw.closesti=null;
\t\t\t},
\t\t\tmousemove : function (e) {
\t\t\t\tvar pos = {
\t\t\t\t\t\tx : Math.round((e.pageX-\$(\"#canvas\").offset().left)/3),
\t\t\t\t\t\ty: Math.round((e.pageY-\$(\"#canvas\").offset().top)/3)
\t\t\t\t\t};
\t\t\t\tpoints[Draw.closesti].x=pos.x;
\t\t\t\tpoints[Draw.closesti].y=pos.y;
\t\t\t\tDraw.getDefense();
\t\t\t},
\t\t};
\t\t\$(Draw.init);
\t</script>
";
    }

    // line 155
    public function block_content($context, array $blocks = array())
    {
        // line 156
        echo "\t<table>
\t<tr><td>
\t<canvas id=\"canvas\" height=\"600\" width=\"800\">No canvas support</canvas>
\t</td><td>
\t\t<select id=\"defense\">
\t\t";
        // line 161
        if (isset($context["defenses"])) { $_defenses_ = $context["defenses"]; } else { $_defenses_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_defenses_);
        foreach ($context['_seq'] as $context["_key"] => $context["defense"]) {
            // line 162
            echo "\t\t\t<option value=\"";
            if (isset($context["defense"])) { $_defense_ = $context["defense"]; } else { $_defense_ = null; }
            echo twig_escape_filter($this->env, $_defense_, "html", null, true);
            echo "\">";
            if (isset($context["defense"])) { $_defense_ = $context["defense"]; } else { $_defense_ = null; }
            echo twig_escape_filter($this->env, $_defense_, "html", null, true);
            echo "</option>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['defense'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 164
        echo "\t\t</select>
\t\t<div id=\"vs\"></div>
\t\t<div id=\"cost\"></div>
\t\tLB: <div id=\"lb\">";
        // line 167
        if (isset($context["lb"])) { $_lb_ = $context["lb"]; } else { $_lb_ = null; }
        echo twig_escape_filter($this->env, $_lb_, "html", null, true);
        echo "</div>
\t</td></tr>
\t</table>
\tDrag and drop to move terminals, right click to place new.
";
    }

    public function getTemplateName()
    {
        return "\\views\\site\\index.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
