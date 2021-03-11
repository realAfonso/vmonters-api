<?

$db = new Database();

showHeader("Novo ícone");

startContainer();

    if($data[m] != "") {

        startSection();

        if($data[m] == "e") {
            showErrorMessage("Erro ao cadastrar ícone. Verifique os dados e tente novamente!");
        } else if($data[m] == "s") {
            showSuccessMessage("Ícone cadastrado com sucesso!");
        }

        endSection();

    }

    startSection();

        startForm("POST", "../modules/_new_icon_submit.php", true);

            startCard();
                startCardBody();

                    startRow();
                        inputText("Nome", "name", true, "Porta");
                    endRow();

                    startRow();
                        inputImage("Selecione a imagem...", "icon");
                    endRow();

                endCardBody();

                showCardFooter("Cadastrar");

            endCard();

        endForm();

    endSection();

endContainer();

?>