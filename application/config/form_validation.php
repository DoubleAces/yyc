<?
/* General validation config */
$config['error_prefix'] = '<span style="float: right; line-height: 2.3em"><span class="label label-danger">';
$config['error_suffix'] = '</span></span>';

/* User registration form */
$config['my/signup'] = array(
	array (
		'field' => 'username',
		'label' => 'Username',
		'rules' => 'trim|required|is_unique[yyc_users.username]'
	),
	array (
		'field' => 'email',
		'label' => 'E-mail',
		'rules' => 'trim|required|valid_email|is_unique[yyc_users.email]'
	),
	array (
		'field' => 'first_name',
		'label' => 'First name',
		'rules' => 'trim|required'
	),
	array (
		'field' => 'last_name',
		'label' => 'Last name',
		'rules' => 'trim|required'
	),
	array (
		'field' => 'password',
		'label' => 'Password',
		'rules' => 'trim|required|min_length[6]'
	),
	array (
		'field' => 'repeat_password',
		'label' => 'Repeat password',
		'rules' => 'trim|required|min_length[6]|matches[password]'
	)
);

/* User login form */
$config['my/enter'] = array(
	array(
		'field' => 'username',
		'label' => 'Username',
		'rules' => 'trim|required|username_exists'
	),
	array(
		'field' => 'password',
		'label' => 'Password',
		'rules' => 'trim|required'
	)
);