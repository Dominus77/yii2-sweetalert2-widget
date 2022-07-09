<?php

namespace dominus77\sweetalert2;

use Yii;
use yii\base\Widget;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\web\Session;
use Exception;
use dominus77\sweetalert2\assets\SweetAlert2Asset;
use dominus77\sweetalert2\assets\AnimateCssAsset;

/**
 * Alert widget renders a message from session flash or custom messages.
 * @see https://sweetalert2.github.io
 * @package dominus77\sweetalert2
 *
 * @property-read string[] $messagesArray
 * @property-read Session|bool|mixed $session
 */
class Alert extends Widget
{
    // Message Type
    const TYPE_INFO = 'info';
    const TYPE_ERROR = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_QUESTION = 'question';

    /**
     * All the flash messages stored for the session are displayed and removed from the session
     * Defaults to false.
     * @var bool
     */
    public $useSessionFlash = false;

    /**
     * @var string alert callback
     */
    public $callback = '(result) => {}';
    /** @var array */
    public $options = [];
    /** @var array */
    public $mixinOptions = [];
    /** @var bool */
    public $customAnimate = false;
    /** @var bool */
    public $progressSteps = false;
    /** @var bool */
    public $autostart = true;
    /** @var View */
    private $view;

    /**
     * @param string $script
     * @return void
     */
    public function registerAsset($script = '')
    {
        if ($this->view === null) {
            $this->view = $this->getView();
        }
        SweetAlert2Asset::register($this->view);
        if ($this->customAnimate === true) {
            AnimateCssAsset::register($this->view);
        }
        if (!empty($script)) {
            $this->view->registerJs($script, $this->view::POS_END);
        }
    }

    /**
     * @return string[]
     */
    public function getMessagesArray()
    {
        return [
            self::TYPE_INFO,
            self::TYPE_ERROR,
            self::TYPE_SUCCESS,
            self::TYPE_WARNING,
            self::TYPE_QUESTION,
        ];
    }

    /**
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if ($session = $this->getSession()) {
            $this->initFlashWidget($this->processFlashSession($session));
        } else {
            $this->initSwalFire();
        }
    }

    /**
     * @return void
     */
    public function initSwalFire()
    {
        $options = $this->getOptions();
        $mixinOptions = Json::encode($this->mixinOptions);
        $js = "async function startSwal() {
            Swal.mixin({$mixinOptions}).fire({$options}).then({$this->callback})
        }";
        if ($this->autostart === true) {
            $js .= "startSwal();";
        }
        $this->registerAsset($js);
    }

    /**
     * @param array $steps
     * @return void
     * @throws Exception
     */
    public function initFlashWidget($steps = [])
    {
        if (is_array($steps) && !empty($steps)) {
            $this->swalQueue($steps);
        }
    }

    /**
     * @param array $steps
     * @return void
     * @throws Exception
     */
    public function swalQueue($steps = [])
    {
        $stringJs = '';
        $progressSteps = [];
        $i = 1;
        $currentMixinOptions = [];
        foreach ($steps as $item) {
            $currentOptions = ArrayHelper::getValue($item, 'options', []);
            $beforeOptions = ['currentProgressStep' => $i - 1];

            $options = ArrayHelper::merge($beforeOptions, $currentOptions);
            $options = Json::encode($options);

            $callback = ArrayHelper::getValue($item, 'callback', $this->callback);
            $stringJs .= "await SwalQueue.fire({$options}).then({$callback});" . PHP_EOL;

            $progressSteps[] = $i;
            $i++;
        }

        $this->progressSteps = ArrayHelper::getValue($currentMixinOptions, 'progressSteps', $this->progressSteps);
        if ($this->progressSteps === true && count($progressSteps) > 1) {
            $progressStepsOption = ['progressSteps' => $progressSteps];
            $this->mixinOptions = ArrayHelper::merge($this->mixinOptions, $progressStepsOption);
        }

        $mixinOptions = Json::encode($this->mixinOptions);

        $js = "async function startSwalQueue() {            
            const SwalQueue = Swal.mixin({$mixinOptions});
            {$stringJs}             
        }";
        if ($this->autostart === true) {
            $js .= "startSwalQueue();";
        }
        $this->registerAsset($js);
    }

    /**
     * @param $session bool|mixed|Session
     * @return array
     * @throws Exception
     */
    public function processFlashSession($session, $steps = [])
    {
        $dates = $session->getAllFlashes();

        foreach ($dates as $type => $data) {
            $data = (array)$data;

            $mixinOptions = ArrayHelper::remove($data, 'mixinOptions', []);
            $this->mixinOptions = ArrayHelper::merge($this->mixinOptions, $mixinOptions);

            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $key => $item) {
                    $steps[$key]['mixinOptions'] = ArrayHelper::remove($item, 'mixinOptions', []);
                    $steps[$key]['callback'] = ArrayHelper::remove($item, 'callback', $this->callback);
                    $steps[$key]['options'] = ArrayHelper::merge(['icon' => $this->isIcon($key)], $item);
                }
            } else {
                if (ArrayHelper::isAssociative($data)) {
                    $steps[$type]['mixinOptions'] = ArrayHelper::remove($data, 'mixinOptions', $this->mixinOptions);
                    $steps[$type]['callback'] = ArrayHelper::remove($data, 'callback', $this->callback);
                    $steps[$type]['options'] = ArrayHelper::merge(['icon' => $this->isIcon($type)], $data);
                } else {
                    foreach ($data as $message) {
                        $steps[$type]['options'] = ArrayHelper::merge(['icon' => $this->isIcon($type), 'title' => $message], $this->options);
                    }
                }
            }
            $session->removeFlash($type);
        }
        return $steps;
    }

    /**
     * @param string $icon
     * @return string
     */
    private function isIcon($icon = '')
    {
        if (!ArrayHelper::isIn($icon, $this->getMessagesArray())) {
            $icon = '';
        }
        return $icon;
    }

    /**
     * Get widget options
     *
     * @return string
     */
    public function getOptions()
    {
        if (isset($this->options['id'])) {
            unset($this->options['id']);
        }

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
     * @return bool|mixed|Session
     */
    private function getSession()
    {
        return $this->useSessionFlash ? Yii::$app->session : false;
    }
}
