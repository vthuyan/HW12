<?php
// Tên file
$fileName = 'data.txt';

// Tạo file nếu chưa tồn tại
if (!file_exists($fileName)) {
    file_put_contents($fileName, '');
    echo "File $fileName đã được tạo mới.<br>";
}

// Kiểm tra xem file có cho phép ghi không
if (is_writable($fileName)) {
    // Mở file để ghi nội dung
    $file = fopen($fileName, 'w');

    // Ghi nội dung vào file
    $content = "Hello ";
    fwrite($file, $content);

    // Đóng file
    fclose($file);
    echo "Đã ghi nội dung vào file $fileName và đã đóng file.<br>";

    // Xóa file
    if (unlink($fileName)) {
        echo "Đã xóa file $fileName.<br>";
    } else {
        echo "Không thể xóa file $fileName.<br>";
    }
} else {
    echo "Không thể ghi vào file $fileName. Kiểm tra lại quyền truy cập.<br>";
}
?>