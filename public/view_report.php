<?php
require_once __DIR__ . '/../backend/auth/auth_check.php';
require_once __DIR__ . '/../backend/database.php';

if (!isset($_GET['id'])) {
    die("Invalid report ID");
}

$db = new Database();
$conn = $db->connect();

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM reports WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$report = $result->fetch_assoc();

$stmt->close();
$conn->close();

if (!$report) {
    die("Report not found.");
}

// Decode report data if JSON
$reportData = json_decode($report['report_data'], true);

// Helper function to recursively render report data
function renderReportData($data) {
    if (is_array($data)) {
        echo '<ul class="report-list">';
        foreach ($data as $key => $value) {
            echo '<li><span class="key">' . ucwords(str_replace('_', ' ', $key)) . ':</span> ';
            renderReportData($value); // recursion
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<span class="value">' . htmlspecialchars($data) . '</span>';
    }
}
?>

<?php include_once __DIR__ . '/../includes/navbar.php'; ?>

<style>
body { 
    background: radial-gradient(circle at top, #0d1b2a, #000); 
    color: #e2e8f0; 
    font-family: 'Segoe UI', sans-serif; 
}
.report-container { 
    margin-top: 40px; 
    max-width: 900px; 
    margin-left: auto; 
    margin-right: auto; 
}
.report-header { 
    background: linear-gradient(145deg,#1e293b,#111827); 
    padding: 30px; 
    border-radius: 18px; 
    text-align: center; 
    color: #ffd700; 
    box-shadow: 0 6px 25px rgba(255,215,0,0.25); 
    position: relative;
}
.report-header h2 { font-size: 2rem; margin-bottom: 8px; }
.report-header p { font-size: 0.95rem; color: #cbd5e1; }

.report-details { 
    margin-top: 25px; 
    background: rgba(17,24,39,0.95); 
    padding: 25px; 
    border-radius: 16px; 
    border: 1px solid rgba(255,215,0,0.25); 
    box-shadow: 0 4px 18px rgba(0,0,0,0.5); 
}
.report-details h4 { 
    color: #ffd700; 
    margin-bottom: 14px; 
    border-bottom: 1px solid rgba(255,215,0,0.2); 
    padding-bottom: 5px;
}
.report-section { 
    margin-bottom: 20px; 
    padding: 18px; 
    background: #1e293b; 
    border-radius: 12px; 
    transition: transform 0.2s ease, background 0.3s ease;
}
.report-section:hover { 
    transform: translateY(-2px); 
    background: #24344d; 
}
.report-section h5 { 
    color: #ffd700; 
    margin-bottom: 10px; 
    font-size: 1.1rem;
}
.report-list { list-style-type: none; padding-left: 15px; }
.report-list li { margin-bottom: 8px; }
.key { font-weight: 600; color: #ffec8b; }
.value { color: #f8fafc; }

.back-btn { 
    display: inline-block; 
    margin-top: 20px; 
    padding: 10px 18px; 
    border-radius: 10px; 
    background: #ffd700; 
    color: #111827; 
    font-weight: 600; 
    text-decoration: none; 
    transition: all 0.3s ease; 
    box-shadow: 0 4px 12px rgba(255,215,0,0.3);
}
.back-btn:hover { 
    background: #ffec8b; 
    box-shadow: 0 6px 18px rgba(255,215,0,0.4);
}
.download-btn { 
    background: linear-gradient(135deg,#facc15,#f59e0b); 
    margin-right: 10px;
}
</style>

<div class="container report-container">
    <div class="report-header">
        <h2>✨ <?php echo ucfirst($report['type']); ?> Report</h2>
        <p>Generated on <?php echo date("d M Y, h:i A", strtotime($report['created_at'])); ?></p>
    </div>

    <div class="report-details">
        <?php if (!empty($reportData) && is_array($reportData)): ?>
            <?php foreach ($reportData as $section => $content): ?>
                <div class="report-section">
                    <h5>🔮 <?php echo ucwords(str_replace('_', ' ', $section)); ?></h5>
                    <?php renderReportData($content); ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No detailed data available for this report.</p>
        <?php endif; ?>

        <div style="margin-top:20px;">
            <?php if (!empty($report['file_path'])): ?>
                <a href="/storage/reports/<?php echo $report['file_path']; ?>" target="_blank" class="back-btn download-btn">⬇ Download Full Report</a>
            <?php endif; ?>
            <a href="dashboard.php" class="back-btn">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>

<script src="<?=$base?>/public/assets/js/bootstrap.bundle.min.js"></script>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
