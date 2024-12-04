<?php
include 'db.php';
session_start();
// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $uid = $_SESSION['user_id'];
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
    <title>
        En-
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Bubble Elements -->
    <div class="bubble-element" style="width: 100px; height: 100px; top: 10%; left: 20%;">
    </div>
    <div class="bubble-element" style="width: 150px; height: 150px; top: 50%; left: 70%;">
    </div>
    <div class="bubble-element" style="width: 80px; height: 80px; top: 80%; left: 30%;">
    </div>


    <div class="container mx-auto p-4">
        <div class="grid grid-cols-10 gap-4 min-w-full max-w-6xl p-8 bg-gray-800 bg-opacity-100 rounded-lg shadow-lg">
            <form action="process.php" method="POST">
            <button type="submit" name="aksi" class="p-2 bg-red-500 rounded-lg text-white font-bold hover:bg-red-600" value="back">Back</button>
            </form>
            <h2 class="text-white font-bold">user: <?php echo $username; ?></h2>
        </div>

        <div class="scrollable-table" style="max-height: 500px; overflow-y: auto;">
            <table class="min-w-full bg-gray-800 text-white" style="table-layout: fixed; width: 100%;">
                <thead style="position: sticky; top: 0; background-color: purple;">
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            ID</th>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            Algoritma</th>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            Key</th>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            En/De</th>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            Pesan</th>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            Hasil Pesan</th>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            Hasil Gambar</th>
                        <th class="py-2 px-4 border-b border-gray-700" style="padding: 10px; border: 1px; text-align: left;">
                            Hasil File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php'; // Koneksi ke database

                    // Query untuk mengambil data
                    $sql = "SELECT id, mode, key_used, tipe_id, teks, result, pict_name, file_name FROM user_{$uid}";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if($row['tipe_id']==0){
                                $t = 'dekripsi';
                            } elseif ($row['tipe_id']==1){
                                $t = 'enkripsi';
                            }
                            echo "<tr>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left;'>" . $row["id"] . "</td>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left;'>" . $row["mode"] . "</td>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left;'>" . $row["key_used"] . "</td>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left;'>" . $t . "</td>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left; overflow: hidden; text-overflow: ellipsis;'>" . $row["teks"] . "</td>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left; overflow: hidden; text-overflow: ellipsis;'>" . $row["result"] . "</td>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left;'>" . $row["pict_name"] . "</td>
                                <td class='py-2 px-4 border-b border-gray-700 table-cell' style='padding: 10px; border: 1px; text-align: left;'>" . $row["file_name"] . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='py-2 px-4 border-b border-gray-700 text-center'>No data found</td></tr>";
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>