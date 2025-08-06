<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin Dashboard</title>
    
    <!-- CSS cho admin only -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        /* Reset bất kỳ CSS nào có thể conflict */
        nav.main-nav,
        header.main-header,
        .user-header {
            display: none !important;
        }
    </style>
    
    <link rel="stylesheet" href="assets_admin/css/admin.css">
    <link rel="stylesheet" href="assets_admin/css/product_add.css">
    <link rel="stylesheet" href="assets_admin/css/product_edit.css">
</head>