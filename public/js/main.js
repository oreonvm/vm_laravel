
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function showBlock() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}


// var btn = document.querySelector('.btn');
// var blockHidden = document.querySelector('.block');

// function showBlock() {

//   blockHidden.classList.add('b-show');

// }
// btn.addEventListener('click', showBlock);

$(".select2").select2();

$('.delete').on("click", function () {
    var res = confirm('Confirm  deletion');
    if (!res) return false;

});









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
