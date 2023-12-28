<?php

/* @var $this \common\components\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = __('Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="card bg-secondary shadow border-0">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"><?=__("Kirishlar tarixi")?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body px-lg-5 py-lg-4">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><?=__('Vaqt')?></th>
                                <th scope="col"><?=__('IP address')?></th>
                                <th scope="col"><?=__('User-Agent')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($journal as $history): ?>
                                <tr>
                                    <td><?=date('Y-m-d H:i:s', $history->login_date)?></td>
                                    <td><?=$history->ip_address?></td>
                                    <td><?=$history->user_agent?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card bg-secondary shadow border-0">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"><?=__("Maxfiy so'zni o'zgartirish")?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body px-lg-5 py-lg-4">
                    <?php $form = ActiveForm::begin(); ?>
                        <?=$form->field($model, 'password')->passwordInput()?>
                        <?=Html::submitButton(__('Save'), ['class' => 'btn btn-success'])?>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
