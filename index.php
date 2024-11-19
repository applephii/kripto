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
</head>

<body>
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
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                
            ?>
                <div class="grid grid-cols-3 gap-4 w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg" style="height: 500px;">
                    <?php
                    if ($message == 'en') {
                        $isEncryptEnabled = true;
                        $isDecryptEnabled = false;
                    } 

                    ?>

                    <!-- Encryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Encryption AES</h2>
                        <input name="plaintext" id="encryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Masukan Teks" value="<?php echo $plain; ?>"/>
                        <div>
                            <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600">Encrypt</button>
                            <input name="keyaes_en" id="keyInput" type="text" class="p-3 bg-gray-600 rounded-lg w-13 h-full" placeholder="Key (alphabet/numeric)" value="<?php echo $isEncryptEnabled ? $key_en : ''; ?>">
                        </div>
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                        <!-- 
                        <button type="submit" name="arrow" id="arrowLeft" value="left" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" disabled>
                            ←
                        </button>
                        -->
                        
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Result AES</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $res_en; ?>" value="<?php echo $res_en; ?>" disabled/>
                        <!-- 
                        <button type="submit" name="kripto" id="decryptButton" value="de" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" disabled>Decrypt</button>
                        -->

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
                $res_en = isset($_SESSION['file_en_res']) ? $_SESSION['xor_en_res'] : '';
                //$res_de = isset($_SESSION['file_de_res']) ? $_SESSION['xor_de_res'] : '';
                $plain = isset($_SESSION['plaintext']) ? $_SESSION['plaintext'] : '';
                $cipher = isset($_SESSION['ciphertext']) ? $_SESSION['ciphertext'] : '';
                $key_en = isset($_SESSION['key_en']) ? $_SESSION['key_en'] : '';
                $x = isset($_SESSION['x']) ? $_SESSION['x'] : '';
                //$key_de = isset($_SESSION['key_de']) ? $_SESSION['key_de'] : '';
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
                        <input name="rfile" id="encryptInput" type="file" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="Pilih file"/>
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
                    </div>

                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Result</h2>
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? '' : $x; ?>" value="<?php echo $isDecryptEnabled ? '' : $x; ?>" disabled/>
                        
                    </div>
                </div>
                <!-- Steganografi -->
            <?php elseif ($mode == "stegano"):
                //$res_en = isset($_SESSION['file_en_res']) ? $_SESSION['xor_en_res'] : '';
                $x = isset($_SESSION['x']) ? $_SESSION['x'] : '';
                $pesan_en = isset($_SESSION['pesan_en']) ? $_SESSION['pesan_en'] : '';
                $img = isset($_SESSION['img_data']) ? $_SESSION['img_data'] : '';
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
                        <h2 class="text-white font-bold">Encryption Steganografi</h2>
                        <input name="pesan" id="keyInput" type="text" class="p-1 bg-gray-600 rounded-lg w-full h-full" placeholder="Pesan" value="<?php echo $isEncryptEnabled ? $pesan_en : ''; ?>" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>
                        
                        <input name="pict" id="encryptInput" type="file" class="p-4 bg-gray-600 rounded-lg w-full h-full form-control" />
                        <button type="submit" name="kripto" id="encryptButton" value="en" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600" <?php echo $isEncryptEnabled ? '' : 'disabled'; ?>>Encrypt</button>
                        
                    </div>

                    <!-- Middle (Arrow) -->
                    <div class="flex flex-col items-center justify-center space-y-8 ">
                        <button type="submit" name="arrow" id="arrowRight" value="right" class="p-3 bg-purple-500 rounded-lg text-white font-bold hover:bg-purple-600 selected">
                            →
                        </button>
                    </div>
                    <?php 
                    $uid = $_SESSION['user_id'];
                    $sql = "SELECT pict_result FROM user_{$uid} WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $stmt->bind_result($fileBlob);
                    $stmt->fetch();
                    $stmt->close();
                    $conn->close();

                    $output = "uploads/file_enkripsi_".$id;
                    file_put_contents($output, $fileBlob);
                    
                    ?>
                    <!-- Decryption -->
                    <div class="flex flex-col justify-center items-center space-y-4 bg-gray-700 rounded-lg p-4">
                        <h2 class="text-white font-bold">Result</h2>
                        <img src="<?php $output; ?>">
                        <input name="ciphertext" id="decryptInput" type="text" class="p-4 bg-gray-600 rounded-lg w-full h-full" placeholder="<?php echo $isDecryptEnabled ? '' : $x; ?>" value="<?php echo $isDecryptEnabled ? '' : $x; ?>" disabled/>
                        
                    </div>
                </div>
                
            <?php endif; ?>
    </form>

    </div>


</body>

</html>