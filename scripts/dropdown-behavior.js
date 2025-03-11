function toggleDropdown() {
    document.querySelector(".profile-dropdown").classList.toggle("active");
}

document.addEventListener("click", function(event) {
    const profileDropdown = document.querySelector(".profile-dropdown");

    if (!event.target.closest(".profile-dropdown")) {
        profileDropdown.classList.remove("active");
    }
});