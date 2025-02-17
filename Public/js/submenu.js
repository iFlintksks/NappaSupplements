

document.addEventListener('DOMContentLoaded', function () {
    const profileSection = document.querySelector('.profile-section');
    const menuList = document.querySelector('.menu-list');
    
    // Mostrar ou esconder o submenu ao clicar no perfil
    profileSection.addEventListener('click', function (e) {
        e.stopPropagation(); 
        menuList.style.display = menuList.style.display === 'block' ? 'none' : 'block';
    });

    // Fechar o submenu se o usuário clicar fora
    document.addEventListener('click', function (e) {
        if (!profileSection.contains(e.target) && !menuList.contains(e.target)) {
            menuList.style.display = 'none';
        }
    });
});

