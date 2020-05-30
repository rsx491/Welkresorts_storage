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

/* themes/custom/welkresorts/templates/pages/page--blogs.html.twig */
class __TwigTemplate_f9dd9a1260fd564c2912c55a51b2e617d1e3b566b24902826066e5238880a107 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 75, "for" => 227];
        $filters = ["escape" => 61, "striptags" => 231];
        $functions = ["drupal_view" => 180, "drupal_field" => 198];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'striptags'],
                ['drupal_view', 'drupal_field']
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
        // line 56
        echo "
<head>
    <title>Welk Resorts</title>
    <meta charset=\"utf-8\">
    <meta content=\"width=device-width, initial-scale=1, shrink-to-fit=no\" name=\"viewport\">
    <link rel=\"stylesheet\" href=\"";
        // line 61
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/bootstrap.min.css\"/>
    <link rel=\"stylesheet\" href=\"";
        // line 62
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/owl.carousel.min.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 63
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/owl.theme.default.min.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 64
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/lib/daterangepicker.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 65
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/css/main.css\"/>
</head>

<body>
    <div class=\"main-wrapper\">
        <header class=\"default-header\">
            <div class=\"container-fluid nopadding\">
                <a class=\"btn btn-primary large book-now d-block d-lg-none\" href=\"#booking-slots\" title=\"Book Now\">Book
                                                                                Now
                </a>
                ";
        // line 75
        if ($this->getAttribute(($context["page"] ?? null), "banner", [])) {
            // line 76
            echo "                    <div class=\"banner-video-block\">
                        ";
            // line 77
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "banner", [])), "html", null, true);
            echo "
                    </div>
                ";
        }
        // line 80
        echo "                <div class=\"top-nav-wrapper\">
                    <nav class=\"navbar navbar-expand-lg navbar-light\">
                        <button class=\"navbar-toggler\" data-target=\"#navBarMenu\" data-toggle=\"collapse\">
                            <span class=\"navbar-toggler-icon\"></span>
                            <span class=\"close-btn hidden\"></span>Menu
                        </button>
                        <a href=\"";
        // line 86
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo "\" class=\"navbar-brand\"></a>
                        <a class=\"sign-in d-block d-lg-none\" href=\"#\">Sign In</a>
                        <div class=\"collapse navbar-collapse\" id=\"navBarMenu\">
                            <div class=\"container\">
                                <div class='row'>
                                    ";
        // line 91
        if ($this->getAttribute(($context["page"] ?? null), "Primary_menu", [])) {
            // line 92
            echo "                                        <div class=\"col-12 col-xl-12 col-lg-12  col-md-12 nopadding\">
                                            ";
            // line 93
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Primary_menu", [])), "html", null, true);
            echo "
                                        </div>
                                    ";
        }
        // line 96
        echo "                                    <div class=\"menu secondary d-block d-lg-none\">
                                        ";
        // line 97
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 98
            echo "                                            <div class=\"contact-number\">
                                                <div class=\"phone\">";
            // line 99
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])), "html", null, true);
            echo "</div>
                                                <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                                            </div>
                                        ";
        }
        // line 103
        echo "                                        ";
        if ($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])) {
            // line 104
            echo "                                            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])), "html", null, true);
            echo "
                                        ";
        }
        // line 106
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
        // line 115
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 116
            echo "                            <div class=\"contact-number\">
                                <div class=\"phone\">";
            // line 117
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])), "html", null, true);
            echo "</div>
                                <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                            </div>
                        ";
        }
        // line 121
        echo "                        ";
        if ($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])) {
            // line 122
            echo "                            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])), "html", null, true);
            echo "
                        ";
        }
        // line 124
        echo "                        <a class=\"btn btn-primary small book-now d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                        </a>
                    </div>
                    <a class=\"btn btn-primary book-now-sticky d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                    </a>
                </div>
            </div>
        </header>
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
        // line 141
        if ($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])) {
            // line 142
            echo "                                <div class=\"container\">
                                    ";
            // line 143
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])), "html", null, true);
            echo "
                                </div>
                            ";
        }
        // line 146
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
        // line 157
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
        <div
            class=\"content-wrapper\">
            <!-- Blogs Section -->
            <div class=\"blogs-explore bg-texture\">
                <div class=\"container\">
                    <div class=\"d-flex heading-section\">
                        ";
        // line 180
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("blog_hero_section", "block_1"), "html", null, true);
        echo "
                    </div>
                </div>
                <div class=\"container\">
                    <div class=\"d-flex justify-content-between align-items-center subscribe\">
                        <a class=\"best-rates\" href=\"#\" data-toggle=\"modal\" data-target=\"#blogModal\">Subscribe to the Blog</a>
                        <div class=\"input-group col-md-4 default-style\">
                            ";
        // line 187
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("blog_search", "block_1"), "html", null, true);
        echo "
                        </div>
                    </div>
                </div>
                <div class=\"modal\" id=\"blogModal\">
                    <div class=\"modal-dialog\">
                        <div
                            class=\"modal-content\">
                            <!-- Modal Header -->
                            <div class=\"modal-header\">
                                <h2 class=\"modal-title\">Subscribe to the blog</h2>
                                <p>";
        // line 198
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalField("body", "block_content", 17), "html", null, true);
        echo "</p>
                                <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                            </div>

                            <!-- Modal body -->
                            <div class=\"modal-body\">
                                <div class=\"flex-item default-style\">
                                    <label>Your Email Address</label>
                                    <div class=\"alert alert-warning alert-dismissible fade hide\" id=\"Emailadd\">Your
                                                                                                                                                                email address is already exist.</div>
                                    <div class=\"captchaerror\"></div>
                                    <div class=\"input-group\">
                                        ";
        // line 210
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ["#type" => "webform", "#webform" => "blog_subscription"], "html", null, true);
        echo "
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rommantic Componenht Section -->
            ";
        // line 220
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("blog", "block_1"), "html", null, true);
        echo "
       
            ";
        // line 222
        if ( !twig_test_empty($this->getAttribute(($context["node"] ?? null), "field_stay_play", []))) {
            // line 223
            echo "                <div class=\"stay-play\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col text-center\">
                                ";
            // line 227
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "field_stay_play", []));
            foreach ($context['_seq'] as $context["_key"] => $context["stay"]) {
                // line 228
                echo "                                    <div class=\"content-wrapper\">
                                        <h3>";
                // line 229
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_title", []), "value", [])), "html", null, true);
                echo "</h3>
                                        <p>
                                            ";
                // line 231
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_desc", []), "value", []))), "html", null, true);
                echo "
                                        </p>
                                        <span class=\"view-details\">
                                            <a href=\"";
                // line 234
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_vd", []), "uri", [])), "html", null, true);
                echo "\" title=\"View Details\" class=\"style-arrow\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_vd", []), "title", [])), "html", null, true);
                echo "
                                            </a>
                                            <a class=\"style-arrow\" href=\"";
                // line 236
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_vd", []), "uri", [])), "html", null, true);
                echo "\" title=\"More Details\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_more_off", []), "title", [])), "html", null, true);
                echo "
                                            </a>
                                        </span>
                                    </div>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['stay'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 241
            echo "                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
        // line 246
        echo "            <!-- Sign Up Section -->
            <div class=\"sign-up-block secondary\">
                <div class=\"container\">
                    <div class=\"d-flex justify-content-between\">
                        <div class=\"flex-item\">
                            <h4>Stay Informed</h4>
                            <h2>Sign Up for Updates</h2>
                        </div>
                        <div class=\"flex-item\">
                            <label>Your Email Address</label>
                            <div class=\"alert alert-warning alert-dismissible fade hide\" id=\"Emailadd\">Your email
                                                                                                                                address is already exist.</div>
                            <div class=\"captchaerror\"></div>
                            <div class=\"input-group\">
                                ";
        // line 260
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ["#type" => "webform", "#webform" => "sign_up_for_update", "#default_data" => ["resort_name" => "blog"]], "html", null, true);
        // line 261
        echo "
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body></div><footer class=\"footer-wrapper\">
";
        // line 270
        if ($this->getAttribute(($context["page"] ?? null), "footer_descover", [])) {
            // line 271
            echo "    ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_descover", [])), "html", null, true);
            echo "
