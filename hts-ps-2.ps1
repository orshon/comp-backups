Add-Type -AssemblyName PresentationFramework
[xml]$XAML = @"
<Window
        xmlns="http://schemas.microsoft.com/winfx/2006/xaml/presentation"
        xmlns:x="http://schemas.microsoft.com/winfx/2006/xaml"
        xmlns:d="http://schemas.microsoft.com/expression/blend/2008"
        xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006"
        xmlns:local="clr-namespace:hts"
        Title="Window1" Height="550" Width="550" Background="#FF01101F">
    <Grid>
        <Label Margin="20,20,227,460" FontFamily="Gill Sans MT" FontSize="20" Foreground="#FF797A8D" FontWeight="bold">Server Checkup:</Label>
        <Image Margin="20,66,379,322" Stretch="Fill" Source="server.png"/>
        <Image Margin="44,240,403,240" Stretch="Fill" Source="cam.png"/>

    </Grid>
</Window>

"@
$reader=(New-Object System.Xml.XmlNodeReader $XAML)
try{$Form=[Windows.Markup.XamlReader]::Load($reader)}
catch{Write-Host "Unable tp load Windows.Markup.XamlReader"; exit}

$XAML.SelectNodes("//*[@Name]") | ForEach-Object {Set-Variable -Name ($_.Name) -Value $Form.FindName($_.Name)}
$Form.ShowDialog() | out-null