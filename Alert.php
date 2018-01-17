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
 * @see https://sweetalert2.github.io/
 * @package dominus77\sweetalert2
 */
class Alert extends Widget
{
    // Modal Type
    const TYPE_INFO = 'info';
    const TYPE_ERROR = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_QUESTION = 'question';

    // Input Type
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
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        SweetAlert2Asset::register($this->view);
    }

    /**
     * @param array $steps
     */
    public function initSwalQueue($steps = [])
    {
        $view = $this->getView();
        $js = "swal.queue(" . Json::encode($steps) . ");";
        $this->view->registerJs($js, $view::POS_END);
    }

    /**
     * @param string $options
     * @param string $callback
     */
    public function initSwal($options = '', $callback = '')
    {
        $view = $this->getView();
        $js = "swal({$options}).then({$callback}).catch(swal.noop);";
        $this->view->registerJs($js, $view::POS_END);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($session = $this->getSession()) {
            $steps = $this->processFlash($session);
            if (!empty($steps)) {
                if (isset($steps[0]['text']) && !is_array($steps[0]['text'])) {
                    $this->initSwalQueue($steps);
                } else {
                    $this->processFlashWidget($steps);
                }
            }
        } else {
            $this->initSwal($this->getOptions(), $this->callback);
        }
    }

    /**
     * @param $session bool|mixed|\yii\web\Session
     * @return array
     */
    public function processFlash($session)
    {
        $flashes = $session->getAllFlashes();
        $steps = [];
        foreach ($flashes as $type => $data) {
            $data = (array)$data;
            foreach ($data as $message) {
                array_push($steps, ['type' => $type, 'text' => $message]);
            }
            $session->removeFlash($type);
        }
        return $steps;
    }

    /**
     * @param array $steps
     */
    public function processFlashWidget($steps = [])
    {
        $params = [];
        if ($params['options'] = $steps[0]['text']) {
            $params['options']['type'] = isset($params['options']['type']) ? $params['options']['type'] : $steps[0]['type'];
            $params['callback'] = isset($steps[1]['text']['callback']) ? $steps[1]['text']['callback'] : $this->callback;
            $this->options = $params['options'];
            $this->callback = $params['callback'];
            $this->initSwal($this->getOptions(), $this->callback);
        }
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

        $this->registerAnimateCss();

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
     * Add support Animate.css
     * @see https://daneden.github.io/animate.css/
     */
    public function registerAnimateCss()
    {
        if (isset($this->options['animation']) && $this->options['animation'] === false) {
            if (isset($this->options['customClass'])) {
                AnimateCssAsset::register($this->view);
            }
        }
    }

    /**
     * @return bool|mixed|\yii\web\Session
     */
    private function getSession()
    {
        return $this->useSessionFlash ? Yii::$app->session : false;
    }
}
