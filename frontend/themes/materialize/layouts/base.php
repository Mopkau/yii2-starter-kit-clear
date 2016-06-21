<?php

	/* @var $this \yii\web\View */
	use yii\widgets\Menu;

	/* @var $content string */

	$this->beginContent ( '@frontend/views/layouts/_clear.php' )
?>
	<div class="row">
		<!--DROPDOWN-->
		<?php echo Menu::widget ( [
				'options' => [
					'class' => 'dropdown-content' ,
					'id'    => 'language' ,
				] ,
				'items'   => array_map ( function ( $code ) {

					return [
						'label'  => Yii::$app->params[ 'availableLocales' ][ $code ] ,
						'url'    => [
							'/site/set-locale' ,
							'locale' => $code ,
						] ,
						'active' => Yii::$app->language === $code ,
					];
				} , array_keys ( Yii::$app->params[ 'availableLocales' ] ) ) ,
			]

		); ?>
		<!--DROPDOWN-->
		<nav>
			<div class="nav-wrapper">
				<div class="col s12">
					<a href="#" class="brand-logo">Logo</a>
					<?php echo Menu::widget ( [
						'options'      => [ 'class' => 'right hide-on-med-and-down' ] ,
						'encodeLabels' => FALSE ,
						'items'        => [
							[
								'label' => Yii::t ( 'frontend' , 'Home' ) ,
								'url'   => [ '/site/index' ] ,
							] ,
							[
								'label' => Yii::t ( 'frontend' , 'Contact' ) ,
								'url'   => [ '/site/contact' ] ,
							] ,
							[
								'label'   => Yii::t ( 'frontend' , 'Signup' ) ,
								'url'     => [ '/user/sign-in/signup' ] ,
								'visible' => Yii::$app->user->isGuest ,
							] ,
							[
								'label'   => Yii::t ( 'frontend' , 'Login' ) ,
								'url'     => [ '/user/sign-in/login' ] ,
								'visible' => Yii::$app->user->isGuest ,
							] ,
							[
								'label'   => Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->getPublicIdentity () ,
								'visible' => !Yii::$app->user->isGuest ,
								'items'   => [
									[
										'label' => Yii::t ( 'frontend' , 'Settings' ) ,
										'url'   => [ '/user/default/index' ] ,
									] ,
									[
										'label'   => Yii::t ( 'frontend' , 'Backend' ) ,
										'url'     => Yii::getAlias ( '@backendUrl' ) ,
										'visible' => Yii::$app->user->can ( 'manager' ) ,
									] ,
									[
										'label'       => Yii::t ( 'frontend' , 'Logout' ) ,
										'url'         => [ '/user/sign-in/logout' ] ,
										'linkOptions' => [ 'data-method' => 'post' ] ,
									] ,
								] ,
							] ,
							[
								'label'       => Yii::t ( 'frontend' , 'Language' ) . '<i class="material-icons right">arrow_drop_down</i>' ,
								'url'         => '#!' ,
								'options' => [
									'data-activates' => 'language' ,
									'class'          => 'dropdown-button',
								] ,
							] ,
						] ,
					] ); ?>
				</div>
			</div>
		</nav>


		<?php echo $content ?>
	</div>

	<footer class="page-footer">
		<div class="row">
			<div class="col l6 s12">
				<h5 class="white-text">Footer Content</h5>
				<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5 class="white-text">Links</h5>
				<ul>
					<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
					<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
				</ul>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				<?php echo Yii::powered () ?>
				<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
			</div>
		</div>
	</footer>
<?php $this->endContent () ?>