<?php
// 1. Dompdf autoload file ko include karein (Path sahi se check karein)
require_once 'lib/dompdf/autoload.inc.php'; 
use Dompdf\Dompdf;

// 2. Database connection
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

if(isset($_POST["export_pdf"])) {
    $dompdf = new Dompdf();
    
    // 3. Table ka content ek variable mein store karein
    $html = '
    <h2 style="text-align:center;">Doctor Records - CarePlus Hospitals</h2>
    <table border="1" cellspacing="0" cellpadding="5" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th>Email</th>
                <th>Fees</th>
            </tr>
        </thead>
        <tbody>';

    $query = "SELECT * FROM doctb";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $html .= '
            <tr>
                <td>' . $row['username'] . '</td>
                <td>' . $row['spec'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['docFees'] . '</td>
            </tr>';
    }

    $html .= '</tbody></table>';

    // 4. PDF Render karein
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // 5. Browser mein download prompt dein
    $dompdf->stream("Doctor_List.pdf", array("Attachment" => 1));
}
?>