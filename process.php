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
        //unset($_SESSION['aes_de_res']);
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
        unset($_SESSION['pesan_en']);
        unset($_SESSION['x']);
        $m = 'en';
        $_SESSION['m'] = $m;
        $_SESSION['mode'] = $_POST['mode'];
        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($mode == 'file') {
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
        unset($_SESSION['x']);
        unset($_SESSION['rf_en_res']);
        unset($_SESSION['rc4_en_res']);

        header("Location: index.php?md=$mode&m=$m");
        exit();
    } elseif ($_POST['arrow'] == 'left') {
        $m = "de";
        $_SESSION['m'] = $m;
        unset($_SESSION['plaintext']);
        unset($_SESSION['ciphertext']);
        unset($_SESSION['caesar_de_res']);
        //unset($_SESSION['aes_de_res']);
        unset($_SESSION['vi_de_res']);
        unset($_SESSION['xor_de_res']);
        unset($_SESSION['super_de_res']);
        unset($_SESSION['key_de']);
        unset($_SESSION['keyvi_de']);
        unset($_SESSION['keyc_de']);
        unset($_SESSION['keyxor_de']);
        unset($_SESSION['rf_de_res']);
        unset($_SESSION['rc4_de_res']);

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
    $_SESSION['iv'] = $iv;
    $iv_file = '1234567890987654321';

    $c = new CaesarCipher();
    $v = new VigenereCipher();
    $x = new XORCipher();
    $f = new File();
    $s = new stegano();
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
                // Caesar Cipher
                $caesarKey = $_POST['keycaesar_en'];
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
                // Vigenere Cipher
                $viKey = $_POST['keyvi_en'];
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
                // Rail Fence Cipher
                $rfKey = $_POST['keyrf_en'];
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
                // AES
                $aeskey = $_POST['keyaes_en'];
                $encryptedAES = openssl_encrypt($plaintext, 'aes-256-cbc', $aeskey, 0, $_SESSION['iv']);
                $_SESSION['key_en'] = $aeskey;
                $_SESSION['aes_en_res'] = $encryptedAES;

                $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, teks, result) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiss", $mode, $aeskey, $tipe, $plaintext, $encryptedAES);
                if ($stmt->execute()) {
                    header("Location: index.php?md=$mode&m=$m");
                    exit();
                } else {
                    echo "Error inserting data: " . $stmt->error;
                }
            } elseif ($mode == 'xor') {
                // XOR
                $xorkey = $_POST['keyxor_en'];
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
                // RC4
                $rckey = $_POST['keyrc4_en'];
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
                // Super
                $xorkey = $_POST['keyxor_en'];
                $caesarKey = $_POST['keycaesar_en'];
                $viKey = $_POST['keyvi_en'];

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
                if (isset($_FILES['rfile'])) {

                    $key = $_POST['file_en'];
                    $file = $_FILES['rfile']['tmp_name'];
                    $oFile = $_FILES['rfile']['name'];
                    $fileContent = file_get_contents($file);
                    $destination = 'files/encrypted_' . $oFile;

                    $encrypted_data = $f->encrypt($fileContent, $key, $iv_file);
                    file_put_contents($destination, $encrypted_data);

                    $_SESSION['key_en'] = $key;
                    $_SESSION['file_res_en'] = $encrypted_data;

                    $sql = "INSERT INTO `user_{$uid}` (mode, key_used, tipe_id, file_asli, file_result) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssiss", $mode, $key, $tipe, $oFile, $encrypted_data);
                    if ($stmt->execute()) {
                        header("Location: index.php?md=$mode&m=$m");
                        unset($_SESSION['x']);
                        $_SESSION['x'] = 'Berhasil DB File';
                        exit();
                    } else {
                        echo "Error inserting data: " . $stmt->error;
                    }
                }
            } elseif ($mode == 'stegano') {
                $pesan = $_POST['pesan'];
                $file = $_FILES['pict']['name'];
                $tmpname = $_FILES['pict']['tmp_name'];

                if (!isset($_FILES['pict']) || $_FILES['pict']['error'] !== UPLOAD_ERR_OK) {
                    die("File upload error: " . ($_FILES['pict']['error'] ?? "No file uploaded."));
                }

                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $destination = $uploadDir . $file;
                if (!move_uploaded_file($tmpname, $destination)) {
                    die("Failed to move uploaded file.");
                }

                $pict = 'uploads/' . $file;

                $s->encrypt($pesan, $pict, $conn);
                $_SESSION['pesan_en'] = $pesan;
            }
        }
    } elseif ($kripto == 'de') {
        $tipe = 0;
        $ciphertext = $_POST['ciphertext'];
        $_SESSION['ciphertext'] = $_POST['ciphertext'];
        if (isset($_SESSION['mode'])) {
            $mode = $_SESSION['mode'];
            if ($mode == 'caesar') {
                // Caesar Cipher
                $caesarKey = $_POST['keycaesar_de'];
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
                // Vigenere Cipher
                $viKey = $_POST['keyvi_de'];
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
                // Rail Fence Cipher
                $rfKey = $_POST['keyrf_de'];
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
                // XOR
                $xorkey = $_POST['keyxor_de'];
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
                // RC4
                $rckey = $_POST['keyrc4_de'];
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
            } elseif ($mode == 'super') {
                // Super
                $xorkey = $_POST['keyxor_de'];
                $caesarKey = $_POST['keycaesar_de'];
                $viKey = $_POST['keyvi_de'];

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

        // apakah key semua alfabet
        for ($i = 0; $i < $keyLen; ++$i)
            if (!ctype_alpha($key[$i]))
                return ""; // error jika bukan alfabet

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
        $text = str_replace(' ', '', $text); // hapus spasi
        $rail = array_fill(0, $key, []);

        $dirDown = false;
        $row = 0;

        // matriks
        for ($i = 0; $i < strlen($text); $i++) {
            $rail[$row][] = $text[$i];

            if ($row == 0 || $row == $key - 1) {
                $dirDown = !$dirDown; // ganti arah (penulisan)
            }
            $row += ($dirDown) ? 1 : -1;
        }

        // Membaca rail per baris
        $cipherText = '';
        foreach ($rail as $line) {
            $cipherText .= implode('', $line);
        }

        return $cipherText;
    }


    function decrypt($cipherText, $key)
    {
        $rail = array_fill(0, $key, array_fill(0, strlen($cipherText), null));
        $dirDown = false;
        $row = 0;

        // menandai posisi di rail matriks
        for ($i = 0; $i < strlen($cipherText); $i++) {
            $rail[$row][$i] = '*';

            if ($row == 0 || $row == $key - 1) {
                $dirDown = !$dirDown; // ganti arah
            }
            $row += ($dirDown) ? 1 : -1;
        }

        // isi matriks dengan cipher text
        $index = 0;
        for ($r = 0; $r < $key; $r++) {
            for ($c = 0; $c < strlen($cipherText); $c++) {
                if ($rail[$r][$c] === '*' && $index < strlen($cipherText)) {
                    $rail[$r][$c] = $cipherText[$index++];
                }
            }
        }

        // baca plaintext secara zigzag traversal
        $plainText = '';
        $row = 0;
        $dirDown = false;
        for ($i = 0; $i < strlen($cipherText); $i++) {
            $plainText .= $rail[$row][$i];

            if ($row == 0 || $row == $key - 1) {
                $dirDown = !$dirDown;
            }
            $row += ($dirDown) ? 1 : -1;
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

    public static function encryptF(string $sourceFile, string $destinationFile, string $key): void
    {
        // Membaca konten file sumber
        $plainText = file_get_contents($sourceFile);
        // Enkripsi konten
        $encryptedText = self::encrypt($plainText, $key);
        // Menyimpan hasil enkripsi ke file tujuan
        file_put_contents($destinationFile, $encryptedText);
    }

    public static function decryptFile(string $sourceFile, string $destinationFile, string $key): void
    {
        // Membaca konten file terenkripsi
        $encryptedText = file_get_contents($sourceFile);
        // Dekripsi konten
        $decryptedText = self::decrypt($encryptedText, $key);
        // Menyimpan hasil dekripsi ke file tujuan
        file_put_contents('Downloads/encrypted_file.txt', $decryptedText);
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
class File
{
    function encrypt($file, $encryption_key, $iv)
    {
        //$data = file_get_contents($file);
        $encrypted_data = openssl_encrypt($file, 'aes-256-cbc', $encryption_key, 0, $iv);
        return $encrypted_data;
    }
    function decrypt($file, $decryption_key, $iv)
    {
        $decrypted_data = openssl_decrypt($file, 'aes-256-cbc', $decryption_key, 0, $iv);
        return $decrypted_data;
    }
}
class stegano
{
    function toBin($str)
    {
        $str = (string)$str;
        $l = strlen($str);
        $result = '';
        while ($l--) {
            $result = str_pad(decbin(ord($str[$l])), 8, "0", STR_PAD_LEFT) . $result;
        }
        return $result;
    }
    function toString($binary)
    {
        return pack('H*', base_convert($binary, 2, 16));
    }

    function checkImageFormat($imagePath)
    {
        // Get the image details
        $imageDetails = getimagesize($imagePath);

        // Check if the MIME type is JPEG or PNG
        if ($imageDetails !== false) {
            $mimeType = $imageDetails['mime'];

            if ($mimeType == 'image/jpeg') {
                return 'JPEG';
            } elseif ($mimeType == 'image/jpg') {
                return 'JPG';
            } elseif ($mimeType == 'image/png') {
                return 'PNG';
            } else {
                return 'Not JPEG or PNG';
            }
        } else {
            return 'Invalid image';
        }
    }
    
    function encrypt($message_to_hide, $src, $conn)
    {
        try{
        $binary_message = $this->toBin($message_to_hide);
        $message_length = strlen($binary_message);
        $img_type = $this->checkImageFormat($src);

    
        if ($img_type == 'JPEG' || $img_type == 'JPG') {
            $im = imagecreatefromjpeg($src);
        } elseif ($img_type == 'PNG') {
            $im = imagecreatefrompng($src);
        } else {
            throw new Exception("Unsupported image format");
            
        }
    

        for ($x = 0; $x < $message_length; $x++) {
            $y = $x;
            $rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $newR = $r;
            $newG = $g;
            $newB = $this->toBin($b);
            $newB[strlen($newB) - 1] = $binary_message[$x];
            $newB = $this->toString($newB);

            $new_color = imagecolorallocate($im, $newR, $newG, $newB);
            imagesetpixel($im, $x, $y, $new_color);
        }
    

        ob_start();
        $temp_path = 'temp_res.png';
        imagepng($im, $temp_path);
        $image_data = file_get_contents($temp_path);
        unlink($temp_path);

        $_SESSION['img_data'] = $image_data;
        $mode = $_SESSION['mode'];
        $tipe = 1;
        $uid = $_SESSION['user_id'];
        $sql = "INSERT INTO `user_{$uid}` (mode, tipe_id, teks, pict_asli, pict_result) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisss", $mode, $tipe, $message_to_hide, $src, $image_data);
        if ($stmt->execute()) {
            unset($_SESSION['x']);
            $_SESSION['x'] = 'Berhasil DB Steganografi';
            header("Location: index.php?md=stegano&m=en");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        imagedestroy($im);
    }catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        header("Location: index.php?md=stegano&m=en");
    }
    }

}
