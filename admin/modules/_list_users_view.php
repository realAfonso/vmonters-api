<?

$db = new Database();

?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Usuários ativos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <section class="col-lg-12 connectedSortable">

                    <form action="../dashboard">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="hidden" name="o" value="lu">
                                    <input type="search" class="form-control form-control-lg" name="s"
                                           placeholder="Pesquisar por usuário ou e-mail">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Usuários ativos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuário</th>
                                    <th>E-mail</th>
                                    <th>Assinatura</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?

                                if ($data[s] != "") {
                                    $r = $db->select("vms_active_users", "WHERE name LIKE '%$data[s]%' OR email LIKE '%$data[s]%'");
                                } else {
                                    $r = $db->select("vms_active_users");
                                }

                                while ($l = mysqli_fetch_array($r, MYSQLI_ASSOC)) { ?>

                                    <tr>
                                        <td><?= $l[id] ?></td>
                                        <td onclick="location.href='../dashboard?o=ub&i=<?= $l[id] ?>'"
                                            style="cursor: pointer;">
                                            <img src="http://api.vmonsters.com/assets/avatars/<?= $l[avatar] ?>"
                                                 class="brand-image img-circle"
                                                 height="30px">&nbsp;&nbsp;<u><?= getName($l[name], $l[id]) ?></u>
                                        </td>
                                        <td><?= $l[email] ?></td>
                                        <td><select class="form-control" id="selectUser<?= $l[id] ?>"
                                                    onchange="changeVip(<?= $l[id] ?>, <?= $l[vip] ?>)"><?
                                            echo "<option value=\"0\" ";
                                            if ($l[vip] == 0) echo "selected";
                                            echo ">N/A</option>";

                                            echo "<option value=\"1\" ";
                                            if ($l[vip] == 1) echo "selected";
                                            echo ">Baby</option>";

                                            echo "<option value=\"2\" ";
                                            if ($l[vip] == 2) echo "selected";
                                            echo ">In-Training</option>";

                                            echo "<option value=\"3\" ";
                                            if ($l[vip] == 3) echo "selected";
                                            echo ">Rookie</option>";

                                            echo "<option value=\"4\" ";
                                            if ($l[vip] == 4) echo "selected";
                                            echo ">Champion</option>";

                                            echo "<option value=\"99\" ";
                                            if ($l[vip] == 99) echo "selected";
                                            echo ">Yggdrasil</option>";

                                            ?></td>
                                    </tr>

                                <? } ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>

    <script>

        function changeVip(selectedUserId, lastUserVip) {
            var selection = document.getElementById("selectUser" + selectedUserId);

            if (confirm("Tem certeza de que deseja trocar o nível de VIP do usuário?")) {
                location.href = "../modules/_change_user_vip.php?u=" + selectedUserId + "&v=" + selection.value;
            } else {
                selection.value = lastUserVip;
            }
        }

    </script>

<?

function getName($name, $id)
{
    if (!empty($name)) return $name;
    else return "Player12$id";
}

?>