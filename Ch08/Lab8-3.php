<?php
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
$user = "Somchai";
page_header("My Web Site", "FFDDEE");
echo "สวัสดีคุณ $user";
page_footer("Thank You.");
?>
