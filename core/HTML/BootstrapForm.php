<?php

namespace Core\HTML;

class BootstrapForm extends Form
{

    /**
     * @param $html string Code HTML à entourer
     * @return string
     */
    protected function surround($html)
    {
        return "<div class=\"form-group\">{$html}</div>";
    }

    /**
     * @param $name
     * @param $label
     * @param array $options
     * @return string
     */
    public function input($name, $label, $options = [], $class='s6')
    {
        $input = '';
        $type = isset($options['type']) ? $options['type'] : 'text';
        if ($type === 'textarea') {
            $label = '<label for="' . $name . '">' . $label . '</label></div></div>';
            $input = '<div class="row"><div class="input-field col s12"><i class="material-icons prefix">mode_edit</i><textarea id="' . $name . '" class="materialize-textarea" name="'. $name .'">' . $this->getValue(
                    $name
                ) . '</textarea>';
            return $input . $label;
        }
        if ($type === 'file') {
            $input = '<div class="file-field input-field"><div class="btn"><span>File</span><input id="' . $name . '" type="' . $type . '" name="' . $name . '" value = "' . $this->getValue(
                    $name
                ) . '" class="form-control-file" ></div><div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Importer une image">
      </div></div>';
            $label = '';
            return $input . $label;
        } else {
            $label = '<label for="'.$name .'">' . $label . '</label></div>';
            $input = '<div class="input-field col '.$class.'">';
            $input .= '<input step="any" type="' . $type . '" name="' . $name . '" value = "' . $this->getValue(
                    $name
                ) . '" class="form-control" >';
            return $input . $label;
        }
    }

    public function selectSendId($name, $label, $options, $extra = '')
    {
        $label = '<label>' . $label . '</label></div>';
        $input = '<div class="input-field col s12"><select class="multiple" name="' . $name . '">';
        $input .= '<option value="" disabled>Veuillez sélectionner</option>';
        foreach ($options as $k => $v) {
            $attributes = '';
            if ($k == $this->getValue($name)) {
                $attributes = 'selected';
            }
            $input .= "<option value='$k' $attributes>($extra[$k]) | $v</option>";
        }
        $input .= '</select>';
        return $input . $label;
    }

    public function selectSendValue($name, $label, $options)
    {
        $label = '<label>' . $label . '</label></div>';
        $input = '<div class="input-field col s12"><select class="multiple" name="' . $name . '">';
        $input .= '<option value="" disabled>Veuillez sélectionner</option>';
        foreach ($options as $k => $v) {
            $attributes = '';
            if ($v == $this->getValue($name)) {
                $attributes = 'selected';
            }
            $input .= "<option value='$v' $attributes>$v</option>";
        }
        $input .= '</select>';
        return $input . $label;
    }


    /**
     * @return string
     */
    public function submit()
    {
        return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
    }

}