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
        margin-top: 30px;
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
    .login-form h2 {
        margin-bottom: 20px;
        font-size: 40px;
        color: green;
        font-family: "Lucida Handwriting", cursive;
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
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        margin-top: 5px;
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
</style>

<body>
    <div class="login-container">
        <form class="login-form" method="post" action="<?= base_url('welcome/regis'); ?> ">
            <h2>Registrasi</h2>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" placeholder="Masukan Username Anda" id="username" name="username" unique
                    value="<?= set_value('username'); ?>">
            </div>
            <div class="input-group">
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Masukan Password Anda" id="password" name="password">
                </div>
                <label for=" email">Email</label>
                <input type="text" placeholder="Masukan Email Anda" id="email" name="email" required
                    value="<?= set_value('email'); ?>">
            </div>
            <button type=" submit">Daftar</button>
            <a href="login">ke halaman logins</a>
        </form>

    </div>
</body>

</html>