Remove-Item E:\xampp\htdocs\wordpress\wp-content\themes\understrap -Force  -Recurse -ErrorAction SilentlyContinue
Copy-Item .\dist -Destination E:\xampp\htdocs\wordpress\wp-content\themes\understrap -Recurse
