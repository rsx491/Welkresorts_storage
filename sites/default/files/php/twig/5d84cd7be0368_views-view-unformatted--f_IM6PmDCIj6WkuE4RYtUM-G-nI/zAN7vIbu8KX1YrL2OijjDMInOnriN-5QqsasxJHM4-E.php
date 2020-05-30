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

/* themes/custom/welkresorts/templates/views/views-view-unformatted--front_blog_block.html.twig */
class __TwigTemplate_032ad72f0f17042be834c035fe3061e5585011513102a4000fb7dc7f1d584c7a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 21, "for" => 25, "set" => 26];
        $filters = ["escape" => 22, "t" => 46];
        $functions = ["file_url" => 26, "url" => 46];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for', 'set'],
                ['escape', 't'],
                ['file_url', 'url']
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
        if (($context["title"] ?? null)) {
            // line 22
            echo "<h3>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            echo "</h3>
";
        }
        // line 24
        echo "<div id=\"blogCarousel\" class=\"owl-carousel owl-theme\">
\t";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
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
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 26
            echo "\t";
            $context["photo"] = call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", [], "array"), "#row", [], "array"), "_entity", []), "field_image", []), "entity", []), "fileuri", []))]);
            // line 27
            echo "\t<div class=\"box-wrapper\">
\t\t<!--<img class=\"img-fluid\" src=\"";
            // line 28
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
            echo "/src/images/destination-branson-1.jpg\" alt=\"Card image cap\"> -->
\t\t";
            // line 29
            if (($context["photo"] ?? null)) {
                // line 30
                echo "\t\t<img class=\"img-fluid\" src=";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["photo"] ?? null)), "html", null, true);
                echo " alt=\"Card image cap\">
\t\t";
            }
            // line 32
            echo "\t\t<div class=\"box-body\">
\t\t\t";
            // line 33
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#row", [], "array"), "_entity", []), "field_category", []), 0, [], "array"), "value", [])) {
                // line 34
                echo "\t\t\t<h5 class=\"box-title\">
\t\t\t\t";
                // line 35
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ field_category }}", [], "array")), "html", null, true);
                echo "</h5>
\t\t\t";
            }
            // line 37
            echo "\t\t\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#row", [], "array"), "_entity", []), "title", []), 0, [], "array"), "value", [])) {
                // line 38
                echo "\t\t\t<h4>";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ title }}", [], "array")), "html", null, true);
                echo "</h4>
\t\t\t";
            }
            // line 40
            echo "\t\t\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#row", [], "array"), "_entity", []), "body", []), 0, [], "array"), "value", [])) {
                // line 41
                echo "\t\t\t<div class=\"box-text\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ body }}", [], "array")), "html", null, true);
                echo "
\t\t\t</div>
\t\t\t";
            }
            // line 44
            echo "\t\t\t";
            if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#row", [], "array"), "_entity", []), "title", []), 0, [], "array"), "value", [])) {
                // line 45
                echo "\t\t\t";
                $context["nodeid"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#row", [], "array"), "_entity", []), "nid", []), 0, [], "array"), "value", []);
                // line 46
                echo "\t\t\t<a class=\"style-arrow\" href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getUrl("entity.node.canonical", ["node" => ($context["nodeid"] ?? null)]), "html", null, true);
                echo "\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("READ MORE"));
                echo "</a>
\t\t\t";
            }
            // line 48
            echo "\t\t</div>
\t</div>
\t";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/views/views-view-unformatted--front_blog_block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 51,  147 => 48,  139 => 46,  136 => 45,  133 => 44,  126 => 41,  123 => 40,  117 => 38,  114 => 37,  109 => 35,  106 => 34,  104 => 33,  101 => 32,  95 => 30,  93 => 29,  89 => 28,  86 => 27,  83 => 26,  66 => 25,  63 => 24,  57 => 22,  55 => 21,);
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
 * Default theme implementation to display a view of unformatted rows.
 *
 * Available variables:
 * - title: The title of this group of rows. May be empty.
 * - rows: A list of the view's row items.
 *   - attributes: The row's HTML attributes.
 *   - content: The row's content.
 * - view: The view object.
 * - default_row_class: A flag indicating whether default classes should be
 *   used on rows.
 *
 * @see template_preprocess_views_view_unformatted()
 *
 * @ingroup themeable
 */

#}
{% if title %}
<h3>{{ title }}</h3>
{% endif %}
<div id=\"blogCarousel\" class=\"owl-carousel owl-theme\">
\t{% for row in rows %}
\t{% set photo = file_url(row['content']['#row']._entity.field_image.entity.fileuri) %}
\t<div class=\"box-wrapper\">
\t\t<!--<img class=\"img-fluid\" src=\"{{ theme_path }}/src/images/destination-branson-1.jpg\" alt=\"Card image cap\"> -->
\t\t{% if photo %}
\t\t<img class=\"img-fluid\" src={{ photo }} alt=\"Card image cap\">
\t\t{% endif %}
\t\t<div class=\"box-body\">
\t\t\t{% if row.content['#row']._entity.field_category[0].value %}
\t\t\t<h5 class=\"box-title\">
\t\t\t\t{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ field_category }}'] }}</h5>
\t\t\t{% endif %}
\t\t\t{% if row.content['#row']._entity.title[0].value %}
\t\t\t<h4>{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ title }}'] }}</h4>
\t\t\t{% endif %}
\t\t\t{% if row.content['#row']._entity.body[0].value %}
\t\t\t<div class=\"box-text\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ body }}'] }}
\t\t\t</div>
\t\t\t{% endif %}
\t\t\t{% if row.content['#row']._entity.title[0].value %}
\t\t\t{% set nodeid = row.content['#row']._entity.nid[0].value %}
\t\t\t<a class=\"style-arrow\" href=\"{{ url('entity.node.canonical', {'node': nodeid}) }}\">{{ 'READ MORE'|t }}</a>
\t\t\t{% endif %}
\t\t</div>
\t</div>
\t{% endfor %}
</div>", "themes/custom/welkresorts/templates/views/views-view-unformatted--front_blog_block.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/views/views-view-unformatted--front_blog_block.html.twig");
    }
}
