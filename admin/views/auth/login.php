<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FoodMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(to right, #f97316, #ef4444); }
        .login-card { background: white; border-radius: 1rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="login-card p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Admin Login</h2>
        <form method="POST">
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="form-control w-full px-3 py-2 border rounded" required value="admin@demo.com">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="form-control w-full px-3 py-2 border rounded" required value="123456">
            </div>
            <button type="submit" class="btn btn-primary w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Login</button>
        </form>
    </div>
</body>
</html>