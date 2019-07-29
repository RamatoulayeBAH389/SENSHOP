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

/* @PrestaShop/Admin/Sell/Order/Delivery/slip.html.twig */
class __TwigTemplate_a6d2f729d9cac9cb1bbd338d747b5710084448f50016e5f6af18f4c76f08872d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        // line 25
        $this->parent = $this->loadTemplate("@PrestaShop/Admin/layout.html.twig", "@PrestaShop/Admin/Sell/Order/Delivery/slip.html.twig", 25);
        $this->blocks = [
            'content' => [$this, 'block_content'],
            'admin_form_order_delivery_slip_pdf' => [$this, 'block_admin_form_order_delivery_slip_pdf'],
            'admin_form_order_delivery_slip_options' => [$this, 'block_admin_form_order_delivery_slip_options'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context)
    {
        return "@PrestaShop/Admin/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 27
        $context["ps"] = $this->loadTemplate("@PrestaShop/Admin/macros.html.twig", "@PrestaShop/Admin/Sell/Order/Delivery/slip.html.twig", 27);
        // line 25
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 29
    public function block_content($context, array $blocks = [])
    {
        // line 30
        echo "  ";
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["pdfForm"] ?? null), 'form_start', ["attr" => ["class" => "form", "autocomplete" => "off"], "action" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_order_delivery_slip_pdf")]);
        echo "
    <div class=\"row justify-content-center\">
      ";
        // line 32
        $this->displayBlock('admin_form_order_delivery_slip_pdf', $context, $blocks);
        // line 65
        echo "    </div>
  ";
        // line 66
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["pdfForm"] ?? null), 'form_end');
        echo "

  ";
        // line 68
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["optionsForm"] ?? null), 'form_start', ["attr" => ["class" => "form"]]);
        echo "
    <div class=\"row justify-content-center\">
      ";
        // line 70
        $this->displayBlock('admin_form_order_delivery_slip_options', $context, $blocks);
        // line 110
        echo "    </div>
  ";
        // line 111
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["optionsForm"] ?? null), 'form_end');
        echo "
";
    }

    // line 32
    public function block_admin_form_order_delivery_slip_pdf($context, array $blocks = [])
    {
        // line 33
        echo "        <div class=\"col-xl-10\">
          <div class=\"card\" id=\"delivery_pdf_fieldset\">
            <h3 class=\"card-header\">
              <i class=\"material-icons\">print</i> ";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Print PDF", [], "Admin.Orderscustomers.Feature"), "html", null, true);
        echo "
            </h3>
            <div class=\"card-block row\">
              <div class=\"card-text\">
                <div class=\"form-group row\">
                  ";
        // line 41
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("From", [], "Admin.Global"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Format: 2011-12-31 (inclusive).", [], "Admin.Orderscustomers.Help"));
        echo "
                  <div class=\"col-sm\">
                    ";
        // line 43
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["pdfForm"] ?? null), "pdf", []), "date_from", []), 'errors');
        echo "
                    ";
        // line 44
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["pdfForm"] ?? null), "pdf", []), "date_from", []), 'widget');
        echo "
                  </div>
                </div>
                <div class=\"form-group row\">
                  ";
        // line 48
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("To", [], "Admin.Global"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Format: 2011-12-31 (inclusive).", [], "Admin.Orderscustomers.Help"));
        echo "
                  <div class=\"col-sm\">
                    ";
        // line 50
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["pdfForm"] ?? null), "pdf", []), "date_to", []), 'errors');
        echo "
                    ";
        // line 51
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["pdfForm"] ?? null), "pdf", []), "date_to", []), 'widget');
        echo "
                  </div>
                </div>
                ";
        // line 54
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["pdfForm"] ?? null), 'rest');
        echo "
              </div>
            </div>
            <div class=\"card-footer\">
              <div class=\"d-flex justify-content-end\">
                <button class=\"btn btn-primary\">";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Generate PDF", [], "Admin.Orderscustomers.Feature"), "html", null, true);
        echo "</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    // line 70
    public function block_admin_form_order_delivery_slip_options($context, array $blocks = [])
    {
        // line 71
        echo "        <div class=\"col-xl-10\">
          <div class=\"card\" id=\"delivery_options_fieldset\">
            <h3 class=\"card-header\">
              <i class=\"material-icons\">settings</i> ";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Delivery slip options", [], "Admin.Orderscustomers.Feature"), "html", null, true);
        echo "
            </h3>
            <div class=\"card-block row\">
              <div class=\"card-text\">
                <div class=\"form-group row\">
                  ";
        // line 79
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Delivery prefix", [], "Admin.Orderscustomers.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Prefix used for delivery slips.", [], "Admin.Orderscustomers.Help"));
        echo "
                  <div class=\"col-sm\">
                    ";
        // line 81
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "options", []), "prefix", []), 'errors');
        echo "
                    ";
        // line 82
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "options", []), "prefix", []), 'widget');
        echo "
                  </div>
                </div>
                <div class=\"form-group row\">
                  ";
        // line 86
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Delivery Number", [], "Admin.Orderscustomers.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("The next delivery slip will begin with this number and then increase with each additional slip.", [], "Admin.Orderscustomers.Help"));
        echo "
                  <div class=\"col-sm\">
                    ";
        // line 88
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "options", []), "number", []), 'errors');
        echo "
                    ";
        // line 89
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "options", []), "number", []), 'widget');
        echo "
                  </div>
                </div>
                <div class=\"form-group row\">
                  ";
        // line 93
        echo $context["ps"]->getlabel_with_help($this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Enable product image", [], "Admin.Orderscustomers.Feature"), $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Adds an image before product name on Delivery-slip", [], "Admin.Orderscustomers.Help"));
        echo "
                  <div class=\"col-sm\">
                    ";
        // line 95
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "options", []), "enable_product_image", []), 'errors');
        echo "
                    ";
        // line 96
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute($this->getAttribute(($context["optionsForm"] ?? null), "options", []), "enable_product_image", []), 'widget');
        echo "
                  </div>
                </div>
                ";
        // line 99
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(($context["optionsForm"] ?? null), 'rest');
        echo "
              </div>
            </div>
            <div class=\"card-footer\">
              <div class=\"d-flex justify-content-end\">
                <button class=\"btn btn-primary\">";
        // line 104
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Save", [], "Admin.Actions"), "html", null, true);
        echo "</button>
              </div>
            </div>
          </div>
        </div>
      ";
    }

    // line 114
    public function block_javascripts($context, array $blocks = [])
    {
        // line 115
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script src=\"";
        // line 117
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("themes/new-theme/public/order_delivery.bundle.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Sell/Order/Delivery/slip.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  235 => 117,  229 => 115,  226 => 114,  216 => 104,  208 => 99,  202 => 96,  198 => 95,  193 => 93,  186 => 89,  182 => 88,  177 => 86,  170 => 82,  166 => 81,  161 => 79,  153 => 74,  148 => 71,  145 => 70,  135 => 59,  127 => 54,  121 => 51,  117 => 50,  112 => 48,  105 => 44,  101 => 43,  96 => 41,  88 => 36,  83 => 33,  80 => 32,  74 => 111,  71 => 110,  69 => 70,  64 => 68,  59 => 66,  56 => 65,  54 => 32,  48 => 30,  45 => 29,  41 => 25,  39 => 27,  22 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Sell/Order/Delivery/slip.html.twig", "/var/www/html/SENSHOP/src/PrestaShopBundle/Resources/views/Admin/Sell/Order/Delivery/slip.html.twig");
    }
}
