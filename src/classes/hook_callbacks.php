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

namespace tool_htmlbootstrapeditor;

use core\hook\output\before_standard_top_of_body_html_generation;

require_once($CFG->dirroot . '/admin/tool/htmlbootstrapeditor/lib.php');

/**
 * Hook callbacks for tool_htmlbootstrapeditor.
 *
 * @package    tool_htmlbootstrapeditor
 * @copyright  2019 RECIT
 * @license    {@link http://www.gnu.org/licenses/gpl-3.0.html} GNU GPL v3 or later
 */
class hook_callbacks {
    /**
     * Load content.js on every page, so that HTML previously authored with this editor (video
     * popups, image lightboxes, flip cards) keeps working even when no Atto or Tiny editor
     * instance is active on the page.
     *
     * @param before_standard_top_of_body_html_generation $hook
     */
    public static function before_standard_top_of_body_html_generation(before_standard_top_of_body_html_generation $hook): void {
        tool_htmlbootstrapeditor_inject_js();
    }
}
