<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkLink</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #e4e4e4;
            font-family: 'Poppins', Arial, sans-serif;
        }
        .main-wrapper {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .left-section {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding-left: 7vw;
        }
        .brand-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #4663e4;
            letter-spacing: 1px;
            text-shadow: 2px 2px 0 #bfc6f5;
            margin-bottom: 0.5rem;
        }
        .tagline {
            font-size: 1.3rem;
            color: #222;
            margin-bottom: 0.5rem;
            font-weight: 400;
        }
        .right-section {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 6px 32px rgba(44, 62, 80, 0.07);
            padding: 2.5rem 2.5rem 2rem 2.5rem;
            min-width: 340px;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }
        .card-title {
            font-size: 2rem;
            font-weight: 700;
            color: #4663e4;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: 1px;
            text-shadow: 1px 2px 0 #bfc6f5;
        }
        .role-group {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
            margin-bottom: 2rem;
        }
        .role-option {
            display: flex;
            align-items: center;
            font-size: 1.15rem;
            color: #222;
            font-weight: 500;
        }
        .role-option input[type="radio"] {
            accent-color: #4663e4;
            width: 21px;
            height: 21px;
            margin-right: 12px;
        }
        .main-btn {
            width: 100%;
            padding: 0.85rem 0;
            background: #4663e4;
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            margin-bottom: 1.2rem;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(70, 99, 228, 0.1);
            transition: background 0.2s;
        }
        .main-btn:hover {
            background: #3249b7;
        }
        .divider {
            border: none;
            border-top: 1.5px solid #eee;
            margin: 1.2rem 0;
        }
        .login-btn {
            width: 100%;
            padding: 0.85rem 0;
            background: #4663e4;
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(70, 99, 228, 0.08);
            transition: background 0.2s;
        }
        .login-btn:hover {
            background: #3249b7;
        }
        @media (max-width: 900px) {
            .main-wrapper {
                flex-direction: column;
                align-items: stretch;
            }
            .left-section {
                align-items: center;
                padding: 2rem 0 0 0;
            }
            .right-section {
                justify-content: center;
                margin-bottom: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="left-section">
            <div class="brand-title">WorkLink</div>
            <div class="tagline">Find the Right Hands for Every Work</div>
        </div>
        <div class="right-section">
            <form class="card" method="get" action="">
                <div class="card-title">WorkLink</div>
                <div class="role-group">
                    <label class="role-option">
                        <input type="radio" name="role" value="worker" checked>
                        Worker
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="customer">
                        Customer
                    </label>
                </div>
                <button type="submit" formaction="register_worker.php" class="main-btn" id="createBtn">Create a new</button>
                <hr class="divider">
                <button type="submit" formaction="login.php" class="login-btn">Login</button>
            </form>
        </div>
    </div>
    <script>
        // Change the form action based on selected radio
        const form = document.querySelector('form.card');
        const workerRadio = form.querySelector('input[value="worker"]');
        const customerRadio = form.querySelector('input[value="customer"]');
        const createBtn = document.getElementById('createBtn');

        form.addEventListener('submit', function(e) {
            if (document.querySelector('input[name="role"]:checked').value === 'worker') {
                createBtn.setAttribute('formaction', 'register_worker.php');
            } else {
                createBtn.setAttribute('formaction', 'register_customer.php');
            }
        });

        // Optional: Change the "Create a new" button's formaction live
        workerRadio.addEventListener('change', function() {
            createBtn.setAttribute('formaction', 'register_worker.php');
        });
        customerRadio.addEventListener('change', function() {
            createBtn.setAttribute('formaction', 'register_customer.php');
        });
    </script>
</body>
</html>
