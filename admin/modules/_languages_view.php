<?

$db = new Database();

showHeader("Linguagens");

startContainer();

    if($data[m] != "") {

        startSection();

        if($data[m] == "e") {
            showErrorMessage("Erro ao cadastrar linguagem. Verifique os dados e tente novamente!");
        } else if($data[m] == "s") {
            showSuccessMessage("Linguagem cadastrado com sucesso!");
        }

        endSection();

    }

    startSection();

        startForm("POST", "../modules/_languages_submit.php");

            startCard();
                startCardBody();

                    startRow();
                        inputText("Nome", "name", true, "Português", 8);
                        inputText("Código", "code", true, "pt-BR", 4);
                    endRow();

                endCardBody();

                showCardFooter("Cadastrar");

            endCard();

        endForm(); ?>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Linguagens cadastradas</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Código</th>
                </tr>
              </thead>
              <tbody>

                <?
                    $r = $db->select("vms_languages", "ORDER BY name ASC");
                    while($l = mysqli_fetch_array($r, MYSQLI_ASSOC)){ ?>

                      <tr>
                        <td><?=$l[id]?></td>
                        <td><?=$l[name]?></td>
                        <td><?=$l[code]?></td>
                      </tr>

                <? } ?>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div> <?php

    endSection();

endContainer();

?>