";
        }
        // line 273
        echo "<div class=\"nav-categories\">
    <div class=\"container\">
        <div class=\"row\">
            ";
        // line 276
        if ($this->getAttribute(($context["page"] ?? null), "Welk_logo_footer", [])) {
            // line 277
            echo "                <div class=\"col-12 footer-logo col-lg-3\">
                    ";
            // line 278
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Welk_logo_footer", [])), "html", null, true);
            echo "</div>
            ";
        }
        // line 280
        echo "            <div class=\"col-12 xl-9 col-lg-9 col-md-9 col-sm-9\">
                <div class=\"container\">
                    <div class=\"row\">
                        ";
        // line 283
        if ($this->getAttribute(($context["page"] ?? null), "Footer_explore_welk", [])) {
            // line 284
            echo "                            <div class=\"col-6 col-lg-4\">
                                ";
            // line 285
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_explore_welk", [])), "html", null, true);
            echo "
                            </div>
                        ";
        }
        // line 288
        echo "                        ";
        if ($this->getAttribute(($context["page"] ?? null), "Footer_follow_us", [])) {
            // line 289
            echo "                            <div class=\"col-6 col-lg-4\">
                                ";
            // line 290
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_follow_us", [])), "html", null, true);
            echo "
                            </div>
                        ";
        }
        // line 293
        echo "                        <div class=\"col-12 col-lg-4\">
                            <h3 class=\"title\">Contact Us</h3>
                            <ul class=\"contant-us\">
                                ";
        // line 296
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 297
            echo "                                    <li class=\"pad-tb12\">
                                        <i class=\"icon call\"></i>
                                        <a href=\"tel:";
            // line 299
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["central_number"] ?? null)), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["central_number"] ?? null)), "html", null, true);
            echo "</a>
                                    </li>
                                ";
        }
        // line 302
        echo "                            </ul>
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
        // line 314
        if ($this->getAttribute(($context["page"] ?? null), "Footer_copyright", [])) {
            // line 315
            echo "                <div class=\"col-12 col xl-3 col-lg-3 col-md-3 col-sm-3\">
                    ";
            // line 316
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_copyright", [])), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 319
        echo "            ";
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 320
            echo "                <div class=\"col-12 col xl-9 col-lg-9 col-md-9 col-sm-9 nopadding\">
                    ";
            // line 321
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 324
        echo "        </div>
    </div>
</div>
<div class=\"sticky-top-btn\"></div></footer></div><script src=\"";
        // line 327
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/jquery-3.4.1.js\"></script><script src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/popper.min.js\"></script><script src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/bootstrap.min.js\"></script><script src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/owl.carousel.min.js\"></script><script src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/moment.min.js\"></script><script src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/daterangepicker.js\"></script><script src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/custom.js\"></script><script src=\"https://static.triptease.io/paperboy/aNLMQWG7V9.js\" defer></script></body>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/pages/page--blogs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  505 => 327,  500 => 324,  494 => 321,  491 => 320,  488 => 319,  482 => 316,  479 => 315,  477 => 314,  463 => 302,  455 => 299,  451 => 297,  449 => 296,  444 => 293,  438 => 290,  435 => 289,  432 => 288,  426 => 285,  423 => 284,  421 => 283,  416 => 280,  411 => 278,  408 => 277,  406 => 276,  401 => 273,  395 => 271,  393 => 270,  382 => 261,  380 => 260,  364 => 246,  357 => 241,  344 => 236,  337 => 234,  331 => 231,  326 => 229,  323 => 228,  319 => 227,  313 => 223,  311 => 222,  306 => 220,  293 => 210,  278 => 198,  264 => 187,  254 => 180,  228 => 157,  215 => 146,  209 => 143,  206 => 142,  204 => 141,  185 => 124,  179 => 122,  176 => 121,  169 => 117,  166 => 116,  164 => 115,  153 => 106,  147 => 104,  144 => 103,  137 => 99,  134 => 98,  132 => 97,  129 => 96,  123 => 93,  120 => 92,  118 => 91,  110 => 86,  102 => 80,  96 => 77,  93 => 76,  91 => 75,  78 => 65,  74 => 64,  70 => 63,  66 => 62,  62 => 61,  55 => 56,);
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
 * - page.blog_comment: Comments that come on blog page.
 * - page.blog_content: Blog contents for blog.
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
        <header class=\"default-header\">
            <div class=\"container-fluid nopadding\">
                <a class=\"btn btn-primary large book-now d-block d-lg-none\" href=\"#booking-slots\" title=\"Book Now\">Book
                                                                                Now
                </a>
                {% if page.banner %}
                    <div class=\"banner-video-block\">
                        {{ page.banner }}
                    </div>
                {% endif %}
                <div class=\"top-nav-wrapper\">
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
                        <a class=\"btn btn-primary small book-now d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                        </a>
                    </div>
                    <a class=\"btn btn-primary book-now-sticky d-none d-lg-block\" data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                    </a>
                </div>
            </div>
        </header>
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
        <div
            class=\"content-wrapper\">
            <!-- Blogs Section -->
            <div class=\"blogs-explore bg-texture\">
                <div class=\"container\">
                    <div class=\"d-flex heading-section\">
                        {{ drupal_view('blog_hero_section', 'block_1') }}
                    </div>
                </div>
                <div class=\"container\">
                    <div class=\"d-flex justify-content-between align-items-center subscribe\">
                        <a class=\"best-rates\" href=\"#\" data-toggle=\"modal\" data-target=\"#blogModal\">Subscribe to the Blog</a>
                        <div class=\"input-group col-md-4 default-style\">
                            {{ drupal_view('blog_search', 'block_1') }}
                        </div>
                    </div>
                </div>
                <div class=\"modal\" id=\"blogModal\">
                    <div class=\"modal-dialog\">
                        <div
                            class=\"modal-content\">
                            <!-- Modal Header -->
                            <div class=\"modal-header\">
                                <h2 class=\"modal-title\">Subscribe to the blog</h2>
                                <p>{{ drupal_field('body', 'block_content', 17) }}</p>
                                <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                            </div>

                            <!-- Modal body -->
                            <div class=\"modal-body\">
                                <div class=\"flex-item default-style\">
                                    <label>Your Email Address</label>
                                    <div class=\"alert alert-warning alert-dismissible fade hide\" id=\"Emailadd\">Your
                                                                                                                                                                email address is already exist.</div>
                                    <div class=\"captchaerror\"></div>
                                    <div class=\"input-group\">
                                        {{ {'#type': 'webform', '#webform': 'blog_subscription'} }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rommantic Componenht Section -->
            {{ drupal_view('blog', 'block_1') }}
       
            {% if node.field_stay_play is not empty %}
                <div class=\"stay-play\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col text-center\">
                                {% for stay in node.field_stay_play %}
                                    <div class=\"content-wrapper\">
                                        <h3>{{ stay.entity.field_stay_and_play_title.value }}</h3>
                                        <p>
                                            {{ stay.entity.field_stay_and_play_desc.value | striptags }}
                                        </p>
                                        <span class=\"view-details\">
                                            <a href=\"{{ stay.entity.field_stay_and_play_vd.uri }}\" title=\"View Details\" class=\"style-arrow\">{{ stay.entity.field_stay_and_play_vd.title }}
                                            </a>
                                            <a class=\"style-arrow\" href=\"{{ stay.entity.field_stay_and_play_vd.uri }}\" title=\"More Details\">{{ stay.entity.field_stay_and_play_more_off.title }}
                                            </a>
                                        </span>
                                    </div>
                                {% endfor %}
                            </div>
                        </div>
                    </div>
                </div>
            {% endif %}
            <!-- Sign Up Section -->
            <div class=\"sign-up-block secondary\">
                <div class=\"container\">
                    <div class=\"d-flex justify-content-between\">
                        <div class=\"flex-item\">
                            <h4>Stay Informed</h4>
                            <h2>Sign Up for Updates</h2>
                        </div>
                        <div class=\"flex-item\">
                            <label>Your Email Address</label>
                            <div class=\"alert alert-warning alert-dismissible fade hide\" id=\"Emailadd\">Your email
                                                                                                                                address is already exist.</div>
                            <div class=\"captchaerror\"></div>
                            <div class=\"input-group\">
                                {{ {'#type': 'webform', '#webform': 'sign_up_for_update','#default_data': {'resort_name': 'blog' }}
                                }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body></div><footer class=\"footer-wrapper\">
{% if page.footer_descover %}
    {{ page.footer_descover }}
{% endif %}
<div class=\"nav-categories\">
    <div class=\"container\">
        <div class=\"row\">
            {% if page.Welk_logo_footer %}
                <div class=\"col-12 footer-logo col-lg-3\">
                    {{ page.Welk_logo_footer }}</div>
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
<div class=\"sticky-top-btn\"></div></footer></div><script src=\"{{ theme_path }}/dest/js/lib/jquery-3.4.1.js\"></script><script src=\"{{ theme_path }}/dest/js/lib/popper.min.js\"></script><script src=\"{{ theme_path }}/dest/js/lib/bootstrap.min.js\"></script><script src=\"{{ theme_path }}/dest/js/lib/owl.carousel.min.js\"></script><script src=\"{{ theme_path }}/dest/js/lib/moment.min.js\"></script><script src=\"{{ theme_path }}/dest/js/lib/daterangepicker.js\"></script><script src=\"{{ theme_path }}/dest/js/custom.js\"></script><script src=\"https://static.triptease.io/paperboy/aNLMQWG7V9.js\" defer></script></body>
", "themes/custom/welkresorts/templates/pages/page--blogs.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/pages/page--blogs.html.twig");
    }
}
