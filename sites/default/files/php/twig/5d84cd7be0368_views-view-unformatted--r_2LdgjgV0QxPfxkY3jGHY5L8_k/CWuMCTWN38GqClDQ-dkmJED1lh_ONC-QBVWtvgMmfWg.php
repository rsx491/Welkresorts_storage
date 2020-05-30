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

/* themes/custom/welkresorts/templates/views/views-view-unformatted--resort-destinations.html.twig */
class __TwigTemplate_a9cde7011eb52b7c9236411f9cf0f32558ced087ba89a00a3a9f5a476261ee9b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 24, "if" => 25, "set" => 32];
        $filters = ["escape" => 26, "length" => 32];
        $functions = ["range" => 40];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if', 'set'],
                ['escape', 'length'],
                ['range']
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
        // line 21
        echo "<div class=\"destination-cards\">
    <div class=\"container\">
        <div class=\"row\">
            ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["row"]) {
            // line 25
            echo "                ";
            if ((($context["key"] == 0) || ($context["key"] == 1))) {
                // line 26
                echo "                    ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["row"], "content", [])), "html", null, true);
                echo "
                ";
            }
            // line 28
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "        </div>
    </div>
</div>
";
        // line 32
        $context["total_count"] = twig_length_filter($this->env, $this->sandbox->ensureToStringAllowed(($context["rows"] ?? null)));
        // line 33
        $context["remaining"] = (($context["total_count"] ?? null) - 2);
        // line 34
        $context["num_rows"] = (($context["remaining"] ?? null) / 3);
        // line 35
        $context["remainder"] = (($context["remaining"] ?? null) % 3);
        // line 36
        echo "<div class=\"destination-cards small\">
    <div class=\"container\">
        ";
        // line 38
        if ((($context["num_rows"] ?? null) > 0)) {
            // line 39
            echo "            ";
            $context["iteration"] = 0;
            // line 40
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(range(1, ($context["num_rows"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                // line 41
                echo "                <div class=\"row\">
                    ";
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(2, 4));
                foreach ($context['_seq'] as $context["_key"] => $context["j"]) {
                    // line 43
                    echo "                        ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["rows"] ?? null), ($context["j"] + ($context["iteration"] ?? null)), [], "array"), "content", [])), "html", null, true);
                    echo "
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['j'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 45
                echo "                </div>
                ";
                // line 46
                $context["iteration"] = (($context["iteration"] ?? null) + 3);
                // line 47
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "        ";
        }
        // line 49
        echo "    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/views/views-view-unformatted--resort-destinations.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 49,  133 => 48,  127 => 47,  125 => 46,  122 => 45,  113 => 43,  109 => 42,  106 => 41,  101 => 40,  98 => 39,  96 => 38,  92 => 36,  90 => 35,  88 => 34,  86 => 33,  84 => 32,  79 => 29,  73 => 28,  67 => 26,  64 => 25,  60 => 24,  55 => 21,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for a view template to display a list of rows.
 *
 * Available variables:
 * - attributes: HTML attributes for the container.
 * - rows: A list of rows for this list.
 *   - attributes: The row's HTML attributes.
 *   - content: The row's contents.
 * - title: The title of this group of rows. May be empty.
 * - list: @todo.
 *   - type: Starting tag will be either a ul or ol.
 *   - attributes: HTML attributes for the list element.
 *
 * @see template_preprocess_views_view_list()
 *
 * @ingroup themeable
 */
#}
<div class=\"destination-cards\">
    <div class=\"container\">
        <div class=\"row\">
            {% for key,row in rows %}
                {% if key == 0 or key == 1 %}
                    {{ row.content }}
                {% endif %}
            {% endfor %}
        </div>
    </div>
</div>
{% set total_count = rows | length %}
{% set remaining = total_count - 2 %}
{% set num_rows = remaining / 3 %}
{% set remainder = remaining % 3 %}
<div class=\"destination-cards small\">
    <div class=\"container\">
        {% if num_rows > 0 %}
            {% set iteration = 0 %}
            {% for i in 1..num_rows %}
                <div class=\"row\">
                    {% for j in 2..4 %}
                        {{ rows[ j + iteration ].content }}
                    {% endfor %}
                </div>
                {% set iteration = iteration + 3 %}
            {% endfor %}
        {% endif %}
    </div>
</div>
", "themes/custom/welkresorts/templates/views/views-view-unformatted--resort-destinations.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/views/views-view-unformatted--resort-destinations.html.twig");
    }
}
