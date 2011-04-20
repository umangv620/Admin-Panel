<?php
//$_AP = Admin Pages. Used for navigation and restricting access.
$_AP = array(
			array(title=>'Dashboard', url=>'index.php'),
			array(title=>'Content', url=>'content.php',
					dd=>array(array(title=>'Add Content', url=>'content.php?action=add'),
							  array(title=>'Edit Content', url=>'content.php?action=edit'),
							  array(title=>'Delete Content', url=>'content.php?action=delete')
							  )
				),
			array(title=>'Users', url=>'user.php',
					dd=>array(array(title=>'Add User', url=>'user.php?action=add'),
							  array(title=>'Edit User', url=>'user.php?action=edit'),
							  array(title=>'Delete User', url=>'user.php?action=delete')
							  )
				), 
			array(title=>'Modules', url=>'module.php',
					dd=>array(array(title=>'Add Module', url=>'module.php?action=add'),
							  array(title=>'Edit Module', url=>'module.php?action=edit'),
							  array(title=>'Delete Module', url=>'module.php?action=delete')
							  )
			)
		);

?>