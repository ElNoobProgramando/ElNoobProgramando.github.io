<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $litros_mp = $_POST['litros_mp'];
    $horas_mo = $_POST['horas_mo'];
    $horas_maquina = $_POST['horas_maquina'];

    $costo_mp = $_POST['costo_mp'];
    $costo_mo = $_POST['costo_mo'];
    $costo_maquina = $_POST['costo_maquina'];
    $cargos_fijos_por_pieza = $_POST['cargos_fijos_por_pieza'];
    
    $unidades_terminadas = $_POST['unidades_termi'];
 

    $requerimiento_mpd = $_POST['requerimiento_mpd'];
    $requerimiento_mod = $_POST['requerimiento_mod'];
    $requerimiento_civ = $_POST['requerimiento_civ'];
    $requerimiento_cif = $_POST['requerimiento_cif'];

    $produccion_proceso = $_POST['produccion_proceso'];

    $real_mp = $_POST['real_mp'];
    $real_mo = $_POST['real_mo'];
    $real_ci = $_POST['real_ci'];
    
    $unidades_vendidas = $_POST['unidades_vendi'];

    // Cálculos de Cédula 1
    $materia_prima = $litros_mp * $costo_mp;
    $mano_obra = $horas_mo * $costo_mo;
    $cargos_indirectos = $horas_maquina * $costo_maquina +$horas_maquina*$cargos_fijos_por_pieza ;
    $total_costo_estandar = $materia_prima + $mano_obra + $cargos_indirectos;

    // Cálculos de Cédula 2
    $costo_mpd = $requerimiento_mpd * $costo_mp;
    $costo_mod = $requerimiento_mod * $costo_mo;
    $costo_civ = $requerimiento_civ * $costo_maquina;
    $costo_cif = $requerimiento_cif * $cargos_fijos_por_pieza;
    $suma_total_cedula_2 = $costo_mpd + $costo_mod + $costo_civ + $costo_cif;

    // Cálculos de Cédula 3
    $costo_proceso_mpd = $litros_mp * $produccion_proceso*$costo_mp;
    $costo_proceso_mod = $horas_mo * $produccion_proceso*$costo_mo;
    $costo_proceso_civ = $horas_maquina * $produccion_proceso*$costo_maquina;
    $costo_proceso_cif = $horas_maquina * $produccion_proceso*$cargos_fijos_por_pieza;

    $suma_total_cedula_3 = $costo_proceso_mpd + $costo_proceso_mod + $costo_proceso_civ + $costo_proceso_cif;

    // Cálculos de Cédula 4 (Desviaciones)
    $desviacion_mp = $real_mp - $materia_prima;
    $desviacion_mo = $real_mo - $mano_obra;
    $desviacion_ci = $real_ci - $cargos_indirectos;

    $desviacion_mp_tipo = $desviacion_mp >= 0 ? 'Desfavorable' : 'Favorable';
    $desviacion_mo_tipo = $desviacion_mo >= 0 ? 'Desfavorable' : 'Favorable';
    $desviacion_ci_tipo = $desviacion_ci >= 0 ? 'Desfavorable' : 'Favorable';

    
    //cedula 6

    $unidades_vendidas=$unidades_terminadas-$unidades_vendidas;
   $real_unudades_vendidas= $unidades_vendidas-$total_costo_estandar;

    // CEDULA 5
    $unidades_terminadas1=$unidades_terminadas*$total_costo_estandar;


    // Resultado en JSON
    echo json_encode([
        'Materia Prima' => number_format($materia_prima, 2),
        'Mano de Obra' => number_format($mano_obra, 2),
        'Cargos Indirectos' => number_format($cargos_indirectos, 2),
        'Total Costo Estándar' => number_format($total_costo_estandar, 2),

        'Costo MPD' => number_format($costo_mpd, 2),
        'Costo MOD' => number_format($costo_mod, 2),
        'Costo CIV' => number_format($costo_civ, 2),
        'Costo CIF' => number_format($costo_cif, 2),
        'Suma Total Cédula 2' => number_format($suma_total_cedula_2, 2),

        'Costo Proceso MPD' => number_format($costo_proceso_mpd, 2),
        'Costo Proceso MOD' => number_format($costo_proceso_mod, 2),
        'Costo Proceso CIV' => number_format($costo_proceso_civ, 2),
        'Costo Proceso CIF' => number_format($costo_proceso_cif, 2),
        'Suma Total Cédula 3' => number_format($suma_total_cedula_3, 2),

        'Desviación MP' => number_format($desviacion_mp, 2),
        'Desviación MP Tipo' => $desviacion_mp_tipo,
        'Desviación MO' => number_format($desviacion_mo, 2),
        'Desviación MO Tipo' => $desviacion_mo_tipo,
        'Desviación CI' => number_format($desviacion_ci, 2),
        'Desviación CI Tipo' => $desviacion_ci_tipo,

        
        'unidades_vendidas' => number_format($real_unudades_vendidas, 2),
        'Val.Prod Termi' => number_format($unidades_terminadas1, 2),


        
    ]);
}
?>

