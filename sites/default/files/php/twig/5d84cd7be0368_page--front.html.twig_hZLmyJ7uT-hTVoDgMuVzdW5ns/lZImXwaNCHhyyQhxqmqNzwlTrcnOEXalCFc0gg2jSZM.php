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

/* themes/custom/welkresorts/templates/pages/page--front.html.twig */
class __TwigTemplate_2742e4bf83f60292a8fc747acb0cac9bf87084604aaf936dd8f321fdf2395628 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 70];
        $filters = ["escape" => 59];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
        // line 54
        echo "
<head>
    <title>Welk Resorts</title>
    <meta charset=\"utf-8\">
    <meta content=\"width=device-width, initial-scale=1, shrink-to-fit=no\" name=\"viewport\">
    <link rel=\"stylesheet\" href=\"";
        // line 59
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/bootstrap.min.css\"/>
    <link rel=\"stylesheet\" href=\"";
        // line 60
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/owl.carousel.min.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 61
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/owl.theme.default.min.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 62
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/daterangepicker.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 63
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/main.css\"/>
</head>

<body>
    <div class=\"main-wrapper\">
        <header>
            <div class=\"container-fluid nopadding\">
                ";
        // line 70
        if ($this->getAttribute(($context["page"] ?? null), "banner", [])) {
            // line 71
            echo "                    <div class=\"banner-video-block\">
                        ";
            // line 72
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "banner", [])), "html", null, true);
            echo "
                    </div>
                ";
        }
        // line 75
        echo "                <div class=\"top-nav-wrapper\">
                    <a class=\"btn btn-primary large book-now mobile d-block d-lg-none\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#booking-slots\" title=\"Book Now\">Book
                                                                                                                                                                                                                        Now</a>
                    <nav class=\"navbar navbar-expand-lg navbar-light\">
                        <button class=\"navbar-toggler\" data-target=\"#navBarMenu\" data-toggle=\"collapse\">
                            <span class=\"navbar-toggler-icon\"></span>
                            <span class=\"close-btn hidden\"></span>Menu
                        </button>
                        <a href=\"";
        // line 83
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo "\" class=\"navbar-brand\"></a>
                        <a class=\"sign-in d-block d-lg-none\" href=\"#\">Sign In</a>
                        <div class=\"collapse navbar-collapse\" id=\"navBarMenu\">
                            <div class=\"container\">
                                <div class='row'>
                                    ";
        // line 88
        if ($this->getAttribute(($context["page"] ?? null), "Primary_menu", [])) {
            // line 89
            echo "                                        <div class=\"col-12 col-xl-12 col-lg-12  col-md-12 nopadding\">
                                            ";
            // line 90
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Primary_menu", [])), "html", null, true);
            echo "
                                        </div>
                                    ";
        }
        // line 93
        echo "                                    <div class=\"menu secondary d-block d-lg-none\">
                                        ";
        // line 94
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 95
            echo "                                            <div class=\"contact-number\">
                                                <div class=\"phone\">";
            // line 96
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])), "html", null, true);
            echo "</div>
                                                <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                                            </div>
                                        ";
        }
        // line 100
        echo "                                        ";
        if ($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])) {
            // line 101
            echo "                                            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])), "html", null, true);
            echo "
                                        ";
        }
        // line 103
        echo "                                        <a class=\"btn btn-primary medium book-now d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book
                                                                                                                                                                                                                                                                                                                                                                                                            Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <div class=\"menu secondary d-none d-lg-block\">
                        ";
        // line 112
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 113
            echo "                            <div class=\"contact-number\">
                                <div class=\"phone\">";
            // line 114
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])), "html", null, true);
            echo "</div>
                                <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                            </div>
                        ";
        }
        // line 118
        echo "                        ";
        if ($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])) {
            // line 119
            echo "                            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])), "html", null, true);
            echo "
                        ";
        }
        // line 121
        echo "                        <a class=\"btn btn-primary book-now d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                        </a>
                    </div>
                    <a class=\"btn btn-primary book-now-sticky d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                    </a>
                </div>
            </div>
        </header>
        <div class=\"content-wrapper clearfix\">
            <div class=\"booking-slots\">
                ";
        // line 131
        if ($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])) {
            // line 132
            echo "                    <div class=\"container\">
                        ";
            // line 133
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])), "html", null, true);
            echo "
                    </div>
                ";
        }
        // line 136
        echo "                <div class=\"modal\" id=\"bestRatesModal\">
                    <div class=\"modal-dialog\">
                        <div
                            class=\"modal-content\">
                            <!-- Modal Header -->
                            <div class=\"modal-header\">
                                <h4 class=\"modal-title\">Best Rates</h4>
                                <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                            </div>

                            <!-- Modal body -->
                            <div class=\"modal-body\">
                                ";
        // line 148
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "best_rates_guaranteed", [])), "html", null, true);
        echo "
                            </div>

                            <!-- Modal footer -->
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-danger\" data-dismiss=\"modal\" type=\"button\">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            ";
        // line 162
        if ($this->getAttribute(($context["page"] ?? null), "Welk_experience", [])) {
            // line 163
            echo "                ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Welk_experience", [])), "html", null, true);
            echo "
            ";
        }
        // line 165
        echo "
            ";
        // line 166
        if ($this->getAttribute(($context["page"] ?? null), "Welk_destination", [])) {
            // line 167
            echo "                ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Welk_destination", [])), "html", null, true);
            echo "
            ";
        }
        // line 169
        echo "
            ";
        // line 170
        if ($this->getAttribute(($context["page"] ?? null), "blog_content", [])) {
            // line 171
            echo "                <div class=\"from-blogs\">
                    <div class=\"container\">
                        ";
            // line 173
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "blog_content", [])), "html", null, true);
            echo "
                    </div>
                </div>
            ";
        }
        // line 177
        echo "
            ";
        // line 178
        if ($this->getAttribute(($context["page"] ?? null), "blog", [])) {
            // line 179
            echo "                <div class=\"inspired-stories\">
                    <div class=\"container\">
                        ";
            // line 181
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "blog", [])), "html", null, true);
            echo "
                    </div>
                </div>
            ";
        }
        // line 185
        echo "
            ";
        // line 186
        if ($this->getAttribute(($context["page"] ?? null), "Social_feed", [])) {
            // line 187
            echo "                <div class=\"share-experience\">
                    ";
            // line 188
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Social_feed", [])), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 191
        echo "        </div>
        <!-- Modal Window for Book your stay -->
        <div class=\"modal\" id=\"bookingSlots\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                    </div>
                    <div class=\"modal-body\">
                        <div class=\"booking-slots header\">
                            ";
        // line 201
        if ($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])) {
            // line 202
            echo "                                <div class=\"container\">
                                    ";
            // line 203
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])), "html", null, true);
            echo "
                                </div>
                            ";
        }
        // line 206
        echo "                            <div class=\"modal\" id=\"bestRatesModal\">
                                <div class=\"modal-dialog\">
                                    <div
                                        class=\"modal-content\">
                                        <!-- Modal Header -->
                                        <div class=\"modal-header\">
                                            <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class=\"modal-body\">
                                            ";
        // line 217
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "best_rates_guaranteed", [])), "html", null, true);
        echo "
                                        </div>

                                        <!-- Modal footer -->
                                        <div class=\"modal-footer\">
                                            <button class=\"btn btn-danger\" data-dismiss=\"modal\" type=\"button\">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Here -->
        <footer class=\"footer-wrapper\">
            ";
        // line 236
        if ($this->getAttribute(($context["page"] ?? null), "footer_descover", [])) {
            // line 237
            echo "                ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_descover", [])), "html", null, true);
            echo "
            ";
        }
        // line 239
        echo "            <div class=\"nav-categories\">
                <div class=\"container\">
                    <div class=\"row\">
                        ";
        // line 242
        if ($this->getAttribute(($context["page"] ?? null), "Welk_logo_footer", [])) {
            // line 243
            echo "                            <div class=\"col-12 footer-logo col-lg-3\">
                                ";
            // line 244
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Welk_logo_footer", [])), "html", null, true);
            echo "
                            </div>
                        ";
        }
        // line 247
        echo "                        <div class=\"col-12 xl-9 col-lg-9 col-md-9 col-sm-9\">
                            <div class=\"container\">
                                <div class=\"row\">
                                    ";
        // line 250
        if ($this->getAttribute(($context["page"] ?? null), "Footer_explore_welk", [])) {
            // line 251
            echo "                                        <div class=\"col-6 col-lg-4\">
                                            ";
            // line 252
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_explore_welk", [])), "html", null, true);
            echo "
                                        </div>
                                    ";
        }
        // line 255
        echo "                                    ";
        if ($this->getAttribute(($context["page"] ?? null), "Footer_follow_us", [])) {
            // line 256
            echo "                                        <div class=\"col-6 col-lg-4\">
                                            ";
            // line 257
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_follow_us", [])), "html", null, true);
            echo "
                                        </div>
                                    ";
        }
        // line 260
        echo "                                    <div class=\"col-12 col-lg-4\">
                                        <h3 class=\"title\">Contact Us</h3>
                                        <ul class=\"contant-us\">
                                            ";
        // line 263
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 264
            echo "                                                <li class=\"pad-tb12\">
                                                    <i class=\"icon call\"></i>
                                                    <a href=\"tel:";
            // line 266
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["central_number"] ?? null)), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["central_number"] ?? null)), "html", null, true);
            echo "</a>
                                                </li>
                                            ";
        }
        // line 269
        echo "                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"divider\"></div>
            <div class=\"copy-rights\">
                <div class=\"container\">
                    <div class=\"row\">
                        ";
        // line 281
        if ($this->getAttribute(($context["page"] ?? null), "Footer_copyright", [])) {
            // line 282
            echo "                            <div class=\"col-12 col xl-3 col-lg-3 col-md-3 col-sm-3\">
                                ";
            // line 283
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_copyright", [])), "html", null, true);
            echo "
                            </div>
                        ";
        }
        // line 286
        echo "                        ";
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 287
            echo "                            <div class=\"col-12 col xl-9 col-lg-9 col-md-9 col-sm-9 nopadding\">
                                ";
            // line 288
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
                            </div>
                        ";
        }
        // line 291
        echo "                    </div>
                </div>
            </div>
            <div class=\"sticky-top-btn\"></div>
        </footer>
    </div>

    <script src=\"";
        // line 298
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/jquery-3.4.1.js\"></script>
    <script src=\"";
        // line 299
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/popper.min.js\"></script>
    <script src=\"";
        // line 300
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/bootstrap.min.js\"></script>
    <script src=\"";
        // line 301
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/owl.carousel.min.js\"></script>
    <script src=\"";
        // line 302
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/moment.min.js\"></script>
    <script src=\"";
        // line 303
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/daterangepicker.js\"></script>
    <script src=\"";
        // line 304
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/custom.js\"></script>
    <script src=\"https://static.triptease.io/paperboy/aNLMQWG7V9.js\" defer></script>
