<?php
// declare function page_header
function page_header() {
echo '<html><head><title>ยินดีต้อนรับทุกท่าน</title><head>';
echo '<body bgcolor="#ffffff">';
}
$user = "Somchai";
page_header();
echo "สวัสดีคุณ $user";
page_footer();
// declare function page_footer
function page_footer() {
echo '<hr />ขอบคุณที่มาเยี่ยมชม';
echo '</body></html>';
}
?>