<?php
include 'db.php';
session_start();

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'logout') {
        session_start();
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    } elseif ($_POST['aksi'] == 'history') {
        header('Location: history.php');
        exit();
    } elseif ($_POST['aksi'] == 'back') {
        header("Location: index.php?md=caesar&m=en");
        exit();
    }
}

if (isset($_POST['mode'])) {
    $mode = $_POST['mode'];
    if ($mode == 'aes') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['aes_en_res']);
        unset($_SESSION['aes_de_res']);
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        // unset($_SESSION['iv']);
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'xor') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['xor_en_res']);
        unset($_SESSION['xor_de_res']);
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['iv']);
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'caesar') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['caesar_en_res']);
        unset($_SESSION['caesar_de_res']);
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'vigenere') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['vi_en_res']);
        unset($_SESSION['vi_de_res']);
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'railfence') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['rf_en_res']);
        unset($_SESSION['rf_de_res']);
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'rc4') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['rc4_en_res']);
        unset($_SESSION['rc4_de_res']);
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'super') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['super_en_res']);
        unset($_SESSION['super_de_res']);
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['keyvi_en']);
        unset($_SESSION['keyc_en']);
        unset($_SESSION['keyxor_en']);
        unset($_SESSION['keyvi_de']);
        unset($_SESSION['keyc_de']);
        unset($_SESSION['keyxor_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'stegano') {
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        unset($_SESSION['pesan_en']);
        unset($_SESSION['pesan_de']);
        unset($_SESSION['x']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'file') {
        unset($_SESSION['mode']);
        unset($_SESSION['m']);
        unset($_SESSION['key_en']);
        unset($_SESSION['key_de']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        unset($_SESSION['x']);
        header("Location: index.php?md=$mode&m=$m");
        exit();
    }
}

$m = 'en';
if (isset($_POST['arrow'])) {
    $mode = $_SESSION['mode'];
    if ($_POST['arrow'] == 'right') {
        $m = "en";
        $_SESSION['m'] = $m;
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['caesar_en_res']);
        unset($_SESSION['aes_en_res']);
        unset($_SESSION['vi_en_res']);
        unset($_SESSION['xor_en_res']);
        unset($_SESSION['super_en_res']);
        unset($_SESSION['key_en']);
        unset($_SESSION['keyvi_en']);
        unset($_SESSION['keyc_en']);
        unset($_SESSION['keyxor_en']);
        unset($_SESSION['pesan_en']);
        // unset($_SESSION['x']);
        unset($_SESSION['rf_en_res']);
        unset($_SESSION['rc4_en_res']);
        unset($_SESSION['pesan_en']);

        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($_POST['arrow'] == 'left') {
        $m = "de";
        $_SESSION['m'] = $m;
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['caesar_de_res']);
        unset($_SESSION['aes_de_res']);
        unset($_SESSION['vi_de_res']);
        unset($_SESSION['xor_de_res']);
        unset($_SESSION['super_de_res']);
        unset($_SESSION['key_de']);
        unset($_SESSION['keyvi_de']);
        unset($_SESSION['keyc_de']);
        unset($_SESSION['keyxor_de']);
        unset($_SESSION['rf_de_res']);
        unset($_SESSION['rc4_de_res']);
        unset($_SESSION['pesan_de']);

        header("Location: index.php?md=$mode&m=$m");
        exit();
    }
}

if (isset($_POST['kripto'])) {
    $kripto = $_POST['kripto'];
    $_SESSION['m'] = $_POST['kripto'];
    $m = $_SESSION['m'];
    $uid = $_SESSION['user_id'];

    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

    $c = new CaesarCipher();
    $v = new VigenereCipher();
    $x = new XORCipher();
    $rf = new railFence();
    $rc = new RC4();

    if ($kripto == 'en') {
        $tipe = 1;
        $plaintext = isset($_POST['plaintext']) ? $_POST['plaintext'] : '';
        if ($plaintext != "") {
            $_SESSION['plaintext'] = $_POST['plaintext'];
        }

        if (isset($_SESSION['mode'])) {
            $mode = $_SESSION['mode'];
            if ($mode == 'caesar') {
                if ($plaintext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=caesar&m=en"); // Redirect back to the index page
                    exit;
                }

                // Caesar Cipher
                $caesarKey = $_POST['keycaesar_en'];

                if ($caesarKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=caesar&m=en"); // Redirect back to the index page
                    exit;
                }

                $encryptedCaesar = $c->encrypt($plaintext, $caesarKey);

                $_SESSION['key_en'] = $caesarKey;
                $_SESSION['caesar_en_res'] = $encryptedCaesar;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $caesarKey, $tipe, $plaintext, $encryptedCaesar);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'vigenere') {
                if ($plaintext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=vigenere&m=en"); // Redirect back to the index page
                    exit;
                }

                // Vigenere Cipher
                $viKey = $_POST['keyvi_en'];

                if ($viKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=vigenere&m=en"); // Redirect back to the index page
                    exit;
                }

                $encryptedVigenere = $v->encrypt($plaintext, $viKey);

                $_SESSION['key_en'] = $viKey;
                $_SESSION['vi_en_res'] = $encryptedVigenere;
                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $viKey, $tipe, $plaintext, $encryptedVigenere);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'railfence') {
                if ($plaintext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=railfence&m=en"); // Redirect back to the index page
                    exit;
                }

                // Rail Fence Cipher
                $rfKey = $_POST['keyrf_en'];

                if ($rfKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=railfence&m=en"); // Redirect back to the index page
                    exit;
                }

                $encryptedRF = $rf->encrypt($plaintext, $rfKey);


                $_SESSION['key_en'] = $rfKey;
                $_SESSION['rf_en_res'] = $encryptedRF;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $rfKey, $tipe, $plaintext, $encryptedRF);

                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'aes') {
                if ($plaintext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=aes&m=en"); // Redirect back to the index page
                    exit;
                }

                // AES
                $aeskey = $_POST['keyaes_en'];

                if ($aeskey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=aes&m=en"); // Redirect back to the index page
                    exit;
                }

                $encryptedAES = openssl_encrypt($plaintext, 'aes-256-cbc', $aeskey, 0, $iv);

                // Encode the IV dan encrypted data dalam Base64
                $ivBase64 = base64_encode($iv);
                $encryptedDataBase64 = base64_encode($encryptedAES);

                $finalAES = $iv . "::" . $encryptedDataBase64;

                $_SESSION['key_en'] = $aeskey;
                $_SESSION['aes_en_res'] = $finalAES;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $aeskey, $tipe, $plaintext, $finalAES);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'xor') {
                if ($plaintext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=xor&m=en"); // Redirect back to the index page
                    exit;
                }

                // XOR
                $xorkey = $_POST['keyxor_en'];
                if ($xorkey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=xor&m=en"); // Redirect back to the index page
                    exit;
                }

                $encryptedXOR = $x->encrypt($plaintext, $xorkey);
                $_SESSION['key_en'] = $xorkey;
                $_SESSION['xor_en_res'] = $encryptedXOR;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $xorkey, $tipe, $plaintext, $encryptedXOR);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'rc4') {
                if ($plaintext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=rc4&m=en"); // Redirect back to the index page
                    exit;
                }

                // RC4
                $rckey = $_POST['keyrc4_en'];
                if ($rckey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=rc4&m=en"); // Redirect back to the index page
                    exit;
                }

                $encryptedRC4 = bin2hex($rc->encrypt($plaintext, $rckey));
                $_SESSION['keyrc4_en'] = $rckey;
                $_SESSION['rc4_en_res'] = $encryptedRC4;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $rckey, $tipe, $plaintext, $encryptedRC4);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'super') {
                if ($plaintext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=super&m=en"); // Redirect back to the index page
                    exit;
                }

                // Super
                $xorkey = $_POST['keyxor_en'];
                $caesarKey = $_POST['keycaesar_en'];
                $viKey = $_POST['keyvi_en'];

                if ($caesarKey == "" && $xorkey == "" && $viKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=super&m=en"); // Redirect back to the index page
                    exit;
                }

                $encryptedCaesar = $c->encrypt($plaintext, $caesarKey);
                $encryptedVigenere = $v->encrypt($encryptedCaesar, $viKey);
                $encryptedXOR = $x->encrypt($encryptedVigenere, $xorkey);

                $_SESSION['keyxor_en'] = $xorkey;
                $_SESSION['keyc_en'] = $caesarKey;
                $_SESSION['keyvi_en'] = $viKey;
                $_SESSION['super_en_res'] = $encryptedXOR;
                $combinedKeys = $xorkey . "," . $caesarKey . "," . $viKey;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $combinedKeys, $tipe, $plaintext, $encryptedXOR);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'file') {
                // FILE
                if (isset($_FILES['file'])) {
                    $key = $_POST['file_en'];
                    if ($key == "") {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Input key',
                        ];
                        header("Location: index.php?md=file&m=en"); // Redirect back to the index page
                        exit;
                    }

                    $targetDir = 'en_files/'; //directory untuk upload file
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $fileTmp = $_FILES['file']['tmp_name'];
                    $fileName = $_FILES['file']['name'];
                    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    //cek apakah jenis file diperbolehkan
                    $allowedType = array('pdf', 'doc', 'docx', 'txt');
                    if (!in_array($fileType, $allowedType)) {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Invalid file type. Please upload JPEG, PNG, or PDF files only.',
                        ];
                        header("Location: index.php?md=file&m=en"); // Redirect back to the index page
                        exit;
                    }

                    $targetPath = $targetDir . 'encrypted_' . pathinfo($fileName, PATHINFO_FILENAME) . '.' . $fileType;

                    $cipher = "AES-256-CBC";
                    $iv_file = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));

                    //membaca isi uploaded file
                    $fileContent = file_get_contents($fileTmp);
                    if ($fileContent === false) {
                        die("Failed to read uploaded file.");
                    }

                    // enkripsi
                    $encryptedData = openssl_encrypt($fileContent, 'aes-256-cbc', $key, 0, $iv);

                    if ($encryptedData === false) {
                        die("Encryption failed.");
                    }

                    // Encode the IV dan encrypted data dalam Base64
                    $ivBase64 = base64_encode($iv);
                    $encryptedDataBase64 = base64_encode($encryptedData);

                    // Gabungkan IV and encrypted data dengan separator ("::")
                    $finalData = $ivBase64 . "::" . $encryptedDataBase64;

                    // Save
                    if (file_put_contents($targetPath, $finalData) === false) {
                        die("Failed to save encrypted file.");
                    }

                    $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, file_path, file_name) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("ssiss", $mode, $key, $tipe, $targetPath, $fileName);
                        if ($stmt->execute()) {
                            $_SESSION['key_en'] = $key;

                            header('Content-Type: application/octet-stream');
                            header('Content-Disposition: attachment; filename="' . basename($targetPath) . '"');
                            header('Content-Length: ' . filesize($targetPath));

                            readfile($targetPath);
                            exit();
                        } else {
                            echo "Error inserting data: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "No File uploaded";
                    }
                }
            } elseif ($mode == 'stegano') {
                // STEGANOGRAFI
                if (isset($_FILES['files'])) {
                    $key = $_POST['keys_en'];
                    if ($key == "") {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Input key',
                        ];
                        header("Location: index.php?md=stegano&m=en"); // Redirect back to the index page
                        exit;
                    }

                    $pesan = $_POST['pesan_en'];
                    if ($key == "") {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Input pesan',
                        ];
                        header("Location: index.php?md=stegano&m=en"); // Redirect back to the index page
                        exit;
                    }

                    $targetDir = 'en_img/';
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $fileTmp = $_FILES['files']['tmp_name'];
                    $fileName = $_FILES['files']['name'];
                    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    // Cek apakah jenis file diperbolehkan
                    $allowedType = array('jpg', 'jpeg', 'png');
                    if (!in_array($fileType, $allowedType)) {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Invalid file type.'
                        ];
                        header("Location: index.php?md=stegano&m=en"); // Redirect back to the index page
                        exit;
                    }

                    $image = file_get_contents($fileTmp); // Membaca gambar
                    if (!$image) {
                        die("Gambar tidak dapat dibaca!");
                    }

                    $hiddenMessage = $c->encrypt($pesan, $key);
                    $messageLength = strlen($hiddenMessage);
                    $messageWithLength = $messageLength . '|' . $hiddenMessage;
                    $imageWithMessage = $messageWithLength . $image;

                    $outputPath = $targetDir . 'hidden_message_' . pathinfo($fileName, PATHINFO_FILENAME) . '.png';

                    if (file_put_contents($outputPath, $imageWithMessage) === false) {
                        die("Gagal menyimpan gambar dengan pesan.");
                    }

                    $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result, pict_path, pict_name) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("ssissss", $mode, $key, $tipe, $pesan, $hiddenMessage, $outputPath, $fileName);
                        if ($stmt->execute()) {
                            $_SESSION['key_en'] = $key;
                            $_SESSION['pesan_en'] = $pesan;

                            header('Content-Type: application/octet-stream');
                            header('Content-Disposition: attachment; filename="' . basename($outputPath) . '"');
                            header('Content-Length: ' . filesize($outputPath));

                            readfile($outputPath);
                            exit();
                        } else {
                            echo "Error inserting data: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "No File uploaded";
                    }
                }
            }
        }
    } elseif ($kripto == 'de') {
        $tipe = 0;
        $ciphertext = isset($_POST['ciphertext']) ? $_POST['ciphertext'] : '';;

        if (isset($_SESSION['mode'])) {
            $mode = $_SESSION['mode'];
            if ($mode == 'caesar') {
                if ($ciphertext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=caesar&m=de"); // Redirect back to the index page
                    exit;
                }

                // Caesar Cipher
                $caesarKey = $_POST['keycaesar_de'];
                if ($caesarKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=caesar&m=de"); // Redirect back to the index page
                    exit;
                }

                $decryptedCaesar = $c->decrypt($ciphertext, $caesarKey);

                $_SESSION['key_de'] = $caesarKey;
                $_SESSION['caesar_de_res'] = $decryptedCaesar;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $caesarKey, $tipe, $ciphertext, $decryptedCaesar);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'vigenere') {
                if ($ciphertext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=vigenere&m=de"); // Redirect back to the index page
                    exit;
                }

                // Vigenere Cipher
                $viKey = $_POST['keyvi_de'];
                if ($viKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=vigenere&m=de"); // Redirect back to the index page
                    exit;
                }

                $decryptedVigenere = $v->decrypt($ciphertext, $viKey);

                $_SESSION['key_de'] = $viKey;
                $_SESSION['vi_de_res'] = $decryptedVigenere;
                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $viKey, $tipe, $ciphertext, $decryptedVigenere);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'railfence') {
                if ($ciphertext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=railfence&m=de"); // Redirect back to the index page
                    exit;
                }

                // Rail Fence Cipher
                $rfKey = $_POST['keyrf_de'];
                if ($rfKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=railfence&m=de"); // Redirect back to the index page
                    exit;
                }

                $decryptedRF = $rf->decrypt($ciphertext, $rfKey);


                $_SESSION['key_de'] = $rfKey;
                $_SESSION['rf_de_res'] = $decryptedRF;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $rfKey, $tipe, $ciphertext, $decryptedRF);

                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'xor') {
                if ($ciphertext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=xor&m=de"); // Redirect back to the index page
                    exit;
                }

                // XOR
                $xorkey = $_POST['keyxor_de'];
                if ($xorkey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=xor&m=de"); // Redirect back to the index page
                    exit;
                }

                $decryptedXOR = $x->decrypt($ciphertext, $xorkey);

                $_SESSION['key_de'] = $xorkey;
                $_SESSION['xor_de_res'] = $decryptedXOR;
                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $xorkey, $tipe, $ciphertext, $decryptedXOR);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'rc4') {
                if ($ciphertext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=rc4&m=de"); // Redirect back to the index page
                    exit;
                }

                // RC4
                $rckey = $_POST['keyrc4_de'];
                if ($rckey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=rc4&m=de"); // Redirect back to the index page
                    exit;
                }

                $decryptedRC4 = $rc->decrypt($ciphertext, $rckey);
                $_SESSION['keyrc4_de'] = $rckey;
                $_SESSION['rc4_de_res'] = $decryptedRC4;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $rckey, $tipe, $ciphertext, $decryptedRC4);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'aes') {
                if ($ciphertext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=aes&m=de"); // Redirect back to the index page
                    exit;
                }

                // AES
                $aeskey = $_POST['keyaes_de'];
                if ($aeskey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=aes&m=de"); // Redirect back to the index page
                    exit;
                }

                list($ivBase64, $encryptedAESBase64) = explode('::', $ciphertext);

                $iv_f = base64_decode($ivBase64);
                $encryptedAES = base64_decode($encryptedAESBase64);

                $decryptedData = openssl_decrypt($encrypteencryptedAESdData, 'aes-256-cbc', $key, 0, $iv_f);

                $_SESSION['key_de'] = $aeskey;
                $_SESSION['aes_de_res'] = $finalAES;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $aeskey, $tipe, $plaintext, $decryptedData);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'super') {
                if ($ciphertext == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input text',
                    ];
                    header("Location: index.php?md=super&m=de"); // Redirect back to the index page
                    exit;
                }

                // Super
                $xorkey = $_POST['keyxor_de'];
                $caesarKey = $_POST['keycaesar_de'];
                $viKey = $_POST['keyvi_de'];

                if ($caesarKey == "" && $xorkey == "" && $viKey == "") {
                    $_SESSION['notification'] = [
                        'type' => 'error',
                        'message' => 'Input key',
                    ];
                    header("Location: index.php?md=super&m=de"); // Redirect back to the index page
                    exit;
                }

                $decryptedXOR = $x->decrypt($ciphertext, $xorkey);
                $decryptedCaesar = $c->decrypt($decryptedXOR, $caesarKey);
                $decryptedVigenere = $v->decrypt($decryptedCaesar, $viKey);

                $_SESSION['keyxor_de'] = $xorkey;
                $_SESSION['keyc_de'] = $caesarKey;
                $_SESSION['keyvi_de'] = $viKey;
                $_SESSION['super_de_res'] = $decryptedVigenere;
                $combinedKeys = $xorkey . "," . $caesarKey . "," . $viKey;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $combinedKeys, $tipe, $ciphertext, $decryptedVigenere);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'file') {
                // FILE
                if (isset($_FILES['filed'])) {
                    $key = $_POST['file_de'];
                    if ($key == "") {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Input key',
                        ];
                        header("Location: index.php?md=file&m=de"); // Redirect back to the index page
                        exit;
                    }

                    $targetDir = 'de_files/'; //directory untuk upload file
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $fileTmp = $_FILES['filed']['tmp_name'];
                    $fileName = $_FILES['filed']['name'];
                    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    //cek apakah jenis file diperbolehkan
                    $allowedType = array('pdf', 'doc', 'docx', 'txt');
                    if (!in_array($fileType, $allowedType)) {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Invalid file type. Please upload JPEG, PNG, or PDF files only.',
                        ];
                        header("Location: index.php?md=file&m=en"); // Redirect back to the index page
                        exit;
                    }

                    //membaca isi uploaded file
                    $fileContent = file_get_contents($fileTmp);
                    if ($fileContent === false) {
                        die("Failed to read uploaded file.");
                    }

                    list($ivBase64, $encryptedDataBase64) = explode('::', $fileContent);
                    if (!$ivBase64 || !$encryptedDataBase64) {
                        die("Invalid file format or corrupted data.");
                    }

                    $iv_f = base64_decode($ivBase64);
                    $encryptedData = base64_decode($encryptedDataBase64);

                    //dekripsi
                    $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv_f);
                    if ($decryptedData === false) {
                        die("Decryption failed." . openssl_error_string());
                    }

                    $targetPath = $targetDir . 'decrypted_' . pathinfo($fileName, PATHINFO_FILENAME) . '.' . $fileType;
                    if (file_put_contents($targetPath, $decryptedData) === false) {
                        die("Failed to save decrypted file.");
                    }

                    $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, file_path, file_name) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("ssiss", $mode, $key, $tipe, $targetPath, $fileName);
                        if ($stmt->execute()) {
                            $_SESSION['key_de'] = $key;

                            header('Content-Type: application/octet-stream');
                            header('Content-Disposition: attachment; filename="' . basename($targetPath) . '"');
                            header('Content-Length: ' . filesize($targetPath));

                            readfile($targetPath);
                            exit();
                        } else {
                            echo "Error inserting data: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "No File uploaded";
                    }
                }
            } elseif ($mode == 'stegano') {
                // STEGANOGRAFI
                if (isset($_FILES['filesd'])) {
                    $key = $_POST['keys_de'];
                    if ($key == "") {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Input key',
                        ];
                        header("Location: index.php?md=stegano&m=de"); // Redirect back to the index page
                        exit;
                    }

                    $targetDir = 'de_img/';
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    $fileTmp = $_FILES['filesd']['tmp_name'];
                    $fileName = $_FILES['filesd']['name'];
                    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    // Cek apakah jenis file diperbolehkan
                    $allowedType = array('jpg', 'jpeg', 'png');
                    if (!in_array($fileType, $allowedType)) {
                        $_SESSION['notification'] = [
                            'type' => 'error',
                            'message' => 'Invalid file type.'
                        ];
                        header("Location: index.php?md=stegano&m=de"); // Redirect back to the index page
                        exit;
                    }

                    $image = file_get_contents($fileTmp);
                    if (!$image) {
                        die("Gambar tidak dapat dibaca!");
                    }

                    // Mengambil panjang pesan dari bagian pertama file
                    $separatorPosition = strpos($image, '|');
                    if ($separatorPosition === false) {
                        die("Pemisah pesan tidak ditemukan!");
                    }
                    $messageLength = (int)substr($image, 0, $separatorPosition);
                    if ($messageLength <= 0) {
                        echo "Panjang pesan yang ditemukan: $messageLength<br>";
                        die("Panjang pesan tidak valid!");
                    }

                    // Mengambil pesan berdasarkan panjang yang ditentukan
                    $message = substr($image, $separatorPosition + 1, $messageLength);
                    if (empty($message)) {
                        die("Pesan kosong atau tidak ditemukan!");
                    }

                    $pesan = $c->decrypt($message, $key);
                    $outputPath = $targetDir . 'result_message_' . pathinfo($fileName, PATHINFO_FILENAME) . '.png';

                    // Memisahkan gambar dari pesan
                    $imageOnlyBinary = substr($image, $separatorPosition + 1 + $messageLength);

                    file_put_contents($outputPath, $imageOnlyBinary); // Simpan gambar tanpa pesan

                    $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result, pict_path, pict_name) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("ssissss", $mode, $key, $tipe, $message, $pesan, $outputPath, $fileName);
                        if ($stmt->execute()) {
                            $_SESSION['key_de'] = $key;
                            $_SESSION['pesan_de'] = $pesan;

                            header('Content-Type: application/octet-stream');
                            header('Content-Disposition: attachment; filename="' . basename($outputPath) . '"');
                            header('Content-Length: ' . filesize($outputPath));

                            readfile($outputPath);

                            exit();
                        } else {
                            echo "Error inserting data into user_{$uid}: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        echo "No File uploaded";
                    }
                }
            }
        }
    }
}

