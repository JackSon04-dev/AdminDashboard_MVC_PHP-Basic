<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="content">
        <h1 class="text-3xl font-bold mb-6">Thêm Sản Phẩm Mới</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Chọn danh mục</option>
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả ngắn</label>
                <input type="text" name="short_desc" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Đơn vị</label>
                <input type="text" name="unit" class="form-control" value="1 Unit">
            </div>
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="price" step="0.01" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá Sale</label>
                <input type="number" name="sale_price" step="0.01" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Hình ảnh</label>
                <input type="text" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Gallery (JSON)</label>
                <textarea name="gallery" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tồn kho</label>
                <input type="number" name="stock" class="form-control" value="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Nổi bật</label>
                <select name="is_featured" class="form-control">
                    <option value="0">Không</option>
                    <option value="1">Có</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</body>
</html>