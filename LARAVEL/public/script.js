document.addEventListener("DOMContentLoaded", () => {
    // Deixa um select com um valor selecionado
    for (select of document.querySelectorAll("select[data-value]")) {
        select.value = select.dataset.value;
    }
});