class CaesarCipher
{

    public function encrypt($plaintext, $key)
    {
        return $this->run($plaintext, $key);
    }

    public function decrypt($ciphertext, $key)
    {
        return $this->run($ciphertext, -$key);
    }

    public function crack($ciphertext)
    {
        $plaintexts = [];

        foreach (range(0, 25) as $key) {
            $plaintexts[$key] = substr_count(strtolower($this->decrypt($ciphertext, $key)), 'e');
        }

        return array_search(max($plaintexts), $plaintexts);
    }

    protected function run($string, $key)
    {
        return implode('', array_map(function ($char) use ($key) {
            return $this->shift($char, $key);
        }, str_split($string)));
    }

    protected function shift($char, $shift)
    {
        $shift = $shift % 25;
        $ascii = ord($char);
        $shifted = $ascii + $shift;

        if ($ascii >= 65 && $ascii <= 90) {
            return chr($this->wrapUppercase($shifted));
        }

        if ($ascii >= 97 && $ascii <= 122) {
            return chr($this->wrapLowercase($shifted));
        }

        return chr($ascii);
    }

    protected function wrapUppercase($ascii)
    {
        if ($ascii < 65) {
            $ascii = 91 - (65 - $ascii);
        }

        if ($ascii > 90) {
            $ascii = ($ascii - 90) + 64;
        }

        return $ascii;
    }

