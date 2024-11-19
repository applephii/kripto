<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email']; 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek username
    $checkUsernameSql = "SELECT * FROM akun WHERE username = ?";
    $stmt = $conn->prepare($checkUsernameSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $usernameResult = $stmt->get_result();

    // Cek email
    $checkEmailSql = "SELECT * FROM akun WHERE email = ?";
    $stmt = $conn->prepare($checkEmailSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $emailResult = $stmt->get_result();

    if ($usernameResult->num_rows > 0) {
        $_SESSION['notification'] = ['message' => 'Username already exists.', 'type' => 'error'];
    } elseif ($emailResult->num_rows > 0) {
        $_SESSION['notification'] = ['message' => 'Email already exists.', 'type' => 'error'];
    } else {
        // Insert (new account)
        $sql = "INSERT INTO akun (email, username, pass) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $username, $password);

        if ($stmt->execute()) {
            
                $user_id = $conn->insert_id;
                $table_name = "user_" . $user_id;
                $create_table_query = "CREATE TABLE `$table_name` (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    mode VARCHAR(10),
                    key_used VARCHAR(30),
                    tipe_id INT,
                    teks TEXT,
                    result TEXT,
                    pict_asli LONGBLOB,
                    pict_result LONGBLOB,
                    file_asli LONGBLOB,
                    file_result LONGBLOB,
                    FOREIGN KEY (tipe_id) REFERENCES tipe(id)
                )";

                if ($conn->query($create_table_query) === TRUE){
                    $_SESSION['notification'] = ['message' => 'Sign up success', 'type' => 'success'];
                    $_SESSION['signup'] = 'success';
                    header("Location: login.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
            
        } else {
            echo "Error: " . $stmt->error;
        }
    }


    $stmt->close();
}

$conn->close();
?>

<!-- Sign-In Page -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En-</title>
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
    <div class="min-h-screen flex items-center justify-center ">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-purple-500">
                Sign Up
            </h2>
            <form method="POST">
                <input name="username" class="w-full p-3 mb-4 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-purple-500" placeholder="Username" type="text" required />
                <input name="email" class="w-full p-3 mb-4 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-purple-500" placeholder="Email" type="email" required />
                <input name="password" class="w-full p-3 mb-4 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-purple-500" placeholder="Password" type="password" required />

                <button id="btn" type="submit" value="register" class="w-full p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                    Sign Up
                </button>

            </form>
            <div class="text-center mt-4">
                <a class="text-purple-500 hover:underline" href="login.php">
                    Already have an account? Login
                </a>
            </div>
        </div>
    </div>
</body>

</html>