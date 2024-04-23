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
 * This plugin is an editor
 *
 * @package    tool_htmlbootstrapeditor
 * @copyright  2019 RECIT
 * @license    {@link http://www.gnu.org/licenses/gpl-3.0.html} GNU GPL v3 or later
 */ 
defined('MOODLE_INTERNAL') || die();

$functions = array(

            'htmlbootstrapeditor_get_template_list' => array(
                'classname'   => 'tool_htmlbootstrapeditor_external',
                'methodname'  => 'get_template_list',
                'classpath'   => '/admin/tool/htmlbootstrapeditor/externallib.php',
                'description' => 'Returns template list',
                'type'        => 'read',
                'ajax'        => true,
            ),
            'htmlbootstrapeditor_save_template' => array(
                'classname'   => 'tool_htmlbootstrapeditor_external',
                'methodname'  => 'save_template',
                'classpath'   => '/admin/tool/htmlbootstrapeditor/externallib.php',
                'description' => 'Saves template',
                'type'        => 'read',
                'ajax'        => true,
            ),
            'htmlbootstrapeditor_import_templates' => array(
                'classname'   => 'tool_htmlbootstrapeditor_external',
                'methodname'  => 'import_templates',
                'classpath'   => '/admin/tool/htmlbootstrapeditor/externallib.php',
                'description' => 'Import template',
                'type'        => 'read',
                'ajax'        => true,
            ),
            'htmlbootstrapeditor_delete_template' => array(
                'classname'   => 'tool_htmlbootstrapeditor_external',
                'methodname'  => 'delete_template',
                'classpath'   => '/admin/tool/htmlbootstrapeditor/externallib.php',
                'description' => 'Delete template',
                'type'        => 'read',
                'ajax'        => true,
            ),


);