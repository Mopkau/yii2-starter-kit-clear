<?php
namespace mopkau\widgets;

use yii\widgets\ActiveField;

class ClearActiveField extends ActiveField
{
/** Base usage:
 *        <?php $form = ActiveForm::begin([
 *          'id' => 'contact-form',
 *           'fieldClass'=>'app\extension\widgets\CleanActiveField']
 *       ); ?>
 *
 **/
/**
 * @var array the HTML attributes (name-value pairs) for the field container tag.
 * The values will be HTML-encoded using [[Html::encode()]].
 * If a value is null, the corresponding attribute will not be rendered.
 * The following special options are recognized:
 *
 * - tag: the tag name of the container element. Defaults to "div".
 *
 * If you set a custom `id` for the container element, you may need to adjust the [[$selectors]] accordingly.
 *
 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
 */
public $options = ['class' => ''];
/**
 * @var string the template that is used to arrange the label, the input field, the error message and the hint text.
 * The following tokens will be replaced when [[render()]] is called: `{label}`, `{input}`, `{error}` and `{hint}`.
 * Default: "{label}\n{input}\n{hint}\n{error}"
 */
public $template = "{input}";
/**
 * @var array the default options for the input tags. The parameter passed to individual input methods
 * (e.g. [[textInput()]]) will be merged with this property when rendering the input tag.
 *
 * If you set a custom `id` for the input element, you may need to adjust the [[$selectors]] accordingly.
 *
 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
 */
public $inputOptions = ['class' => ''];
/**
 * @var array the default options for the error tags. The parameter passed to [[error()]] will be
 * merged with this property when rendering the error tag.
 * The following special options are recognized:
 *
 * - tag: the tag name of the container element. Defaults to "div".
 * - encode: whether to encode the error output. Defaults to true.
 *
 * If you set a custom `id` for the error element, you may need to adjust the [[$selectors]] accordingly.
 *
 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
 */
public $errorOptions = ['class' => ''];
/**
 * @var array the default options for the label tags. The parameter passed to [[label()]] will be
 * merged with this property when rendering the label tag.
 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
 */
public $labelOptions = ['class' => ''];
/**
 * @var array the default options for the hint tags. The parameter passed to [[hint()]] will be
 * merged with this property when rendering the hint tag.
 * The following special options are recognized:
 *
 * - tag: the tag name of the container element. Defaults to "div".
 *
 * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
 */
public $hintOptions = ['class' => ''];





/**
 * Renders the whole field.
 * This method will generate the label, error tag, input tag and hint tag (if any), and
 * assemble them into HTML according to [[template]].
 * @param string|callable $content the content within the field container.
 * If null (not set), the default methods will be called to generate the label, error tag and input tag,
 * and use them as the content.
 * If a callable, it will be called to generate the content. The signature of the callable should be:
 *
 * ```php
 * function ($field) {
 *     return $html;
 * }
 * ```
 *
 * @return string the rendering result
 */
public function render($content = null)
{
    if ($content === null) {
        if (!isset($this->parts['{input}'])) {
            $this->textInput();
        }
        if (!isset($this->parts['{label}'])) {
            $this->label();
        }
        if (!isset($this->parts['{error}'])) {
            $this->error();
        }
        if (!isset($this->parts['{hint}'])) {
            $this->hint(null);
        }
        $content = strtr($this->template, $this->parts);
    } elseif (!is_string($content)) {
        $content = call_user_func($content, $this);
    }

    return $content;
}


}
