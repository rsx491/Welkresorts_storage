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

/* themes/custom/welkresorts/templates/blocks/block--welksocial.html.twig */
class __TwigTemplate_c3695449333435e1dddac1224517edd521e48f9d1c2564708533c418ff13b2ed extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 49, "if" => 57];
        $filters = ["clean_class" => 51, "escape" => 59];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_class', 'escape'],
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
        // line 49
        $context["classes"] = [0 => "block", 1 => ("block-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 51
($context["configuration"] ?? null), "provider", [])))), 2 => ("block-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(        // line 52
($context["plugin_id"] ?? null)))), 3 => "clearfix"];
        // line 56
        echo "                <div class=\"container\">
\t\t\t\t\t";
        // line 57
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_hyp3r_header_description", []), 0, [])) {
            // line 58
            echo "\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t";
            // line 59
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_hyp3r_header_description", []), 0, [])), "html", null, true);
            echo "
\t\t\t\t\t\t</div>
\t\t\t\t\t";
        }
        // line 62
        echo "                    <!-- Set up your HTML -->
\t\t\t\t\t
\t\t\t\t\t\t<script src=\"";
        // line 64
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_hyp3r_source_link", []), 0, []), "#url", [], "array")), "html", null, true);
        echo "\" id=\"HYP3R-widget\" data-base-url=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_hyp3r_source_data_base", []), 0, []), "#url", [], "array")), "html", null, true);
        echo "\" data-visualization=\"2013\" data-token=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_hyp3r_data_token", []), 0, [])), "html", null, true);
        echo "\"data-type=\"feed\"></script>
\t\t\t\t
                </div>
            ";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/blocks/block--welksocial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 64,  73 => 62,  67 => 59,  64 => 58,  62 => 57,  59 => 56,  57 => 52,  56 => 51,  55 => 49,);
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
 * Default theme implementation to display a block.
 *
 * Available variables:
 * - \$block->subject: Block title.
 * - \$content: Block content.
 * - \$block->module: Module that generated the block.
 * - \$block->delta: An ID for the block, unique within each module.
 * - \$block->region: The block region embedding the current block.
 * - \$classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable \$classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., \"theming hook\".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be 'block-user'.
 * - \$title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - \$title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - \$classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable \$classes.
 * - \$block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - \$zebra: Same output as \$block_zebra but independent of any block region.
 * - \$block_id: Counter dependent on each block region.
 * - \$id: Same output as \$block_id but independent of any block region.
 * - \$is_front: Flags true when presented in the front page.
 * - \$logged_in: Flags true when the current user is a logged-in member.
 * - \$is_admin: Flags true when the current user is an administrator.
 * - \$block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @ingroup templates
 *
 * @see bootstrap_preprocess_block()
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see bootstrap_process_block()
 * @see template_process()
 */
#}
{%
  set classes = [
    'block',
    'block-' ~ configuration.provider|clean_class,
    'block-' ~ plugin_id|clean_class,
    'clearfix',
  ]
%}
                <div class=\"container\">
\t\t\t\t\t{% if content.field_hyp3r_header_description.0 %}
\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t{{ content.field_hyp3r_header_description.0 }}
\t\t\t\t\t\t</div>
\t\t\t\t\t{% endif %}
                    <!-- Set up your HTML -->
\t\t\t\t\t
\t\t\t\t\t\t<script src=\"{{ content.field_hyp3r_source_link.0['#url'] }}\" id=\"HYP3R-widget\" data-base-url=\"{{ content.field_hyp3r_source_data_base.0['#url'] }}\" data-visualization=\"2013\" data-token=\"{{ content.field_hyp3r_data_token.0 }}\"data-type=\"feed\"></script>
\t\t\t\t
                </div>
            ", "themes/custom/welkresorts/templates/blocks/block--welksocial.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/blocks/block--welksocial.html.twig");
    }
}
