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
 * @package   tool_htmlbootstrapeditor
 * @copyright 2019 RÉCIT 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

function xmldb_tool_htmlbootstrapeditor_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();

    $newversion = 2023101901;
    if ($oldversion < $newversion) {
        $table = new xmldb_table('htmlbseditor_templates');
        $dbman->rename_table($table, 'tool_htmlbootstrapeditor_tpl');

        upgrade_plugin_savepoint(true, $newversion, 'tool', 'htmlbootstrapeditor');
    }

    $newversion = 2024121602;
    if ($oldversion < $newversion) {
        $iconclass = get_config('tool_htmlbootstrapeditor', 'iconclass');

        $iconclass = \tool_htmlbootstrapeditor\admin_setting_configtext_iconclass::DEFAULT_VALUE;
        
        set_config('iconclass', $iconclass, 'tool_htmlbootstrapeditor');

        upgrade_plugin_savepoint(true, $newversion, 'tool', 'htmlbootstrapeditor');
    }

    return true;
}
