function iniciarTrocaDeImagens() {
    const intervalo = 10000; // 10 segundos
    const imagens = [
        ['ImagensPetala/cabeloPetala.jpg', 'ImagensPetala/manicurePetala.jpg'],
        ['ImagensPetala/coloracaoPetala.jpg', 'ImagensPetala/PePetala.jpg'],
    ];

    let indiceImagem = 1;

    function trocarImagens() {

        const [imagem1Src, imagem2Src] = imagens[indiceImagem];

        const imagem1 = document.getElementById('imagem1');
        const imagem2 = document.getElementById('imagem2');

        imagem1.style.opacity = 0;
        imagem2.style.opacity = 0;

        setTimeout(() => {
            imagem1.src = imagem1Src;
            imagem2.src = imagem2Src;

            imagem1.style.opacity = 1;
            imagem2.style.opacity = 1;
        }, 1000);

        indiceImagem = (indiceImagem + 1) % imagens.length;
    }
    setInterval(trocarImagens, intervalo);
}

window.onload = iniciarTrocaDeImagens;
