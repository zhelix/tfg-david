

Invoke-WebRequest http://nginx.org/download/nginx-1.10.2.zip -outfile c:\tmp\nginx-1.10.2.zip
Add-Type -AssemblyName System.IO.Compression.FileSystem
function Unzip
{
    param([string]$zipfile, [string]$outpath)

    [System.IO.Compression.ZipFile]::ExtractToDirectory($zipfile, $outpath)
}
Unzip "nginx-1.10.2.zip" ".\"
cd nginx-1.10.2
