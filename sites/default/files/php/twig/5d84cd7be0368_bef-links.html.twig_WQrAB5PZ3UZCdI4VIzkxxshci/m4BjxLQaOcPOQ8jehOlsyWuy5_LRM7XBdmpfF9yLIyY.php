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

/* modules/contrib/better_exposed_filters/templates/bef-links.html.twig */
class __TwigTemplate_694b20538e4d292abe734451956c35b6ec125ceefef90ebdb31580636f2cc38b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 2, "for" => 9, "if" => 11, "include" => 16];
        $filters = ["escape" => 6, "merge" => 12];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for', 'if', 'include'],
                ['escape', 'merge'],
                []
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
        $context["classes"] = [0 => "bef-links"];
        // line 6
        echo "<input type=\"hidden\" name=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "#name", [], "array")), "html", null, true);
        echo "\" value=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "#value", [], "array")), "html", null, true);
        echo "\" />
<div";
        // line 7
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">
  ";
        // line 8
        $context["current_nesting_level"] = 0;
        // line 9
        echo "  ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["children"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 10
            echo "    ";
            $context["item"] = $this->getAttribute(($context["element"] ?? null), $context["child"]);
            // line 11
            echo "    ";
            if (twig_in_filter($context["child"], ($context["selected"] ?? null))) {
                // line 12
                echo "      ";
                $context["item"] = twig_array_merge($this->sandbox->ensureToStringAllowed(($context["item"] ?? null)), ["#attributes" => ["class" => "bef-link-active"]]);
                // line 13
                echo "    ";
            }
            // line 14
            echo "    ";
            if (($context["isNested"] ?? null)) {
                // line 15
                echo "      ";
                $context["new_nesting_level"] = $this->getAttribute(($context["depth"] ?? null), $context["child"]);
                // line 16
                echo "      ";
                $this->loadTemplate("@better_exposed_filters/bef-nested-elements.html.twig", "modules/contrib/better_exposed_filters/templates/bef-links.html.twig", 16)->display($context);
                // line 17
                echo "      ";
                $context["current_nesting_level"] = ($context["new_nesting_level"] ?? null);
                // line 18
                echo "    ";
            } else {
                // line 19
                echo "      ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["item"] ?? null)), "html", null, true);
                echo "
    ";
            }
            // line 21
            echo "  ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/better_exposed_filters/templates/bef-links.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 22,  121 => 21,  115 => 19,  112 => 18,  109 => 17,  106 => 16,  103 => 15,  100 => 14,  97 => 13,  94 => 12,  91 => 11,  88 => 10,  70 => 9,  68 => 8,  64 => 7,  57 => 6,  55 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{%
  set classes = [
    'bef-links',
  ]
%}
<input type=\"hidden\" name=\"{{ element[\"#name\"] }}\" value=\"{{ element[\"#value\"] }}\" />
<div{{ attributes.addClass(classes) }}>
  {% set current_nesting_level = 0 %}
  {% for child in children %}
    {% set item = attribute(element, child) %}
    {% if child in selected %}
      {% set item = item|merge({'#attributes': {'class': 'bef-link-active'}}) %}
    {% endif %}
    {% if isNested %}
      {% set new_nesting_level = attribute(depth, child) %}
      {% include '@better_exposed_filters/bef-nested-elements.html.twig' %}
      {% set current_nesting_level = new_nesting_level %}
    {% else %}
      {{ item }}
    {% endif %}
  {% endfor %}
</div>
", "modules/contrib/better_exposed_filters/templates/bef-links.html.twig", "/var/www/html/development/Welkresorts/modules/contrib/better_exposed_filters/templates/bef-links.html.twig");
    }
}
