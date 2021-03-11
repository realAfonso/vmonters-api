<?php

$db = new Database();


$mapSelected = $data[map];
$localId = $data[a];

$mapType = 1;

$places = $db->selectArray("vms_maps");

$placesToSelection = array();
foreach ($places as $value) {
    if($value[id] == $mapSelected) $mapType = $value[type];
    $place = array(
        "value" => $value[id],
        "label" => $value[name]
    );
    array_push($placesToSelection, $place);
}

$chars = $db->selectArray("vms_chars");

$charsToSelection = array();
foreach ($chars as $value) {
    $char = array(
        "value" => $value[id],
        "label" => $value[name]
    );
    array_push($charsToSelection, $char);
}

showHeader("Editar locais");

startContainer();

    if ($data[m] != "") {

        startSection();

        if ($data[m] == "e") {
            showErrorMessage("Erro ao editar local. Verifique os dados e tente novamente!");
        } else if ($data[m] == "s") {
            showSuccessMessage("Local cadastrado com sucesso!");
        }

        endSection();

    }

    startSection();
        startForm("GET", "../dashboard");
        startCard();
            startCardBody();
                startRow();
                    inputHidden("o", "el");
                    inputSelect("Mapa", "map", $placesToSelection, $mapSelected);
                endRow();
            endCardBody();
            showCardFooter("Selecionar mapa");
        endCard();
        endForm();
    endSection();

    if(!empty($mapSelected)) {

        startSection();

            startForm("GET", "../dashboard");

                startCard();
                    startCardBody();

                        inputHidden("o", "el");
                        inputHidden("map", $mapSelected);

                        startRow();
                            inputRadio("A1", "a", "A1", 1, "", $localId == "A1", $mapType == 1);
                            inputRadio("B1", "a", "B1", 1, "", $localId == "B1", $mapType <= 2);
                            inputRadio("C1", "a", "C1", 1, "", $localId == "C1");
                            inputRadio("D1", "a", "D1", 1, "", $localId == "D1");
                            inputRadio("E1", "a", "E1", 1, "", $localId == "E1");
                            inputRadio("F1", "a", "F1", 1, "", $localId == "F1");
                            inputRadio("G1", "a", "G1", 1, "", $localId == "G1", $mapType <= 2);
                            inputRadio("H1", "a", "H1", 1, "", $localId == "H1", $mapType == 1);
                        endRow();

                        startRow();
                            inputRadio("A2", "a", "A2", 1, "", $localId == "A2", $mapType == 1);
                            inputRadio("B2", "a", "B2", 1, "", $localId == "B2", $mapType <= 2);
                            inputRadio("C2", "a", "C2", 1, "", $localId == "C2");
                            inputRadio("D2", "a", "D2", 1, "", $localId == "D2");
                            inputRadio("E2", "a", "E2", 1, "", $localId == "E2");
                            inputRadio("F2", "a", "F2", 1, "", $localId == "F2");
                            inputRadio("G2", "a", "G2", 1, "", $localId == "G2", $mapType <= 2);
                            inputRadio("H2", "a", "H2", 1, "", $localId == "H2", $mapType == 1);
                        endRow();

                        startRow();
                            inputRadio("A3", "a", "A3", 1, "", $localId == "A3", $mapType == 1);
                            inputRadio("B3", "a", "B3", 1, "", $localId == "B3", $mapType <= 2);
                            inputRadio("C3", "a", "C3", 1, "", $localId == "C3");
                            inputRadio("D3", "a", "D3", 1, "", $localId == "D3");
                            inputRadio("E3", "a", "E3", 1, "", $localId == "E3");
                            inputRadio("F3", "a", "F3", 1, "", $localId == "F3");
                            inputRadio("G3", "a", "G3", 1, "", $localId == "G3", $mapType <= 2);
                            inputRadio("H3", "a", "H3", 1, "", $localId == "H3", $mapType == 1);
                        endRow();

                        startRow();
                            inputRadio("A4", "a", "A4", 1, "", $localId == "A4", $mapType == 1);
                            inputRadio("B4", "a", "B4", 1, "", $localId == "B4", $mapType <= 2);
                            inputRadio("C4", "a", "C4", 1, "", $localId == "C4");
                            inputRadio("D4", "a", "D4", 1, "", $localId == "D4");
                            inputRadio("E4", "a", "E4", 1, "", $localId == "E4");
                            inputRadio("F4", "a", "F4", 1, "", $localId == "F4");
                            inputRadio("G4", "a", "G4", 1, "", $localId == "G4", $mapType <= 2);
                            inputRadio("H4", "a", "H4", 1, "", $localId == "H4", $mapType == 1);
                        endRow();

                    endCardBody();

                    showCardFooter("Selecionar local");

                endCard();

            endForm();

        endSection();

    }

    if(!empty($localId)) {

        startSection();

            startForm("POST", "../modules/_edit_place_submit.php", true);

                startCard();
                    startCardBody();

                        inputHidden("map", $mapSelected);
                        inputHidden("field", $localId);

                        startRow();
                            $placeTypes = array();
                            array_push($placeTypes, array("value" => "MAP", "label" => "Mapa"));
                            array_push($placeTypes, array("value" => "CHAR", "label" => "Personagem"));
                            inputSelect("Tipo de local", "type", $placeTypes, "", "onTypeChange()");
                        endRow();

                        startRow("selectMap");
                            inputSelect("Mapa", "actionIdMap", $placesToSelection);
                        endRow();

                        startRow("selectChar");
                            inputSelect("Personagem", "actionIdChar", $charsToSelection);
                        endRow();

                        startRow();
                            inputRadio("Sempre visível", "visibility", "1", 2, "", true);
                            inputRadio("Visível à noite", "visibility", "2", 2);
                            inputRadio("Visível de dia", "visibility", "3", 2);
                        endRow();

                        startRow();
                            $cusic = $db->selectArray("vms_custom_icons");

                            $iconsToSelection = array();
                            array_push($iconsToSelection, array(
                                "value" => "default",
                                "label" => "Padrão"
                            ));
                            foreach ($cusic as $value) {
                                $ico = array(
                                    "value" => $value[icon],
                                    "label" => $value[name]
                                );
                                array_push($iconsToSelection, $ico);
                            }
                            inputSelect("Ícones", "icons", $iconsToSelection);
                        endRow();

                        startRow();
                            inputImage("Ícone personalizado...", "icon", false);
                        endRow();

                    endCardBody();

                    showCardFooter("Cadastrar local");

                endCard();

            endForm();

        endSection();

    }

