<?

$db = new Database();

$chars = $db->selectArray("vms_chars");

$charsToSelection = array();
foreach ($chars as $value) {
    $char = array(
        "value" => $value[id],
        "label" => $value[name]
    );
    array_push($charsToSelection, $char);
}

$keys = $db->selectArray("vms_keywords", "GROUP BY keyword");

$keysToSelection = array();
array_push($keysToSelection, array(
    "value" => "",
    "label" => "N/A"
));
foreach ($keys as $value) {
    $key = array(
        "value" => $value[keyword],
        "label" => $value[label]
    );
    array_push($keysToSelection, $key);
}

showHeader("Nova cena");

startContainer();

    if($data[m] != "") {

        startSection();

        if($data[m] == "e") {
            showErrorMessage("Erro ao cadastrar cena. Verifique os dados e tente novamente!");
        } else if($data[m] == "s") {
            showSuccessMessage("Cena cadastrada com sucesso!");
        }

        endSection();

    }

    startSection();

        startForm("POST", "../modules/_new_scene_submit.php", true);

            startCard();
                startCardBody();

                    startRow();
                        inputRadio("Início", "position", 1);
                        inputRadio("Meio", "position", 2, 1, "", true);
                        inputRadio("Fim", "position", 3);
                    endRow();

                    startRow();
                        inputText("Chave da cena", "keyy", true, "CENA", 8, $data[k]);
                        inputText("Ação extra", "extraAction", false, "ACTION_HERE", 4);
                    endRow();

                    startRow();
                        inputSelect("Personagem", "charId", $charsToSelection, $data[ci], "", true, 4);
                        inputSelect("Liberar palavra-chave", "unlockKeyword", $keysToSelection, "", "", false, 4);
                        inputSelect("Remover palavra-chave", "removeKeyword", $keysToSelection, "", "", false, 4);
                    endRow();

                    startRow();
                        inputTextArea("Texto", "text", true, "Será que chove?");
                    endRow();

                endCardBody();

                showCardFooter("Cadastrar");

            endCard();

        endForm();

    endSection();

endContainer();

?>