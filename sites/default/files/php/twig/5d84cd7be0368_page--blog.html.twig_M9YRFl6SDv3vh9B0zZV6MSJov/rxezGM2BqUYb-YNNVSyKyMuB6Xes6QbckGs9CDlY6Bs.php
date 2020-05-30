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

/* themes/custom/welkresorts/templates/pages/page--blog.html.twig */
class __TwigTemplate_f56b6e648e0740e4490b2fe78db82634926265af99723e6d329133bd6893cbe9 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 74, "set" => 247, "trans" => 248, "for" => 270];
        $filters = ["escape" => 61, "date" => 247, "raw" => 255, "striptags" => 274];
        $functions = ["drupal_view" => 181, "drupal_field" => 198, "file_url" => 254];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'trans', 'for'],
                ['escape', 'date', 'raw', 'striptags'],
                ['drupal_view', 'drupal_field', 'file_url']
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
        echo "/dest/css/lib/bootstrap.min.css\" />
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
        echo "/dest/css/main.css\" />
</head>

<body>
    <div class=\"main-wrapper\">
        <header class=\"default-header\">
            <div class=\"container-fluid nopadding\">
                <a class=\"btn btn-primary large book-now d-block d-lg-none\" href=\"#booking-slots\" title=\"Book Now\">Book
                    Now</a>
                ";
        // line 74
        if ($this->getAttribute(($context["page"] ?? null), "banner", [])) {
            // line 75
            echo "                <div class=\"banner-video-block\">
                    ";
            // line 76
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "banner", [])), "html", null, true);
            echo "
                </div>
                ";
        }
        // line 79
        echo "                <div class=\"top-nav-wrapper\">
                    <nav class=\"navbar navbar-expand-lg navbar-light\">
                        <button class=\"navbar-toggler\" data-target=\"#navBarMenu\" data-toggle=\"collapse\">
                            <span class=\"navbar-toggler-icon\"></span>
                            <span class=\"close-btn hidden\"></span>Menu
                        </button>
                        <a href=\"";
        // line 85
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo "\" class=\"navbar-brand\"></a>
                        <a class=\"sign-in d-block d-lg-none\" href=\"#\">Sign In</a>
                        <div class=\"collapse navbar-collapse\" id=\"navBarMenu\">
                            <div class=\"container\">
                                <div class='row'>
                                    ";
        // line 90
        if ($this->getAttribute(($context["page"] ?? null), "Primary_menu", [])) {
            // line 91
            echo "                                    <div class=\"col-12 col-xl-12 col-lg-12  col-md-12 nopadding\">
                                        ";
            // line 92
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Primary_menu", [])), "html", null, true);
            echo "
                                    </div>
                                    ";
        }
        // line 95
        echo "                                    <div class=\"menu secondary d-block d-lg-none\">
                                        ";
        // line 96
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 97
            echo "                                        <div class=\"contact-number\">
                                            <div class=\"phone\">";
            // line 98
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])), "html", null, true);
            echo "</div>
                                            <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                                        </div>
                                        ";
        }
        // line 102
        echo "                                        ";
        if ($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])) {
            // line 103
            echo "                                        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])), "html", null, true);
            echo "
                                        ";
        }
        // line 105
        echo "                                        <a class=\"btn btn-primary medium book-now d-none d-lg-block\"
                                            data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\"
                                            title=\"Book Now\">Book
                                            Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <div class=\"menu secondary d-none d-lg-block\">
                        ";
        // line 116
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 117
            echo "                        <div class=\"contact-number\">
                            <div class=\"phone\">";
            // line 118
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])), "html", null, true);
            echo "</div>
                            <a class=\"d-block d-lg-none\" href=\"#\" id=\"phoneNo\" title=\"\"></a>
                        </div>
                        ";
        }
        // line 122
        echo "                        ";
        if ($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])) {
            // line 123
            echo "                        ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Secondary_menu", [])), "html", null, true);
            echo "
                        ";
        }
        // line 125
        echo "                        <a class=\"btn btn-primary small book-now d-none d-lg-block\" data-target=\"#bookingSlots\"
                            data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                        </a>
                    </div>
                    <a class=\"btn btn-primary book-now-sticky d-none d-lg-block\" data-target=\"#bookingSlots\"
                        data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
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
        // line 144
        if ($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])) {
            // line 145
            echo "                            <div class=\"container\">
                                ";
            // line 146
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "book_your_stay", [])), "html", null, true);
            echo "
                            </div>
                            ";
        }
        // line 149
        echo "                            <div class=\"modal\" id=\"bestRatesModal\">
                                <div class=\"modal-dialog\">
                                    <div class=\"modal-content\">
                                        <!-- Modal Header -->
                                        <div class=\"modal-header\">
                                            <button class=\"close\" data-dismiss=\"modal\" type=\"button\"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class=\"modal-body\">
                                            ";
        // line 159
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
        <div class=\"content-wrapper\">
            <!-- Blogs Section -->
            <div class=\"blogs-explore bg-texture\">
                <div class=\"container\">
                    <div class=\"d-flex heading-section\">
                        ";
        // line 181
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("blog_hero_section", "block_1"), "html", null, true);
        echo "
                    </div>
                </div>
                <div class=\"container\">
                    <div class=\"d-flex justify-content-between align-items-center subscribe\">
                        <a class=\"best-rates\" href=\"#\" data-toggle=\"modal\" data-target=\"#subscriberModal\">Subscribe to the Blog</a>
                        <div class=\"input-group col-md-4 default-style\">
                           ";
        // line 188
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("blog_search", "block_1"), "html", null, true);
        echo "
                        </div>
                    </div>
                </div>
                <div class=\"modal\" id=\"subscriberModal\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
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
            <!-- Tabing Component -->
            <div class=\"categories-block blogs tab-components default-style\">
                <div class=\"d-flex container\">
                    <h4>Categories:</h4>
                    <!-- Nav tabs -->
                    <ul>
                        <li>
                            <a class=\"active\" href=\"#\">All</a>
                        </li>
                        <li>
                            <a href=\"#\">Local Life</a>
                        </li>
                        <li>
                            <a href=\"#\">Guest Postcards</a>
                        </li>
                        <li>
                            <a href=\"#\">Vacation Tips &amp; Tricks</a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Categories name Section -->
            <div class=\"categories-name-section\">
                <div class=\"container\">
                    <h5>";
        // line 243
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_category", []), "entity", []), "name", []), "value", [])), "html", null, true);
        echo "</h5>
                    <h1>";
        // line 244
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "label", [])), "html", null, true);
        echo "</h1>
                    <div class=\"date-block\">
                        <div>
                            ";
        // line 247
        $context["createdDate"] = twig_date_format_filter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "getCreatedTime", [])), "F jS, Y");
        // line 248
        echo "                            ";
        echo t("@createdDate", array("@createdDate" =>         // line 249
($context["createdDate"] ?? null), ));
        // line 251
        echo "                        </div>
                    </div>
                    <div class=\"banner-section\">
                        <img src=";
        // line 254
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_image", []), "entity", []), "fileuri", []))]), "html", null, true);
        echo " />
                        ";
        // line 255
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["node"] ?? null), "body", []), "value", [])));
        echo "
                    </div>
            <div class=\"comments-section default-style divider\">
                <div class=\"container\">
                    <h3>Leave a Comment</h3>
                    <h5>* Indicates Required Information</h5>
                    ";
        // line 261
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ["#type" => "webform", "#webform" => "blog_comment", "#default_data" => ["blog_node" => $this->getAttribute($this->getAttribute(($context["node"] ?? null), "id", []), "value", [])]], "html", null, true);
        echo "
                </div>          
