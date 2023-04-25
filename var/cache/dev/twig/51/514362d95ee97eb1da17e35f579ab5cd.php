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

        ";
        // line 10
        echo $this->extensions['Symfony\Bridge\Twig\Extension\DumpExtension']->dump($this->env, $context, (isset($context["testvar"]) || array_key_exists("testvar", $context) ? $context["testvar"] : (function () { throw new RuntimeError('Variable "testvar" does not exist.', 10, $this->source); })()));
        echo "
            
            ";
        // line 13
        echo "            ";
        // line 14
        echo "            ";
        // line 15
        echo "            
            ";
        // line 16
        if ((null === twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "user", [], "any", false, false, false, 16))) {
            // line 17
            echo "                <h1>Willkommen, Gast</h1> 
            ";
        } else {
            // line 19
            echo "                <h1>Willkommen, ";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 19, $this->source); })()), "user", [], "any", false, false, false, 19), "email", [], "any", false, false, false, 19), "html", null, true);
            echo "</h1>
            ";
        }
        // line 21
        echo "            <h2>Deine Umfragen:</h2>
            
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
        // line 37
        if ((null === twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 37, $this->source); })()), "user", [], "any", false, false, false, 37))) {
            // line 38
            echo "                
                    <tr>
                        <td colspan=\"12\"><p>Du bist nicht eingeloggt!</p> </td>
                    </tr>
                ";
        } else {
            // line 43
            echo "                    <tr>
                        <td colspan=\"12\"> <h1> In Arbeit! </h1></td>
                    <tr>
                ";
        }
        // line 47
        echo "                </tbody>
            </table>
                
            
            <h2>Öffentliche Umfragen:</h2>
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
        // line 66
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["umfragen"]) || array_key_exists("umfragen", $context) ? $context["umfragen"] : (function () { throw new RuntimeError('Variable "umfragen" does not exist.', 66, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["umfrage"]) {
            // line 67
            echo "                    <tr>
                        <td>";
            // line 68
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "id", [], "any", false, false, false, 68), "html", null, true);
            echo "</td>
                        <td>";
            // line 69
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "name", [], "any", false, false, false, 69), "html", null, true);
            echo "</td>
                        <td>";
            // line 70
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "email", [], "any", false, false, false, 70), "html", null, true);
            echo "</td>
                        <td>";
            // line 71
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "title", [], "any", false, false, false, 71), "html", null, true);
            echo "</td>
                        <td>";
            // line 72
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "description", [], "any", false, false, false, 72), "html", null, true);
            echo "</td>
                        <td>
                        ";
            // line 74
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["umfrage"], "termins", [], "any", false, false, false, 74));
            foreach ($context['_seq'] as $context["_key"] => $context["date"]) {
                // line 75
                echo "                            <div>";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["date"], "date", [], "any", false, false, false, 75), "d.m.Y h:m"), "html", null, true);
                echo "</div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['date'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 77
            echo "                        </td>
                        <td>";
            // line 78
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["umfrage"], "expiration_date", [], "any", false, false, false, 78), "d.m.Y h:m"), "html", null, true);
            echo "</td>
                        <td>
                        ";
            // line 80
            if ((null === twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 80, $this->source); })()), "user", [], "any", false, false, false, 80))) {
                // line 81
                echo "                            <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"";
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_umfrage", ["id" => twig_get_attribute($this->env, $this->source, $context["umfrage"], "id", [], "any", false, false, false, 81)]), "html", null, true);
                echo "\">Vote</a>
                        ";
            } else {
                // line 83
                echo "                        ";
                echo $this->extensions['Symfony\Bridge\Twig\Extension\DumpExtension']->dump($this->env, $context, $context["umfrage"]);
                echo "
                            ";
                // line 84
                if ((twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 84, $this->source); })()), "user", [], "any", false, false, false, 84) == twig_get_attribute($this->env, $this->source, $context["umfrage"], "loggedInUser", [], "any", false, false, false, 84))) {
                    // line 85
                    echo "                                <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_umfrage", ["id" => twig_get_attribute($this->env, $this->source, $context["umfrage"], "id", [], "any", false, false, false, 85)]), "html", null, true);
                    echo "\">Vote</a>
                                <a class=\"btn btn-warning\" href=\"\">edit</a>
                                <a class=\"btn btn-danger\"  href=\"\">delete</a>
                            ";
                } else {
                    // line 89
                    echo "                                <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"";
                    echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_umfrage", ["id" => twig_get_attribute($this->env, $this->source, $context["umfrage"], "id", [], "any", false, false, false, 89)]), "html", null, true);
                    echo "\">Vote</a>
                            ";
                }
                // line 91
                echo "                        ";
            }
            // line 92
            echo "                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 95
            echo "                    <tr>
                        <td colspan=\"12\">Keine Umfragen</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['umfrage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 99
        echo "                </tbody>
            </table>
            <a class=\"btn btn-primary\" href=\"";
        // line 101
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
        return array (  274 => 101,  270 => 99,  261 => 95,  254 => 92,  251 => 91,  245 => 89,  237 => 85,  235 => 84,  230 => 83,  224 => 81,  222 => 80,  217 => 78,  214 => 77,  205 => 75,  201 => 74,  196 => 72,  192 => 71,  188 => 70,  184 => 69,  180 => 68,  177 => 67,  172 => 66,  151 => 47,  145 => 43,  138 => 38,  136 => 37,  118 => 21,  112 => 19,  108 => 17,  106 => 16,  103 => 15,  101 => 14,  99 => 13,  94 => 10,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Home{% endblock %}

{% block body %}
<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-12\">

        {{ dump(testvar) }}
            
            {# check if app.user.email is set #}
            {# if yes, display the email #}
            {# if not, display the message #}
            
            {% if app.user is null %}
                <h1>Willkommen, Gast</h1> 
            {% else %}
                <h1>Willkommen, {{ app.user.email }}</h1>
            {% endif %}
            <h2>Deine Umfragen:</h2>
            
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
                {% if app.user is null %}
                
                    <tr>
                        <td colspan=\"12\"><p>Du bist nicht eingeloggt!</p> </td>
                    </tr>
                {% else %}
                    <tr>
                        <td colspan=\"12\"> <h1> In Arbeit! </h1></td>
                    <tr>
                {% endif %}
                </tbody>
            </table>
                
            
            <h2>Öffentliche Umfragen:</h2>
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
                        {% if app.user is null %}
                            <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"{{ path('app_umfrage', { 'id': umfrage.id })}}\">Vote</a>
                        {% else %}
                        {{dump(umfrage)}}
                            {% if app.user == umfrage.loggedInUser %}
                                <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"{{ path('app_umfrage', { 'id': umfrage.id })}}\">Vote</a>
                                <a class=\"btn btn-warning\" href=\"\">edit</a>
                                <a class=\"btn btn-danger\"  href=\"\">delete</a>
                            {% else %}
                                <a class=\"btn btn-success d-flex flex-wrap-reverse p-3 mb-1 justify-content-center\" href=\"{{ path('app_umfrage', { 'id': umfrage.id })}}\">Vote</a>
                            {% endif %}
                        {% endif %}
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
", "home/index.html.twig", "D:\\Max Projects\\Symfony\\dritter-versuch\\templates\\home\\index.html.twig");
    }
}
