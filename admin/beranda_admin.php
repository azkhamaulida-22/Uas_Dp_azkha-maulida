<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
require_once("../koneksi.php");
$username = $_SESSION['username'];
$sql = "SELECT * FROM tbl_user WHERE username = '$username'";
$query = mysqli_query($db, $sql);
$hasil = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        merah: '#DC2626',
                        'merah-dark': '#B91C1C',
                        'merah-light': '#FEE2E2',
                        'merah-deep': '#991B1B'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-merah-light min-h-screen">
    <!-- Header -->
    <header class="bg-merah-dark text-white text-center py-6 shadow">
        <h1 class="text-3xl font-bold">Halaman Administrator</h1>
    </header>

    <!-- Container -->
    <div class="flex max-w-7xl mx-auto mt-8 px-4">
        <!-- Sidebar -->
        <aside class="w-1/4 bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold text-merah-dark mb-4 text-center">MENU</h2>
            <ul class="space-y-2 text-gray-700">
                <li><a href="beranda_admin.php" class="block hover:text-merah-dark">Beranda</a></li>
                <li><a href="data_artikel.php" class="block hover:text-merah-dark">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block hover:text-merah-dark">Kelola Gallery</a></li>
                <li><a href="about.php" class="block hover:text-merah-dark">About</a></li>
                <li>
                    <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');"
                        class="block text-red-600 hover:underline font-medium">Logout</a>
                </li>
            </ul>
        </aside>

        <?php
        $jumlah_artikel = mysqli_num_rows(mysqli_query($db, "SELECT id_artikel FROM tbl_artikel"));
        $jumlah_gallery = mysqli_num_rows(mysqli_query($db, "SELECT id_gallery FROM tbl_gallery"));
        ?>

        <!-- Main Content -->
        <main class="w-3/4 bg-white rounded shadow p-6 ml-6">
            <div class="text-lg text-gray-800 mb-4">
                Halo, <strong class="text-merah-deep"><?php echo $_SESSION['username']; ?></strong>! Apa kabar? 😊
            </div>
            <p class="text-sm text-gray-500">Silakan gunakan menu di samping untuk mengelola data.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <div class="bg-white shadow rounded p-4 text-center border-t-4 border-merah-dark">
                    <h3 class="text-xl font-semibold text-merah-dark">Artikel</h3>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $jumlah_artikel; ?></p>
                </div>
                <div class="bg-white shadow rounded p-4 text-center border-t-4 border-merah">
                    <h3 class="text-xl font-semibold text-merah">Gallery</h3>
                    <p class="text-3xl font-bold text-gray-800"><?php echo $jumlah_gallery; ?></p>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-merah-dark text-white text-center py-4 mt-10">
        &copy; <?php echo date('Y'); ?> -  Azkha maulida
    </footer>
</body>

</html>
