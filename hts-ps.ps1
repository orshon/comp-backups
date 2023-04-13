Add-Type -AssemblyName PresentationFramework
[xml]$XAML = @"
<Window
        xmlns="http://schemas.microsoft.com/winfx/2006/xaml/presentation"
        xmlns:x="http://schemas.microsoft.com/winfx/2006/xaml"
        xmlns:d="http://schemas.microsoft.com/expression/blend/2008"
        xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006"
        xmlns:local="clr-namespace:hts"
        Title="MainWindow" Height="470" Width="820" Background="#FF01101F">
        <Grid>

        <Button Content="Jet" HorizontalAlignment="Left" Height="49" Margin="263,102,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="Hava 5" HorizontalAlignment="Left" Height="49" Margin="150,102,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107"  BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="Hava 7" HorizontalAlignment="Left" Height="49" Margin="37,102,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>

        <Button Content="Alias" HorizontalAlignment="Left" Height="49" Margin="150,325,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="Ofra" HorizontalAlignment="Left" Height="49" Margin="263,158,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="Anata" HorizontalAlignment="Left" Height="49" Margin="150,158,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="Shabash" HorizontalAlignment="Left" Height="49" Margin="37,158,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>


        <Button Content="Kikar Hayeshuvim" HorizontalAlignment="Left" Height="49" Margin="263,270,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="British Police" HorizontalAlignment="Left" Height="49" Margin="150,270,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="El Hader" HorizontalAlignment="Left" Height="49" Margin="37,270,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>

        <Button Content="Shilo" HorizontalAlignment="Left" Height="49" Margin="37,214,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="Amos" HorizontalAlignment="Left" Height="49" Margin="150,214,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Button Content="Doar" HorizontalAlignment="Left" Height="49" Margin="263,214,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="107" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <Label Margin="20,20,527,380" FontFamily="Gill Sans MT" FontSize="16" Foreground="#FF797A8D" FontWeight="bold">Choose Your Preferred Option:</Label>
        <Button Content="Check All Junctions" HorizontalAlignment="Left" Height="84" Margin="502,169,0,0" VerticalAlignment="Top" FontFamily="Gill Sans MT" FontSize="16" Width="188" BorderBrush="Black" FontStyle="italic" FontWeight="bold" Background="#FF010811" OpacityMask="Black" Foreground="#FF797A8D"/>
        <GridSplitter HorizontalAlignment="Left"  Height="377" Margin="416,37,0,0" VerticalAlignment="Top" Width="1" Background="#FF545566"/>

    </Grid>
</Window>
"@
$reader=(New-Object System.Xml.XmlNodeReader $XAML)
try{$Form=[Windows.Markup.XamlReader]::Load($reader)}
catch{Write-Host "Unable tp load Windows.Markup.XamlReader"; exit}

$XAML.SelectNodes("//*[@Name]") | ForEach-Object {Set-Variable -Name ($_.Name) -Value $Form.FindName($_.Name)}
$Form.ShowDialog() | out-null