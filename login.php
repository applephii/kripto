<?php
include 'db.php';
session_start();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM akun WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['pass'])) {
            $_SESSION['username'] = $username;
            $sql2 = "SELECT id FROM akun WHERE username = ?";
            $stmt = $conn->prepare($sql2);
            $stmt->bind_param("s", $username); 
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();
            
            $_SESSION['user_id'] = $id;
            //$_SESSION['notification'] = ['message' => 'Login Success', 'type' => 'success'];
            $mode = 'caesar';
            $m = 'en';
            $_SESSION['mode'] = $mode;
            $_SESSION['m'] = $m;
            header("Location: index.php?md=$mode&m=en");
            exit();
        } else {
            $_SESSION['notification'] = ['message' => 'Invalid password', 'type' => 'error'];
        }
    } else {
        $_SESSION['notification'] = ['message' => 'User  not found', 'type' => 'error'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        En-
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notifyjs-browser@0.4.2/dist/notify.min.js"></script>
</head>

<body>
    <!-- Notification -->
    <script>
        $(document).ready(function() {
            
            <?php if (isset($_SESSION['notification'])): ?>

                const notification = {
                    status: '<?php echo $_SESSION['notification']['type']; ?>',
                    title: '<?php echo $_SESSION['notification']['type'] === 'success' ? 'Success' : 'Error'; ?>',
                    text: '<?php echo $_SESSION['notification']['message']; ?>',
                };
                
                $('#notifyBtn').on('click', function() {
                    
                    $.notify(notification.text, {
                        className: notification.status, 
                        autoHide: true,
                        clickToHide: true,
                        autoHideDelay: 5000, 
                        position: "top center" 
                    });
                });
                
                $.notify(notification.text, {
                    className: notification.status,
                    autoHide: true,
                    clickToHide: true,
                    autoHideDelay: 5000, 
                    position: "top center", 
                    style: 'bootstrap', 
                });

                <?php unset($_SESSION['notification']);
                ?>
            <?php endif; ?>
        });
    </script>

    <!-- Bubble Elements -->
    <div class="bubble-element" style="width: 100px; height: 100px; top: 10%; left: 20%;">
    </div>
    <div class="bubble-element" style="width: 150px; height: 150px; top: 50%; left: 70%;">
    </div>
    <div class="bubble-element" style="width: 80px; height: 80px; top: 80%; left: 30%;">
    </div>
    <!-- Login Page -->
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-purple-500">
                Login
            </h2>

            <form method="POST">
                <input name="username" class="w-full p-3 mb-4 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-purple-500" placeholder="Username" type="text" />
                <input name="password" class="w-full p-3 mb-4 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-purple-500" placeholder="Password" type="password" />
                <button id="btn" type="submit" value="login" class="w-full p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                    Login
                </button>
            </form>
            <div class="text-center mt-4">
                <a class="text-purple-500 hover:underline" href="signup.php">
                    Don't have an account? Sign up
                </a>
            </div>
        </div>
    </div>

</body>

</html>