<?php

namespace dominus77\sweetalert2;

use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use dominus77\sweetalert2\assets\SweetAlert2Asset;
use dominus77\sweetalert2\assets\AnimateCssAsset;

/**
 * Alert widget renders a message from session flash or custom messages.
 * @package dominus77\sweetalert2
 */
class Alert extends Widget
{
    //modal type
    const TYPE_INFO = 'info';
    const TYPE_ERROR = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_QUESTION = 'question';
    //input type
    const INPUT_TYPE_TEXT = 'text';
    const INPUT_TYPE_EMAIL = 'email';
    const INPUT_TYPE_PASSWORD = 'password';
    const INPUT_TYPE_NUMBER = 'number';
    const INPUT_TYPE_RANGE = 'range';
    const INPUT_TYPE_TEXTAREA = 'textarea';
    const INPUT_TYPE_SELECT = 'select';
    const INPUT_TYPE_RADIO = 'radio';
    const INPUT_TYPE_CHECKBOX = 'checkbox';
    const INPUT_TYPE_FILE = 'file';

    /**
     * All the flash messages stored for the session are displayed and removed from the session
     * Defaults to false.
     * @var bool
     */
    public $useSessionFlash = false;

    /**
     * @var string alert callback
     */
    public $callback = 'function() {}';

    /**
     * Initializes the widget
     */
    public function init()
    {
        parent::init();
        $this->registerAssets();
    }

    /**
     * @return string|void
     */
    public function run()
    {
        $view = $this->getView();
        if ($this->useSessionFlash) {
            $session = Yii::$app->getSession();
            $flashes = $session->getAllFlashes();
            $steps = [];
            foreach ($flashes as $type => $data) {
                $data = (array)$data;
                foreach ($data as $message) {
                    array_push($steps, ['type' => $type, 'text' => $message]);
                }
                $session->removeFlash($type);
            }
            if (!empty($steps)) {
                if (is_array($steps[0]['text'])) {
                    $steps[0]['text']['type'] = isset($steps[0]['text']['type']) ? $steps[0]['text']['type'] : $steps[0]['type'];
                    if (isset($steps[0]['text']['animation']) && $steps[0]['text']['animation'] == false) {
                        if (isset($steps[0]['text']['customClass'])) {
                            AnimateCssAsset::register($view);
                        }
                    }
                    $callback = Json::encode($steps[1]['text']['callback']);
                    $js = "swal(" . Json::encode($steps[0]['text']) . ").then({$callback}).catch(swal.noop);";
                    $view->registerJs($js, $view::POS_END);
                } else {
                    $js = "swal.queue(" . Json::encode($steps) . ");";
                    $view->registerJs($js, $view::POS_END);
                }
            }
        } else {
            $js = "swal({$this->getOptions()}).then({$this->callback}).catch(swal.noop);";
            $view->registerJs($js, $view::POS_END);
        }
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        SweetAlert2Asset::register($view);
        if (isset($this->options['animation']) && $this->options['animation'] == false) {
            if (isset($this->options['customClass'])) {
                AnimateCssAsset::register($view);
            }
        }
    }

    /**
     * Get plugin options
     *
     * @return string
     */
    protected function getOptions()
    {
        unset($this->options['id']);
        if (ArrayHelper::isIndexed($this->options)) {
            $str = '';
            foreach ($this->options as $value) {
                $str .= '"' . $value . '",';
            }
            return chop($str, ' ,');
        }
        return Json::encode($this->options);
    }
}
