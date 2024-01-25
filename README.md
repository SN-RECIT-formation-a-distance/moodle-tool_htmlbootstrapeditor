# tool_htmlbootstrapeditor

The HTML Bootstrap editor allows you to create a much more attractive and responsive layout. It is based on the Bootstrap 4 framework and its drag-and-drop usage makes it easy to integrate content into Moodle. It offers a wide range of elements (text, image, Youtube video, embed elements, etc.) commonly used today. This editor meets the first level of accessibility standards and ensures a consistent presentation of content, regardless of the type of device used: computer, tablet or smartphone.

# Dependencies
* Bootstrap 4.6
* jQuery
* FontAwesome

# Non-standard post-installation steps
After installing this plugin, it is necessary to install atto_htmlbootstrapeditor (https://moodle.org/plugins/atto_htmlbootstrapeditor) in order to add the button in the Atto editor.

## Showcase
https://github.com/SN-RECIT-formation-a-distance/html-bootstrap-editor-showcase

## Pixabay API
To make the Pixabay feature available inside the editor, the administrator must:
1. Create a Pixabay account, which will generate an API key automatically
2. Copy the generated API key in the 'Parameters' section on this page: https://pixabay.com/api/docs/
3. Assign the tool_htmlbootstrapeditor setting **pixabaykey**.

## CSS loading
By default, the editor will load the main CSS file compiled by Moodle. However, if you want to use your own styles, you have the option to use inline CSS or external CSS files.

To use inline CSS or an external CSS file with the editor, you will need to add the title attribute to your style tag and specify the value of the title attribute in the ``stylesheet_to_add`` setting. For example, you might write something like this:

``<style title="example" href="path/to/external/css/file">``

This will tell the editor to load the specified CSS file (in this case, "example") when it is rendering the content of the editor canvas.

## Custom components
The files styles.css and content.js are a copy from the library html-bootstrap-editor.

## Library html-bootstrap editor compilation 
1. Committing changes to the lib git repository (increase version number).
2. Run in the react folder of plugin "npm i git+https://github.com/SN-RECIT-formation-a-distance/html-bootstrap-editor.git" to update the lib at plugin folder.
3. Run in the react folder of plugin "npm run build" to compile the plugin with the lib.
