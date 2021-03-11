<?php

function showHeader($title)
{
    echo "<div class=\"content-header\">
            <div class=\"container-fluid\">
                <div class=\"row mb-2\">
                    <div class=\"col-sm-6\">
                        <h1 class=\"m-0\">$title</h1>
                    </div>
                    <div class=\"col-sm-6\">
                    </div>
                </div>
            </div>
        </div>";
}

function startContainer()
{
    echo "<section class=\"content\">
        <div class=\"container-fluid\">";
}

function endContainer()
{
    echo "</div></section>";
}

function startSection($col = 12)
{
    echo "<div class=\"row\"><section class=\"col-lg-$col\">";
}

function endSection()
{
    echo "</section></div>";
}

function startCard()
{
    echo "<div class=\"card\">";
}

function endCard()
{
    echo "</div>";
}

function startCardBody()
{
    echo "<div class=\"card-body\">";
}

function endCardBody()
{
    echo "</div>";
}

function startForm($method, $action, $hasUpload = false)
{
    echo "<form method=\"$method\" action=\"$action\" ";
    if ($hasUpload) echo "enctype=\"multipart/form-data\"";
    echo ">";
}

function endForm()
{
    echo "</form>";
}

function startRow($id = "")
{
    echo "<div id=\"$id\" class=\"row\">";
}

function endRow()
{
    echo "</div>";
}

function inputText($label, $name, $isRequired = false, $placeholder = "", $col = 12, $value = "", $isEnable = true)
{
    echo "<div class=\"col-sm-$col\">
            <div class=\"form-group\">
                <label>$label ";
    if ($isRequired) echo "*";
    echo "</label>
                <input type=\"text\" name=\"$name\" class=\"form-control\" placeholder=\"$placeholder\" value=\"$value\" ";
    if ($isEnable == false) echo "disabled ";
    if ($isRequired) echo "required";
    echo ">
            </div>
        </div>";
}

function inputTextArea($label, $name, $isRequired = false, $placeholder = "", $col = 12, $rows = 3, $value = "")
{
    echo "<div class=\"col-sm-$col\">
            <div class=\"form-group\">
                <label>$label ";
    if ($isRequired) echo "*";
    echo "</label>
            <textarea class=\"form-control\" name=\"$name\" rows=\"$rows\" placeholder=\"$placeholder\" ";
    if ($isRequired) echo "required";
    echo "></textarea>
            </div>
        </div>";
}

function inputNumber($label, $name, $isRequired = false, $placeholder = "", $col = 12, $value)
{
    echo "<div class=\"col-sm-$col\">
            <div class=\"form-group\">
                <label>$label ";
    if ($isRequired) echo "*";
    echo "</label>
                <input type=\"number\" name=\"$name\" class=\"form-control\" placeholder=\"$placeholder\" value=\"$value\" ";
    if ($isRequired) echo "required";
    echo ">
            </div>
        </div>";
}

function inputSelect($label, $name, $items, $itemSelected = "", $onChange = "", $isRequired = false, $col = 12)
{
    echo "<div class=\"col-sm-$col\">
                  <div class=\"form-group\">
                    <div class=\"form-group\">
                    <label>$label</label>
                    <select class=\"form-control\" name=\"$name\" id=\"$name\" onchange=\"$onChange\">";

    foreach ($items as $item)
    {
        echo "<option value=\"$item[value]\" ";
        if($itemSelected == $item[value]) echo "selected";
        echo ">$item[label]</option>";
    }

    echo "</select>
          </div>
          </div>
        </div>";
}

function inputHidden($name, $value)
{
    echo "<input type='hidden' name='$name' value='$value'>";
}

function inputImage($label, $name, $isRequired=true, $col = 12){
    echo "<div class=\"col-sm-$col\">
              <div class=\"form-group\">
                <div class=\"custom-file\">
                  <input type=\"file\" class=\"custom-file-input\" id=\"id$name\" name=\"$name\" ";
    if($isRequired) echo "required";
    echo "><label class=\"custom-file-label\" for=\"id$name\">$label</label>
                </div>
              </div>
            </div>";
}

function inputRadio($label, $name, $value, $col = 1, $onChecked = "", $isChecked = false, $isEnable = true){
    echo "<div class=\"col-sm-$col\">
            <div class=\"form-group\">
                <div class=\"form-check\">
                    <input class=\"form-check-input\" type=\"radio\" name=\"$name\" value=\"$value\" onclick=\"$onChecked\" ";

    if($isChecked) echo " checked ";
    if(!$isEnable) echo " disabled ";

    echo "><label class=\"form-check-label\">$label</label>
                </div>
            </div>
        </div>";
}

function showCardFooter($label){
    echo "<div class=\"card-footer\">
            <button type=\"submit\" class=\"btn btn-primary\">$label</button>
        </div>";
}

function showErrorMessage($message, $title = "Erro!")
{
    echo "<div class=\"alert alert-danger alert-dismissible\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
            <h5><i class=\"icon fas fa-ban\"></i> $title</h5>
            $message
        </div>";
}

function showSuccessMessage($message, $title = "Sucesso!")
{
    echo "<div class=\"alert alert-success alert-dismissible\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
            <h5><i class=\"icon fas fa-check\"></i> $title</h5>
            $message
        </div>";
}