<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="content">
        <h1 class="text-3xl font-bold mb-6">Quản Lý Sản Phẩm</h1>
        <a href="index.php?controller=product&action=add" class="btn btn-primary mb-4">Thêm Sản Phẩm</a>

        <form method="GET" class="mb-4">
            <input type="hidden" name="controller" value="product">
            <input type="hidden" name="action" value="list">
            <label>Tìm kiếm tên: <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>"></label>
            <label>Lọc danh mục: 
                <select name="category">
                    <option value="">Tất cả</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= $category == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>

        <table class="table table-striped" id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Giá Sale</th>
                    <th>Tồn</th>
                    <th>Nổi bật</th>
                    <th>Status</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><img src="<?= htmlspecialchars($product['image']) ?>" width="50" alt=""></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['category_name']) ?></td>
                    <td><?= number_format($product['price']) ?> VNĐ</td>
                    <td><?= $product['sale_price'] ? number_format($product['sale_price']) : '' ?> VNĐ</td>
                    <td><?= $product['stock'] ?></td>
                    <td><?= $product['is_featured'] ? 'Có' : 'Không' ?></td>
                    <td><?= $product['status'] ? 'Active' : 'Inactive' ?></td>
                    <td>
                        <a href="index.php?controller=product&action=edit&id=<?= $product['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <a href="index.php?controller=product&action=delete&id=<?= $product['id'] ?>" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">Xóa</a>
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
            $('#productTable').DataTable();
        });
    </script>
</body>
</html>