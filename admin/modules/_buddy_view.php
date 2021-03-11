<?

$db = new Database();

$user = getUser($data[i]);

showHeader($user[name]);

startContainer();

    startSection();

        startCard();
            startCardBody();

                startRow();
                    inputText("Nome", "", false, "", 4, $user[buddy][name], false);
                    inputText("Personalidade", "", false, "", 4, $user[buddy][personality], false);
                    inputText("Espécie", "", false, "", 4, $user[buddy][specie], false);
                endRow();

                startRow();
                    inputText("Base HP", "", false, "", 2, ($user[buddy][baseHp]*5), false);
                    inputText("Base ATK", "", false, "", 2, $user[buddy][baseAtk], false);
                    inputText("Base DEF", "", false, "", 2, $user[buddy][baseDef], false);
                    inputText("Base SP.ATK", "", false, "", 2, $user[buddy][baseSpAtk], false);
                    inputText("Base SP.DEF", "", false, "", 2, $user[buddy][baseSpDef], false);
                    inputText("Base SPD", "", false, "", 2, $user[buddy][baseSpd], false);
                endRow();

                startRow();
                    inputText("EU HP", "", false, "", 2, (intval($user[buddy][euHp]/4)*5), false);
                    inputText("EU ATK", "", false, "", 2, intval($user[buddy][euAtk]/4), false);
                    inputText("EU DEF", "", false, "", 2, intval($user[buddy][euDef]/4), false);
                    inputText("EU SP.ATK", "", false, "", 2, intval($user[buddy][euSpAtk]/4), false);
                    inputText("EU SP.DEF", "", false, "", 2, intval($user[buddy][euSpDef]/4), false);
                    inputText("EU SPD", "", false, "", 2, intval($user[buddy][euSpd]/4), false);
                endRow();

                startRow();
                    inputText("True HP", "", false, "", 2, $user[buddy][hp], false);
                    inputText("True ATK", "", false, "", 2, $user[buddy][atk], false);
                    inputText("True DEF", "", false, "", 2, $user[buddy][def], false);
                    inputText("True SP.ATK", "", false, "", 2, $user[buddy][spatk], false);
                    inputText("True SP.DEF", "", false, "", 2, $user[buddy][spdef], false);
                    inputText("True SPD", "", false, "", 2, $user[buddy][spd], false);
                endRow();

            endCardBody();

        endCard();

    endSection();

endContainer();

?>