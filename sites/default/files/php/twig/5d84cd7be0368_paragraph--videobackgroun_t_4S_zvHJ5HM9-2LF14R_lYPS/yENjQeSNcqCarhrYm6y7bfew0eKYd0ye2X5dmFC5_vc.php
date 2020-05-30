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

/* themes/custom/welkresorts/templates/paragraphs/paragraph--videobackground-banner-block.html.twig */
class __TwigTemplate_d0ca6c7f36d8753bc2781a671fc1286ac141a3d3eb51d17abeafa61c4e7ff192 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'paragraph' => [$this, 'block_paragraph'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["block" => 43, "if" => 46, "for" => 54];
        $filters = ["escape" => 44];
        $functions = ["attach_library" => 44, "file_url" => 48];

        try {
            $this->sandbox->checkSecurity(
                ['block', 'if', 'for'],
                ['escape'],
                ['attach_library', 'file_url']
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
        echo "

";
        // line 43
        $this->displayBlock('paragraph', $context, $blocks);
    }

    public function block_paragraph($context, array $blocks = [])
    {
        // line 44
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("videobackground_banner_block/videobackground_banner_block.assests"), "html", null, true);
        echo "
<div class=\"video-banner-wrapper\">
    ";
        // line 46
        if ( !twig_test_empty($this->getAttribute(($context["paragraph"] ?? null), "field_videobackground_banner_vid", []))) {
            // line 47
            echo "    <video autoplay id=\"bgvid\" loop muted playsinline>
        <source src=\"";
            // line 48
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_videobackground_banner_vid", []), "entity", []), "uri", []), "value", []))]), "html", null, true);
            echo "\" type=\"video/mp4\">
    </video>
    ";
        }
        // line 51
        echo "    <div id=\"heroBanner\" class=\"carousel slide\" data-ride=\"carousel\">
        <div class=\"carousel-inner\">
            ";
        // line 53
        if ( !twig_test_empty($this->getAttribute(($context["paragraph"] ?? null), "field_banner_image", []))) {
            // line 54
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["paragraph"] ?? null), "field_banner_image", []));
            foreach ($context['_seq'] as $context["_key"] => $context["singleimage"]) {
                // line 55
                echo "            <div class=\"carousel-item\">
                <img src=\"";
                // line 56
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["singleimage"], "entity", []), "fileuri", []))]), "html", null, true);
                echo "\" />
                <div class=\"container position-relative\">
                    <div class=\"caption\">";
                // line 58
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["singleimage"], "title", [])), "html", null, true);
                echo "</div>
                </div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['singleimage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            echo "            ";
        } else {
            // line 63
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_banner_image", []), 0, [])), "html", null, true);
            echo "
            ";
            // line 64
            if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_caption", []), 0, [], "array")) {
                // line 65
                echo "            <div class=\"container position-relative\">
                <div class=\"caption\">";
                // line 66
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_caption", []), 0, [])), "html", null, true);
                echo "</div>
            </div>
            ";
            }
            // line 69
            echo "            ";
        }
        // line 70
        echo "        </div>
    </div>
