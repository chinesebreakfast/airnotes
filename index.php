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
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <!-- Поисковая форма -->
    <form class="d-flex align-items-center search-form">
      <div class="input-group search-container">
        <input type="search" class="form-control search-input" placeholder="Поиск...">
        <button class="btn search-btn" type="submit">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </button>
      </div>
    </form>
  </div>
</nav>
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
            <button type="submit" class="btn">Опубликовать</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>

</body>
</html>