<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/welkresorts/templates/regions/region--Secondary-menu.html.twig */
class __TwigTemplate_08cf4d39144af9ac910629f4449550bcd924eabd0a0a09ae96e95d8cb6cd5430 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 2, "for" => 6];
        $filters = ["escape" => 7];
        $functions = ["simplify_menu" => 2];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for'],
                ['escape'],
                ['simplify_menu']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 2
        $context["items"] = call_user_func_array($this->env->getFunction('simplify_menu')->getCallable(), ["secondary-menu"]);
        // line 3
        echo "<div class=\"row nopadding\">
    <div class=\"col\">
        <div class=\"utility-nav text-right\">
            ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["items"] ?? null), "menu_tree", []));
        foreach ($context['_seq'] as $context["_key"] => $context["menu_item"]) {
            // line 7
            echo "                <a class=\"nav-link\" href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["menu_item"], "url", [])), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["menu_item"], "text", [])), "html", null, true);
            echo "</a>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['menu_item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
        echo "        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/regions/region--Secondary-menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 9,  66 => 7,  62 => 6,  57 => 3,  55 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{# Get menu items #}
{% set items = simplify_menu('secondary-menu') %}
<div class=\"row nopadding\">
    <div class=\"col\">
        <div class=\"utility-nav text-right\">
            {% for menu_item in items.menu_tree %}
                <a class=\"nav-link\" href=\"{{ menu_item.url }}\">{{ menu_item.text }}</a>
            {% endfor %}
        </div>
    </div>
</div>
", "themes/custom/welkresorts/templates/regions/region--Secondary-menu.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/regions/region--Secondary-menu.html.twig");
    }
}
