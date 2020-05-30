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

/* core/themes/classy/templates/content-edit/filter-tips.html.twig */
class __TwigTemplate_06389336a8bdb537ec2f9e2a4d67cd47ea2c07efcdf79bd53df039e5d662f6dc extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 19, "for" => 28, "set" => 31];
        $filters = ["t" => 20, "length" => 23, "clean_class" => 33, "escape" => 36, "replace" => 45];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['t', 'length', 'clean_class', 'escape', 'replace'],
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
        // line 19
        if (($context["multiple"] ?? null)) {
            // line 20
            echo "  <h2>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Text Formats"));
            echo "</h2>
";
        }
        // line 22
        echo "
";
        // line 23
        if (twig_length_filter($this->env, ($context["tips"] ?? null))) {
            // line 24
            echo "  ";
            if (($context["multiple"] ?? null)) {
                // line 25
                echo "    <div class=\"compose-tips\">
  ";
            }
            // line 27
            echo "
  ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["tips"] ?? null));
            foreach ($context['_seq'] as $context["name"] => $context["tip"]) {
                // line 29
                echo "    ";
                if (($context["multiple"] ?? null)) {
                    // line 30
                    echo "      ";
                    // line 31
                    $context["tip_classes"] = [0 => "filter-type", 1 => ("filter-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(                    // line 33
$context["name"])))];
                    // line 36
                    echo "      <div";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["tip"], "attributes", []), "addClass", [0 => ($context["tip_classes"] ?? null)], "method")), "html", null, true);
                    echo ">
      <h3>";
                    // line 37
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["tip"], "name", [])), "html", null, true);
                    echo "</h3>
    ";
                }
                // line 39
                echo "
    ";
                // line 40
                if (twig_length_filter($this->env, $this->getAttribute($context["tip"], "list", []))) {
                    // line 41
                    echo "      <ul class=\"tips\">
      ";
                    // line 42
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["tip"], "list", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 43
                        echo "        ";
                        // line 44
                        $context["item_classes"] = [0 => ((                        // line 45
($context["long"] ?? null)) ? (("filter-" . twig_replace_filter($this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "id", [])), ["/" => "-"]))) : (""))];
                        // line 48
                        echo "        <li";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => ($context["item_classes"] ?? null)], "method")), "html", null, true);
                        echo ">";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "tip", [])), "html", null, true);
                        echo "</li>
      ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 50
                    echo "      </ul>
    ";
                }
                // line 52
                echo "
    ";
                // line 53
                if (($context["multiple"] ?? null)) {
                    // line 54
                    echo "      </div>
    ";
                }
                // line 56
                echo "  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['tip'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "
  ";
            // line 58
            if (($context["multiple"] ?? null)) {
                // line 59
                echo "    </div>
  ";
            }
        }
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/content-edit/filter-tips.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 59,  150 => 58,  147 => 57,  141 => 56,  137 => 54,  135 => 53,  132 => 52,  128 => 50,  117 => 48,  115 => 45,  114 => 44,  112 => 43,  108 => 42,  105 => 41,  103 => 40,  100 => 39,  95 => 37,  90 => 36,  88 => 33,  87 => 31,  85 => 30,  82 => 29,  78 => 28,  75 => 27,  71 => 25,  68 => 24,  66 => 23,  63 => 22,  57 => 20,  55 => 19,);
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
 * Theme override for a set of filter tips.
 *
 * Available variables:
 * - tips: Descriptions and a CSS ID in the form of 'module-name/filter-id'
 *   (only used when 'long' is TRUE) for each filter in one or more text
 *   formats.
 * - long: A flag indicating whether the passed-in filter tips contain extended
 *   explanations, i.e. intended to be output on the path 'filter/tips'
 *   (TRUE), or are in a short format, i.e. suitable to be displayed below a
 *   form element. Defaults to FALSE.
 * - multiple: A flag indicating there is more than one filter tip.
 *
 * @see template_preprocess_filter_tips()
 */
#}
{% if multiple %}
  <h2>{{ 'Text Formats'|t }}</h2>
{% endif %}

{% if tips|length %}
  {% if multiple %}
    <div class=\"compose-tips\">
  {% endif %}

  {% for name, tip in tips %}
    {% if multiple %}
      {%
        set tip_classes = [
          'filter-type',
          'filter-' ~ name|clean_class,
        ]
      %}
      <div{{ tip.attributes.addClass(tip_classes) }}>
      <h3>{{ tip.name }}</h3>
    {% endif %}

    {% if tip.list|length %}
      <ul class=\"tips\">
      {% for item in tip.list %}
        {%
          set item_classes = [
            long ? 'filter-' ~ item.id|replace({'/': '-'}),
          ]
        %}
        <li{{ item.attributes.addClass(item_classes) }}>{{ item.tip }}</li>
      {% endfor %}
      </ul>
    {% endif %}

    {% if multiple %}
      </div>
    {% endif %}
  {% endfor %}

  {% if multiple %}
    </div>
  {% endif %}
{% endif %}
", "core/themes/classy/templates/content-edit/filter-tips.html.twig", "/var/www/html/development/Welkresorts/core/themes/classy/templates/content-edit/filter-tips.html.twig");
    }
}
