<?php

$db = new Database();


$mapSelected = $data[map];
$pointSelected = $data[point];

$places = $db->selectArray("vms_maps");

$placesToSelection = array();
foreach ($places as $value) {
    if ($value[id] == $mapSelected) $mapType = $value[type];
    $place = array(
        "value" => $value[id],
        "label" => $value[name]
    );
    array_push($placesToSelection, $place);
}

$keys = $db->selectArray("vms_keywords", "WHERE language = '1'");

$keysToSelection = array();
foreach ($keys as $value) {
    $keyy = array(
        "value" => $value[keyword],
        "label" => $value[label]
    );
    array_push($keysToSelection, $keyy);
}

$scenes = $db->selectArray("vms_scenes", "WHERE position = '1'");

$scenesToSelection = array();
foreach ($scenes as $value) {
    $scene = array(
        "value" => $value[keyy],
        "label" => $value[keyy]
    );
    array_push($scenesToSelection, $scene);
}

$points = $db->selectArray("vms_map_has_place", "WHERE map = '$mapSelected'");

$pointsToSelection = array();
foreach ($points as $value) {
    $name = $value[actionId];
    if ($value[type] == "MAP") {
        $aux = $db->selectObject("vms_maps", "WHERE id = '$value[actionId]'");
        $name = $aux[name];
    } else if ($value[type] == "CHAR") {
        $aux = $db->selectObject("vms_chars", "WHERE id = '$value[actionId]'");
        $name = $aux[name];
    }

    $point = array(
        "value" => $value[id],
        "label" => $name
    );
    array_push($pointsToSelection, $point);
}

showHeader("Editar história");

startContainer();

if ($data[m] != "") {

    startSection();

    if ($data[m] == "e") {
        showErrorMessage("Erro ao editar história. Verifique os dados e tente novamente!");
    } else if ($data[m] == "s") {
        showSuccessMessage("História cadastrada com sucesso!");
    }

    endSection();

}

startSection();
    startForm("GET", "../dashboard");
        startCard();
            startCardBody();
                startRow();
                    inputHidden("o", "eh");
                    inputSelect("Mapa", "map", $placesToSelection, $mapSelected);
                endRow();
            endCardBody();
            showCardFooter("Selecionar mapa");
        endCard();
    endForm();
endSection();

if (!empty($mapSelected)) {

    startSection();
        startForm("GET", "../dashboard");
            startCard();
                startCardBody();
                    startRow();
                        inputHidden("o", "eh");
                        inputHidden("map", $mapSelected);
                        inputSelect("Ponto de interesse", "point", $pointsToSelection, $pointSelected);
                    endRow();
                endCardBody();
                showCardFooter("Selecionar ponto");
            endCard();
        endForm();
    endSection();

}

if (!empty($pointSelected)) {

    startSection();

        startForm("POST", "../modules/_edit_story_submit.php", true);

            startCard();
                startCardBody();

                    inputHidden("place", $pointSelected);

                    startRow();
                        inputSelect("Palavra-chave", "keyword", $keysToSelection, "", "", true, 6);
                        inputSelect("Cena", "scene", $scenesToSelection, "", "", true, 6);
                    endRow();

                endCardBody();

                showCardFooter("Cadastrar história");

            endCard();

        endForm();

    endSection();

}

endContainer();

?>