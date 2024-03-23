<?php
session_start();

// Kiểm tra nếu có sự kiện được gửi từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event = $_POST['event'];
    $time = date("Y-m-d H:i:s");
    
    // Lưu sự kiện và thời gian vào session
    if (!isset($_SESSION['events'])) {
        $_SESSION['events'] = array();
    }
    array_push($_SESSION['events'], array('event' => $event, 'time' => $time));
}

// Xóa sự kiện đã ghi nhận
if (isset($_GET['clear'])) {
    unset($_SESSION['events']);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Baby Tracker</title>
</head>
<body>
    <h1>Baby Tracker</h1>
    <form method="post">
        <label for="event">Nhập sự kiện (ví dụ: Ăn, Ngủ, Thức dậy, Đi vệ sinh)</label><br>
        <input type="text" id="event" name="event"><br><br>
        <input type="submit" value="Ghi nhận">
    </form>

    <?php if (isset($_SESSION['events'])): ?>
        <h2>Các sự kiện đã ghi nhận:</h2>
        <ul>
            <?php foreach ($_SESSION['events'] as $event): ?>
                <li><?php echo $event['event'] . " - " . $event['time']; ?></li>
            <?php endforeach; ?>
        </ul>
        <form method="get">
            <input type="submit" name="clear" value="Xóa sự kiện">
        </form>
    <?php endif; ?>
</body>
</html>