</body></body>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/pages/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  502 => 304,  498 => 303,  494 => 302,  490 => 301,  486 => 300,  482 => 299,  478 => 298,  469 => 291,  463 => 288,  460 => 287,  457 => 286,  451 => 283,  448 => 282,  446 => 281,  432 => 269,  424 => 266,  420 => 264,  418 => 263,  413 => 260,  407 => 257,  404 => 256,  401 => 255,  395 => 252,  392 => 251,  390 => 250,  385 => 247,  379 => 244,  376 => 243,  374 => 242,  369 => 239,  363 => 237,  361 => 236,  339 => 217,  326 => 206,  320 => 203,  317 => 202,  315 => 201,  303 => 191,  297 => 188,  294 => 187,  292 => 186,  289 => 185,  282 => 181,  278 => 179,  276 => 178,  273 => 177,  266 => 173,  262 => 171,  260 => 170,  257 => 169,  251 => 167,  249 => 166,  246 => 165,  240 => 163,  238 => 162,  221 => 148,  207 => 136,  201 => 133,  198 => 132,  196 => 131,  184 => 121,  178 => 119,  175 => 118,  168 => 114,  165 => 113,  163 => 112,  152 => 103,  146 => 101,  143 => 100,  136 => 96,  133 => 95,  131 => 94,  128 => 93,  122 => 90,  119 => 89,  117 => 88,  109 => 83,  99 => 75,  93 => 72,  90 => 71,  88 => 70,  78 => 63,  74 => 62,  70 => 61,  66 => 60,  62 => 59,  55 => 54,);
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
 * Default theme implementation to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - title_prefix: Additional output populated by modules, intended to be
 *   displayed in front of the main title tag that appears in the template.
 * - title: The page title, for use in the actual content.
 * - title_suffix: Additional output populated by modules, intended to be
 *   displayed after the main title tag that appears in the template.
 * - messages: Status and error messages. Should be displayed prominently.
 * - tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.header: Items for the header region.
 * - page.navigation: Items for the navigation region.
 * - page.navigation_collapsible: Items for the navigation (collapsible) region.
 * - page.highlighted: Items for the highlighted content region.
 * - page.help: Dynamic help text, mostly for admin pages.
 * - page.content: The main content of the current page.
 * - page.sidebar_first: Items for the first sidebar.
 * - page.sidebar_second: Items for the second sidebar.
 * - page.footer: Items for the footer region.
 *
 * @ingroup templates
 *
 * @see template_preprocess_page()
 * @see html.html.twig
 */
