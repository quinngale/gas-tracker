<?php
require '../../../config.php';

if (isset($_SESSION["id"])) {
    header("Location: /dashboard");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username =  $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (!empty($username) && !empty($email) && !empty($password) && !empty($password_confirm)) {
        if ($password != $password_confirm || strlen($password) < 12) $flash[] = "Passwords don't match or password is too short";
        elseif (strlen($username) > 64) $flash[] = "Username is too long. The maximum length is 64 characters.";
        elseif (strlen($email) > 254) $flash[] = "Email is invalid. Please try again.";

        $password = password_hash($password, PASSWORD_DEFAULT);
        $password_confirm = "";

        if (empty($flash)) {
            if ($stmt = $mysqli->prepare("SELECT `id` FROM `accounts` WHERE `email_normalized` = ?")) {
                $stmt->bind_param('s', strtoupper($email));
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows == 0 && $stmt = $mysqli->prepare("SELECT `id` FROM `accounts` WHERE `username_normalized` = ?")) {
                    $stmt->bind_param('s', strtoupper($username));
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows == 0 && $stmt = $mysqli->prepare('INSERT INTO `accounts` (`id`, `email`, `email_normalized`, `username`, `username_normalized`, `password`) VALUES (?, ?, ?, ?, ?, ?)')) {
                        $id = uuid_bin();
                        $stmt->bind_param('bsssss', $id, $email, strtoupper($email), $username, strtoupper($username), $password);
                        $stmt->send_long_data(0, $id);
                        $stmt->execute();
                    } else {
                        $flash[] = "That username is already taken. PLease try another";
                    }
                } else {
                    $flash[] = "This email address is already taken. Please try another";
                }
            }
        }
    } else {
        if (empty($username)) $flash[] = "Please enter a username";
        if (empty($email)) $flash[] = "Please enter a email";
        if (empty($password)) $flash[] = "Please enter a password";
        if (empty($password_confirm)) $flash[] = "Please confirm your password";
    }
}

site_top("Sign Up");
?>
<main class="section">
    <div class="content">
        <div class="columns is-centered">
            <div class="column is-one-third-widescreen is-two-thirds-tablet is-full-mobile">
                <div class="box">
                    <h1 class="title">Sign Up</h1>
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
                            <label class="label" for="email">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" id="email" name="email" placeholder="hannah@example.com" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
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
                            <div class="help">
                                <p class="mb-0"><strong>Requirements</strong></p>
                                <ul class="mt-0">
                                    <li>Minimum 12 characters long</li>
                                </ul>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="password_confirm">Confirm Password</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" id="password_confirm" name="password_confirm" placeholder="Confirm password" required>
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                            </div>
                        </div>

                        <br>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-link">Sign up</button>
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