\t\t   </div> 
                    ";
        // line 264
        if ( !twig_test_empty($this->getAttribute(($context["node"] ?? null), "field_stay_play", []))) {
            // line 265
            echo "                    <div class=\"stay-play\">
                        <div class=\"container\">
                            <div class=\"row\">
                                <div class=\"col text-center\">
                                    <div id=\"offerCarousel\" class=\"owl-carousel owl-theme\">
                                        ";
            // line 270
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "field_stay_play", []));
            foreach ($context['_seq'] as $context["_key"] => $context["stay"]) {
                // line 271
                echo "                                        <div class=\"content-wrapper\">
                                            <h3>";
                // line 272
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_title", []), "value", [])), "html", null, true);
                echo "</h3>
                                            <p>
                                                ";
                // line 274
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_desc", []), "value", []))), "html", null, true);
                echo "
                                            </p>
                                            <span class=\"view-details\">
                                                <a href=\"";
                // line 277
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_vd", []), "uri", [])), "html", null, true);
                echo "\"
                                                    title=\"View Details\"
                                                    class=\"style-arrow\">";
                // line 279
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_vd", []), "title", [])), "html", null, true);
                echo "
                                                </a>
                                                <a class=\"style-arrow\"
                                                    href=\"";
                // line 282
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($context["stay"], "entity", []), "field_stay_and_play_vd", []), "uri", [])), "html", null, true);
                echo "\"
                                                    title=\"More Details\">";
                // line 283
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
            // line 288
            echo "                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
        }
        // line 294
        echo "                    <!-- Sign Up Section -->
                    <div class=\"sign-up-block secondary\">
                        <div class=\"container\">
                            <div class=\"d-flex justify-content-between\">
                                <div class=\"flex-item\">
                                    <h4>Stay Informed</h4>
                                    <h2>Sign Up for Updates</h2>
                                </div>
                                <div class=\"flex-item\">
                                    <label>Your Email Address</label>
                                    <div class=\"alert alert-warning alert-dismissible fade hide\" id=\"Emailadd\">Your
                                        email address is already exist.</div>
                                    <div class=\"captchaerror\"></div>
                                    <div class=\"input-group\">
                                        ";
        // line 308
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ["#type" => "webform", "#webform" => "sign_up_for_update", "#default_data" => ["resort_name" => "blog"]], "html", null, true);
        // line 309
        echo "
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Popular Posts Components -->
            ";
        // line 316
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("blog_detail_page_posts", "block_1"), "html", null, true);
        echo "
                </div>
            </div>
        </div>
        <footer class=\"footer-wrapper\">
            ";
        // line 321
        if ($this->getAttribute(($context["page"] ?? null), "footer_descover", [])) {
            // line 322
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_descover", [])), "html", null, true);
            echo "
            ";
        }
        // line 324
        echo "            <div class=\"nav-categories\">
                <div class=\"container\">
                    <div class=\"row\">
                        ";
        // line 327
        if ($this->getAttribute(($context["page"] ?? null), "Welk_logo_footer", [])) {
            // line 328
            echo "                        <div class=\"col-12 footer-logo col-lg-3\">
                            ";
            // line 329
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Welk_logo_footer", [])), "html", null, true);
            echo "</div>
                        ";
        }
        // line 331
        echo "                        <div class=\"col-12 xl-9 col-lg-9 col-md-9 col-sm-9\">
                            <div class=\"container\">
                                <div class=\"row\">
                                    ";
        // line 334
        if ($this->getAttribute(($context["page"] ?? null), "Footer_explore_welk", [])) {
            // line 335
            echo "                                    <div class=\"col-6 col-lg-4\">
                                        ";
            // line 336
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_explore_welk", [])), "html", null, true);
            echo "
                                    </div>
                                    ";
        }
        // line 339
        echo "                                    ";
        if ($this->getAttribute(($context["page"] ?? null), "Footer_follow_us", [])) {
            // line 340
            echo "                                    <div class=\"col-6 col-lg-4\">
                                        ";
            // line 341
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_follow_us", [])), "html", null, true);
            echo "
                                    </div>
                                    ";
        }
        // line 344
        echo "                                    <div class=\"col-12 col-lg-4\">
                                        <h3 class=\"title\">Contact Us</h3>
                                        <ul class=\"contant-us\">
                                            ";
        // line 347
        if ($this->getAttribute(($context["page"] ?? null), "Central_contact_number", [])) {
            // line 348
            echo "                                            <li class=\"pad-tb12\">
                                                <i class=\"icon call\"></i>
                                                <a href=\"tel:";
            // line 350
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["central_number"] ?? null)), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["central_number"] ?? null)), "html", null, true);
            echo "</a>
                                            </li>
                                            ";
        }
        // line 353
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
        // line 365
        if ($this->getAttribute(($context["page"] ?? null), "Footer_copyright", [])) {
            // line 366
            echo "                        <div class=\"col-12 col xl-3 col-lg-3 col-md-3 col-sm-3\">
                            ";
            // line 367
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "Footer_copyright", [])), "html", null, true);
            echo "
                        </div>
                        ";
        }
        // line 370
        echo "                        ";
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 371
            echo "                        <div class=\"col-12 col xl-9 col-lg-9 col-md-9 col-sm-9 nopadding\">
                            ";
            // line 372
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo "
                        </div>
                        ";
        }
        // line 375
        echo "                    </div>
                </div>
            </div>
            <div class=\"sticky-top-btn\"></div>
        </footer>

    </div>
    <script src=\"";
        // line 382
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/jquery-3.4.1.js\"></script>
    <script src=\"";
        // line 383
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/popper.min.js\"></script>
    <script src=\"";
        // line 384
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/bootstrap.min.js\"></script>
    <script src=\"";
        // line 385
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/owl.carousel.min.js\"></script>
    <script src=\"";
        // line 386
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/moment.min.js\"></script>
    <script src=\"";
        // line 387
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/lib/daterangepicker.js\"></script>
    <script src=\"";
        // line 388
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["theme_path"] ?? null)), "html", null, true);
        echo "/dest/js/custom.js\"></script>
    <script src=\"https://static.triptease.io/paperboy/aNLMQWG7V9.js\" defer></script>
