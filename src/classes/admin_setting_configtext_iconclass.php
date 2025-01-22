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

namespace tool_htmlbootstrapeditor;
defined('MOODLE_INTERNAL') || die();


class admin_setting_configtext_iconclass extends \admin_setting_configtextarea {
    public const DEFAULT_VALUE = "fontawesome6\nfontello\nrecitfad\nfontawesome4";

    public function validate($data) {      
        if (strlen($data) == 0){
            return true;
        } 

        $data = explode("\n", $data);
        foreach($data as $d){
            if (strlen($d) == 0){
                return false;
            }
        }
        return true;
    }
}