    protected function wrapLowercase($ascii)
    {

        if ($ascii < 97) {
            $ascii = 123 - (97 - $ascii);
        }

        if ($ascii > 122) {
            $ascii = ($ascii - 122) + 96;
        }

        return $ascii;
    }
}

class VigenereCipher
{
    // Mod function: modulus positive value
    public function Mod($a, $b)
    {
        return ($a % $b + $b) % $b;
    }

    public function Cipher($input, $key, $encipher)
    {
        $keyLen = strlen($key);

        //  cek apakah key semua alfabet
        for ($i = 0; $i < $keyLen; ++$i)
            if (!ctype_alpha($key[$i]))
                return "";

        $output = "";
        $nonAlphaCharCount = 0;
        $inputLen = strlen($input);

        for ($i = 0; $i < $inputLen; ++$i) {
            if (ctype_alpha($input[$i])) {
                $cIsUpper = ctype_upper($input[$i]);
                $offset = ord($cIsUpper ? 'A' : 'a');
                $keyIndex = ($i - $nonAlphaCharCount) % $keyLen;
                $k = ord($cIsUpper ? strtoupper($key[$keyIndex]) : strtolower($key[$keyIndex])) - $offset;
                $k = $encipher ? $k : -$k;  // enkrip atau dekrip
                $ch = chr(($this->Mod((ord($input[$i]) + $k) - $offset, 26)) + $offset);
                $output .= $ch;
            } else {
                $output .= $input[$i];
                ++$nonAlphaCharCount; // itung non-alfabet
            }
        }

        return $output;
    }

