<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Formlib
 *
 * @author jobinrjohnson
 */
class Formlib {

    private $fields;
    private $form;
    private $CI;

    public function __construct($param) {
        $this->CI = & get_instance();
        $this->CI->load->config('forms');
        $this->form = $this->CI->config->item($param['form_name']);
        $this->fields = $this->form['fields'];
    }

    private function get_item_1($field, $value = NULL) {
        $string = '<div class="form-group form-float ' . (isset($field['extraclasses']) ? $field['extraclasses'] : '' ) . '">';
        $extras = isset($field['extras']) ? $field['extras'] : '';
        if (strcmp($field['tag'], 'input') == 0) {
            if (strcmp($field['type'], 'simple_checkbox') == 0) {
                $string .= '<div class="switch">';
                if (isset($value)) {
                    $field['default'] = ($value == 1 || $value == TRUE) ? 'checked' : '';
                }
                $string .= '<label><input type="' . 'checkbox' . '" value="1" ' . $extras . ' name="' . $field['name'] . '" ' . (isset($field['default']) ? $field['default'] : '') . ' value="1" />';
                $string .= '' . $field['title'] . '<span class="lever switch-col-red"></span></label>';
            } else if (strcmp($field['type'], 'date') == 0) {
                $string .= '<div class="form-line">';
                $string .= '<label> ' . $field['title'] . '</label>';
                $string .= '<input ' . (isset($value) ? ('value="' . $value . '"') : '') . ' type="' . $field['type'] . '" name="' . $field['name'] . '" class="form-control" ' . $extras . ' />';
            } else if (strcmp($field['type'], 'money') == 0) {
                $string .= '<div class="form-line">';
                $string .= '<input type="number"' . (isset($value) ? ('value="' . $value . '"') : '') . ' step=".01" min="0" name="' . $field['name'] . '" class="form-control" ' . $extras . ' />';
                $string .= '<label class="form-label">' . $field['title'] . ' in ' . $this->CI->config->item('currency') . '</label>';
            } else if (strcmp($field['type'], 'tags') == 0) {
                $string .= '<div class="form-line">';
                $string .= '<div class="bootstrap-tagsinput" style="display:block;"></div><input type="text"  name="' . $field['name'] . '"  maxlength="1000" class="form-control" data-role="tagsinput" ' . (isset($value) ? ('value="' . $value . '"') : '') . ' placeholder="' . $field['title'] . '. &nbsp;">';
            } else if (strcmp($field['type'], 'hidden') == 0) {
                if (!isset($value) && isset($field['default'])) {
                    $value = $field['default'];
                }
                return '<input ' . (isset($value) ? ('value="' . $value . '"') : '') . ' type="' . $field['type'] . '" name="' . $field['name'] . '" class="form-control" ' . $extras . ' />';
            } else {
                $string .= '<div class="form-line">';
                $string .= '<input ' . (isset($value) ? ('value="' . $value . '"') : '') . ' type="' . $field['type'] . '" name="' . $field['name'] . '" class="form-control" ' . $extras . ' />';
                $string .= '<label class="form-label">' . $field['title'] . '</label>';
            }
            $string .= '</div>';
        } elseif (strcmp($field['tag'], 'textarea') == 0) {
            $string .= '<div class="form-line">';
            $string .= '<label class="form-label">' . $field['title'] . '</label>';
            $string .= '<textarea name="' . $field['name'] . '" rows="4" class="form-control" ' . $extras . '>' . (isset($value) ? $value : '') . '</textarea>';
            $string .= '</div>';
        } elseif (strcmp($field['tag'], 'select') == 0) {
            $string .= '<div class="form-line focused">';
            $string .= '<select name="' . $field['name'] . '" class="form-control" ' . $extras . '>';
            $counter = 0;
            if (isset($field['staticdata'])) {
                foreach ($field['staticdata'] as $val) {
                    if (isset($value)) {
                        $string .= '<option ' . ($value == $counter ? 'selected' : '') . ' value="' . $counter++ . '">' . $val . '</option>';
                        continue;
                    }
                    $string .= '<option value="' . $counter++ . '">' . $val . '</option>';
                }
            } else if (isset($field['dynamic_data'])) {
                $parser = explode(',', $field['dynamic_data']);
                $conditionstrings = explode('=', $parser[2]);
                $items = explode('&', $parser[1]);
                $res = $this->CI->db->select($items)->where($conditionstrings[0], $conditionstrings[1])->get($parser[0])->result_array();
                $string .= '<option value="">Select</option>';
                if (!isset($value) && isset($field['default'])) {
                    $value = $field['default'];
                }
                foreach ($res as $val) {
                    if (isset($value)) {
                        $string .= '<option ' . ($value == $val[$items[0]] ? 'selected' : '') . ' value="' . $val[$items[0]] . '">' . $val[$items[1]] . '</option>';
                        continue;
                    }
                    $string .= '<option value="' . $val[$items[0]] . '">' . $val[$items[1]] . '</option>';
                }
            }

            $string .= '</select>';
            $string .= '<label class="form-label"> ' . $field['title'] . '</label>';
            $string .= '</div>';
        }
        $string .= '</div>';
        return $string;
    }

    public function modify_field($filed_name, $attribute, $value) {
        if (isset($this->fields[$filed_name])) {
            $this->fields[$filed_name][$attribute] = $value;
            return TRUE;
        }
        return FALSE;
    }

