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

/* themes/custom/welkresorts/templates/webforms/webform--booking-form.html.twig */
class __TwigTemplate_7dcfcd2d7f9d4246fe43a6d7a6882bec264ff002b24ee7b6165309bfa174d065 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 24];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
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
        // line 24
        echo "<form";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        echo ">
    ";
        // line 25
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "form_token", [])), "html", null, true);
        echo "
    ";
        // line 26
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "form_build_id", [])), "html", null, true);
        echo "
    ";
        // line 27
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "form_id", [])), "html", null, true);
        echo "
    <div class=\"row\">
        ";
        // line 29
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "destinations", [])), "html", null, true);
        echo "
        <div class=\"col-xl-4 col-lg-4 col-12 destination\">
            <div class=\"title\">Destination</div>
            <div class=\"select-side\">
                <i class=\"arrow-down\"></i>
            </div>
            ";
        // line 35
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "resort_destinations", [])), "html", null, true);
        echo "
        </div>
        ";
        // line 37
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "dropdown_destinations", [])), "html", null, true);
        echo "
        <div class=\"col-xl-4 col-lg-4 col-12 check-in-out\">
            <div class=\"title\">Check In / Check Out</div>
            <div class=\"select-side\">
                <i class=\"arrow-down\"></i>
            </div>
            ";
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "check_in_check_out", [])), "html", null, true);
        echo "            
        </div>
        <div class=\"col-xl-4 col-lg-4 col-12 rooms-booking\">
            <div class=\"title\">Rooms & Guests</div>
            <div class=\"select-side\">
                <i class=\"arrow-down\"></i>
            </div>
            ";
        // line 50
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "rooms_guests", [])), "html", null, true);
        echo "
        </div>
        ";
        // line 52
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "rooms_guests_dropdown", [])), "html", null, true);
        echo "
        ";
        // line 53
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "rooms", [])), "html", null, true);
        echo "
        ";
        // line 54
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "guests", [])), "html", null, true);
        echo "
    </div>  
    <div class=\"d-flex justify-content-between\">
        <a class=\"best-rates\" href=\"#\" data-toggle=\"modal\" data-target=\"#bestRatesModal\">
            Best Rate Guaranteed           
        </a>
        <i class=\"info\"></i>
        ";
        // line 61
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "form_token", [])), "html", null, true);
        echo "
\t\t";
        // line 62
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "form_build_id", [])), "html", null, true);
        echo "
\t\t";
        // line 63
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "form_id", [])), "html", null, true);
        echo "
        ";
        // line 64
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "elements", []), "actions", [])), "html", null, true);
        echo " 
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/webforms/webform--booking-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 64,  137 => 63,  133 => 62,  129 => 61,  119 => 54,  115 => 53,  111 => 52,  106 => 50,  96 => 43,  87 => 37,  82 => 35,  73 => 29,  68 => 27,  64 => 26,  60 => 25,  55 => 24,);
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
 * Theme implementation for a 'webform' element.
 *
 * This is an copy of the webform.html.twig theme_wrapper which includes the
 * 'title_prefix' and 'title_suffix' variables needed for
 * contextual links to appear.
 *
 * Available variables
 * - attributes: A list of HTML attributes for the wrapper element.
 * - children: The child elements of the webform.
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the main title tag that appears in the template.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the main title tag that appears in the template.
 *
 * @see template_preprocess_webform()
 * @see _webform_form_after_build()
 *
 * @ingroup themeable
 */
#}
<form{{ attributes }}>
    {{ element.elements.form_token }}
    {{ element.elements.form_build_id }}
    {{ element.elements.form_id }}
    <div class=\"row\">
        {{element.elements.destinations}}
        <div class=\"col-xl-4 col-lg-4 col-12 destination\">
            <div class=\"title\">Destination</div>
            <div class=\"select-side\">
                <i class=\"arrow-down\"></i>
            </div>
            {{element.elements.resort_destinations}}
        </div>
        {{element.elements.dropdown_destinations}}
        <div class=\"col-xl-4 col-lg-4 col-12 check-in-out\">
            <div class=\"title\">Check In / Check Out</div>
            <div class=\"select-side\">
                <i class=\"arrow-down\"></i>
            </div>
            {{ element.elements.check_in_check_out }}            
        </div>
        <div class=\"col-xl-4 col-lg-4 col-12 rooms-booking\">
            <div class=\"title\">Rooms & Guests</div>
            <div class=\"select-side\">
                <i class=\"arrow-down\"></i>
            </div>
            {{element.elements.rooms_guests}}
        </div>
        {{element.elements.rooms_guests_dropdown}}
        {{element.elements.rooms}}
        {{element.elements.guests}}
    </div>  
    <div class=\"d-flex justify-content-between\">
        <a class=\"best-rates\" href=\"#\" data-toggle=\"modal\" data-target=\"#bestRatesModal\">
            Best Rate Guaranteed           
        </a>
        <i class=\"info\"></i>
        {{ element.form_token }}
\t\t{{ element.form_build_id }}
\t\t{{ element.form_id }}
        {{element.elements.actions}} 
    </div>
</form>
", "themes/custom/welkresorts/templates/webforms/webform--booking-form.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/webforms/webform--booking-form.html.twig");
    }
}