    public function encrypt($input, $key)
    {
        return $this->Cipher($input, $key, true);
    }

    public function decrypt($input, $key)
    {
        return $this->Cipher($input, $key, false);
    }
}
class railFence
{

    function encrypt($text, $key)
    {

        $rail = array_fill(0, $key, []);
        $nonAlphaCharCount = 0; // Untuk menghitung karakter non-alfabet
        $textLen = strlen($text);

        $dirDown = false;
        $row = 0;


        for ($i = 0; $i < $textLen; $i++) {
            if (ctype_alpha($text[$i])) {
                $rail[$row][] = $text[$i];
    
                if ($row == 0 || $row == $key - 1) {
                    $dirDown = !$dirDown; // Ganti arah
                }
                $row += ($dirDown) ? 1 : -1;
            } else {
                $nonAlphaCharCount++; // Abaikan non-alfabet
            }
        }

        // Membaca rail per baris
        $cipherText = '';
        foreach ($rail as $line) {
            $cipherText .= implode('', $line);
        }

        // Tambahkan kembali karakter non-alfabet ke posisi aslinya
        $finalCipherText = '';
        $j = 0;
        for ($i = 0; $i < $textLen; $i++) {
            if (ctype_alpha($text[$i])) {
                $finalCipherText .= $cipherText[$j++];
            } else {
                $finalCipherText .= $text[$i];
            }
        }

        // return $cipherText;
        return $finalCipherText;
    }


