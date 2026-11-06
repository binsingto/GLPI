<?php
/**
 * IT Staff Tasks, Workload & Responsibility Audit System
 * Main Router & Enterprise Application Layout
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 * 
 * Standards Compliance: ISO 9001:2015 & ISO/IEC 27001:2022
 */

if (!defined('AGE_IT_SYSTEM')) {
    define('AGE_IT_SYSTEM', true);
}
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/functions.php';

// Handle AJAX actions
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    $action = $_GET['action'];

    if ($action === 'save_cards' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (is_array($input)) {
            save_json_data(PATH_CARDS_JSON, $input);
            echo json_encode(['status' => 'success', 'message' => 'บันทึกการ์ด KPI เรียบร้อย']);
            exit;
        }
        echo json_encode(['status' => 'error', 'message' => 'ข้อมูลไม่ถูกต้อง']);
        exit;
    }

    if ($action === 'save_settings' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (is_array($input)) {
            save_json_data(PATH_EMAIL_JSON, $input);
            echo json_encode(['status' => 'success', 'message' => 'บันทึกการตั้งค่าเรียบร้อย']);
            exit;
        }
        echo json_encode(['status' => 'error', 'message' => 'ข้อมูลไม่ถูกต้อง']);
        exit;
    }
}

// Router for Tabs
$titles_data = load_json_data(PATH_TITLES_JSON, []);
$available_tabs = ['overview', 'daily', 'weekly', 'monthly', 'checklist', 'meeting'];
$current_tab = isset($_GET['tab']) && in_array($_GET['tab'], $available_tabs) ? $_GET['tab'] : 'overview';

