<?php

/**
 * AssetListingWidget renders an array of assets.
 *
 * @author Sage Gerard
 */

class AssetListingWidget extends CWidget
{
    /**
     * @var array Array of assets to render
     */
    public $assets = array();

    /**
     * @var string Heading displayed above the set of assets
     * Defaults to "Products"
     */
    public $heading = "Products";

    /**
     * @var string A message shown when no assets are available.
     * When no assets can be rendered, this message is shown where the
     * assets would be. Defaults to "There are no products to show."
     */
    public $empty_message = "There are no products to show.";

    /**
     * @var string CSS class prefix
     * The following CSS classes are defined for this widget:
     *
     * {prefix}-heading
     * {prefix}-empty-message
     * {prefix}-list-item
     */
    public $css_class = "css-class";
    
    /**
     * @var string View used to render single asset
     * This is the name of thw widget view that will be
     * used to render a single asset. Set it to the name
     * of the script file containing the view, without the
     * .php extension.
     */
    public $view = 'default';
    
    /**
     * @var array Data to pass to {@link AssetListingWidget::view}
     */
    public $view_vars = array('show_summary'=>false);
    
    /**
     * Renders assets in {@link AssetListingWidget::assets}
     *
     * @return void
     */
    public function run()
    {
        $yii = Yii::app();

        $html = CHtml::tag(
            'h1',
            array('class'=>$this->css_class.'-heading'),
            $this->heading
        );

        if (empty($this->assets))
        {
            // Display default message if no assets are available
            $html .= CHtml::tag(
                'p',
                array('class'=>$this->css_class.'-empty-message'),
                $this->empty_message
            );
        }
        else
        {
            $html .= $this->render(
                'listing',
                array('assets'=>$this->assets),
                true
            );
        }

        // 
        $html = CHtml::tag(
            'div',
            array('class'=>$this->css_class),
            $html
        );

        echo $html;
    }
}