</div>
<div class=\"container position-relative\">
    <div class=\"home-banner-text\">
        ";
        // line 75
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_tit", []), 0, [], "array")) {
            // line 76
            echo "
        <div class=\"create-your-own-adv\">";
            // line 77
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_tit", []), 0, [])), "html", null, true);
            echo "</div>
        ";
        }
        // line 79
        echo "        ";
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_con", []), 0, [], "array")) {
            // line 80
            echo "
        <div class=\"with-luxury-hotels-l\">";
            // line 81
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_con", []), 0, [])), "html", null, true);
            echo "</div>
        ";
        }
        // line 83
        echo "
        <div class=\"view-location text-center\">
            ";
        // line 85
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_view_location", []), 0, [], "array")) {
            // line 86
            echo "            <a class=\"btn btn-secondary-01 large\"
                href='#block-resortdestinations'>";
            // line 87
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_view_location", []), 0, [])), "html", null, true);
            echo "</a>
            ";
        }
        // line 89
        echo "        </div>
    </div>
    <div class=\"video-btn-wrapper\">
        ";
        // line 92
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_vid", []), 0, [], "array")) {
            // line 93
            echo "        <div class=\"col btn pauseplay\">
            <button></button>
        </div>
        ";
        }
        // line 97
        echo "        ";
        if ($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_videobackground_banner_vid", []), 0, [], "array")) {
            // line 98
            echo "        ";
            if (($this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_sound", []), "value", []) == true)) {
                // line 99
                echo "        <div class=\"col btn\">
            <button id='sound' onclick=\"makeSound()\"></button>
        </div>
        ";
            }
            // line 103
            echo "        ";
        }
        // line 104
        echo "    </div>
</div>
";
        // line 106
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("welkbgbanner/welkbgbanner.assests_footer"), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/paragraphs/paragraph--videobackground-banner-block.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  207 => 106,  203 => 104,  200 => 103,  194 => 99,  191 => 98,  188 => 97,  182 => 93,  180 => 92,  175 => 89,  170 => 87,  167 => 86,  165 => 85,  161 => 83,  156 => 81,  153 => 80,  150 => 79,  145 => 77,  142 => 76,  140 => 75,  133 => 70,  130 => 69,  124 => 66,  121 => 65,  119 => 64,  114 => 63,  111 => 62,  101 => 58,  96 => 56,  93 => 55,  88 => 54,  86 => 53,  82 => 51,  76 => 48,  73 => 47,  71 => 46,  66 => 44,  60 => 43,  56 => 41,);
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
<div class=\"video-banner-wrapper\">
    {% if paragraph.field_videobackground_banner_vid is not empty %}
    <video autoplay id=\"bgvid\" loop muted playsinline>
        <source src=\"{{ file_url(paragraph.field_videobackground_banner_vid.entity.uri.value) }}\" type=\"video/mp4\">
    </video>
    {% endif %}
    <div id=\"heroBanner\" class=\"carousel slide\" data-ride=\"carousel\">
        <div class=\"carousel-inner\">
            {% if paragraph.field_banner_image is not empty %}
            {% for singleimage in paragraph.field_banner_image %}
            <div class=\"carousel-item\">
                <img src=\"{{ file_url(singleimage.entity.fileuri) }}\" />
                <div class=\"container position-relative\">
                    <div class=\"caption\">{{ singleimage.title }}</div>
                </div>
            </div>
            {% endfor %}
            {% else %}
            {{ content.field_banner_image.0 }}
            {% if content.field_caption[0] %}
            <div class=\"container position-relative\">
                <div class=\"caption\">{{ content.field_caption.0 }}</div>
            </div>
            {% endif %}
            {% endif %}
        </div>
    </div>
</div>
<div class=\"container position-relative\">
    <div class=\"home-banner-text\">
        {% if content.field_videobackground_banner_tit[0] %}

        <div class=\"create-your-own-adv\">{{ content.field_videobackground_banner_tit.0 }}</div>
        {% endif %}
        {% if content.field_videobackground_banner_con[0] %}

        <div class=\"with-luxury-hotels-l\">{{ content.field_videobackground_banner_con.0 }}</div>
        {% endif %}

        <div class=\"view-location text-center\">
            {% if content.field_view_location[0] %}
            <a class=\"btn btn-secondary-01 large\"
                href='#block-resortdestinations'>{{ content.field_view_location.0 }}</a>
            {% endif %}
        </div>
    </div>
    <div class=\"video-btn-wrapper\">
        {% if content.field_videobackground_banner_vid[0] %}
        <div class=\"col btn pauseplay\">
            <button></button>
        </div>
        {% endif %}
        {% if content.field_videobackground_banner_vid[0] %}
        {% if paragraph.field_sound.value == true %}
        <div class=\"col btn\">
            <button id='sound' onclick=\"makeSound()\"></button>
        </div>
        {% endif %}
        {% endif %}
    </div>
</div>
{{ attach_library('welkbgbanner/welkbgbanner.assests_footer') }}
{% endblock paragraph %}", "themes/custom/welkresorts/templates/paragraphs/paragraph--videobackground-banner-block.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/paragraphs/paragraph--videobackground-banner-block.html.twig");
    }
}
