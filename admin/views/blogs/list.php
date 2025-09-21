<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Bài Đăng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="content">
        <h1 class="text-3xl font-bold mb-6">Quản Lý Bài Đăng</h1>
        <a href="index.php?controller=blog&action=add" class="btn btn-primary mb-4">Thêm Bài Đăng</a>

        <form method="GET" class="mb-4">
            <input type="hidden" name="controller" value="blog">
            <input type="hidden" name="action" value="list">
            <label>Tìm kiếm tiêu đề: <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>"></label>
            <button type="submit" class="btn btn-primary">Tìm</button>
        </form>

        <table class="table table-striped" id="blogTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Thumbnail</th>
                    <th>Created</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?= $blog['id'] ?></td>
                    <td><?= htmlspecialchars($blog['title']) ?></td>
                    <td><?= htmlspecialchars($blog['thumbnail']) ?></td>
                    <td><?= $blog['created_at'] ?></td>
                    <td>
                        <a href="index.php?controller=blog&action=edit&id=<?= $blog['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <a href="index.php?controller=blog&action=delete&id=<?= $blog['id'] ?>" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">Xóa</a>
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
            $('#blogTable').DataTable();
        });
    </script>
</body>
</html>