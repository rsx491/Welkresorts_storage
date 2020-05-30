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

/* themes/contrib/bootstrap/templates/input/textarea.html.twig */
class __TwigTemplate_8af5c1643b51c59241cf7ce3974b435e25749e83db9225f4c23e10b59a41a091 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 19];
        $filters = ["escape" => 26];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set'],
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
        // line 19
        $context["classes"] = [0 => "form-textarea", 1 => "form-control", 2 => ((        // line 22
($context["resizable"] ?? null)) ? (("resize-" . $this->sandbox->ensureToStringAllowed(($context["resizable"] ?? null)))) : ("")), 3 => ((        // line 23
($context["required"] ?? null)) ? ("required") : (""))];
        // line 26
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["wrapper_attributes"] ?? null), "addClass", [0 => "form-textarea-wrapper"], "method")), "html", null, true);
        echo ">
  <textarea";
        // line 27
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["value"] ?? null)), "html", null, true);
        echo "</textarea>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/bootstrap/templates/input/textarea.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 27,  59 => 26,  57 => 23,  56 => 22,  55 => 19,);
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
 * Bootstrap theme implementation for a 'textarea' #type form element.
 *
 * Available variables
 * - wrapper_attributes: A list of HTML attributes for the wrapper element.
 * - attributes: A list of HTML attributes for the textarea element.
 * - resizable: An indicator for whether the textarea is resizable.
 * - required: An indicator for whether the textarea is required.
 * - value: The textarea content.
 *
 * @ingroup templates
 *
 * @see template_preprocess_textarea()
 */
#}
{%
  set classes = [
    'form-textarea',
    'form-control',
    resizable ? 'resize-' ~ resizable,
    required ? 'required',
  ]
%}
<div{{ wrapper_attributes.addClass('form-textarea-wrapper') }}>
  <textarea{{ attributes.addClass(classes) }}>{{ value }}</textarea>
</div>
", "themes/contrib/bootstrap/templates/input/textarea.html.twig", "/var/www/html/development/Welkresorts/themes/contrib/bootstrap/templates/input/textarea.html.twig");
    }
}
