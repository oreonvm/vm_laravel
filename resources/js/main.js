
function toggleMenu() {
    $('.menu-toggle').toggleClass('menu-toggle_active')
    $('.menu').toggleClass('menu_active')
}

$('.menu-toggle').on("click", function () { toggleMenu() })

function closeMenu() {
    $('.menu-toggle').removeClass('menu-toggle_active')
    $('.menu').removeClass('menu_active')
}
$(document).on("click", function (e) {
    if ($(e.target).closest('.menu-container').length) return
    closeMenu()
})
