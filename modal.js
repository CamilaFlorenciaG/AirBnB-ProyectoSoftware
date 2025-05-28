// Abrir y cerrar modal de login
const btnAbrir = document.getElementById("abrirModal");
const btnCerrar = document.getElementById("cerrarModal");
const modal = document.getElementById("modal");

btnAbrir.addEventListener("click", () => {
  modal.style.display = "flex";
});

btnCerrar.addEventListener("click", () => {
  modal.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});

// Abrir y cerrar modal de registro
const btnAbrirRegistro = document.getElementById("abrirModalRegistro");
const btnCerrarRegistro = document.getElementById("cerrarModalRegistro");
const modalRegistro = document.getElementById("modalRegistro");

btnAbrirRegistro.addEventListener("click", () => {
  modalRegistro.style.display = "flex";
  modal.style.display = "none";
});

btnCerrarRegistro.addEventListener("click", () => {
  modalRegistro.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target === modalRegistro) {
    modalRegistro.style.display = "none";
  }
});
