<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <h1 class="text-3xl font-bold mb-6">Chi Tiết Đơn Hàng #<?= $order['id'] ?></h1>
        <p><strong>User:</strong> <?= htmlspecialchars($order['user_id']) ?></p>
        <p><strong>Tổng Giá:</strong> <?= number_format($order['total_price']) ?> VNĐ</p>
        <p><strong>Status:</strong> <?= $order['status'] ?></p>
        <p><strong>Payment:</strong> <?= $order['payment_method'] ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
        <p><strong>Note:</strong> <?= htmlspecialchars($order['note']) ?></p>

        <h2 class="text-xl mt-6 mb-4">Sản Phẩm Trong Đơn</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Giảm</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price']) ?> VNĐ</td>
                    <td><?= number_format($item['discount']) ?> VNĐ</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form method="POST" class="mt-4" action="index.php?controller=order&action=updateStatus">
            <input type="hidden" name="id" value="<?= $order['id'] ?>">
            <label class="form-label">Cập nhật Status</label>
            <select name="status" class="form-control mb-2">
                <option value="cho_xac_nhan" <?= $order['status'] == 'cho_xac_nhan' ? 'selected' : '' ?>>Chờ xác nhận</option>
                <option value="da_xac_nhan" <?= $order['status'] == 'da_xac_nhan' ? 'selected' : '' ?>>Đã xác nhận</option>
                <option value="dang_giao" <?= $order['status'] == 'dang_giao' ? 'selected' : '' ?>>Đang giao</option>
                <option value="da_giao" <?= $order['status'] == 'da_giao' ? 'selected' : '' ?>>Đã giao</option>
                <option value="thanh_cong" <?= $order['status'] == 'thanh_cong' ? 'selected' : '' ?>>Thành công</option>
                <option value="huy" <?= $order['status'] == 'huy' ? 'selected' : '' ?>>Hủy</option>
            </select>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</body>
</html>