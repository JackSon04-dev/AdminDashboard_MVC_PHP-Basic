<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Đánh Giá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="content">
        <h1 class="text-3xl font-bold mb-6">Quản Lý Đánh Giá</h1>

        <form method="GET" class="mb-4">
            <input type="hidden" name="controller" value="review">
            <input type="hidden" name="action" value="list">
            <label>Tìm kiếm Product/User: <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>"></label>
            <label>Lọc Approved: 
                <select name="approved">
                    <option value="">Tất cả</option>
                    <option value="1" <?= $approved == '1' ? 'selected' : '' ?>>Approved</option>
                    <option value="0" <?= $approved == '0' ? 'selected' : '' ?>>Pending</option>
                </select>
            </label>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>

        <table class="table table-striped" id="reviewTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Approved</th>
                    <th>Created</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?= $review['id'] ?></td>
                    <td><?= htmlspecialchars($review['product_name']) ?></td>
                    <td><?= htmlspecialchars($review['user_name']) ?></td>
                    <td><?= $review['rating'] ?> ★</td>
                    <td><?= htmlspecialchars($review['comment']) ?></td>
                    <td><?= $review['is_approved'] ? 'Yes' : 'No' ?></td>
                    <td><?= $review['created_at'] ?></td>
                    <td>
                        <?php if (!$review['is_approved']): ?>
                            <a href="index.php?controller=review&action=approve&id=<?= $review['id'] ?>" class="btn btn-sm btn-success">Approve</a>
                        <?php endif; ?>
                        <a href="index.php?controller=review&action=delete&id=<?= $review['id'] ?>" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">Xóa</a>
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
            $('#reviewTable').DataTable();
        });
    </script>
</body>
</html>