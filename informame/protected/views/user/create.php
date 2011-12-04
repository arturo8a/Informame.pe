<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

?>

<center><h1>Registro de Usuario</h1></center>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>