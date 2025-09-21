<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FoodMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar { background: #1e3a8a; color: white; height: 100vh; }
        .content { padding: 20px; }
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar w-64 p-4">
            <h3 class="text-xl font-bold mb-6">FoodMart Admin</h3>
            <ul class="space-y-4">
                <li><a href="index.php?controller=home" class="text-white hover:bg-blue-800 p-2 rounded block">Trang Chủ</a></li>
                <li><a href="index.php?controller=user&action=list" class="text-white hover:bg-blue-800 p-2 rounded block">Quản Lý User</a></li>
                <li><a href="index.php?controller=product&action=list" class="text-white hover:bg-blue-800 p-2 rounded block">Quản Lý Sản Phẩm</a></li>
                <li><a href="index.php?controller=order&action=list" class="text-white hover:bg-blue-800 p-2 rounded block">Quản Lý Đơn Hàng</a></li>
                <li><a href="index.php?controller=review&action=list" class="text-white hover:bg-blue-800 p-2 rounded block">Quản Lý Đánh Giá</a></li>
                <li><a href="index.php?controller=blog&action=list" class="text-white hover:bg-blue-800 p-2 rounded block">Quản Lý Bài Đăng</a></li>
                <li><a href="index.php?controller=auth&action=logout" class="text-white hover:bg-red-600 p-2 rounded block">Đăng Xuất</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content flex-1">
            <h1 class="text-3xl font-bold mb-6">Trang Chủ Admin</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Top Selling Products -->
                <div class="card p-4">
                    <h2 class="text-xl mb-4">Top 5 Mặt Hàng Bán Chạy</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Bán được</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($topSelling as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td><?= htmlspecialchars($item['category_name']) ?></td>
                                <td><?= $item['total_sold'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Revenue by Month -->
                <div class="card p-4">
                    <h2 class="text-xl mb-4">Doanh Thu Theo Tháng</h2>
                    <canvas id="revenueMonthChart"></canvas>
                </div>

                <!-- Revenue by Year -->
                <div class="card p-4">
                    <h2 class="text-xl mb-4">Doanh Thu Theo Năm</h2>
                    <canvas id="revenueYearChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Chart for Revenue by Month
        const monthCtx = document.getElementById('revenueMonthChart').getContext('2d');
        new Chart(monthCtx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($revenueMonth as $m) echo "'{$m['month']}/{$m['year']}', "; ?>],
                datasets: [{
                    label: 'Doanh Thu',
                    data: [<?php foreach ($revenueMonth as $m) echo "{$m['revenue']}, "; ?>],
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });

        // Chart for Revenue by Year
        const yearCtx = document.getElementById('revenueYearChart').getContext('2d');
        new Chart(yearCtx, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($revenueYear as $y) echo "'{$y['year']}', "; ?>],
                datasets: [{
                    label: 'Doanh Thu',
                    data: [<?php foreach ($revenueYear as $y) echo "{$y['revenue']}, "; ?>],
                    backgroundColor: 'rgb(153, 102, 255)'
                }]
            }
        });
    </script>
</body>
</html>