#}

<head>
    <title>Welk Resorts</title>
    <meta charset=\"utf-8\">
    <meta content=\"width=device-width, initial-scale=1, shrink-to-fit=no\" name=\"viewport\">
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/bootstrap.min.css\"/>
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/owl.carousel.min.css\">
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/owl.theme.default.min.css\">
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/daterangepicker.css\">
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/main.css\"/>
</head>

<body>
    <div class=\"main-wrapper\">
        <header>
            <div class=\"container-fluid nopadding\">
                {% if page.banner %}
                    <div class=\"banner-video-block\">
                        {{ page.banner }}
                    </div>
                {% endif %}
                <div class=\"top-nav-wrapper\">
                    <a class=\"btn btn-primary large book-now mobile d-block d-lg-none\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#booking-slots\" title=\"Book Now\">Book
                                                                                                                                                                                                                        Now</a>
                    <nav class=\"navbar navbar-expand-lg navbar-light\">
                        <button class=\"navbar-toggler\" data-target=\"#navBarMenu\" data-toggle=\"collapse\">
                            <span class=\"navbar-toggler-icon\"></span>
                            <span class=\"close-btn hidden\"></span>Menu
                        </button>
                        <a href=\"{{ base_path }}\" class=\"navbar-brand\"></a>
                        <a class=\"sign-in d-block d-lg-none\" href=\"#\">Sign In</a>
                        <div class=\"collapse navbar-collapse\" id=\"navBarMenu\">
                            <div class=\"container\">
                                <div class='row'>
                                    {% if page.Primary_menu  %}
                                        <div class=\"col-12 col-xl-12 col-lg-12  col-md-12 nopadding\">
                                            {{ page.Primary_menu }}
                                        </div>
                                    {% endif %}
                                    <div class=\"menu secondary d-block d-lg-none\">
                                        {% if page.Central_contact_number  %}
                                            <div class=\"contact-number\">
                                                <div class=\"phone\">{{ page.Central_contact_number }}</div>
                                                <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                                            </div>
                                        {% endif %}
                                        {% if page.Secondary_menu %}
                                            {{ page.Secondary_menu }}
                                        {% endif %}
                                        <a class=\"btn btn-primary medium book-now d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book
                                                                                                                                                                                                                                                                                                                                                                                                            Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <div class=\"menu secondary d-none d-lg-block\">
                        {% if page.Central_contact_number  %}
                            <div class=\"contact-number\">
                                <div class=\"phone\">{{ page.Central_contact_number }}</div>
                                <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                            </div>
                        {% endif %}
                        {% if page.Secondary_menu %}
                            {{ page.Secondary_menu }}
                        {% endif %}
                        <a class=\"btn btn-primary book-now d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                        </a>
                    </div>
                    <a class=\"btn btn-primary book-now-sticky d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                    </a>
                </div>
            </div>
        </header>
        <div class=\"content-wrapper clearfix\">
            <div class=\"booking-slots\">
                {% if page.book_your_stay %}
                    <div class=\"container\">
                        {{ page.book_your_stay }}
                    </div>
                {% endif %}
                <div class=\"modal\" id=\"bestRatesModal\">
                    <div class=\"modal-dialog\">
                        <div
                            class=\"modal-content\">
                            <!-- Modal Header -->
                            <div class=\"modal-header\">
                                <h4 class=\"modal-title\">Best Rates</h4>
                                <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                            </div>

                            <!-- Modal body -->
                            <div class=\"modal-body\">
                                {{ page.best_rates_guaranteed }}
                            </div>

                            <!-- Modal footer -->
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-danger\" data-dismiss=\"modal\" type=\"button\">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {% if page.Welk_experience %}
                {{ page.Welk_experience }}
            {% endif %}

            {% if page.Welk_destination %}
                {{ page.Welk_destination }}
            {% endif %}

            {% if page.blog_content %}
                <div class=\"from-blogs\">
                    <div class=\"container\">
                        {{ page.blog_content }}
                    </div>
                </div>
            {% endif %}

            {% if page.blog %}
                <div class=\"inspired-stories\">
                    <div class=\"container\">
                        {{ page.blog }}
                    </div>
                </div>
            {% endif %}

            {% if page.Social_feed %}
                <div class=\"share-experience\">
                    {{ page.Social_feed }}
                </div>
            {% endif %}
        </div>
        <!-- Modal Window for Book your stay -->
        <div class=\"modal\" id=\"bookingSlots\">
            <div class=\"modal-dialog\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                    </div>
                    <div class=\"modal-body\">
                        <div class=\"booking-slots header\">
                            {% if page.book_your_stay %}
                                <div class=\"container\">
                                    {{ page.book_your_stay }}
                                </div>
                            {% endif %}
                            <div class=\"modal\" id=\"bestRatesModal\">
                                <div class=\"modal-dialog\">
                                    <div
                                        class=\"modal-content\">
                                        <!-- Modal Header -->
                                        <div class=\"modal-header\">
                                            <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class=\"modal-body\">
                                            {{ page.best_rates_guaranteed }}
                                        </div>

                                        <!-- Modal footer -->
                                        <div class=\"modal-footer\">
                                            <button class=\"btn btn-danger\" data-dismiss=\"modal\" type=\"button\">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Here -->
        <footer class=\"footer-wrapper\">
            {% if page.footer_descover %}
                {{ page.footer_descover }}
            {% endif %}
            <div class=\"nav-categories\">
                <div class=\"container\">
                    <div class=\"row\">
                        {% if page.Welk_logo_footer %}
                            <div class=\"col-12 footer-logo col-lg-3\">
                                {{ page.Welk_logo_footer }}
                            </div>
                        {% endif %}
                        <div class=\"col-12 xl-9 col-lg-9 col-md-9 col-sm-9\">
                            <div class=\"container\">
                                <div class=\"row\">
                                    {% if page.Footer_explore_welk %}
                                        <div class=\"col-6 col-lg-4\">
                                            {{ page.Footer_explore_welk }}
                                        </div>
                                    {% endif %}
                                    {% if page.Footer_follow_us %}
                                        <div class=\"col-6 col-lg-4\">
                                            {{ page.Footer_follow_us }}
                                        </div>
                                    {% endif %}
                                    <div class=\"col-12 col-lg-4\">
                                        <h3 class=\"title\">Contact Us</h3>
                                        <ul class=\"contant-us\">
                                            {% if page.Central_contact_number %}
                                                <li class=\"pad-tb12\">
                                                    <i class=\"icon call\"></i>
                                                    <a href=\"tel:{{ central_number }}\">{{ central_number }}</a>
                                                </li>
                                            {% endif %}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"divider\"></div>
            <div class=\"copy-rights\">
                <div class=\"container\">
                    <div class=\"row\">
                        {% if page.Footer_copyright %}
                            <div class=\"col-12 col xl-3 col-lg-3 col-md-3 col-sm-3\">
                                {{ page.Footer_copyright }}
                            </div>
                        {% endif %}
                        {% if page.footer %}
                            <div class=\"col-12 col xl-9 col-lg-9 col-md-9 col-sm-9 nopadding\">
                                {{ page.footer }}
                            </div>
                        {% endif %}
                    </div>
                </div>
            </div>
            <div class=\"sticky-top-btn\"></div>
        </footer>
    </div>

    <script src=\"{{ theme_path }}/dest/js/lib/jquery-3.4.1.js\"></script>
    <script src=\"{{ theme_path }}/dest/js/lib/popper.min.js\"></script>
    <script src=\"{{ theme_path }}/dest/js/lib/bootstrap.min.js\"></script>
    <script src=\"{{ theme_path }}/dest/js/lib/owl.carousel.min.js\"></script>
    <script src=\"{{ theme_path }}/dest/js/lib/moment.min.js\"></script>
    <script src=\"{{ theme_path }}/dest/js/lib/daterangepicker.js\"></script>
    <script src=\"{{ theme_path }}/dest/js/custom.js\"></script>
    <script src=\"https://static.triptease.io/paperboy/aNLMQWG7V9.js\" defer></script>
</body></body>
", "themes/custom/welkresorts/templates/pages/page--front.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/pages/page--front.html.twig");
    }
}
