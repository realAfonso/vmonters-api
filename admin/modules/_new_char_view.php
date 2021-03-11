<?

$db = new Database();

showHeader("Novo personagem");

startContainer();

    if($data[m] != "") {

        startSection();

        if($data[m] == "e") {
            showErrorMessage("Erro ao cadastrar personagem. Verifique os dados e tente novamente!");
        } else if($data[m] == "s") {
            showSuccessMessage("Personagem cadastrado com sucesso!");
        }

        endSection();

    }

    startSection();

        startForm("POST", "../modules/_new_char_submit.php", true);

            startCard();
                startCardBody();

                startRow();
                    inputText("Nome", "name", true, "Agumon");
                endRow();

                startRow();
                    inputImage("Selecione o ícone (300x300)", "icon");
                endRow();

                startRow();
                    inputImage("Selecione a imagem (300x533)", "image");
                endRow();

                startRow();
                    inputText("Fala padrão", "defaultText", true, "Eu gosto de comer doces...");
                endRow();

                endCardBody();

            showCardFooter("Cadastrar");

            endCard();

        endForm();

    endSection();

endContainer();

?>