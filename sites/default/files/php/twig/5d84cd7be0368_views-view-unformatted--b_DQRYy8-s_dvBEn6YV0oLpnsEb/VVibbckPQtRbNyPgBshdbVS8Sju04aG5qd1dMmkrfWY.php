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

/* themes/custom/welkresorts/templates/views/views-view-unformatted--blog-detail-page-posts.html.twig */
class __TwigTemplate_503c3c224efeb26ca85c1c2ae1d9c75b8fcb4db11ee247cb91d10a62fd112959 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 29, "set" => 36];
        $filters = ["escape" => 32, "striptags" => 36];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'set'],
                ['escape', 'striptags'],
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
        // line 21
        echo "
<div class=\"posts-components\">
    <div class=\"container\">
        <div class=\"col text-center\">
            <div class=\"small-text\">Lorem ipsum</div>
            <h2>Polular Posts</h2>
        </div>
        <div class=\"row\">
            ";
        // line 29
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
            // line 30
            echo "                <div class=\"col-12 col-lg-4\">
                    <div class=\"card\">
                        <img class=\"card-img-top\">";
            // line 32
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ field_image }}", [], "array")), "html", null, true);
            echo "
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">";
            // line 34
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ field_category }}", [], "array")), "html", null, true);
            echo "</h4>
                            <p class=\"card-text\">";
            // line 35
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ title }}", [], "array")), "html", null, true);
            echo "</p>
                            ";
            // line 36
            $context["blog_link"] = strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["row"], "content", []), "#view", [], "array"), "style_plugin", []), "render_tokens", []), $this->getAttribute($context["loop"], "index0", []), [], "array"), "{{ view_node }}", [], "array")));
            // line 37
            echo "                            <a href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["blog_link"] ?? null)), "html", null, true);
            echo "\" class=\"style-arrow\">Read More</a>
                        </div>
                    </div>
                </div>
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "        </div>
    </div>
</div>
<a href=\"";
        // line 45
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo "\" class=\"btn btn-primary large\">View all Posts</a>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/views/views-view-unformatted--blog-detail-page-posts.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 45,  121 => 42,  101 => 37,  99 => 36,  95 => 35,  91 => 34,  86 => 32,  82 => 30,  65 => 29,  55 => 21,);
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

<div class=\"posts-components\">
    <div class=\"container\">
        <div class=\"col text-center\">
            <div class=\"small-text\">Lorem ipsum</div>
            <h2>Polular Posts</h2>
        </div>
        <div class=\"row\">
            {% for row in rows %}
                <div class=\"col-12 col-lg-4\">
                    <div class=\"card\">
                        <img class=\"card-img-top\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ field_image }}'] }}
                        <div class=\"card-body\">
                            <h4 class=\"card-title\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ field_category }}'] }}</h4>
                            <p class=\"card-text\">{{ row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ title }}'] }}</p>
                            {% set blog_link = row.content['#view'].style_plugin.render_tokens[ loop.index0 ]['{{ view_node }}']|striptags %}
                            <a href=\"{{ blog_link }}\" class=\"style-arrow\">Read More</a>
                        </div>
                    </div>
                </div>
            {% endfor %}
        </div>
    </div>
</div>
<a href=\"{{ base_path }}\" class=\"btn btn-primary large\">View all Posts</a>
", "themes/custom/welkresorts/templates/views/views-view-unformatted--blog-detail-page-posts.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/views/views-view-unformatted--blog-detail-page-posts.html.twig");
    }
}