endContainer();

?>

<script>
    selectMap.style.visibility = 'visible';
    selectMap.style.height = 'auto';
    selectMap.style.width = 'auto';

    selectChar.style.visibility = 'hidden';
    selectChar.style.height = '0';
    selectChar.style.width = '0';
</script>

<script type="text/javascript">
    function onTypeChange(){
        if(type.options[type.selectedIndex].value == "MAP"){
            selectMap.style.visibility = 'visible';
            selectMap.style.height = 'auto';
            selectMap.style.width = 'auto';

            selectChar.style.visibility = 'hidden';
            selectChar.style.height = '0';
            selectChar.style.width = '0';
        }else{
            selectChar.style.visibility = 'visible';
            selectChar.style.height = 'auto';
            selectChar.style.width = 'auto';

            selectMap.style.visibility = 'hidden';
            selectMap.style.height = '0';
            selectMap.style.width = '0';
        }
    }

    function isExternal() {
        backgroundMapExternalDay.style.visibility = 'visible';
        backgroundMapExternalDay.style.height = 'auto';
        backgroundMapExternalDay.style.width = 'auto';

        backgroundMapExternalNight.style.visibility = 'visible';
        backgroundMapExternalNight.style.height = 'auto';
        backgroundMapExternalNight.style.width = 'auto';

        backgroundStoryExternalDay.style.visibility = 'visible';
        backgroundStoryExternalDay.style.height = 'auto';
        backgroundStoryExternalDay.style.width = 'auto';

        backgroundStoryExternalNight.style.visibility = 'visible';
        backgroundStoryExternalNight.style.height = 'auto';
        backgroundStoryExternalNight.style.width = 'auto';

        backgroundMapInternal.style.visibility = 'hidden';
        backgroundMapInternal.style.height = '0';
        backgroundMapInternal.style.width = '0';

        backgroundStoryInternal.style.visibility = 'hidden';
        backgroundStoryInternal.style.height = '0';
        backgroundStoryInternal.style.width = '0';
    }

    function isInternal() {
        backgroundMapExternalDay.style.visibility = 'hidden';
        backgroundMapExternalDay.style.height = '0';
        backgroundMapExternalDay.style.width = '0';

        backgroundMapExternalNight.style.visibility = 'hidden';
        backgroundMapExternalNight.style.height = '0';
        backgroundMapExternalNight.style.width = '0';

        backgroundStoryExternalDay.style.visibility = 'hidden';
        backgroundStoryExternalDay.style.height = '0';
        backgroundStoryExternalDay.style.width = '0';

        backgroundStoryExternalNight.style.visibility = 'hidden';
        backgroundStoryExternalNight.style.height = '0';
        backgroundStoryExternalNight.style.width = '0';

        backgroundMapInternal.style.visibility = 'visible';
        backgroundMapInternal.style.height = 'auto';
        backgroundMapInternal.style.width = 'auto';

        backgroundStoryInternal.style.visibility = 'visible';
        backgroundStoryInternal.style.height = 'auto';
        backgroundStoryInternal.style.width = 'auto';
    }

    isExternal();
</script>