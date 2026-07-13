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
 * HTML Bootstrap Editor IWrapper API.
 *
 * Imported directly (as an AMD module) by tiny_htmlbootstrapeditor's wrapper, which builds the
 * IWrapper object handed to the popup editor window (see view.php). Loading it as an AMD
 * dependency instead of a plain $PAGE->requires->js() script means it is still delivered when the
 * Tiny button is initialised outside of a full page render, e.g. inside a block or an assignment
 * (mod_assign) form loaded through Moodle's fragment/AJAX API.
 *
 * @module     tool_htmlbootstrapeditor/editor
 * @copyright  2019 RECIT
 * @license    {@link http://www.gnu.org/licenses/gpl-3.0.html} GNU GPL v3 or later
 */

let settings = {currentthemesubrev: 1};

const post = (url, data) => {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();

        xhr.open('post', url, true);
        // Header sent to the server, specifying a particular format (the content of message body).
        xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
        xhr.setRequestHeader('Accept', 'json'); // What kind of response to expect.

        xhr.onload = (event) => {
            let response = null;

            try {
                response = JSON.parse(event.target.response);
            } catch (error) {
                reject(error);
                return;
            }

            resolve(response);
        };

        xhr.onerror = (err) => {
            reject(err);
        };

        xhr.send(JSON.stringify(data));
    });
};

const queryMoodle = (methodName, args) => {
    const data = {index: 0, args: args, methodname: methodName};
    const url = `${M.cfg.wwwroot}/lib/ajax/service.php?sesskey=${M.cfg.sesskey}&info=${methodName}`;

    return post(url, [data]);
};

/**
 * Apply the server-side settings (theme sub-revision, showcase url, icons, ...) for the editor.
 *
 * @param {Object} newSettings
 */
export const initSettings = (newSettings) => {
    settings = newSettings;
};

const getSettings = () => ({
    wwwroot: M.cfg.wwwroot,
    showcase_url: settings.showcase_url,
    iconclass: settings.iconclass,
    pixabaykey: settings.pixabaykey,
    enable_migration_popup: settings.enable_migration_popup,
});

const getThemeCssRules = (returnAllRules) => {
    const styleSheets = window.document.styleSheets;
    const cssRulesBuffer = {rules: [], urlList: []};
    const titles = settings.stylesheet_to_add ? settings.stylesheet_to_add.split(',') : [];

    for (const sheet of styleSheets) {
        // The only css rules we are looking for is the current theme or some custom css from theme.
        if ((sheet.href && sheet.href.includes(`/theme/styles.php/${M.cfg.theme}`))
                || (titles.includes(sheet.title) || titles.includes(sheet.href))) {
            if (sheet.href === null || returnAllRules) {
                for (const rule of sheet.rules) {
                    cssRulesBuffer.rules.push(rule);
                }
            }
            if (sheet.href) {
                cssRulesBuffer.urlList.push(sheet.href);
            }
        }
    }

    return cssRulesBuffer;
};

const getAdditionalHTMLHead = () => {
    const result = {css: [], js: []};
    const additionalstylesheet = settings.additionalstylesheet || '';

    if (additionalstylesheet.length > 0) {
        result.css = additionalstylesheet.split('\n');
    }

    return result;
};

const getTemplateList = (type) => queryMoodle('htmlbootstrapeditor_get_template_list', {type: type});

const saveTemplate = (data) => queryMoodle('htmlbootstrapeditor_save_template', data);

const deleteTemplate = (id) => queryMoodle('htmlbootstrapeditor_delete_template', {id: id});

const importTemplates = (fileContent) => queryMoodle('htmlbootstrapeditor_import_templates', {fileContent: fileContent});

/**
 * The IWrapper API surface handed to the popup editor window (see view.php) by whichever
 * text editor plugin (currently tiny_htmlbootstrapeditor) opens it.
 */
export const IWrapper = {
    getSettings,
    getThemeCssRules,
    getAdditionalHTMLHead,
    getTemplateList,
    saveTemplate,
    deleteTemplate,
    importTemplates,
};
