<?php
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['loginmasuk'])) {
    header('Location: ../signin.php');
    exit;
}

// Check if the user submitted the logout form
if (isset($_POST['logout'])) {
    // Perform logout actions
    $_SESSION = [];
    session_unset();
    session_destroy();
    header('Location: ../signin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <style>
        body {
            overflow: hidden;
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .card {
            overflow: hidden;
            position: relative;
            background-color: #ffffff;
            text-align: left;
            border-radius: 0.5rem;
            max-width: 290px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .header {
            padding: 1.25rem 1rem 1rem 1rem;
            background-color: #ffffff;
        }

        .image {
            display: flex;
            margin-left: auto;
            margin-right: auto;
            background-color: #FEE2E2;
            flex-shrink: 0;
            justify-content: center;
            align-items: center;
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
        }

        .image svg {
            color: #DC2626;
            width: 1.5rem;
            height: 1.5rem;
        }

        .content {
            margin-top: 0.75rem;
            text-align: center;
        }

        .title {
            color: #111827;
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.5rem;
        }

        .message {
            margin-top: 0.5rem;
            color: #6B7280;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .actions {
            margin: 0.75rem 1rem;
            background-color: #F9FAFB;
        }

        .desactivate,
        .cancel {
            display: inline-flex;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            line-height: 1.5rem;
            font-weight: 500;
            justify-content: center;
            width: 100%;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .desactivate {
            background-color: #DC2626;
            color: #ffffff;
            border: none;
        }

        .cancel {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #D1D5DB;
            margin-top: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="header">
            <div class="image">
                <svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                    <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg>
            </div>
            <div class="content">
                <span class="title">Keluar Akun</span>
                <p class="message">Apakah Anda yakin ingin keluar dari akun ini?</p>
            </div>
            <div class="actions">
                <form method="post" action="">
                    <button class="desactivate" type="submit" name="logout">Log out</button>
                </form>
                <button class="cancel" type="button" onclick="cancelLogout()">Batal</button>
            </div>
        </div>
    </div>

    <script>
        function cancelLogout() {
            // Redirect or perform other actions when the user cancels logout
            window.location.href = '../dsb-halaman-utama.php';
        }
    </script>
</body>

</html>
