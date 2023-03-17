<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* home/index.html.twig */
class __TwigTemplate_f45c8a9ec3053535cfcd2e29aed9edd0 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Home";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-12\">
            <h1>Puudel Project 🐩</h1>

            <table class=\"table\">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Author Email</th>
                        <th>Title</th>
                        <th>Beschreibung</th>
                        <th>Termine</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["umfragen"]) || array_key_exists("umfragen", $context) ? $context["umfragen"] : (function () { throw new RuntimeError('Variable "umfragen" does not exist.', 25, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["umfrage"]) {
            // line 26
            echo "                    <tr>
                        <td>";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "id", [], "any", false, false, false, 27), "html", null, true);
            echo "</td>
                        <td>";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "name", [], "any", false, false, false, 28), "html", null, true);
            echo "</td>
                        <td>";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "email", [], "any", false, false, false, 29), "html", null, true);
            echo "</td>
                        <td>";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "title", [], "any", false, false, false, 30), "html", null, true);
            echo "</td>
                        <td>";
            // line 31
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "description", [], "any", false, false, false, 31), "html", null, true);
            echo "</td>
                        <td>
                        ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["umfrage"], "termins", [], "any", false, false, false, 33));
            foreach ($context['_seq'] as $context["_key"] => $context["date"]) {
                // line 34
                echo "                            <div>";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["date"], "date", [], "any", false, false, false, 34), "d.m.Y h:m"), "html", null, true);
                echo "</div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['date'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "                        </td>
                        <td>";
            // line 37
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "expiration_date", [], "any", false, false, false, 37), "d.m.Y h:m"), "html", null, true);
            echo "</td>
                        <td>
                            <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"\">Vote</a>
                            <a class=\"btn btn-warning\" href=\"\">edit</a>
                            <a class=\"btn btn-danger\"  href=\"\">delete</a>
                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 45
            echo "                    <tr>
                        <td colspan=\"12\">Keine Umfragen</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['umfrage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 49
        echo "                </tbody>
            </table>
            <a class=\"btn btn-primary\" href=\"";
        // line 51
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_create");
        echo "\">Neue Umfrage!</a>
        </div>
    </div>
</div>
    
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "home/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 51,  176 => 49,  167 => 45,  154 => 37,  151 => 36,  142 => 34,  138 => 33,  133 => 31,  129 => 30,  125 => 29,  121 => 28,  117 => 27,  114 => 26,  109 => 25,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Home{% endblock %}

{% block body %}
<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-12\">
            <h1>Puudel Project 🐩</h1>

            <table class=\"table\">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Author Email</th>
                        <th>Title</th>
                        <th>Beschreibung</th>
                        <th>Termine</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                {% for umfrage in umfragen %}
                    <tr>
                        <td>{{ umfrage.id }}</td>
                        <td>{{ umfrage.name }}</td>
                        <td>{{ umfrage.email }}</td>
                        <td>{{ umfrage.title }}</td>
                        <td>{{ umfrage.description }}</td>
                        <td>
                        {% for date in umfrage.termins  %}
                            <div>{{ date.date|date('d.m.Y h:m') }}</div>
                        {% endfor %}
                        </td>
                        <td>{{ umfrage.expiration_date|date('d.m.Y h:m') }}</td>
                        <td>
                            <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"\">Vote</a>
                            <a class=\"btn btn-warning\" href=\"\">edit</a>
                            <a class=\"btn btn-danger\"  href=\"\">delete</a>
                        </td>
                    </tr>
                {% else %}
                    <tr>
                        <td colspan=\"12\">Keine Umfragen</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
            <a class=\"btn btn-primary\" href=\"{{ path('app_create') }}\">Neue Umfrage!</a>
        </div>
    </div>
</div>
    
{% endblock %}
", "home/index.html.twig", "D:\\Projects\\Puudel\\templates\\home\\index.html.twig");
    }
}
