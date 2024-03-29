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
 * Atto HTML editor
 *
 * @package    tool_htmlbootstrapeditor
 * @copyright  2019 RECIT
 * @license    {@link http://www.gnu.org/licenses/gpl-3.0.html} GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_tool_htmlbootstrapeditor_install() {
    global $DB;
    $dbman = $DB->get_manager();
    if ($dbman->table_exists('atto_reciteditor_templates')) {
        $rst = $DB->get_records('atto_reciteditor_templates');

        foreach ($rst as $obj){
            unset($obj->id);
            $DB->insert_record('tool_htmlbootstrapeditor_tpl', $obj);
        }
    }
}