$tab_titles = $titles_data['tabs'] ?? [];
$active_tab_meta = $tab_titles[$current_tab] ?? [
    'header_title' => SYS_NAME_TH,
    'iso_code' => 'ISO 9001:2015 / ISO 27001:2022',
    'description' => SYS_NAME
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($active_tab_meta['header_title'] ?? SYS_NAME) ?> | บมจ. เอเชีย กรีน เอนเนอจี</title>
  
  <!-- Fonts: Sarabun & Prompt & Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5.3 & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

  <style>
    :root {
      --font-base: 'Sarabun', -apple-system, BlinkMacSystemFont, sans-serif;
      --font-heading: 'Prompt', -apple-system, BlinkMacSystemFont, sans-serif;
      --primary-navy: #0f172a;
      --secondary-slate: #1e293b;
      --accent-blue: #0284c7;
      --accent-purple: #7c3aed;
      --accent-emerald: #059669;
    }

    body {
      font-family: var(--font-base);
      background-color: #f1f5f9;
      color: #334155;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    h1, h2, h3, h4, h5, h6, .fw-bold, .nav-link, .modal-title {
      font-family: var(--font-heading);
    }

    .bg-gradient-navy {
      background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
    }

    .bg-navy { background-color: #1e3a8a !important; }
    .bg-sky { background-color: #0284c7 !important; }
    .bg-emerald { background-color: #059669 !important; }
    .bg-purple { background-color: #7c3aed !important; }
    .bg-orange { background-color: #ea580c !important; }
    .bg-slate { background-color: #475569 !important; }
    .text-purple { color: #7c3aed !important; }

    /* Top Enterprise Navbar */
    .age-navbar {
      background: #0f172a;
      border-bottom: 2px solid #0284c7;
    }
    .age-logo-badge {
      background: #0284c7;
      color: #fff;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 6px;
      letter-spacing: 1px;
    }

    /* Sub Tabs Nav */
    .nav-tabs-enterprise {
      background: #ffffff;
      border-bottom: 1px solid #cbd5e1;
    }
    .nav-tabs-enterprise .nav-link {
      color: #64748b;
      font-weight: 500;
      border: none;
      padding: 12px 18px;
      position: relative;
      transition: all 0.2s ease;
      font-size: 0.95rem;
    }
    .nav-tabs-enterprise .nav-link:hover {
      color: #0284c7;
      background: #f8fafc;
    }
    .nav-tabs-enterprise .nav-link.active {
      color: #0284c7;
      font-weight: 700;
      background: transparent;
    }
    .nav-tabs-enterprise .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      right: 0;
      height: 3px;
      background: #0284c7;
      border-radius: 3px 3px 0 0;
    }

    /* KPI Cards */
    .kpi-stat-card {
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .kpi-stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
    }
    .kpi-icon-box {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
    }
    .kpi-value {
      font-size: 1.65rem;
      font-family: var(--font-heading);
      letter-spacing: -0.5px;
    }
    .kpi-title {
      font-size: 0.85rem;
    }

    /* Org Tree Styles */
    .org-node-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 10px;
      padding: 14px;
      min-width: 250px;
      max-width: 320px;
      display: inline-block;
      transition: all 0.25s ease;
      cursor: pointer;
      position: relative;
    }
    .org-node-card:hover {
      border-color: #0284c7;
      box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.25) !important;
      transform: translateY(-4px);
    }
    .node-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1.1rem;
    }
    .node-badge {
      position: absolute;
      top: -10px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 0.68rem;
      padding: 2px 10px;
      border-radius: 12px;
      font-weight: 600;
      white-space: nowrap;
    }
    .tree-line-vertical {
      width: 2px;
      height: 24px;
      background: #cbd5e1;
      margin: 0 auto;
    }

    /* RACI Badges */
    .raci-badge {
      display: inline-block;
      width: 30px;
      height: 30px;
      line-height: 30px;
      border-radius: 50%;
      font-weight: 700;
      font-size: 0.85rem;
    }
    .badge-raci-r { background: #fee2e2; color: #dc2626; border: 1px solid #f87171; }
    .badge-raci-a { background: #dbeafe; color: #1d4ed8; border: 1px solid #60a5fa; }
    .badge-raci-c { background: #fef3c7; color: #d97706; border: 1px solid #fcd34d; }
    .badge-raci-i { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }

    /* Scorecard Grade Ribbon */
    .grade-corner-ribbon {
      position: absolute;
      top: 15px;
      right: -30px;
      transform: rotate(45deg);
      padding: 4px 35px;
      font-size: 0.75rem;
      font-weight: bold;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }

    /* Print Stylesheet for ISO Audits */
    @media print {
      body { background: #fff !important; }
      .age-navbar, .nav-tabs-enterprise, .btn, .modal, .toast-container { display: none !important; }
      .card { border: 1px solid #ddd !important; box-shadow: none !important; }
      .tab-pane-content { padding: 0 !important; }
    }
  </style>
</head>
<body>

  <!-- Top Enterprise Navigation Bar -->
  <nav class="navbar navbar-expand-lg age-navbar py-2 shadow-sm text-white sticky-top">
    <div class="container-fluid px-3 px-md-4">
      <div class="d-flex align-items-center gap-3">
        <span class="age-logo-badge">AGE</span>
        <div>
          <div class="fw-bold fs-6 mb-0 text-white"><?= COMPANY_NAME_TH ?></div>
          <div class="text-white-50 small d-none d-md-block" style="font-size: 0.78rem;">
            <?= SYS_NAME ?> | <?= DEPARTMENT_NAME ?>
          </div>
        </div>
      </div>

      <div class="ms-auto d-flex align-items-center gap-2">
        <div class="d-none d-lg-flex align-items-center gap-1 me-2">
          <span class="badge bg-success-subtle text-success border border-success-subtle">
            <i class="bi bi-shield-check me-1"></i> ISO 9001:2015
          </span>
          <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
            <i class="bi bi-lock-fill me-1"></i> ISO/IEC 27001:2022
          </span>
        </div>

        <button type="button" class="btn btn-sm btn-outline-light d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalSettings">
          <i class="bi bi-gear-fill"></i>
          <span class="d-none d-sm-inline">ตั้งค่าระบบ</span>
        </button>

        <a href="https://github.com/binsingto/GLPI" target="_blank" class="btn btn-sm btn-light d-flex align-items-center gap-1">
          <i class="bi bi-github"></i>
          <span class="d-none d-md-inline">Repository</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- 6-Tab Navigation Bar -->
  <div class="nav-tabs-enterprise shadow-sm sticky-top" style="top: 56px; z-index: 1020;">
    <div class="container-fluid px-3 px-md-4">
      <ul class="nav nav-tabs border-0 flex-nowrap overflow-x-auto" id="mainTabList" role="tablist">
        <?php foreach ($available_tabs as $tabKey): 
          $tMeta = $tab_titles[$tabKey] ?? [];
          $isActive = ($current_tab === $tabKey);
        ?>
        <li class="nav-item" role="presentation">
          <a class="nav-link text-nowrap <?= $isActive ? 'active' : '' ?>" href="ittasks.php?tab=<?= $tabKey ?>">
            <i class="bi <?= $tMeta['icon'] ?? 'bi-file-text' ?> me-1"></i>
            <?= htmlspecialchars($tMeta['nav_title_th'] ?? ucfirst($tabKey)) ?>
            <?php if (!empty($tMeta['iso_code'])): ?>
            <span class="badge bg-light text-secondary border ms-1 font-monospace" style="font-size: 0.68rem;"><?= htmlspecialchars($tMeta['iso_code']) ?></span>
            <?php endif; ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- Main Content Container -->
  <main class="flex-grow-1 py-4">
    <div class="container-fluid px-3 px-md-4">
      <?php
      // Include the active tab component
      $tab_file = __DIR__ . '/tabs/tab_' . $current_tab . '.php';
      if (file_exists($tab_file)) {
          include $tab_file;
      } else {
          echo '<div class="alert alert-danger">ไม่พบไฟล์แท็บที่ต้องการ: ' . htmlspecialchars($current_tab) . '</div>';
      }
      ?>
    </div>
  </main>

  <!-- Enterprise Footer -->
  <footer class="bg-white border-top py-3 mt-auto">
    <div class="container-fluid px-3 px-md-4 d-flex flex-wrap justify-content-between align-items-center gap-2 small text-muted">
      <div>
        <strong><?= COMPANY_NAME_EN ?></strong> &copy; <?= date('Y') ?> | ฝ่ายสนับสนุนไอทีและโครงสร้างพื้นฐาน
      </div>
      <div class="d-flex align-items-center gap-3">
        <span>ISO Forms: FR-IT-ISO-021 ถึง 024</span>
        <span>•</span>
        <span>Version: <?= SYS_VERSION ?></span>
        <span>•</span>
        <span class="text-success"><i class="bi bi-shield-check"></i> ISMS Certified</span>
      </div>
    </div>
  </footer>

  <!-- Modals -->
  <?php 
  require_once __DIR__ . '/modals/modal_cards.php';
  require_once __DIR__ . '/modals/modal_settings.php';
  ?>

  <!-- Toast Notification Container -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">
    <div id="liveToast" class="toast align-items-center text-white border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body d-flex align-items-center gap-2">
          <i id="toastIcon" class="bi bi-check-circle-fill fs-5"></i>
          <div>
            <strong id="toastTitle" class="d-block">แจ้งเตือน</strong>
            <span id="toastMessage" class="small">ข้อความแจ้งเตือน</span>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 Bundle JS & Core Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Initialize Popovers
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

    // Toast Notification Helper
    function showToastNotification(title, message, type = 'success') {
      const toastEl = document.getElementById('liveToast');
      const toastTitle = document.getElementById('toastTitle');
      const toastMessage = document.getElementById('toastMessage');
      const toastIcon = document.getElementById('toastIcon');

      toastTitle.innerText = title;
      toastMessage.innerText = message;

      toastEl.className = 'toast align-items-center text-white border-0 shadow-lg';
      if (type === 'success') {
        toastEl.classList.add('bg-success');
        toastIcon.className = 'bi bi-check-circle-fill fs-5';
      } else if (type === 'warning') {
        toastEl.classList.add('bg-warning', 'text-dark');
        toastIcon.className = 'bi bi-exclamation-triangle-fill fs-5 text-dark';
      } else if (type === 'danger') {
        toastEl.classList.add('bg-danger');
        toastIcon.className = 'bi bi-x-circle-fill fs-5';
      } else {
        toastEl.classList.add('bg-primary');
        toastIcon.className = 'bi bi-info-circle-fill fs-5';
      }

      const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
      toast.show();
    }
  </script>
</body>
</html>
