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

/* themes/custom/welkresorts/templates/we-megamenu/we-megamenu-li.html.twig */
class __TwigTemplate_2cabea5980ffc69a2002d96ea14c2e6008fbea272aa20743cad1640f5fa8a0be extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 2];
        $filters = ["escape" => 1, "trim" => 6];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'trim'],
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
        // line 1
        echo "<li ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        echo ">
  ";
        // line 2
        if (twig_test_empty(($context["href"] ?? null))) {
            // line 3
            echo "    <span data-drupal-link-system-path=\"<front>\" class=\"we-megamenu-nolink\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            echo "</span>
  ";
        } else {
            // line 5
            echo "    <a class=\"we-mega-menu-li\" title=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "description")), "html", null, true);
            echo "\" href=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["href"] ?? null)), "html", null, true);
            echo "\" target=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "data-target")), "html", null, true);
            echo "\">
      ";
            // line 6
            if (($this->getAttribute(($context["attributes"] ?? null), "data-icon", [], "any", true, true) && twig_trim_filter($this->getAttribute(($context["attributes"] ?? null), "data-icon")))) {
                // line 7
                echo "        <i class=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "data-icon")), "html", null, true);
                echo "\"></i>
      ";
            }
            // line 9
            echo "
      ";
            // line 10
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null)), "html", null, true);
            echo "

      ";
            // line 12
            if (($this->getAttribute(($context["attributes"] ?? null), "data-caption", [], "any", true, true) && twig_trim_filter($this->getAttribute(($context["attributes"] ?? null), "data-caption")))) {
                // line 13
                echo "        <span class=\"we-mega-menu-caption\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "data-caption")), "html", null, true);
                echo "</span>
      ";
            }
            // line 15
            echo "    </a>
  ";
        }
        // line 17
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true);
        echo "
</li>";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/we-megamenu/we-megamenu-li.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 17,  101 => 15,  95 => 13,  93 => 12,  88 => 10,  85 => 9,  79 => 7,  77 => 6,  68 => 5,  62 => 3,  60 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<li {{ attributes }}>
  {% if href is empty %}
    <span data-drupal-link-system-path=\"<front>\" class=\"we-megamenu-nolink\">{{ title }}</span>
  {% else %}
    <a class=\"we-mega-menu-li\" title=\"{{ attribute(attributes, 'description') }}\" href=\"{{ href }}\" target=\"{{ attribute(attributes, 'data-target') }}\">
      {% if (attribute(attributes, 'data-icon') is defined and attribute(attributes, 'data-icon')|trim) %}
        <i class=\"{{ attribute(attributes, 'data-icon') }}\"></i>
      {% endif %}

      {{ title }}

      {% if (attribute(attributes, 'data-caption') is defined and attribute(attributes, 'data-caption')|trim) %}
        <span class=\"we-mega-menu-caption\">{{ attribute(attributes, 'data-caption') }}</span>
      {% endif %}
    </a>
  {% endif %}
  {{ content }}
</li>", "themes/custom/welkresorts/templates/we-megamenu/we-megamenu-li.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/we-megamenu/we-megamenu-li.html.twig");
    }
}
