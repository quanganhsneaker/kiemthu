const menuLi = document.querySelectorAll('.admin-sidebar-content > ul > li > a');
const subMenu = document.querySelectorAll('.sub-menu');

let openedSubMenu = null; // Biến lưu submenu đang mở

for (let index = 0; index < menuLi.length; index++) {
    menuLi[index].addEventListener('click', (e) => {
        e.preventDefault();

        const currentSubMenu = menuLi[index].parentNode.querySelector('ul'); // Lấy submenu của mục hiện tại

        // Nếu submenu đã mở và người dùng click vào chính nó lần nữa, ta sẽ đóng lại
        if (openedSubMenu === currentSubMenu) {
            currentSubMenu.setAttribute("style", "height: 0px"); // Đóng submenu
            openedSubMenu = null; // Reset submenu đã mở
        } else {
            // Nếu có submenu đang mở, không đóng nó
            // Mở submenu hiện tại
            const submenuHeight = currentSubMenu.querySelector('.sub-menu-items').offsetHeight;
            currentSubMenu.setAttribute("style", "height: " + submenuHeight + "px");
            openedSubMenu = currentSubMenu; // Lưu submenu đang mở
        }
    });
}
