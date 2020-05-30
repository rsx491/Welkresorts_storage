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

/* themes/custom/welkresorts/templates/views/views-view-unformatted--blog.html.twig */
class __TwigTemplate_46c9db2929f4663981326c0b110b70e60878745030bc2939d32b3674a1e053a4 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 40, "if" => 42, "set" => 48];
        $filters = ["escape" => 49, "striptags" => 56];
        $functions = ["file_url" => 48];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if', 'set'],
                ['escape', 'striptags'],
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
        // line 38
        echo "

";
        // line 40
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
        foreach ($context['_seq'] as $context["key"] => $context["row"]) {
            // line 41
            echo "
";
            // line 42
            if (($context["key"] == 0)) {
                // line 43
                echo "\t <!-- Rommantic Componenht Section -->
            <div class=\"rommantic-section\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            ";
                // line 48
                $context["photo"] = call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", [], "array"), "#row", [], "array"), "_entity", []), "field_image", []), "entity", []), "fileuri", []))]);
                echo "          
           <img src=";
                // line 49
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["photo"] ?? null)), "html", null, true);
                echo ">
\t\t   </div>
\t\t   <div class=\"col-lg-6\">
                            <div class=\"content-wrapper\">
\t\t\t\t\t\t\t<h5 class=\"alt\">";
                // line 53
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ field_category }}", [], "array")), "html", null, true);
                echo "</h5>
\t\t\t\t\t\t\t<h2>";
                // line 54
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ title }}", [], "array")), "html", null, true);
                echo "</h2>
\t\t\t\t\t\t\t<p>";
                // line 55
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ body }}", [], "array")), "html", null, true);
                echo "</p>
\t\t\t\t\t\t\t ";
                // line 56
                $context["blog_link"] = strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ view_node }}", [], "array")));
                // line 57
                echo "\t\t\t\t\t\t\t <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["blog_link"] ?? null)), "html", null, true);
                echo "\" class=\"style-arrow\">Read More</a>
\t\t\t\t\t\t\t</div>
\t\t   </div>
\t\t  </div>\t
\t\t  </div>
\t<div class=\"posts-components\">
    <div class=\"container\">
\t <div class=\"row\">
";
            } else {
                // line 66
                echo "<div class=\"col-12 col-lg-4\">
                        <div class=\"card test\">    
                <img class=\"card-img-top\">";
                // line 68
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ field_image }}", [], "array")), "html", null, true);
                echo "
                                   \t\t\t <div class=\"card-body\">
\t\t\t<h4 class=\"card-title\">";
                // line 70
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ field_category }}", [], "array")), "html", null, true);
                echo "</h4>
\t\t\t<p class=\"card-text\">";
                // line 71
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ title }}", [], "array")), "html", null, true);
                echo "</p>
\t\t\t";
                // line 72
                $context["blog_link"] = strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ view_node }}", [], "array")));
                // line 73
                echo "\t\t\t\t\t\t\t <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["blog_link"] ?? null)), "html", null, true);
                echo "\" class=\"style-arrow\">Read More</a>
            </div>                            
                </div>
            </div>
";
            }
            // line 77
            echo "\t
";
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
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "        </div>\t\t\t
    </div>
\t</div>
<a href=\"";
        // line 82
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo "\" class=\"btn btn-primary large\">View all Posts</a>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/views/views-view-unformatted--blog.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 82,  169 => 79,  154 => 77,  145 => 73,  143 => 72,  139 => 71,  135 => 70,  130 => 68,  126 => 66,  113 => 57,  111 => 56,  107 => 55,  103 => 54,  99 => 53,  92 => 49,  88 => 48,  81 => 43,  79 => 42,  76 => 41,  59 => 40,  55 => 38,);
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
 * Theme override to display a view of unformatted rows.
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
 */
#}
{#
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


{% for key, row in rows %}

{% if (key == 0) %}
\t <!-- Rommantic Componenht Section -->
            <div class=\"rommantic-section\">
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            {% set photo = file_url(row['content']['#row']._entity.field_image.entity.fileuri) %}          
           <img src={{ photo }}>
\t\t   </div>
\t\t   <div class=\"col-lg-6\">
                            <div class=\"content-wrapper\">
\t\t\t\t\t\t\t<h5 class=\"alt\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ field_category }}'] }}</h5>
\t\t\t\t\t\t\t<h2>{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ title }}'] }}</h2>
\t\t\t\t\t\t\t<p>{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ body }}'] }}</p>
\t\t\t\t\t\t\t {% set blog_link = row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ view_node }}']|striptags %}
\t\t\t\t\t\t\t <a href=\"{{ blog_link }}\" class=\"style-arrow\">Read More</a>
\t\t\t\t\t\t\t</div>
\t\t   </div>
\t\t  </div>\t
\t\t  </div>
\t<div class=\"posts-components\">
    <div class=\"container\">
\t <div class=\"row\">
{% else %}
<div class=\"col-12 col-lg-4\">
                        <div class=\"card test\">    
                <img class=\"card-img-top\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ field_image }}'] }}
                                   \t\t\t <div class=\"card-body\">
\t\t\t<h4 class=\"card-title\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ field_category }}'] }}</h4>
\t\t\t<p class=\"card-text\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ title }}'] }}</p>
\t\t\t{% set blog_link = row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ view_node }}']|striptags %}
\t\t\t\t\t\t\t <a href=\"{{ blog_link }}\" class=\"style-arrow\">Read More</a>
            </div>                            
                </div>
            </div>
{% endif %}\t
{% endfor %}
        </div>\t\t\t
    </div>
\t</div>
<a href=\"{{ base_path }}\" class=\"btn btn-primary large\">View all Posts</a>
", "themes/custom/welkresorts/templates/views/views-view-unformatted--blog.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/views/views-view-unformatted--blog.html.twig");
    }
}
