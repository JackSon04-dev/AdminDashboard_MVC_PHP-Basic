<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="content">
        <h1 class="text-3xl font-bold mb-6">Quản Lý Đơn Hàng</h1>

        <form method="GET" class="mb-4">
            <input type="hidden" name="controller" value="order">
            <input type="hidden" name="action" value="list">
            <label>Tìm kiếm ID/User: <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>"></label>
            <label>Lọc status: 
                <select name="status">
                    <option value="">Tất cả</option>
                    <option value="cho_xac_nhan" <?= $status == 'cho_xac_nhan' ? 'selected' : '' ?>>Chờ xác nhận</option>
                    <option value="da_xac_nhan" <?= $status == 'da_xac_nhan' ? 'selected' : '' ?>>Đã xác nhận</option>
                    <option value="dang_giao" <?= $status == 'dang_giao' ? 'selected' : '' ?>>Đang giao</option>
                    <option value="da_giao" <?= $status == 'da_giao' ? 'selected' : '' ?>>Đã giao</option>
                    <option value="thanh_cong" <?= $status == 'thanh_cong' ? 'selected' : '' ?>>Thành công</option>
                    <option value="huy" <?= $status == 'huy' ? 'selected' : '' ?>>Hủy</option>
                </select>
            </label>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>

        <table class="table table-striped" id="orderTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Tổng Giá</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Created</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['user_name']) ?></td>
                    <td><?= number_format($order['total_price']) ?> VNĐ</td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['payment_method'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td>
                        <a href="index.php?controller=order&action=view&id=<?= $order['id'] ?>" class="btn btn-sm btn-info">Xem</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#orderTable').DataTable();
        });
    </script>
</body>
</html>