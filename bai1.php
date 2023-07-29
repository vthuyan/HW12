<?php
class ImageUpload
{
    private $fileName;
    private $fileType;

    public function getFileName()
    {
        return $this->fileName;
    }

    public function moveFile($file)
    {
        $uploadDir = 'D:\SaveD\Videos\Captures'; // Thư mục để lưu trữ file được tải lên

        // Kiểm tra xem có lỗi khi upload hay không
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Lấy tên file và kiểu file
        $this->fileName = basename($file['name']);
        $this->fileType = strtolower(pathinfo($this->fileName, PATHINFO_EXTENSION));

        // Kiểm tra kiểu file (jpeg, jpg, png, gif)
        if (!$this->isValidFileType()) {
            return false;
        }

        // Di chuyển file vào thư mục lưu trữ
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $this->fileName)) {
            return true;
        }

        return false;
    }

    private function isValidFileType()
    {
        $allowedTypes = array('jpeg', 'jpg', 'png', 'gif');
        return in_array($this->fileType, $allowedTypes);
    }
}

// Sử dụng lớp ImageUpload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $imageUpload = new ImageUpload();

    // Upload file
    if ($imageUpload->moveFile($_FILES["fileToUpload"])) {
        echo "File đã được tải lên thành công. Tên file: " . $imageUpload->getFileName();
    } else {
        echo "Không thể tải lên file.";
    }
}
?>
