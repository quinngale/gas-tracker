<?php
require '../../../config.php';

session_destroy();
$_SESSION = array();

site_top("Home");
?>
<main class="section">
    <div class="content">
        <div class="columns is-centered">
            <div class="column is-one-third-widescreen is-two-thirds-tablet is-full-mobile">
                <div class="box">
                    <h1>Logout</h1>
                    <p>You have been succesully logged out.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
site_bottom();
