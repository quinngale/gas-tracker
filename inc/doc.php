<?php
$site_title = "Gas Tracker";

function site_head($page_title)
{
    global $site_title;

    echo <<<EOT
    <head>
        <title>$page_title - $site_title</title>

        <link rel="stylesheet" href="/css/bulma.css">
        
        <script src="/js/bulma.js"></script>
    </head>
    EOT;
}

function site_header()
{
    echo <<<EOT
    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                Gas Tracker
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="main-nav">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="main-nav" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    Documentation
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                    <a class="button is-link">
                        <strong>Sign up</strong>
                    </a>
                    <a class="button is-light">
                        Log in
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    EOT;
}

function site_top($page_title)
{
    echo <<<EOT
    <html>
    EOT;
    site_head($page_title);

    echo <<<EOT
    <body>
    EOT;
    site_header();
}
