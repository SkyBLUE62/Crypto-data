function masquerAlert() {
    const alert = document.getElementById('alert');
    alert.innerHTML = "";
    alert.style.display = "none";
}
window.setTimeout(masquerAlert, 5000);
