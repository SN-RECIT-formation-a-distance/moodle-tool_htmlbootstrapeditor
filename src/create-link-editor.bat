echo off
set pluginPath=..\..\html-bootstrap-editor\dist

rem remove the current link
..\..\outils\junction -d editor
rmdir /S /Q editor

rem set the link
..\..\outils\junction editor %pluginPath%

pause