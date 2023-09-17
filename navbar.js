function updateNavbar() {
    let nav = document.getElementById("mainNavbar");
    let navHeight = nav.offsetHeight;
    if (window.pageYOffset > navHeight) {
        nav.classList.add("scrolled");
    } else {
        nav.classList.remove("scrolled");
    }
}
document.addEventListener("scroll", function () {
    updateNavbar();
});


function updateRecipesNavbar() {
    let navInRecip = document.getElementById("mainNavbarInRecipes");
    let navInRecipHeight = navInRecip.offsetHeight;
    if (window.pageYOffset > navInRecipHeight) {
        navInRecip.classList.add("scrolled");
    } else {
        navInRecip.classList.remove("scrolled");
    }
}
document.addEventListener("scroll", function () {
    updateRecipesNavbar();
});

