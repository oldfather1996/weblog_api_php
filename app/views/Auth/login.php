<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        background-color: slategrey;
    }

    .container {
        width: 50vw;
        margin: auto;
        margin-top: 12vh;
    }

    .form-group {
        padding-bottom: 10px;
        display: flex;
        flex-direction: column;
        font-size: large;   
    }

    button {
        font-size: large;
    }

    h1 {
        text-align: center;
    }
</style>

<body>
    <?php
    function doLogin($username = null, $password = null)
    {
        global $mysqli;
        $stmt = $mysqli->prepare('SELECT * FROM users where username=? and acitive=1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) :
            $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Your account have not been enable. please contact an adminstor');
        else :
            while ($row = $result->fetch_assoc()) {
                $_SESSION['user']['id'] = $row['id'];
                $_SESSION['user']['username'] = $row['username'];
                $_SESSION['user']['email'] = $row['email'];
                header('Location: ../admin/project');
            }
        endif;
        $stmt->close();
    }
    ?>
    <?php
    if (isset($_POST['btnLogin'])) :
        $username = $_POST['username'];
        $password = $_POST['password'];
        doLogin($username, $password);
    endif;
    ?>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['message']['type']; ?>" role="alert">
            <?php echo $_SESSION["message"]['msg']; ?>
        </div>
        <?php unset($_SESSION['message']) ?>
    <?php endif; ?>
    <div class="container">
        <h1>User Login</h1>
        <form action="" method="post" class="login">
            <label for="userName">User Name</label>
            <input type="text" name="userName" id="userName" class="form-control">
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <div>
                <button id="btnLogin">Login</button>
            </div>
        </form>
    </div>
    <script src="login.js" defer></script>
</body>

</html>