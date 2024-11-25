function iniciarTrocaDeImagens() {
    const intervalo = 10000; // 10 segundos
    const imagens = [
        ['ImagensPetala/cabeloPetala.jpg', 'ImagensPetala/manicurePetala.jpg'], // imagens iniciais
        ['ImagensPetala/coloracaoPetala.jpg', 'ImagensPetala/pePetala.jpg'], // novas imagens
    ];

    let indiceImagem = 1;

    function trocarImagens() {
        // Obtém as imagens atuais
        const [imagem1Src, imagem2Src] = imagens[indiceImagem];

        // Seleciona as imagens
        const imagem1 = document.getElementById('imagem1');
        const imagem2 = document.getElementById('imagem2');

        // Efeito imagens
        imagem1.style.opacity = 0;
        imagem2.style.opacity = 0;

        setTimeout(() => {
            imagem1.src = imagem1Src;
            imagem2.src = imagem2Src;

            imagem1.style.opacity = 1;
            imagem2.style.opacity = 1;
        }, 1000);

        // Atualiza o índice para o próximo conjunto de imagens
        indiceImagem = (indiceImagem + 1) % imagens.length;
    }
    setInterval(trocarImagens, intervalo);
}

// Chama a função quando a página carrega
window.onload = iniciarTrocaDeImagens;
