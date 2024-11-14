function validarFormulario(formulario) {
    const campos = formulario.querySelectorAll('input[required]');
    for (let campo of campos) {
        if (!campo.value) {
            alert('Por favor, preencha todos os campos!');
            return false;
        }
    }

    // Validação de e-mail simples
    const email = formulario.querySelector('input[type="email"]');
    if (email && !/\S+@\S+\.\S+/.test(email.value)) {
        alert('Por favor, insira um e-mail válido!');
        return false;
    }

    return true;
}

const DB = {
    salvarPerguntaPrototipo(pergunta) {
        let perguntas = JSON.parse(localStorage.getItem('perguntas_prototipo') || '[]');
        perguntas.push(pergunta);
        localStorage.setItem('perguntas_prototipo', JSON.stringify(perguntas));
    },

    salvarPerguntaDefinitiva(pergunta) {
        let perguntas = JSON.parse(localStorage.getItem('perguntas_definitivas') || '[]');
        perguntas.push(pergunta);
        localStorage.setItem('perguntas_definitivas', JSON.stringify(perguntas));
    },

    getPerguntasPrototipo() {
        return JSON.parse(localStorage.getItem('perguntas_prototipo') || '[]');
    },

    getPerguntasDefinitivas() {
        return JSON.parse(localStorage.getItem('perguntas_definitivas') || '[]');
    },

    removerPerguntaPrototipo(index) {
        let perguntas = this.getPerguntasPrototipo();
        perguntas.splice(index, 1);
        localStorage.setItem('perguntas_prototipo', JSON.stringify(perguntas));
    },

    removerPerguntaDefinitiva(pergunta) {
        let perguntas = this.getPerguntasDefinitivas();
        perguntas = perguntas.filter(p => JSON.stringify(p) !== JSON.stringify(pergunta));
        localStorage.setItem('perguntas_definitivas', JSON.stringify(perguntas));
    },

    editarPerguntaDefinitiva(perguntaAntiga, perguntaNova) {
        let perguntas = this.getPerguntasDefinitivas();
        const index = perguntas.findIndex(p => JSON.stringify(p) === JSON.stringify(perguntaAntiga));
        if (index !== -1) {
            perguntas[index] = perguntaNova;
            localStorage.setItem('perguntas_definitivas', JSON.stringify(perguntas));
            return true;
        }
        return false;
    }
};

const Usuario = {
    cadastrar(nome, email, senha) {
        let usuarios = JSON.parse(localStorage.getItem('usuarios') || '[]');
        usuarios.push({ nome, email, senha });
        localStorage.setItem('usuarios', JSON.stringify(usuarios));
    },

    login(email, senha) {
        let usuarios = JSON.parse(localStorage.getItem('usuarios') || '[]');
        const usuario = usuarios.find(u => u.email === email);
        if (!usuario) return { sucesso: false, mensagem: "E-mail não encontrado." };
        if (usuario.senha === senha) {
            return { sucesso: true };
        } else {
            return { sucesso: false, mensagem: "Senha incorreta." };
        }
    }
};

function calcularResultados(respostas, gabaritos) {
    let acertos = 0;
    let resultados = [];

    for (let i = 0; i < respostas.length; i++) {
        let correto = respostas[i] === gabaritos[i];
        if (correto) acertos++;

        resultados.push({
            perguntaNum: i + 1,
            resposta: respostas[i],
            gabarito: gabaritos[i],
            correto: correto
        });
    }

    return {
        acertos,
        total: respostas.length,
        detalhes: resultados
    };
}
