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

/* modules/contrib/videobackground_banner_block/templates/paragraph--videobackground-banner-block.html.twig */
class __TwigTemplate_00daefe99d37f0c0e63ac76f0152c1143cb387b7f0d6f58811a6cd6a1a71ccbb extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'paragraph' => [$this, 'block_paragraph'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["block" => 41, "if" => 43];
        $filters = ["escape" => 42];
        $functions = ["attach_library" => 42];

        try {
            $this->sandbox->checkSecurity(
                ['block', 'if'],
                ['escape'],
                ['attach_library']
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
        // line 41
        $this->displayBlock('paragraph', $context, $blocks);
        // line 63
        echo "
      ";
    }

    // line 41
    public function block_paragraph($context, array $blocks = [])
    {
        // line 42
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("videobackground_banner_block/videobackground_banner_block.assests"), "html", null, true);
        echo "
";
        // line 43
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_vid", []), 0, [], "array")) {
            // line 44
            echo "<div class=\"video-banner-wrapper\">
<video id=\"bgvid\" playsinline autoplay muted loop>
<source src=\"";
            // line 46
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_vid", []), 0, [])), "html", null, true);
            echo "\">
</video>
";
        }
        // line 49
        echo "<div id=\"polina\">
\t<div class=\"content-wrapper\">
";
        // line 51
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_tit", []), 0, [], "array")) {
            // line 52
            echo "<h1>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_tit", []), 0, [])), "html", null, true);
            echo "</h1>
";
        }
        // line 54
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_con", []), 0, [], "array")) {
            // line 55
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_con", []), 0, [])), "html", null, true);
            echo "
";
        }
        // line 57
        echo "<button>Pause</button>
</div>
</div>
</div>
";
        // line 61
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("videobackground_banner_block/videobackground_banner_block.assests_footer"), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/videobackground_banner_block/templates/paragraph--videobackground-banner-block.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  107 => 61,  101 => 57,  96 => 55,  94 => 54,  88 => 52,  86 => 51,  82 => 49,  76 => 46,  72 => 44,  70 => 43,  66 => 42,  63 => 41,  58 => 63,  56 => 41,);
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
{% block paragraph %}
{{ attach_library('videobackground_banner_block/videobackground_banner_block.assests') }}
{% if content.field_videobackground_banner_vid[0] %}
<div class=\"video-banner-wrapper\">
<video id=\"bgvid\" playsinline autoplay muted loop>
<source src=\"{{ content.field_videobackground_banner_vid.0 }}\">
</video>
{% endif %}
<div id=\"polina\">
\t<div class=\"content-wrapper\">
{% if content.field_videobackground_banner_tit[0] %}
<h1>{{ content.field_videobackground_banner_tit.0 }}</h1>
{% endif %}
{% if content.field_videobackground_banner_con[0] %}
{{ content.field_videobackground_banner_con.0 }}
{% endif %}
<button>Pause</button>
</div>
</div>
</div>
{{ attach_library('videobackground_banner_block/videobackground_banner_block.assests_footer') }}
{% endblock paragraph %}

      ", "modules/contrib/videobackground_banner_block/templates/paragraph--videobackground-banner-block.html.twig", "/var/www/html/development/Welkresorts/modules/contrib/videobackground_banner_block/templates/paragraph--videobackground-banner-block.html.twig");
    }
}
