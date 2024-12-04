<?php
include 'db.php';
session_start();
// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
} else {
    $username = '';
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>En-</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
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
    
    <!-- Main Container -->
    <form method="POST" action="process.php" enctype="multipart/form-data">
        <div class="min-h-screen flex items-center justify-center p-8">
            <div class="flex flex-col space-y-3 bg-gray-900 bg-opacity-95 p-4 rounded-lg w-64" style="height: 500px; width: 200px">
                <h4>@<?php echo $username; ?></h4>
                <hr>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="caesar">Caesar Cipher</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="vigenere">Vigenere Cipher</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="railfence">Rail Fence Cipher</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="aes">AES</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="xor">XOR</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="rc4">RC4</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="super">Super Enkripsi</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="stegano">Steganografi</button>
                <button type="submit" name="mode" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="file">File</button>
                <button type="submit" name="aksi" class="p-1/2 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" value="history">History</button>
                <button type="submit" name="aksi" class="p-1 bg-red-500 rounded-lg text-white font-bold hover:bg-red-600" value="logout">Logout</button>
            </div>

            <?php
            $mode = isset($_GET['md']) ? $_GET['md'] : 'caesar';
            $isEncryptEnabled = true;
            $isDecryptEnabled = false;
            $result_en = '';
            $result_de = '';
            $key_en = '';
            $key_de = '';
            $x = '';

            $message = isset($_GET['m']) ? $_GET['m'] : 'en';
            ?>
            <!-- Klasik: Caesar Cipher -->
            <?php if ($mode == "caesar"):
                $res_en = isset($_SESSION['caesar_en_res']) ? $_SESSION['caesar_en_res'] : '';
                $res_de = isset($_SESSION['caesar_de_res']) ? $_SESSION['caesar_de_res'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption Caesar Cipher</h2>
                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isEncryptEnabled ? 'Masukan Teks' : $res_de; ?>" value="<?php echo $isEncryptEnabled ? $plain : $res_de; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="keycaesar_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (numeric)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Decryption Caesar Cipher</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? 'Masukkan Teks' : $res_en; ?>" value="<?php echo $isDecryptEnabled ? $cipher : $res_en; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="keycaesar_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (numeric)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>

                    </div>
                </div>
                <!-- Klasik: Vigenere Cipher -->
            <?php elseif ($mode == "vigenere"):
                $res_en = isset($_SESSION['vi_en_res']) ? $_SESSION['vi_en_res'] : '';
                $res_de = isset($_SESSION['vi_de_res']) ? $_SESSION['vi_de_res'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption Vigenere Cipher</h2>
                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isEncryptEnabled ? 'Masukan Teks' : $res_de; ?>" value="<?php echo $isEncryptEnabled ? $plain : $res_de; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="keyvi_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Decryption Vigenere Cipher</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? 'Masukkan Teks' : $res_en; ?>" value="<?php echo $isDecryptEnabled ? $cipher : $res_en; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="keyvi_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>

                    </div>
                </div>
                <!-- Klasik: Rail Fence Cipher -->
            <?php elseif ($mode == "railfence"):
                $res_en = isset($_SESSION['rf_en_res']) ? $_SESSION['rf_en_res'] : '';
                $res_de = isset($_SESSION['rf_de_res']) ? $_SESSION['rf_de_res'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption Rail Fence Cipher</h2>
                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isEncryptEnabled ? 'Masukan Teks' : $res_de; ?>" value="<?php echo $isEncryptEnabled ? $plain : $res_de; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="keyrf_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (numberic)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Decryption Rail Fence Cipher</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? 'Masukkan Teks' : $res_en; ?>" value="<?php echo $isDecryptEnabled ? $cipher : $res_en; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="keyrf_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (numberic)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>

                    </div>
                </div>
                <!-- Modern: AES -->
            <?php elseif ($mode == "aes"):
                $res_en = isset($_SESSION['aes_en_res']) ? $_SESSION['aes_en_res'] : '';
                $res_de = isset($_SESSION['aes_de_res']) ? $_SESSION['aes_de_res'] : '';
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption AES</h2>
                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isEncryptEnabled ? 'Masukan Teks' : $res_de; ?>" value="<?php echo $isEncryptEnabled ? $plain : $res_de; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>/>
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="keyaes_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                       
                        
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Decryption AES</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? 'Masukkan Teks' : $res_en; ?>" value="<?php echo $isDecryptEnabled ? $cipher : $res_en; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="keyaes_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>
                </div>
                <!-- Modern: XOR -->
            <?php elseif ($mode == "xor"):
                $res_en = isset($_SESSION['xor_en_res']) ? $_SESSION['xor_en_res'] : '';
                $res_de = isset($_SESSION['xor_de_res']) ? $_SESSION['xor_de_res'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption XOR</h2>
                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isEncryptEnabled ? 'Masukan Teks' : $res_de; ?>" value="<?php echo $isEncryptEnabled ? $plain : $res_de; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="keyxor_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Decryption XOR (hex)</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? 'Masukkan Teks' : $res_en; ?>" value="<?php echo $isDecryptEnabled ? $cipher : $res_en; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="keyxor_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>

                    </div>
                </div>
                <!-- Modern: RC4 -->
            <?php elseif ($mode == "rc4"):
                $res_en = isset($_SESSION['rc4_en_res']) ? $_SESSION['rc4_en_res'] : '';
                $res_de = isset($_SESSION['rc4_de_res']) ? $_SESSION['rc4_de_res'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption RC4</h2>
                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isEncryptEnabled ? 'Masukan Teks' : $res_de; ?>" value="<?php echo $isEncryptEnabled ? $plain : $res_de; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="keyrc4_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Decryption RC4 (hex)</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? 'Masukkan Teks' : $res_en; ?>" value="<?php echo $isDecryptEnabled ? $cipher : $res_en; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?> />
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="keyrc4_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>

                    </div>
                </div>
                <!-- Super Enkripsi -->
            <?php elseif ($mode == "super"):
                $res_en = isset($_SESSION['super_en_res']) ? $_SESSION['super_en_res'] : '';
                $res_de = isset($_SESSION['super_de_res']) ? $_SESSION['super_de_res'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
                $keyxor_en = isset($_SESSION['keyxor_en']) ? $_SESSION['keyxor_en'] : '';
                $keyc_en = isset($_SESSION['keyc_en']) ? $_SESSION['keyc_en'] : '';
                $keyvi_en = isset($_SESSION['keyvi_en']) ? $_SESSION['keyvi_en'] : '';
                $keyxor_de = isset($_SESSION['keyxor_de']) ? $_SESSION['keyxor_de'] : '';
                $keyc_de = isset($_SESSION['keyc_de']) ? $_SESSION['keyc_de'] : '';
                $keyvi_de = isset($_SESSION['keyvi_de']) ? $_SESSION['keyvi_de'] : '';

                 ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }
                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Super Encryption</h2>

                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isEncryptEnabled ? 'Masukan Teks' : $res_de; ?>" value="<?php echo $isEncryptEnabled ? $plain : $res_de; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?> />

                        
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                        <div>
                            <input name="keycaesar_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-full h-5" placeholder="Caesar (numeric)" value="<?php echo $isEncryptEnabled ? $keyc_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                            <input name="keyvi_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-full h-5" placeholder="Vigenere (alphabet)" value="<?php echo $isEncryptEnabled ? $keyvi_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                            <input name="keyxor_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-full h-5" placeholder="XOR (alphabet/numeric)" value="<?php echo $isEncryptEnabled ? $keyxor_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Super Decryption</h2>

                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? 'Masukkan Teks' : $res_en; ?>" value="<?php echo $isDecryptEnabled ? $cipher : $res_en; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?> />

                        <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                        <div>
                            <input name="keycaesar_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-full h-5" placeholder="Caesar (numeric)" value="<?php echo $isDecryptEnabled ? $keyc_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                            <input name="keyvi_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-full h-5" placeholder="Vigenere (alphabet)" value="<?php echo $isDecryptEnabled ? $keyvi_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                            <input name="keyxor_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-full h-5" placeholder="XOR (alphabet/numeric)" value="<?php echo $isDecryptEnabled ? $keyxor_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>
                </div>
                <!-- File -->
            <?php elseif ($mode == "file"):
               
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption File (AES)</h2>
                        <label for="file">Upload your document (pdf/doc/docx/txt):</label>
                        <input name="file" id="encryptInput" type="file" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Pilih file" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>/>
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="file_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>
                    
                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Decryption File (AES)</h2>
                        <label for="filed">Upload your document (pdf/doc/docx/txt):</label>
                        <input name="filed" id="decryptInput" type="file" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Pilih file" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>/>
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="file_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>
                </div>
                <!-- Steganografi -->
            <?php elseif ($mode == "stegano"):
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
                $pesan_en = isset($_SESSION['pesan_en']) ? $_SESSION['pesan_en'] : '';
                $pesan_de = isset($_SESSION['pesan_de']) ? $_SESSION['pesan_de'] : '';
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } elseif ($message == 'de') {
                        $isEncryptEnabled = false;
                        $isDecryptEnabled = true;
                    }

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Hide Message in Image</h2>
                        <label for="files">Upload your image (jpg/jpeg/png):</label>
                        <input name="files" id="encryptInput" type="file" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Pilih file" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>/>
                        <input name="pesan_en" id="pesanEnInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Masukkan pesan" value="<?php echo $isEncryptEnabled ? $pesan_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>/>
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                            <input name="keys_en" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Caesar Key (numeric)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>
                    
                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">
                            ←
                        </button>
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Get Message in Image</h2>
                        <label for="filesd">Upload your image (jpg/jpeg/png):</label>
                        <input name="filesd" id="decryptInput" type="file" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Pilih file" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>/>
                        <input name="pesan_de" id="pesanDeInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Refresh page untuk pesan" value="<?php echo $isDecryptEnabled ? $pesan_de : ''; ?>"/>
                        <div>
                            <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>Decrypt</button>
                            <input name="keys_de" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-13 h-full" placeholder="Caesar Key (numeric)" value="<?php echo $isDecryptEnabled ? $key_de : ''; ?>" <?php echo $isDecryptEnabled ? '' : 'disabled'; ?>>
                        </div>
                    </div>
                </div>
                
            <?php endif; ?>
    </form>

    </div>

</body>

</html>