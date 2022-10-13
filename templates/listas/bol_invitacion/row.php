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
    <td><?php include 'templates/botons/bol_invitacion/link_get_invitacion.php';?></td>
    <td><?php include 'templates/botons/bol_invitacion/link_ver_qr.php';?></td>
    <td><?php include 'templates/botons/bol_invitacion/link_genera_qr.php';?></td>
    <td><?php include 'templates/botons/bol_invitacion/link_genera_pdf.php';?></td>
    <?php include (new views())->ruta_templates.'listas/action_row.php';?>
</tr>
