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

/* core/themes/classy/templates/form/field-multiple-value-form.html.twig */
class __TwigTemplate_8c8deb0993428c0d590cd9fa17228012997dd9a1d63093d222ca3762afb8e8d3 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 22, "set" => 24, "for" => 39];
        $filters = ["escape" => 29];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape'],
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
        // line 22
        if (($context["multiple"] ?? null)) {
            // line 23
            echo "  ";
            // line 24
            $context["classes"] = [0 => "js-form-item", 1 => "form-item"];
            // line 29
            echo "  <div";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
            echo ">
    ";
            // line 30
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["table"] ?? null)), "html", null, true);
            echo "
    ";
            // line 31
            if ($this->getAttribute(($context["description"] ?? null), "content", [])) {
                // line 32
                echo "      <div";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["description"] ?? null), "attributes", []), "addClass", [0 => "description"], "method")), "html", null, true);
                echo " >";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["description"] ?? null), "content", [])), "html", null, true);
                echo "</div>
    ";
            }
            // line 34
            echo "    ";
            if (($context["button"] ?? null)) {
                // line 35
                echo "      <div class=\"clearfix\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["button"] ?? null)), "html", null, true);
                echo "</div>
    ";
            }
            // line 37
            echo "  </div>
";
        } else {
            // line 39
            echo "  ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["elements"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 40
                echo "    ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["element"]), "html", null, true);
                echo "
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/form/field-multiple-value-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 40,  93 => 39,  89 => 37,  83 => 35,  80 => 34,  72 => 32,  70 => 31,  66 => 30,  61 => 29,  59 => 24,  57 => 23,  55 => 22,);
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
 * Theme override for an individual form element.
 *
 * Available variables for all fields:
 * - multiple: Whether there are multiple instances of the field.
 *
 * Available variables for single cardinality fields:
 * - elements: Form elements to be rendered.
 *
 * Available variables when there are multiple fields.
 * - table: Table of field items.
 * - description: The description element containing the following properties:
 *   - content: The description content of the form element.
 *   - attributes: HTML attributes to apply to the description container.
 * - button: \"Add another item\" button.
 *
 * @see template_preprocess_field_multiple_value_form()
 */
#}
{% if multiple %}
  {%
    set classes = [
      'js-form-item',
      'form-item'
    ]
  %}
  <div{{ attributes.addClass(classes) }}>
    {{ table }}
    {% if description.content %}
      <div{{ description.attributes.addClass('description') }} >{{ description.content }}</div>
    {% endif %}
    {% if button %}
      <div class=\"clearfix\">{{ button }}</div>
    {% endif %}
  </div>
{% else %}
  {% for element in elements %}
    {{ element }}
  {% endfor %}
{% endif %}
", "core/themes/classy/templates/form/field-multiple-value-form.html.twig", "/var/www/html/development/Welkresorts/core/themes/classy/templates/form/field-multiple-value-form.html.twig");
    }
}
