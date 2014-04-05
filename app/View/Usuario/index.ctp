<?php
$this->set('activeMenu', 'hotspots');
?>

ob_start();
?>
<table class="table table-bordered table-hover table-striped">
    <?php
    echo $this->Html->tableHeaders(
        array(
            $this->Paginator->sort('id'),
            $this->Paginator->sort('nombre'),
            $this->Paginator->sort('apellidos'),
            $this->Paginator->sort('alias')
        )
    );
    ?>
    <tbody>
    <?php

        echo $this->Html->tableCells(
            array(
                h($usuario['Usuario']['id']),
                h($usuario['Usuario']['nombre']),
                h($asuario['Usuario']['apellidos']),
                h($usuario['Usuario']['alias'])
            )
        );
    ?>
    </tbody>
    <tfoot><tr><td colspan="100"><?= $this->element('paginator'); ?></td></tr></tfoot>
</table>
<div class="index">
    <?php
    echo $this->element('widget',
        array(
            'title' => __("Usuario"),
            'icon' => 'desktop',
            'table' => TRUE,
            'content' => ob_get_clean()
        )
    );
    ?>
</div>

</div>