    public function get_db_edit_data() {
        $data = array();
        $input = $this->CI->input;
        foreach ($this->fields as $field) {
            if (isset($field['db_name'])) {
                if (isset($field['enabled']) && $field['enabled'] == FALSE) {
                    continue;
                }
                if (strcmp($field['tag'], 'input') == 0) {
                    if (strcmp($field['type'], 'simple_checkbox') == 0) {
                        $data[$field['db_name']] = $input->post($field['name']) == 1 ? 1 : 0;
                        continue;
                    }
                }
                $data[$field['db_name']] = $input->post($field['name']);
            }
        }
        return $data;
    }

    public function get_db_add_data() {
        $data = array();
        $input = $this->CI->input;
        foreach ($this->fields as $field) {
            if (isset($field['db_name'])) {
                if (isset($field['enabled']) && $field['enabled'] == FALSE) {
                    continue;
                }
                if (strcmp($field['tag'], 'input') == 0) {
                    if (strcmp($field['type'], 'simple_checkbox') == 0) {
                        $data[$field['db_name']] = $input->post($field['name']) == 1 ? 1 : 0;
                        continue;
                    }
                }
                $data[$field['db_name']] = $input->post($field['name']);
            }
        }
        return $data;
    }

    public function validate() {
        $this->CI->load->library('form_validation');
        $form_v = $this->CI->form_validation;
        foreach ($this->fields as $field) {
            if (isset($field['enabled']) && $field['enabled'] == FALSE) {
                continue;
            }
            if (isset($field['form_attr'])) {
                $form_v->set_rules($field['name'], $field['title'], 'trim|xss_clean|strip_tags|' . implode('|', $field['form_attr']));
            } else {
                $form_v->set_rules($field['name'], $field['title'], 'trim|xss_clean|strip_tags');
            }
        }
        if ($form_v->run() == TRUE) {
            return TRUE;
        } else {
            return validation_errors();
        }
    }

    public function validate_for_edit() {
        $this->CI->load->library('form_validation');
        $form_v = $this->CI->form_validation;
        $extra_errors = NULL;
        foreach ($this->fields as $field) {
            if (isset($field['enabled']) && $field['enabled'] == FALSE) {
                continue;
            }
            if (isset($field['form_attr'])) {

                $validate = '';
                foreach ($field['form_attr'] as $afield) {
                    if (strpos($afield, 'is_unique') > -1) {

                        $sq_br_position = strpos($afield, '[') + 1;
                        $dbops = explode('.', substr($afield, $sq_br_position, strlen($afield) - $sq_br_position - 1));

                        $this->CI->db->where($dbops[1], $this->CI->input->post($field['name']));
                        $this->CI->db->where_not_in($this->form['primary_key'], $this->get_edit_primary_key());
                        if ($this->CI->db->get($dbops[0])->num_rows() > 0) {
                            $error = '<p>' . $field['title'] . ' should be unique</p>';
                            $extra_errors = $extra_errors == NULL ? $error : ($extra_errors . $error);
                        }
                        continue;
                    }

                    if ($validate == '') {
                        $validate .= $afield;
                        continue;
                    }
                    $validate .= '|' . $afield;
                }

                $form_v->set_rules($field['name'], $field['title'], 'trim|xss_clean|strip_tags|' . $validate);
            } else {
                $form_v->set_rules($field['name'], $field['title'], 'trim|xss_clean|strip_tags');
            }
        }
        if ($extra_errors == NULL && $form_v->run() == TRUE) {
            return TRUE;
        } else {
            return validation_errors() . ($extra_errors == NULL ? '' : $extra_errors);
        }
    }

    private function generate_seprator($index) {
        echo $index % 2 == 0 ? '<div class="clearfix"></div>' : '';
    }

    public function load_form($col = 'col-md-6') {
        $i = 1;
        foreach ($this->fields as $field) {
            if (isset($field['enabled']) && $field['enabled'] == FALSE) {
                continue;
            }
            echo '<div class="' . $col . '">';
            echo $this->get_item_1($field);
            echo '</div>';
            $this->generate_seprator($i++);
        }
    }

    public function load_edit_form($item, $col = 'col-md-6') {
        $q = $this->CI->db->where($this->form['primary_key'], $item)->get($this->form['table']);
        if ($q->num_rows() < 1) {
            echo 'Item not available please add one.';
            return;
        }
        $res = $q->result_array()[0];
        $i = 1;
        echo '<input type="hidden" name="primary_key" value="' . $item . '">';
        foreach ($this->fields as $field) {
            if ((isset($field['enabled']) && $field['enabled'] == FALSE) || (isset($field['editable']) && $field['editable'] == FALSE)) {
                continue;
            }
            echo '<div class="' . $col . '">';
            if (isset($field['db_name'])) {
                echo $this->get_item_1($field, $res[$field['db_name']]);
            } else {
                echo $this->get_item_1($field);
            }
            echo '</div>';
            $this->generate_seprator($i++);
        }
    }

    public function get_edit_primary_key() {
        return $this->CI->input->post('primary_key');
    }

    public function dategretaer($str) {
        $form_v = $this->CI->form_validation;
        $date = strtotime($str);
        if ($date < strtotime(date("d/m/Y"))) {
            $this->CI->form_validation->set_message('dategretaer', 'Date should be greater than today');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_title($i = -1) {
        $op = '';
        if ($i == 0) {
            $op .= 'Edit';
        } else if ($i == 1) {
            $op .= 'Add';
        }
        $op .= ' ';
        $op .= isset($this->form['form_title']) ? $this->form['form_title'] : 'Form';
        return $op;
    }

}
