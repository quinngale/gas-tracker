<?php
$site_title = "Gas Tracker";
$flash = array();

function site_head($page_title)
{
    global $site_title;

    echo <<<EOT
    <head>
        <title>$page_title - $site_title</title>

        <link rel="stylesheet" href="/css/bulma.css">
        
        <script src="/js/bulma.js"></script>
        <script src="https://kit.fontawesome.com/3587f0af61.js" crossorigin="anonymous"></script>
    </head>

    EOT;
}

function site_nav()
{
    echo <<<EOT
        <nav class="navbar" role="navigation" aria-label="main navigation">
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
                    <!--- <a class="navbar-item">
                        Documentation
                    </a> --->
                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                        <a href="/account/sign-up" class="button is-light">
                            Sign up
                        </a>
                        <a class="button is-primary">
                            Log in
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    EOT;
}

function site_footer()
{
    echo <<<EOT
        <footer class="footer">
            <div class="container">
                <div class="level">
                    <div class="level-item">
                        <p>
                            Created by <a href="https://quinngale.com" title="Quinn Gale">Quinn Gale</a>
                        </p>
                    </div>
                    <div class="level-item">
                        <a href="https://github.com/gabeauim/gas-tracker" class="button">
                            <span class="icon">
                                <i class="fab fa-github"></i>
                            </span>
                            <span>GitHub</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>

    EOT;
}

function site_top($page_title)
{
    global $flash;

    echo <<<EOT
    <!doctype HTML>
    <html>

    EOT;
    site_head($page_title);

    echo <<<EOT
    <body>
    
    EOT;
    site_nav();

    if (!empty($flash)) {
        echo <<<EOT
                <div class="container">
        EOT;

        foreach ($flash as $message) {
            echo <<<EOT
                        <div class="notification">
                            <button class="delete"></button>
                            $message
                        </div>
            EOT;
        }

        echo <<<EOT
                </div>
        EOT;
    }
}

function site_bottom()
{
    site_footer();

    echo <<<EOT
    </body>
    </html>
    EOT;
}
