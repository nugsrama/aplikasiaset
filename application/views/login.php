<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<style type="text/css">
    /* Global styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        display: flex;
        background-size: cover;
        justify-content: center;
        align-items: center;
        height: 100vh;
        position: center;
        margin-bottom: 50px;
        background-image: url(<?php echo base_url(); ?>image/login.jpeg)
    }

    /* Container for the login form */
    .login-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    /* Form heading */
    .login-container h2 {
        margin-bottom: 50px;
        font-size: 50px;
        font-family: "Lucida Handwriting", cursive;
        color: green;
    }

    /* Input group styles */
    .input-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .input-group label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }

    .input-group input {
        width: 100%;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 10px;
        font-size: 16px;
        margin-top: 10px;
    }

    /* Button styles */
    button {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .alert {
        color: red;
        size: 10px;
        font-size: 15px;
    }

    .alert-regis {

        color: green;
        size: 10px;
    }

    #text {
        display: none;
        color: red
    }
</style>

<body>

    <div class="login-container">


        <div class="image">



            <form action=" <?php echo site_url('welcome/autentikasi'); ?>" method="post">
                <h1>Asset GA </h1>
                <h2>Login</h2>
                <div class="alert-regis">
                    <?php echo $this->session->flashdata('pesan'); ?>
                </div>

                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Masukan Username Anda" id="username" name="username" value="<?= set_value('username'); ?>" required>
                </div>
                <p id="text">Capslock aktif, matikan capslock!!</p>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Masukan Password Anda" id="password" name="password" value="<?= set_value('password'); ?>" required>
                </div>
                <div class="alert">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <br></br>
                <button type="submit">Login</button>


                <div class="text-center">
                    Belum punya akun? <a href="registrasi">Register</a>
                </div>


            </form>


        </div>


    </div>

    <script>
        var input = document.getElementById("username");
        var text = document.getElementById("text");
        input.addEventListener("keyup", function(event) {

            if (event.getModifierState("CapsLock")) {
                text.style.display = "block";
            } else {
                text.style.display = "none"
            }
        });
    </script>
</body>

</html>