<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
$this->title = 'Test task';
?>
<div class="site-index">

    <div class="body-header">
		<div class="row">
			<?php
				$form = ActiveForm::begin([
					'id' => 'login-form',
					'options' => ['class' => ''],
				]);
			?>
				
			<?= $form->field($modelForm, 'url')->textInput(['class' => 'form-control', 'placeholder' => 'URL'])->label(false);?>
			<?= Html::submitButton('Сканировать', ['class' => 'btn btn-success', 'name' => 'submit']) ?>

			<?php ActiveForm::end(); ?>
		</div>		
    </div>
	
    <div class="body-content">

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<th>
								id
							</th>
							<th>
								page_url
							</th>
							<th>
								link_name
							</th>
							<th>
								link_url 
							</th>
							<th>
								time 
							</th>
						</thead>
						<tbody>
							<?php foreach($links as $link):?>
							<tr>
								<td><?=$link["id"]?></td>
								<td><?=$link["page_url"]?></td>
								<td><?=$link["link_name"]?></td>
								<td><?=$link["link_url"]?></td>
								<td><?=$link["time"]?></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					<?php
					echo LinkPager::widget([
						'pagination' => $pages,
					]);
					?>
				</div>
            </div>
        </div>

    </div>
</div>
