<?

$db = new Database();

showHeader("Novo avatar");

startContainer();

    if($data[m] != "") {

        startSection();

        if($data[m] == "e") {
            showErrorMessage("Erro ao cadastrar avatar. Verifique os dados e tente novamente!");
        } else if($data[m] == "s") {
            showSuccessMessage("Avatar cadastrado com sucesso!");
        }

        endSection();

    }

    startSection();

        startForm("POST", "../modules/_new_avatar_submit.php", true);

            startCard();
                startCardBody();

                    startRow();
                        inputText("Descrição", "description", true, "The best avatar ever!", 8);
                        inputNumber("Preço", "price", true, "500", 4, $data[prc]);
                    endRow();

                    startRow();
                        inputRadio("Padrão", "isDefault", "1", "1");
                        inputRadio("Para venda", "isDefault", "0", "2", "", true);
                    endRow();

                    startRow();
                        inputImage("Selecione a imagem...", "image");
                    endRow();

                    startRow();
                        inputText("Disponível de...", "startDate", false, "24-12-2020 00:00", 6, $data[sd]);
                        inputText("Disponível até...", "endDate", false, "25-12-2020 23:59", 6, $data[ed]);
                    endRow();

                    startRow();
                        inputRadio("Ativo", "status", "1", "1", "", true);
                        inputRadio("Inativo", "status", "0", "2");
                    endRow();

                endCardBody();

                showCardFooter("Cadastrar");

            endCard();

        endForm();

    endSection();

endContainer();

?>