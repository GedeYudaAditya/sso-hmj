<?php if ($ajax == 1) : ?>
<input type="hidden" value="<?= $digSI ?>" id="SI_Diagram">
<input type="hidden" value="<?= $digMI ?>" id="MI_Diagram">
<input type="hidden" value="<?= $digIlkom ?>" id="Ilkom_Diagram">
<input type="hidden" value="<?= $digPTI ?>" id="PTI_Diagram">
<?php elseif ($ajax == 2) : ?>
<input type="hidden" value="<?= $sem_a ?>" id="A_Diagram">
<input type="hidden" value="<?= $sem_b ?>" id="B_Diagram">
<input type="hidden" value="<?= $sem_c ?>" id="C_Diagram">
<input type="hidden" value="<?= $sem_d ?>" id="D_Diagram">
<input type="hidden" value="<?= $sem_etc ?>" id="Etc_Diagram">
<?php elseif ($ajax == 3) : ?>
<?php
    $arrs = array();
    for ($i = 1; $i <= $jml_kandidat; $i++) {
        array_push($arrs, $kandidat[$i]);
    }
    ?>
<?php
    $i = 0;
    foreach ($arrs as $arr) : ?>
<input type="hidden" value="<?= $arr ?>" id="Diagram<?= $i++ ?>">
<?php
    endforeach;
    unset($arrs);
    ?>
<input type="hidden" value="<?= $i ?>" id="count">
<?php elseif ($ajax == 4) : ?>
<input type="hidden" value="<?= $jml_sudah_voting ?>" id="sudah_Diagram">
<input type="hidden" value="<?= $jml_belum_voting ?>" id="belum_Diagram">
<?php endif; ?>