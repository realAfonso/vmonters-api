<?

$db = new Database();

showHeader("Novo mapa");

startContainer();

    if($data[m] != "") {

         startSection();

            if($data[m] == "e") {
                showErrorMessage("Erro ao cadastrar Digimon. Verifique os dados e tente novamente!");
            } else if($data[m] == "s") {
                showSuccessMessage("Digimon cadastrado com sucesso!");
            }

         endSection();

    }

    startSection();

        startForm("POST", "../modules/_new_map_submit.php", true);

            startCard();
                startCardBody();

                    startRow();
                        inputText("Nome", "name", true, "Sala do prefeito", 8);
                        inputText("Key", "keyy", true, "MAYOR_ROOM", 4);
                    endRow();

                    startRow();
                        inputRadio("Área externa", "type", 1, 1, "isExternal()", true);
                        inputRadio("Área interna", "type", 2, 1, "isInternal()");
                        inputRadio("Sala interna", "type", 3, 1, "isInternal()");
                    endRow();

                    startRow("backgroundMapInternal");
                        inputImage("Fundo do mapa (1080x1920)", "imageInteral", false);
                    endRow();

                    startRow("backgroundStoryInternal");
                        inputImage("Fundo da história (1080x1920)", "storyInternal", false);
                    endRow();

                    startRow("backgroundMapExternalDay");
                        inputImage("Fundo do mapa de dia (1080x1920)", "imageDay", false);
                    endRow();

                    startRow("backgroundMapExternalNight");
                        inputImage("Fundo do mapa de noite (1080x1920)", "imageNight", false);
                    endRow();

                    startRow("backgroundStoryExternalDay");
                        inputImage("Fundo da história de dia (1080x1920)", "storyDay", false);
                    endRow();

                    startRow("backgroundStoryExternalNight");
                        inputImage("Fundo da história de noite (1080x1920)", "storyNight", false);
                    endRow();

                endCardBody();

                showCardFooter("Cadastrar");

            endCard();

        endForm();

    endSection();

endContainer();

?>

<script type="text/javascript">
    function isExternal(){
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

    function isInternal(){
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