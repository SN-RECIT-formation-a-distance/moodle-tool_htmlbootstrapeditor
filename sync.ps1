$from = "moodle-tool_htmlbootstrapeditor/src/*"
$to = "shared/recitfad/admin/tool/htmlbootstrapeditor"
$source = "./src";

try {
    . ("..\sync\watcher.ps1")
}
catch {
    Write-Host "Error while loading sync.ps1 script." 
}