<?php
namespace mopkau\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\data\Sort;
use yii\helpers\Html;

class ClearLinkSorter extends LinkSorter
{

	/**
     * @var HTML attribute for the sort container
     */
    public $containerTag = 'ul';
    /**
     * @var Sort the sort definition
     */
    public $sort;
    /**
     * @var array list of the attributes that support sorting. If not set, it will be determined
     * using [[Sort::attributes]].
     */
    public $attributes;
    /**
     * @var array HTML attributes for the sorter container tag.
     * @see \yii\helpers\Html::ul() for special attributes.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'sorter'];
    /**
     * @var array HTML attributes for the link in a sorter container tag which are passed to [[Sort::link()]].
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     * @since 2.0.6
     */
    public $linkOptions = [];


    /**
     * Initializes the sorter.
     */
    public function init()
    {
        if ($this->sort === null) {
            throw new InvalidConfigException('The "sort" property must be set.');
        }
    }

    /**
     * Executes the widget.
     * This method renders the sort links.
     */
    public function run()
    {
        echo $this->renderSortLinks();
    }

    /**
     * Renders the sort links.
     * @return string the rendering result
     */
    protected function renderSortLinks()
    {
        $attributes = empty($this->attributes) ? array_keys($this->sort->attributes) : $this->attributes;
        $links = [];
        foreach ($attributes as $name) {
            $links[] = $this->sort->link($name, array_merge($this->options, ['encode' => false], $this->linkOptions));
        }

        return Html::tag($this->containerTag, $links);
    }
}
