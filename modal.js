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
