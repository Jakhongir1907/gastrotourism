<?php
/**
 * @author O`tkir   <https://gitlab.com/utkir24>
 * @package prokuratura.uz
 *
 */

namespace common\modules\filemanager\controllers;

use common\modules\filemanager\models\Files;
use Yii;
use yii\console\Controller;

/**
 * Class ConverterController
 * @package common\modules\filemanager\controllers
 *
 * console
 * controller map
 * common\modules\filemanager\controllers
 */
class ConverterController extends Controller
{
    /**
     * @var string
     */
    public $defaultAction = "file";

    /**
     * @return int
     */
    public function actionFile(){
        Files::cron();
        return 0;
    }
}