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

/* themes/custom/welkresorts/templates/paragraphs/paragraph--welk-experience.html.twig */
class __TwigTemplate_30a22ee59ac6c286f11a953f3f9c9d0390c2ee2f8b69e9ed950aece6b0f129c0 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'paragraph' => [$this, 'block_paragraph'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 42, "block" => 49, "if" => 52];
        $filters = ["clean_class" => 44, "escape" => 58];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'block', 'if'],
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
        // line 42
        $context["classes"] = [0 => "paragraph", 1 => ("paragraph--type--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($this->getAttribute(        // line 44
($context["paragraph"] ?? null), "bundle", [])))), 2 => ((        // line 45
($context["view_mode"] ?? null)) ? (("paragraph--view-mode--" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(($context["view_mode"] ?? null))))) : ("")), 3 => (( !$this->getAttribute(        // line 46
($context["paragraph"] ?? null), "isPublished", [], "method")) ? ("paragraph--unpublished") : (""))];
        // line 49
        $this->displayBlock('paragraph', $context, $blocks);
    }

    public function block_paragraph($context, array $blocks = [])
    {
        // line 50
        echo "  
    ";
        // line 51
        $this->displayBlock('content', $context, $blocks);
        // line 91
        echo " 
";
    }

    // line 51
    public function block_content($context, array $blocks = [])
    {
        // line 52
        if ((($context["counter"] ?? null) == "0")) {
            // line 53
            echo "\t";
            if ($this->getAttribute(($context["content"] ?? null), "field_question_welk", [])) {
                echo "  
\t\t<div class=\"card\">
\t\t\t\t<div class=\"card-header\">
\t\t\t\t\t<h5 class=\"mb-0\">
\t\t\t\t\t<button class=\"btn btn-link collapsed\" data-toggle=\"collapse\"
\t\t\t\t\t\t\tdata-target=\"#collapse";
                // line 58
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["counter"] ?? null)), "html", null, true);
                echo "\">
\t\t\t\t\t\t\t";
                // line 59
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_question_welk", [])), "html", null, true);
                echo "
\t\t\t\t\t</button>
\t\t\t\t\t</h5>
\t\t\t\t</div>

\t\t\t\t<div id=\"collapse";
                // line 64
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["counter"] ?? null)), "html", null, true);
                echo "\" class=\"collapse\" data-parent=\"#accordion\">
\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t";
                // line 66
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_answer_welk", [])), "html", null, true);
                echo "
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t</div>
\t";
            }
        } else {
            // line 72
            echo "\t";
            if ($this->getAttribute(($context["content"] ?? null), "field_question_welk", [])) {
                // line 73
                echo "\t\t<div class=\"card\">
\t\t\t<div class=\"card-header\">
\t\t\t\t<h5 class=\"mb-0\">
\t\t\t\t<button class=\"btn btn-link collapsed\" data-toggle=\"collapse\"
\t\t\t\t\t\tdata-target=\"#collapse";
                // line 77
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["counter"] ?? null)), "html", null, true);
                echo "\">
\t\t\t\t\t\t";
                // line 78
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_question_welk", [])), "html", null, true);
                echo "
\t\t\t\t</button>
\t\t\t\t</h5>
\t\t\t</div>
\t\t\t<div id=\"collapse";
                // line 82
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["counter"] ?? null)), "html", null, true);
                echo "\" class=\"collapse\" data-parent=\"#accordion\">
