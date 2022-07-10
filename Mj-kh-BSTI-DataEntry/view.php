<?php 

$my_options = get_option( 'mj_kh_bsti_dashboard_setttings' );

//echo json_encode($my_options);

?>
 <h3> <?php echo $my_options['mj_kh_bsti_dashboard_token']; ?>    </h3>
 <h3> <?php echo $my_options['mj_kh_bsti_dashboard_apiBaseUrl']; ?>    </h3>