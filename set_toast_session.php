<?php
class PBO
{
    public function setSessionValues($tbPgref, $tbTxtref, $nama_id)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $toastMessages = array(
                "code_green",
                "1.1 > Data $tbTxtref($nama_id) added successfully :)"
            );

            if (isset($toastMessages) && is_array($toastMessages)) {
                $_SESSION['toastMessages'] = $toastMessages;
                echo "<script>console.log('Session values set successfully');</script>";
            } else {
                echo "<script>console.log('Invalid data');</script>";
            }
        } else {
            $baseUrl = $_SERVER['HTTP_HOST'] . '/';
            $desiredPath = $tbPgref;
            $redirectUrl = $baseUrl . $desiredPath;

            echo "<script>
                window.onload = function() {
                    window.location.href = '$redirectUrl';
                };
            </script>";
        }
    }
}

// Usage example
$pbo = new PBO();
$tbPgref = "desired-page.php";
$tbTxtref = "example";
$nama_id = 123;

$pbo->setSessionValues($tbPgref, $tbTxtref, $nama_id);
?>



















<!-- ?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Jika belum dimulai, mulai sesi
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['toastMessages']) && is_array($_POST['toastMessages'])) {
        $forjs = $_SESSION['toastMessages'] = $_POST['toastMessages'];
        echo "<script>console.log(<?= '$forjs' ?>) </script>";
echo "<script>
console.log('Session values set successfully')
</script>";
} else {
echo "<script>
console.log('Invalid data')
</script>";
}
} else {
echo "<script>
console.log('Invalid request')
</script>";
} -->