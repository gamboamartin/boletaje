<?php use config\views; ?>
<?php /** @var stdClass $row  viene de registros del controler*/ ?>
<tr>
    <td><?php echo $row->bol_invitacion_id; ?></td>
    <td><?php echo $row->bol_invitacion_codigo; ?></td>
    <td><?php echo $row->bol_invitacion_codigo_bis; ?></td>
    <!-- Dynamic generated -->
    <td><?php echo $row->bol_invitacion_nombre_completo; ?></td>
    <td><?php echo $row->bol_invitacion_n_boletos; ?></td>
    <td><?php echo $row->bol_invitacion_n_boletos_extra; ?></td>
    <td><?php echo $row->bol_invitacion_licenciatura; ?></td>

    <!-- End dynamic generated -->

    <?php include (new views())->ruta_templates.'listas/action_row.php';?>
</tr>