</body>";
    }

    public function getTemplateName()
    {
        return "themes/custom/welkresorts/templates/pages/page--blog.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  605 => 388,  601 => 387,  597 => 386,  593 => 385,  589 => 384,  585 => 383,  581 => 382,  572 => 375,  566 => 372,  563 => 371,  560 => 370,  554 => 367,  551 => 366,  549 => 365,  535 => 353,  527 => 350,  523 => 348,  521 => 347,  516 => 344,  510 => 341,  507 => 340,  504 => 339,  498 => 336,  495 => 335,  493 => 334,  488 => 331,  483 => 329,  480 => 328,  478 => 327,  473 => 324,  467 => 322,  465 => 321,  457 => 316,  448 => 309,  446 => 308,  430 => 294,  422 => 288,  411 => 283,  407 => 282,  401 => 279,  396 => 277,  390 => 274,  385 => 272,  382 => 271,  378 => 270,  371 => 265,  369 => 264,  363 => 261,  354 => 255,  350 => 254,  345 => 251,  343 => 249,  341 => 248,  339 => 247,  333 => 244,  329 => 243,  293 => 210,  278 => 198,  265 => 188,  255 => 181,  230 => 159,  218 => 149,  212 => 146,  209 => 145,  207 => 144,  186 => 125,  180 => 123,  177 => 122,  170 => 118,  167 => 117,  165 => 116,  152 => 105,  146 => 103,  143 => 102,  136 => 98,  133 => 97,  131 => 96,  128 => 95,  122 => 92,  119 => 91,  117 => 90,  109 => 85,  101 => 79,  95 => 76,  92 => 75,  90 => 74,  78 => 65,  74 => 64,  70 => 63,  66 => 62,  62 => 61,  55 => 56,);
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
 * {{ content }} to print them all, or print a subset such as
 *   {{ content.field_example }}.
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
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/bootstrap.min.css\" />
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/owl.carousel.min.css\">
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/owl.theme.default.min.css\">
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/lib/daterangepicker.css\">
    <link rel=\"stylesheet\" href=\"{{ theme_path }}/dest/css/main.css\" />
</head>

<body>
    <div class=\"main-wrapper\">
        <header class=\"default-header\">
            <div class=\"container-fluid nopadding\">
                <a class=\"btn btn-primary large book-now d-block d-lg-none\" href=\"#booking-slots\" title=\"Book Now\">Book
                    Now</a>
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
                                        <a class=\"btn btn-primary medium book-now d-none d-lg-block\"
                                            data-target=\"#bookingSlots\" data-toggle=\"modal\" href=\"#\"
                                            title=\"Book Now\">Book
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
                        <a class=\"btn btn-primary small book-now d-none d-lg-block\" data-target=\"#bookingSlots\"
                            data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
                        </a>
                    </div>
                    <a class=\"btn btn-primary book-now-sticky d-none d-lg-block\" data-target=\"#bookingSlots\"
                        data-toggle=\"modal\" href=\"#\" title=\"Book Now\">Book Now
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
                                    <div class=\"modal-content\">
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
        <div class=\"content-wrapper\">
            <!-- Blogs Section -->
            <div class=\"blogs-explore bg-texture\">
                <div class=\"container\">
                    <div class=\"d-flex heading-section\">
                        {{ drupal_view('blog_hero_section', 'block_1') }}
                    </div>
                </div>
                <div class=\"container\">
                    <div class=\"d-flex justify-content-between align-items-center subscribe\">
                        <a class=\"best-rates\" href=\"#\" data-toggle=\"modal\" data-target=\"#subscriberModal\">Subscribe to the Blog</a>
                        <div class=\"input-group col-md-4 default-style\">
                           {{ drupal_view('blog_search', 'block_1') }}
                        </div>
                    </div>
                </div>
                <div class=\"modal\" id=\"subscriberModal\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
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
            <!-- Tabing Component -->
            <div class=\"categories-block blogs tab-components default-style\">
                <div class=\"d-flex container\">
                    <h4>Categories:</h4>
                    <!-- Nav tabs -->
                    <ul>
                        <li>
                            <a class=\"active\" href=\"#\">All</a>
                        </li>
                        <li>
                            <a href=\"#\">Local Life</a>
                        </li>
                        <li>
                            <a href=\"#\">Guest Postcards</a>
                        </li>
                        <li>
                            <a href=\"#\">Vacation Tips &amp; Tricks</a>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- Categories name Section -->
            <div class=\"categories-name-section\">
                <div class=\"container\">
                    <h5>{{ node.field_category.entity.name.value }}</h5>
                    <h1>{{ node.label }}</h1>
                    <div class=\"date-block\">
                        <div>
                            {% set createdDate = node.getCreatedTime|date('F jS, Y') %}
                            {% trans %}
                            {{ createdDate }}
                            {% endtrans %}
                        </div>
                    </div>
                    <div class=\"banner-section\">
                        <img src={{ file_url(node.field_image.entity.fileuri) }} />
                        {{ node.body.value|raw }}
                    </div>
            <div class=\"comments-section default-style divider\">
                <div class=\"container\">
                    <h3>Leave a Comment</h3>
                    <h5>* Indicates Required Information</h5>
                    {{ {'#type': 'webform', '#webform': 'blog_comment','#default_data': {'blog_node':node.id.value }} }}
                </div>          
\t\t   </div> 
                    {% if node.field_stay_play is not empty %}
                    <div class=\"stay-play\">
                        <div class=\"container\">
                            <div class=\"row\">
                                <div class=\"col text-center\">
                                    <div id=\"offerCarousel\" class=\"owl-carousel owl-theme\">
                                        {% for stay in node.field_stay_play %}
                                        <div class=\"content-wrapper\">
                                            <h3>{{ stay.entity.field_stay_and_play_title.value }}</h3>
                                            <p>
                                                {{ stay.entity.field_stay_and_play_desc.value | striptags }}
                                            </p>
                                            <span class=\"view-details\">
                                                <a href=\"{{ stay.entity.field_stay_and_play_vd.uri }}\"
                                                    title=\"View Details\"
                                                    class=\"style-arrow\">{{ stay.entity.field_stay_and_play_vd.title }}
                                                </a>
                                                <a class=\"style-arrow\"
                                                    href=\"{{ stay.entity.field_stay_and_play_vd.uri }}\"
                                                    title=\"More Details\">{{ stay.entity.field_stay_and_play_more_off.title }}
                                                </a>
                                            </span>
                                        </div>
                                        {% endfor %}
                                    </div>
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
                                    <div class=\"alert alert-warning alert-dismissible fade hide\" id=\"Emailadd\">Your
                                        email address is already exist.</div>
                                    <div class=\"captchaerror\"></div>
                                    <div class=\"input-group\">
                                        {{ {'#type': 'webform', '#webform': 'sign_up_for_update','#default_data': {'resort_name': 'blog' }}
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Popular Posts Components -->
            {{ drupal_view('blog_detail_page_posts', 'block_1') }}
                </div>
            </div>
        </div>
        <footer class=\"footer-wrapper\">
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
</body>", "themes/custom/welkresorts/templates/pages/page--blog.html.twig", "/var/www/html/development/Welkresorts/themes/custom/welkresorts/templates/pages/page--blog.html.twig");
    }
}
