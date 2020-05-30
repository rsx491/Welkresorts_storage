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

/* themes/custom/welkresorts/templates/blocks/block--thewelkexperience.html.twig */
class __TwigTemplate_ea2b107d08390a3f5b17cc249bf80f370673939fbb357250591a0c7b10b4ae19 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 49];
        $filters = ["clean_class" => 51, "escape" => 60, "render" => 80];
        $functions = ["file_url" => 74];

        try {
            $this->sandbox->checkSecurity(
                ['set'],
                ['clean_class', 'escape', 'render'],
                ['file_url']
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
        echo "<div class=\"welk-experience\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-12 col-lg-6 col-xl-6\">
                                <span class=\"experience\">";
        // line 60
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
        echo "</span>
                                <span class=\"get-away-text\">";
        // line 61
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_heading", [])), "html", null, true);
        echo "</span>
                            </div>
                            <div class=\"col-12 col-lg-6 col-xl-6\">
                                <div class=\"welk-resorts-is-more\">";
        // line 64
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_description", [])), "html", null, true);
        echo "</div>
                            </div>
                        </div>
                    </div>
                </div>
<div class=\"spacious-accommodation\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col xl-5 col-lg-5 col-12\">
                                <div class=\"wave-btn\"></div> 
                                <img class=\"img-fluid\" src=\"";
        // line 74
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_image", []), 0, []), "#item", [], "array"), "entity", []), "uri", []), "value", []))]), "html", null, true);
        echo "\" alt=\"\">
                            </div>
\t\t\t\t\t\t\t<div class=\"offset-lg-1 col xl-6 col-lg-6 col-12\">
                                <div id=\"accordion\">
\t\t\t\t\t\t\t\t\t";
        // line 78
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_faq", [])), "html", null, true);
        echo "
\t\t\t\t\t\t      </div>
\t\t\t\t\t\t\t  <a href= \"";
        // line 80
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_button_with_link_and_text", []), 0, []), "#url", [], "array")), "html", null, true);
        echo "\" class=\"btn btn-primary large\" title=\"Explore the Welk Experience\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_button_with_link_and_text", []), 0, []), "#title", [], "array"))), "html", null, true);
        echo "</a>
                          </div>
                        </div>
                    </div>
                </div>

";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/blocks/block--thewelkexperience.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 80,  95 => 78,  88 => 74,  75 => 64,  69 => 61,  65 => 60,  59 => 56,  57 => 52,  56 => 51,  55 => 49,);
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
<div class=\"welk-experience\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-12 col-lg-6 col-xl-6\">
                                <span class=\"experience\">{{ label }}</span>
                                <span class=\"get-away-text\">{{ content.field_heading }}</span>
                            </div>
                            <div class=\"col-12 col-lg-6 col-xl-6\">
                                <div class=\"welk-resorts-is-more\">{{ content.field_description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
<div class=\"spacious-accommodation\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col xl-5 col-lg-5 col-12\">
                                <div class=\"wave-btn\"></div> 
                                <img class=\"img-fluid\" src=\"{{ file_url(content.field_image.0['#item'].entity.uri.value) }}\" alt=\"\">
                            </div>
\t\t\t\t\t\t\t<div class=\"offset-lg-1 col xl-6 col-lg-6 col-12\">
                                <div id=\"accordion\">
\t\t\t\t\t\t\t\t\t{{ content.field_faq }}
\t\t\t\t\t\t      </div>
\t\t\t\t\t\t\t  <a href= \"{{ content.field_button_with_link_and_text.0['#url'] }}\" class=\"btn btn-primary large\" title=\"Explore the Welk Experience\">{{ content.field_button_with_link_and_text.0['#title']|render }}</a>
                          </div>
                        </div>
                    </div>
                </div>

", "themes/custom/welkresorts/templates/blocks/block--thewelkexperience.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/blocks/block--thewelkexperience.html.twig");
    }
}
