<?
// declare function page_header with argument and defualt value
function page_header($title, $bgcolor = "ffffff") {
echo '<html><head><title>' . $title . '</title><head>';
echo '<body bgcolor="#' . $bgcolor . '">';
}
// declare function page_footer
function page_footer($message) {
echo '<hr />' . $message ;
echo '</body></html>';
}
// declare function checker
function show_checker($bgcolor1, $bgcolor2) {
echo '<table align="center" border="1">' ;
for($r = 1; $r <= 5; $r++) {
echo '<tr >';
for($c = 1; $c <= 10; $c++) {
if ( $r % 2 == 1) {
echo '<td bgcolor="#' . (($c % 2 == 1) ? $bgcolor1 : $bgcolor2) . '">';
}
else {
echo '<td bgcolor="#' . (($c % 2 == 1) ? $bgcolor2 : $bgcolor1) . '">';
}
echo $r . ' , ' . $c . '</td>';
}
echo '</tr>';
}
echo '</table>';
}
page_header("My Web Site", "FFDDEE");
show_checker("33ff99","ffff99");
page_footer("Thank You.");
?>