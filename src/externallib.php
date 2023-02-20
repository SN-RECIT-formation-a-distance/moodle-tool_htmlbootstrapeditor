<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This plugin is an interface for filter_recitautolink
 *
 * @package    tool_htmlbootstrapeditor
 * @copyright  2019 RECIT
 * @license    {@link http://www.gnu.org/licenses/gpl-3.0.html} GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once("$CFG->libdir/externallib.php");

class tool_htmlbootstrapeditor_external extends external_api {
    
    //
    public static function get_template_list_parameters() {
        return new external_function_parameters(array(
            'type' => new external_value(PARAM_TEXT, 'tpl type', VALUE_DEFAULT, ''),
        ));
    }

    public static function get_template_list_returns() {
        return new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'id' => new external_value(PARAM_INT, 'tpl id'),
                            'type' => new external_value(PARAM_TEXT, 'tpl type'),
                            'name' => new external_value(PARAM_TEXT, 'tpl name'),
                            'htmlstr' => new external_value(PARAM_RAW, 'tpl name'),
                            'img' => new external_value(PARAM_RAW, 'img'),
                            'userid' => new external_value(PARAM_INT, 'user'),
                        )
                    ), VALUE_DEFAULT, array()
                );
    }

    public static function get_template_list($type = null) {
        global $DB, $USER;

        $rst = $DB->get_records('htmlbseditor_templates', array('userid' => $USER->id), 'name');

        $result = array();
        foreach ($rst as $obj){
            $result[] = $obj;
        }
        
        return $result;
    }
    
    public static function save_template_parameters() {
        return new external_function_parameters(array(
            'type' => new external_value(PARAM_RAW, 'tpl type'),
            'name' => new external_value(PARAM_RAW, 'tpl name'),
            'htmlstr' => new external_value(PARAM_RAW, 'tpl html'),
            'img' => new external_value(PARAM_RAW, 'img'),
        ));
    }
    
    public static function save_template_returns() {
        return
            new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL, 'success'),
                )
            );
    }

    public static function save_template($type, $name, $htmlstr, $img) {
        global $DB, $USER;
        $params = self::validate_parameters(
                        self::save_template_parameters(),
                        array('type' => $type, 'name' => $name, 'htmlstr' => $htmlstr, 'img' => $img));

        $DB->insert_record('htmlbseditor_templates', array('name' => $name, 'type' => $type, 'userid' => $USER->id, 'htmlstr' => $htmlstr, 'img' => $img));
        return array('success' => true);
    }
    
    public static function import_templates_parameters() {
        return new external_function_parameters(array(
            'fileContent' => new external_value(PARAM_RAW, 'tpl'),
        ));
    }
    
    public static function import_templates_returns() {
        return
            new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL, 'success'),
                )
            );
    }

    public static function import_templates($fileContent) {
        global $DB, $USER;
        $params = self::validate_parameters(
                        self::import_templates_parameters(),
                        array('fileContent' => $fileContent));

        $fileContent = json_decode($fileContent);

        if(!is_array($fileContent)){
            $fileContent = array($fileContent);
        }

        foreach($fileContent as $item){
            if (!isset($item->htmlStr)) $item->htmlStr = $item->htmlstr; //JSON sometimes voids capit keys
            $DB->insert_record('htmlbseditor_templates', array('name' => $item->name, 'type' => $item->type, 'userid' => $USER->id, 'htmlstr' => $item->htmlStr, 'img' => $item->img));
        }
        return array('success' => true);
    }
    
    public static function delete_template_parameters() {
        return new external_function_parameters(array(
            'id' => new external_value(PARAM_INT, 'tpl id'),
        ));
    }
    
    public static function delete_template_returns() {
        return
            new external_single_structure(
                array(
                    'success' => new external_value(PARAM_BOOL, 'success'),
                )
            );
    }

    public static function delete_template($id) {
        global $DB, $USER;
        $params = self::validate_parameters(
                        self::delete_template_parameters(),
                        array('id' => $id));

        $DB->delete_records('htmlbseditor_templates', array('id' => $id, 'userid' => $USER->id));//Pass userid so user can only delete their own templates
        return array('success' => true);
    }

}
