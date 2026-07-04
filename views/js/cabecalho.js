function aplicarTemaSalvo() {
    const tema = localStorage.getItem("tema");

    if (tema === "dark") {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }

    atualizarBotaoTema();
}

function alternarTema() {
    document.body.classList.toggle("dark-mode");

    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("tema", "dark");
    } else {
        localStorage.setItem("tema", "light");
    }

    atualizarBotaoTema();
}

function atualizarBotaoTema() {
    const botao = document.getElementById("btnTema");

    if (!botao) {
        return;
    }

    if (document.body.classList.contains("dark-mode")) {
        botao.innerText = "☀️";
        botao.title = "Ativar modo claro";
    } else {
        botao.innerText = "🌙";
        botao.title = "Ativar modo escuro";
    }
}

document.addEventListener("DOMContentLoaded", aplicarTemaSalvo);