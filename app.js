async function loadPosts() {
    try {
        const response = await fetch('/api/posts');
        const rawData = await response.json();
        console.log(rawData);
        const data = rawData.data;
        
        if (rawData.status === 'success') {
            const postsContainer = document.getElementById('posts-container');
            postsContainer.innerHTML = data.map(post => `
                <div class="post" data-id="${post.id}">
                    <h3>${post.label}</h3>
                    <p>${post.text}</p>
                    <button class="btn-delete" 
                    data-id="${post.id}">
                      удалить 
                    </button>
                </div>
            `).join('');
        }
    } catch (error) {
        console.error('Ошибка:', error);
    }
}

// Запускаем при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    console.log('0. Страница загружена');
    loadPosts();
});

document.getElementById('post-form').addEventListener('submit', async (e) => {
  e.preventDefault(); // Отменяем стандартную отправку формы
  
  // 1. Собираем данные из формы
  const postData = {
    label: document.getElementById('postTitle').value,
    text: document.getElementById('postContent').value
  };
  console.log(postData);

  // 2. Отправляем на сервер
  try {
    const response = await fetch('/api/posts', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(postData)
    });

    // 3. Проверяем ответ
    if (!response.ok) {
      throw new Error('Ошибка сервера');
    }

    // 4. Обновляем список постов
    loadPosts();
    
    // 5. Очищаем форму
    document.getElementById('post-form').reset();
    
    console.log('Пост создан!');
    
  } catch (error) {
    console.error('Ошибка:', error);
    alert('Не удалось создать пост: ' + error.message);
  }
});

// Обработчик удаления
document.addEventListener('click', async (e) => {
  if (e.target.classList.contains('btn-delete')) {
    const postElement = e.target.closest('.post');
    const postId = postElement.dataset.id;

    if (confirm('Удалить этот пост?')) {
      try {
        const response = await fetch(`/api/posts/${postId}`, {
          method: 'DELETE'
        });

        if (response.ok) {
          postElement.remove(); // Удаляем элемент со страницы
          console.log('Пост удалён');
        }
      } catch (error) {
        console.error('Ошибка:', error);
      }
    }
  }
});