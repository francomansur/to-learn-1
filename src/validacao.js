/**
 * validacao.js — Funções de validação compartilhadas
 */

/**
 * Valida CPF: remove pontos e traço, verifica se tem exatamente 11 dígitos
 * e se não são todos iguais.
 * @param {string} cpf
 * @returns {boolean}
 */
function cpfValido(cpf) {
    cpf = cpf.replace(/[.\-]/g, '').trim(); // remove pontos e traço
    cpf = cpf.replace(/\D/g, '');           // remove qualquer outro não-dígito
    if (cpf.length !== 11) return false;
    if (/^(\d)\1{10}$/.test(cpf)) return false; // rejeita 00000000000, 11111111111...
    return true;
}

/**
 * Valida senha forte: mínimo 6 chars, 1 maiúscula, 1 minúscula, 1 número, 1 especial.
 * @param {string} senha
 * @returns {boolean}
 */
function senhaValida(senha) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{6,}$/.test(senha);
}

/**
 * Mostra erro em um campo: borda vermelha + mensagem abaixo do input.
 * @param {HTMLElement} input
 * @param {string} msg
 */
function mostrarErro(input, msg) {
    input.classList.add('input-error');
    let hint = input.parentElement.querySelector('.field-hint');
    if (!hint) {
        hint = document.createElement('span');
        hint.className = 'field-hint error-hint';
        input.parentElement.appendChild(hint);
    }
    hint.textContent = msg;
    hint.style.display = 'block';
    input.focus();
}

/**
 * Remove erro de um campo.
 * @param {HTMLElement} input
 */
function limparErro(input) {
    input.classList.remove('input-error');
    const hint = input.parentElement.querySelector('.field-hint');
    if (hint) hint.style.display = 'none';
}

/**
 * Validação completa de cadastro (CPF + senha obrigatória).
 * @param {HTMLFormElement} form
 * @returns {boolean}
 */
function validarCadastro(form) {
    let valido = true;

    const campoCpf   = form.querySelector('[name="cpf"]');
    const campoSenha = form.querySelector('[name="senha"]');

    limparErro(campoCpf);
    limparErro(campoSenha);

    if (!cpfValido(campoCpf.value.trim())) {
        mostrarErro(campoCpf, 'Informe um CPF válido (11 dígitos).');
        valido = false;
    }

    if (!senhaValida(campoSenha.value)) {
        mostrarErro(campoSenha, 'Mínimo 6 caracteres: 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial.');
        if (valido) campoSenha.focus();
        valido = false;
    }

    return valido;
}

/**
 * Validação de edição (CPF sempre obrigatório; senha só validada se preenchida).
 * @param {HTMLFormElement} form
 * @returns {boolean}
 */
function validarEdicao(form) {
    let valido = true;

    const campoCpf   = form.querySelector('[name="cpf"]');
    const campoSenha = form.querySelector('[name="senha"]');

    limparErro(campoCpf);
    limparErro(campoSenha);

    if (!cpfValido(campoCpf.value.trim())) {
        mostrarErro(campoCpf, 'Informe um CPF válido (11 dígitos).');
        valido = false;
    }

    if (campoSenha && campoSenha.value.trim() !== '') {
        if (!senhaValida(campoSenha.value)) {
            mostrarErro(campoSenha, 'Mínimo 6 caracteres: 1 maiúscula, 1 minúscula, 1 número e 1 caractere especial.');
            if (valido) campoSenha.focus();
            valido = false;
        }
    }

    return valido;
}

/* Limpa erros visuais ao começar a digitar */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.input').forEach(function (input) {
        input.addEventListener('input', function () { limparErro(this); });
    });
});
