<?php
// Dompdf library include karein
require_once 'lib/dompdf/autoload.inc.php'; 
use Dompdf\Dompdf;

// Database connection
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

if(isset($_POST["export_pdf"])) {
    $table = $_POST['table_name'];
    $filename = $_POST['file_name'];
    
    $dompdf = new Dompdf();
    
    // PDF Design (Styling)
    $html = '
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; font-family: sans-serif; color: #333; }
    </style>
    <h2>CarePlus Hospitals - ' . str_replace('_', ' ', $filename) . '</h2>
    <table>
        <thead><tr>';

    // 1. Column Names Fetch karein
    $res = mysqli_query($con, "SHOW COLUMNS FROM $table");
    $columns = [];
    while($col = mysqli_fetch_array($res)) {
        // Password column ko PDF mein na dikhane ke liye filter
        if($col['Field'] == 'password') continue; 
        
        $html .= '<th>' . ucfirst($col['Field']) . '</th>';
        $columns[] = $col['Field'];
    }
    $html .= '</tr></thead><tbody>';

    // 2. Table Data Fetch karein
    $query = "SELECT * FROM $table";
    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
        $html .= '<tr>';
        foreach($columns as $colName) {
            // Agar value null hai toh blank dikhayein
            $val = isset($row[$colName]) ? $row[$colName] : "";
            $html .= '<td>' . $val . '</td>';
        }
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // 3. PDF Generation
    $dompdf->loadHtml($html);
    
    // Agar columns zyada hain (jaise Appointment table), toh Landscape mode use karein
    if(count($columns) > 6) {
        $dompdf->setPaper('A4', 'landscape');
    } else {
        $dompdf->setPaper('A4', 'portrait');
    }

    $dompdf->render();
    $dompdf->stream($filename.".pdf", array("Attachment" => 1));
}
?>