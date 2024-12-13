<?php
// Ma'lumotlar bazasiga ulanish
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hemis"; // hemis nomli ma'lumotlar bazasiga ulanamiz

$conn = new mysqli($servername, $username, $password);

// Ulanish xatolarini tekshirish
if ($conn->connect_error) {
    die("Ulanishda xatolik: " . $conn->connect_error);
}

// Filtrlar uchun kod
$fan_nomi = isset($_GET['fan_nomi']) ? $_GET['fan_nomi'] : '';
$oquv_yili = isset($_GET['oquv_yili']) ? $_GET['oquv_yili'] : '';
$semestr = isset($_GET['semestr']) ? $_GET['semestr'] : '';
$guruhi = isset($_GET['guruhi']) ? $_GET['guruhi'] : '';
$mashgulot_turi = isset($_GET['mashgulot_turi']) ? $_GET['mashgulot_turi'] : '';

// SQL so'rovini yaratish
$sql = "SELECT * FROM kalendar_reja WHERE 1=1";

if ($fan_nomi) {
    $sql .= " AND fan_nomi LIKE '%$fan_nomi%'";
}
if ($oquv_yili) {
    $sql .= " AND oquv_yili='$oquv_yili'";
}
if ($semestr) {
    $sql .= " AND semestr='$semestr'";
}
if ($guruhi) {
    $sql .= " AND guruhi LIKE '%$guruhi%'";
}
if ($mashgulot_turi) {
    $sql .= " AND mashgulot_turi LIKE '%$mashgulot_turi%'";
}

$result = $conn->query($sql);

// Fanlar jadvalini yaratish (agar mavjud bo'lmasa)
$sql_create_fanlar = "
CREATE TABLE IF NOT EXISTS fanlar (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    fan_nomi VARCHAR(255),
    mavzu_nomi VARCHAR(255)
)";
$conn->query($sql_create_fanlar);

// Mavzu qo'shish uchun kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fan_nomi_post = $_POST['fan_nomi'];
    $mavzu_nomi_post = $_POST['mavzu_nomi'];

    $sql_insert_mavzu = "INSERT INTO fanlar (fan_nomi, mavzu_nomi) VALUES ('$fan_nomi_post', '$mavzu_nomi_post')";
    if ($conn->query($sql_insert_mavzu) === TRUE) {
        echo "Mavzu muvaffaqiyatli qo'shildi!<br>";
    } else {
        echo "Mavzu qo'shishda xatolik: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kalendar Reja Filtrlash va Mavzu Qo'shish</title>
</head>
<body>
    <h2>Kalendar Reja Ma'lumotlarini Filtrlash</h2>

    <!-- Filtrlash formasi -->
    <form method="GET" action="">
        <label>Fan nomi:</label>
        <input type="text" name="fan_nomi" value="<?php echo $fan_nomi; ?>"><br>

        <label>O'quv yili:</label>
        <input type="text" name="oquv_yili" value="<?php echo $oquv_yili; ?>"><br>

        <label>Semestr:</label>
        <input type="number" name="semestr" value="<?php echo $semestr; ?>"><br>

        <label>Guruh:</label>
        <input type="text" name="guruhi" value="<?php echo $guruhi; ?>"><br>

        <label>Mashg'ulot turi:</label>
        <input type="text" name="mashgulot_turi" value="<?php echo $mashgulot_turi; ?>"><br>

        <input type="submit" value="Filtrlash">
    </form>

    <h3>Natijalar:</h3>
    <table border="1">
        <tr>
            <th>Fan nomi</th>
            <th>O'quv yili</th>
            <th>Semestr</th>
            <th>Guruh</th>
            <th>Mashg'ulot turi</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            // Natijalarni chiqarish
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['fan_nomi'] . "</td>
                        <td>" . $row['oquv_yili'] . "</td>
                        <td>" . $row['semestr'] . "</td>
                        <td>" . $row['guruhi'] . "</td>
                        <td>" . $row['mashgulot_turi'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Natijalar topilmadi</td></tr>";
        }
        ?>
    </table>

    <h2>Fanlarga Mavzu Qo'shish</h2>

    <!-- Mavzu qo'shish formasi -->
    <form method="POST" action="">
        <label>Fan nomi:</label>
        <input type="text" name="fan_nomi" required><br>

        <label>Mavzu nomi:</label>
        <input type="text" name="mavzu_nomi" required><br>

        <input type="submit" value="Mavzu qo'shish">
    </form>

    <?php $conn->close(); ?>
</body>
</html>
