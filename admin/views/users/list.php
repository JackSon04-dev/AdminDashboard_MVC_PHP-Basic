<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Sidebar from home -->
    <div class="content">
        <h1 class="text-3xl font-bold mb-6">Quản Lý User</h1>
        <a href="index.php?controller=user&action=add" class="btn btn-primary mb-4">Thêm User</a>

        <form method="GET" class="mb-4">
            <input type="hidden" name="controller" value="user">
            <input type="hidden" name="action" value="list">
            <label>Tìm kiếm: <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>"></label>
            <label>Lọc role: 
                <select name="role">
                    <option value="">Tất cả</option>
                    <option value="admin" <?= $role == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="staff" <?= $role == 'staff' ? 'selected' : '' ?>>Staff</option>
                    <option value="user" <?= $role == 'user' ? 'selected' : '' ?>>User</option>
                </select>
            </label>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>

        <table class="table table-striped" id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                    <td><?= htmlspecialchars($user['address']) ?></td>
                    <td><?= $user['status'] ? 'Active' : 'Inactive' ?></td>
                    <td>
                        <a href="index.php?controller=user&action=edit&id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <a href="index.php?controller=user&action=delete&id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="confirmDelete(event)">Xóa</a>
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
            $('#userTable').DataTable();
        });

        function confirmDelete(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = e.target.href;
                }
            });
        }
    </script>
</body>
</html>