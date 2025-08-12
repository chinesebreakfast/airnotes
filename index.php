<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Left container - post form -->
            <div class="col-md-6" id="posts-container">
                
            </div>
            
<!-- Right container - post form -->
    <div class="col-md-6 post-form-container">
        <form id="post-form">
            <div class="mb-3">
                <input type="text" class="form-control" id="postTitle" placeholder="Введите заголовок" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" required id="postContent" rows="10" placeholder="Напишите ваш текст здесь..."></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Опубликовать</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>

</body>
</html>