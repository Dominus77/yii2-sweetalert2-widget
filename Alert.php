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
        if ($this->useSessionFlash) {
            $this->renderFlashAlerts();
        } else {
            $this->renderAlerts();
        }
    }

    /**
     * Renders alerts from session flash settings.
     * @see [[\yii\web\Session::getAllFlashes()]]
     */
    public function renderFlashAlerts()
    {
        $session = $this->getSession();
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
            if (!is_array($steps[0]['text'])) {
                $this->registerSwalQueue($steps);
            } else {
                $steps[0]['text']['type'] = isset($steps[0]['text']['type']) ? $steps[0]['text']['type'] : $steps[0]['type'];
                if (isset($steps[0]['text']['animation']) && $steps[0]['text']['animation'] == false) {
                    if (isset($steps[0]['text']['customClass'])) {
                        $this->registerAnimate();
                    }
                }
                $this->options = $steps[0]['text'];
                $this->callback = isset($steps[1]['text']['callback']) ? $steps[1]['text']['callback'] : $this->callback;
                $this->registerSwal($this->getOptions(), $this->callback);
            }
        }
    }

    /**
     * Renders manually set alerts
     */
    public function renderAlerts()
    {
        $this->registerSwal($this->getOptions(), $this->callback);
    }

    /**
     * Get widget options
     *
     * @return string
     */
    public function getOptions()
    {
        if (isset($this->options['id']))
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

    /**
     * @param array $steps
     */
    protected function registerSwalQueue($steps = [])
    {
        $view = $this->getView();
        $js = "swal.queue(" . Json::encode($steps) . ");";
        $this->view->registerJs($js, $view::POS_END);
    }

    /**
     * @param string $options
     * @param string $callback
     */
    protected function registerSwal($options = '', $callback = '')
    {
        $view = $this->getView();
        $js = "swal({$options}).then({$callback}).catch(swal.noop);";
        $this->view->registerJs($js, $view::POS_END);
    }

    /**
     * Register Animate Assets
     */
    protected function registerAnimate()
    {
        AnimateCssAsset::register($this->view);
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        SweetAlert2Asset::register($this->view);
        if (isset($this->options['animation']) && $this->options['animation'] == false) {
            if (isset($this->options['customClass'])) {
                $this->registerAnimate();
            }
        }
    }

    /**
     * @return \yii\web\Session
     */
    private function getSession()
    {
        return Yii::$app->getSession();
    }
}
