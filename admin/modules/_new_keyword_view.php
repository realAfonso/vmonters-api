<?

$db = new Database();

$languages = $db->selectArray("vms_languages");

showHeader("Nova palavra-chave");

startContainer();

    if($data[m] != "") {

        startSection();

        if($data[m] == "e") {
            showErrorMessage("Erro ao cadastrar palavra-chave. Verifique os dados e tente novamente!");
        } else if($data[m] == "s") {
            showSuccessMessage("Palavra-chave cadastrado com sucesso!");
        }

        endSection();

    }

    startSection();

        startForm("POST", "../modules/_new_keyword_submit.php");

            startCard();
                startCardBody();

                    $isFirst = true;

                    foreach ($languages as $lang) {

                        startRow();
                            if($isFirst) {
                                inputText("Label ($lang[name])", "keyys[$lang[id]][label]", true, "Papai-noel", 6);
                                inputText("Palavra-chave", "keyys[$lang[id]][keyword]", true, "PAPAINOEL", 6);
                                $isFirst = false;
                            }else{
                                inputText("Label ($lang[name])", "keyys[$lang[id]][label]", true, "Papai-noel");
                            }
                        endRow();

                        startRow();
                            inputText("Objetivo ($lang[name])", "keyys[$lang[id]][target]", true, "Vá até o polo-norte!");
                            inputHidden("keyys[$lang[id]][language]", "$lang[id]");
                        endRow();

                        ?><br><hr><br><?

                    }

                endCardBody();

                showCardFooter("Cadastrar");

            endCard();

        endForm();

    endSection();

endContainer();

?>