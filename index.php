<?php

include "./ini_form.php";

$form = new ini_forms\ini_form('magento_set');

$content = $form->render_form();

include "./examples/main_template.php";
