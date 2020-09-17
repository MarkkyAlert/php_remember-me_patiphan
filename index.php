<?php
session_start();
include('config.php');

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = mysqli_query($dbcon, "SELECT * FROM tblusers WHERE username = '$username' AND password = '$password'");
    $row = mysqli_fetch_array($sql);

    if ($row) {
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $row['username'];

        if (!empty($_POST['remember'])) {
            setcookie('user_login', $_POST['username'], time() + (10 * 365 * 24 * 60 * 60));
            setcookie('user_password', $_POST['password'], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE['user_login'])) {
                setcookie('user_login', '');

                if (isset($_COOKIE['user_password'])) {
                    setcookie('user_password', '');
                }
            }
        }
        header('location: welcome.php');
    } else {
        $msg = 'Invalid Login';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="display-4 mt-4">Login Page</h1>
        <hr>
        <form method="post">
            <?php if (isset($msg)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $msg ?>
                </div <div class="mb-3">
            <?php endif; ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="username" name="username" value="<?php if (isset($_COOKIE['user_login'])) { echo $_COOKIE['user_login'];} ?>">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($_COOKIE['user_password'])) { echo $_COOKIE['user_password'];} ?>">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" <?php if (isset($_COOKIE['user_login'])) { ?> checked <?php } ?>>
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>