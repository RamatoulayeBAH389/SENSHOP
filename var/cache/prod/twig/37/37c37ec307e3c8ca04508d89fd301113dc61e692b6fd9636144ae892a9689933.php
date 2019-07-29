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

/* @PrestaShop/Admin/Improve/Design/MailTheme/Blocks/generate_mails_form.html.twig */
class __TwigTemplate_4f3a0beeec2964f03331104800b653f574d3492b41b89d30cabad713fec90fb2 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'generateMailsFormBlock' => [$this, 'block_generateMailsFormBlock'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 25
        echo "
";
        // line 26
        $this->displayBlock('generateMailsFormBlock', $context, $blocks);
    }

    public function block_generateMailsFormBlock($context, array $blocks = [])
    {
        // line 27
        echo "<div class=\"row justify-content-center\">
  <div class=\"col-xl-10\">
    ";
        // line 29
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["generateMailsForm"] ?? null), 'form_start', ["action" => $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("admin_mail_theme_generate")]);
        echo "
    <div class=\"card\">
      <h3 class=\"card-header\">
        <i class=\"material-icons\">email</i> ";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Generate emails", [], "Admin.Design.Feature"), "html", null, true);
        echo "
      </h3>

      <div class=\"card-block row\">
        <div class=\"card-text\">

          <div class=\"form-group row\">
            <label class=\"form-control-label\">
              ";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Select your email theme", [], "Admin.Design.Feature"), "html", null, true);
        echo "
            </label>
            <div class=\"col-sm\">
              ";
        // line 43
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "mailTheme", []), 'errors');
        echo "
              ";
        // line 44
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "mailTheme", []), 'widget');
        echo "
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">
              ";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Select your language", [], "Admin.International.Feature"), "html", null, true);
        echo "
            </label>
            <div class=\"col-sm\">
              ";
        // line 53
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "language", []), 'errors');
        echo "
              ";
        // line 54
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "language", []), 'widget');
        echo "
            </div>
          </div>

          <div class=\"form-group row\">
            <label class=\"form-control-label\">
              ";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute(($context["ps"] ?? null), "label_with_help", [0 => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Select the theme you want to overwrite", [], "Admin.Design.Feature"), 1 => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("PrestaShop's email templates are stored in the \"mails\" folder, but they can be overridden by your current theme's own \"mails\" folder. Using this option enables to overwrite emails from your current theme.", [], "Admin.Design.Help")], "method"), "html", null, true);
        // line 63
        echo "
            </label>
            <div class=\"col-sm\">
              ";
        // line 66
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "theme", []), 'errors');
        echo "
              ";
        // line 67
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "theme", []), 'widget');
        echo "
              ";
        // line 68
        if ($this->getAttribute($this->getAttribute($this->getAttribute(($context["generateMailsForm"] ?? null), "theme", []), "vars", []), "disabled", [])) {
            // line 69
            echo "              <small class=\"form-text\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("No emails were detected in any theme folder so this field is disabled.", [], "Admin.Design.Help"), "html", null, true);
            echo "</small>
              ";
        }
        // line 71
        echo "            </div>
          </div>

          <div class=\"form-group row\">
            ";
        // line 75
        echo twig_escape_filter($this->env, $this->getAttribute(($context["ps"] ?? null), "label_with_help", [0 => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Overwrite templates", [], "Admin.Design.Feature"), 1 => $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("By default, existing email template files are not modified to avoid deleting any modification you may have done. Enable this option to force the overwrite.", [], "Admin.Design.Help")], "method"), "html", null, true);
        // line 78
        echo "
            <div class=\"col-sm\">
              ";
        // line 80
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "overwrite", []), 'errors');
        echo "
              ";
        // line 81
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($this->getAttribute(($context["generateMailsForm"] ?? null), "overwrite", []), 'widget');
        echo "
            </div>
          </div>

        </div>
      </div>

      <div class=\"card-footer\">
        <div class=\"d-flex justify-content-end\">
          <button class=\"btn btn-primary\">
            <i class=\"material-icons\">email</i>
            <span>";
        // line 92
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("Generate emails", [], "Admin.Actions"), "html", null, true);
        echo "</span>
          </button>
        </div>
      </div>
    </div>
    ";
        // line 97
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock(($context["generateMailsForm"] ?? null), 'form_end');
        echo "
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/generate_mails_form.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  160 => 97,  152 => 92,  138 => 81,  134 => 80,  130 => 78,  128 => 75,  122 => 71,  116 => 69,  114 => 68,  110 => 67,  106 => 66,  101 => 63,  99 => 60,  90 => 54,  86 => 53,  80 => 50,  71 => 44,  67 => 43,  61 => 40,  50 => 32,  44 => 29,  40 => 27,  34 => 26,  31 => 25,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "@PrestaShop/Admin/Improve/Design/MailTheme/Blocks/generate_mails_form.html.twig", "/var/www/html/SENSHOP/src/PrestaShopBundle/Resources/views/Admin/Improve/Design/MailTheme/Blocks/generate_mails_form.html.twig");
    }
}
