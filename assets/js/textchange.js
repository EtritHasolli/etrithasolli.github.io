function updatePageName() {
    const nameElement = document.getElementById("page-name");
    const isMobile = window.innerWidth <= 650;

    if (isMobile) {
        nameElement.innerHTML = "Full Stack Developer";
    } else {
        nameElement.innerHTML = "Etrit Hasolli | Full Stack Developer";
    }
}

document.addEventListener('DOMContentLoaded', updatePageName);
window.addEventListener('resize', updatePageName);