    function decrypt($cipherText, $key)
    {
        // $rail = array_fill(0, $key, array_fill(0, strlen($cipherText), null));
        $textLen = strlen($cipherText);
        $rail = array_fill(0, $key, array_fill(0, $textLen, null));
        $nonAlphaCharCount = 0;

        $dirDown = false;
        $row = 0;


        // Tandai posisi alfabet di rail matriks
        for ($i = 0; $i < $textLen; $i++) {
            if (ctype_alpha($cipherText[$i])) {
                $rail[$row][$i] = '*';
    
                if ($row == 0 || $row == $key - 1) {
                    $dirDown = !$dirDown; // Ganti arah
                }
                $row += ($dirDown) ? 1 : -1;
            } else {
                $nonAlphaCharCount++; // Hitung karakter non-alfabet
            }
        }


        // Isi matriks dengan cipher text (hanya untuk karakter alfabet)
        $index = 0;
        for ($r = 0; $r < $key; $r++) {
            for ($c = 0; $c < $textLen; $c++) {
                if ($rail[$r][$c] === '*' && ctype_alpha($cipherText[$index])) {
                    $rail[$r][$c] = $cipherText[$index++];
                }
            }
        }

        // baca plaintext secara zigzag traversal
        $plainText = '';
        $row = 0;
        $dirDown = false;

        for ($i = 0; $i < $textLen; $i++) {
            if (ctype_alpha($cipherText[$i])) {
                // Ambil karakter dari rail
                $plainText .= $rail[$row][$i] ?? '';
                if ($row == 0 || $row == $key - 1) {
                    $dirDown = !$dirDown;
                }
                $row += ($dirDown) ? 1 : -1;
            } else {
                // Tambahkan karakter non-alfabet langsung ke teks hasil
                $plainText .= $cipherText[$i];
            }
        }
    
        return $plainText;
    }
}
class XORCipher
{
    public static function encrypt(string $plainText, string $key): string
    {
        $output = "";
        $keyPos = 0;
        for ($p = 0; $p < strlen($plainText); $p++) {
            if ($keyPos > strlen($key) - 1) {
                $keyPos = 0;
            }
            $char = $plainText[$p] ^ $key[$keyPos];
            $bin = str_pad(decbin(ord($char)), 8, "0", STR_PAD_LEFT);

            $hex = dechex(bindec($bin));
            $hex = str_pad($hex, 2, "0", STR_PAD_LEFT);
            $output .= strtoupper($hex);
            $keyPos++;
        }
        return $output;
    }