\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t";
                // line 84
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_answer_welk", [])), "html", null, true);
                echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t";
            }
        }
        // line 90
        echo "    ";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/paragraphs/paragraph--welk-experience.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 90,  143 => 84,  138 => 82,  131 => 78,  127 => 77,  121 => 73,  118 => 72,  109 => 66,  104 => 64,  96 => 59,  92 => 58,  83 => 53,  81 => 52,  78 => 51,  73 => 91,  71 => 51,  68 => 50,  62 => 49,  60 => 46,  59 => 45,  58 => 44,  57 => 42,);
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
 * Default theme implementation to display a paragraph.
 *
 * Available variables:
 * - paragraph: Full paragraph entity.
 *   Only method names starting with \"get\", \"has\", or \"is\" and a few common
 *   methods such as \"id\", \"label\", and \"bundle\" are available. For example:
 *   - paragraph.getCreatedTime() will return the paragraph creation timestamp.
 *   - paragraph.id(): The paragraph ID.
 *   - paragraph.bundle(): The type of the paragraph, for example, \"image\" or \"text\".
 *   - paragraph.getOwnerId(): The user ID of the paragraph author.
 *   See Drupal\\paragraphs\\Entity\\Paragraph for a full list of public properties
 *   and methods for the paragraph object.
 * - content: All paragraph items. Use {{ content }} to print them all,
 *   or print a subset such as {{ content.field_example }}. Use
 *   {{ content|without('field_example') }} to temporarily suppress the printing
 *   of a given child element.
 * - attributes: HTML attributes for the containing element.
 *   The attributes.class element may contain one or more of the following
 *   classes:
 *   - paragraphs: The current template type (also known as a \"theming hook\").
 *   - paragraphs--type-[type]: The current paragraphs type. For example, if the paragraph is an
 *     \"Image\" it would result in \"paragraphs--type--image\". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - paragraphs--view-mode--[view_mode]: The View Mode of the paragraph; for example, a
 *     preview would result in: \"paragraphs--view-mode--preview\", and
 *     default: \"paragraphs--view-mode--default\".
 * - view_mode: View mode; for example, \"preview\" or \"full\".
 * - logged_in: Flag for authenticated user status. Will be true when the
 *   current user is a logged-in member.
 * - is_admin: Flag for admin user status. Will be true when the current user
 *   is an administrator.
 *
 * @see template_preprocess_paragraph()
 *
 * @ingroup themeable
 */
#}
{%
  set classes = [
    'paragraph',
    'paragraph--type--' ~ paragraph.bundle|clean_class,
    view_mode ? 'paragraph--view-mode--' ~ view_mode|clean_class,
    not paragraph.isPublished() ? 'paragraph--unpublished'
  ]
%}
{% block paragraph %}
  
    {% block content %}
{% if counter ==\"0\"  %}
\t{% if content.field_question_welk %}  
\t\t<div class=\"card\">
\t\t\t\t<div class=\"card-header\">
\t\t\t\t\t<h5 class=\"mb-0\">
\t\t\t\t\t<button class=\"btn btn-link collapsed\" data-toggle=\"collapse\"
\t\t\t\t\t\t\tdata-target=\"#collapse{{ counter }}\">
\t\t\t\t\t\t\t{{ content.field_question_welk }}
\t\t\t\t\t</button>
\t\t\t\t\t</h5>
\t\t\t\t</div>

\t\t\t\t<div id=\"collapse{{ counter }}\" class=\"collapse\" data-parent=\"#accordion\">
\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t{{ content.field_answer_welk }}
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t</div>
\t{% endif %}
{% else %}
\t{% if content.field_question_welk %}
\t\t<div class=\"card\">
\t\t\t<div class=\"card-header\">
\t\t\t\t<h5 class=\"mb-0\">
\t\t\t\t<button class=\"btn btn-link collapsed\" data-toggle=\"collapse\"
\t\t\t\t\t\tdata-target=\"#collapse{{ counter }}\">
\t\t\t\t\t\t{{ content.field_question_welk }}
\t\t\t\t</button>
\t\t\t\t</h5>
\t\t\t</div>
\t\t\t<div id=\"collapse{{ counter }}\" class=\"collapse\" data-parent=\"#accordion\">
\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t{{ content.field_answer_welk }}
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t{% endif %}
{% endif %}
    {% endblock %}
 
{% endblock paragraph %}
", "themes/custom/welkresorts/templates/paragraphs/paragraph--welk-experience.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/paragraphs/paragraph--welk-experience.html.twig");
    }
}
