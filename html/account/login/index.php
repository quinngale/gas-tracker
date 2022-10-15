<?php
require '../../../config.php';

if (isset($_SESSION["id"])) {
    header("Location: /dashboard");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =  $_POST['username'];
    $password = $_POST['password'];
    $result = array();

    if ($stmt = $mysqli->prepare('SELECT `id`, `username`, `password` FROM `accounts` WHERE `username_normalized` = ?')) {
        $username_normalized = strtoupper($username);
        $stmt->bind_param('s', $username_normalized);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($result['id'], $result['username'], $result['password']);
            $stmt->fetch();

            if (password_verify($password, $result['password'])) {
                $_SESSION['id'] = $result['id'];
                $_SESSION['username'] = $username;

                header("Location: /dashboard");
                die();
            }
        } else {
            $flash[] = "Invaild credentials";
        }
    }
}

site_top("Log in");
?>
<main class="section">
    <div class="content">
        <div class="columns is-centered">
            <div class="column is-one-third-widescreen is-two-thirds-tablet is-full-mobile">
                <div class="box">
                    <h1 class="title">Login</h1>
                    <form action="./" method="POST">
                        <div class="field">
                            <label class="label" for="username">Username</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" id="username" name="username" placeholder="username" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="password">Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" id="password" name="password" placeholder="Password" required>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-link">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
site_bottom();