    public static function decrypt(string $encryptedText, string $key): string
    {
        $output = "";
        $hex_arr = explode(" ", trim(chunk_split($encryptedText, 2, " ")));
        $keyPos = 0;
        for ($p = 0; $p < sizeof($hex_arr); $p++) {
            if ($keyPos > strlen($key) - 1) {
                $keyPos = 0;
            }
            $char = chr(hexdec($hex_arr[$p])) ^ $key[$keyPos];

            $output .= $char;
            $keyPos++;
        }
        return $output;
    }
}
class RC4
{
    function encrypt($data, $key)
    {
        // KSA
        // Inisialisasi larik/baris S
        $S = range(0, 255);
        $keyLength = strlen($key);

        // Padding kunci jika panjangnya kurang dari 256 byte
        while (strlen($key) < 256) {
            $key .= $key;
        }
        $key = substr($key, 0, 256);

        // Proses permutasi
        $j = 0;
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $S[$i] + ord($key[$i])) % 256;
            // Pertukaran nilai S[i] dan S[j]
            $temp = $S[$i];
            $S[$i] = $S[$j];
            $S[$j] = $temp;
        }

        // PRGA
        // Inisialisasi untuk aliran kunci dan enkripsi
        $i = 0;
        $j = 0;
        $result = "";

        for ($idx = 0, $len = strlen($data); $idx < $len; $idx++) {
            $i = ($i + 1) % 256;
            $j = ($j + $S[$i]) % 256;

            // Pertukaran nilai S[i] dan S[j]
            $temp = $S[$i];
            $S[$i] = $S[$j];
            $S[$j] = $temp;

            // Hitung indeks t dan keystream K
            $t = ($S[$i] + $S[$j]) % 256;
            $K = $S[$t];

            // Enkripsi atau dekripsi
            $result .= chr($K ^ ord($data[$idx]));
        }

        return $result;
    }

    function decrypt($ciphertext, $key)
    {
        // Dekripsi menggunakan fungsi yang sama karena RC4 simetris
        $ciphertext = hex2bin($ciphertext);
        return $this->encrypt($ciphertext, $key);
    }
}