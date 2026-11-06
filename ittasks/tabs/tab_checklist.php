<?php
/**
 * Tab 5: Critical 4-System Routine Checklist (FR-IT-ISO-024)
 * Server, Backup, CCTV, Meeting Room Systems
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */

$checklist_data = get_checklist_systems_data();
$systems = $checklist_data['systems'];
?>

<div class="tab-pane-content">
  <!-- Top Document Meta Banner -->
  <div class="card border-0 shadow-sm mb-4 bg-white border-start border-4 border-success">
    <div class="card-body p-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-success"><?= ISO_DOC_CHECKLIST ?></span>
            <span class="badge bg-light text-dark border"><?= ISO_DOC_CHECKLIST_REV ?></span>
            <span class="badge bg-danger-subtle text-danger">Information Security & Operations (ISO 27001: A.8.16 / A.8.19)</span>
          </div>
          <h5 class="fw-bold mb-0 text-dark">แบบตรวจเช็กระบบโครงสร้างพื้นฐาน 4 ระบบหลัก (Critical Infrastructure Routine Checklist)</h5>
          <small class="text-muted">บันทึกผลการตรวจสอบความพร้อมและมาตรการควบคุมความมั่นคงปลอดภัยสารสนเทศประจำวัน</small>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button class="btn btn-sm btn-outline-danger" onclick="triggerIncidentFromChecklist()">
            <i class="bi bi-exclamation-triangle-fill me-1"></i> เปิด Incident Ticket ด่วน
          </button>
          <button class="btn btn-sm btn-primary" onclick="saveAllChecklistStatus()">
            <i class="bi bi-save2-fill me-1"></i> บันทึกผลการตรวจ (Submit Log)
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- System Status Overview Pills -->
  <div class="row g-3 mb-4">
    <?php foreach ($systems as $key => $sys): 
      $statusBadge = match($sys['overall_status']) {
        'Warning' => 'bg-warning text-dark',
        'Critical' => 'bg-danger text-white',
        default => 'bg-success text-white'
      };
      $statusText = match($sys['overall_status']) {
        'Warning' => 'พบรายการเฝ้าระวัง (Warning)',
        'Critical' => 'พบเหตุขัดข้องวิกฤต (Critical)',
        default => 'ระบบทำงานสมบูรณ์ (All Normal)'
      };
    ?>
    <div class="col-md-6 col-xl-3">
      <div class="card border-0 shadow-sm h-100 p-3 bg-white border-top border-3 border-<?= $sys['overall_status'] == 'Warning' ? 'warning' : 'success' ?>">
        <div class="d-flex justify-content-between align-items-start mb-2">
          <span class="badge <?= $statusBadge ?>"><?= $sys['overall_status'] ?></span>
          <i class="bi <?= $sys['icon'] ?> fs-4 text-secondary"></i>
        </div>
        <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($sys['name']) ?></h6>
        <div class="small text-muted mb-2"><i class="bi bi-person-check me-1"></i> <?= htmlspecialchars($sys['owner']) ?></div>
        <div class="small fw-semibold <?= $sys['overall_status'] == 'Warning' ? 'text-warning-emphasis' : 'text-success' ?>">
          <i class="bi <?= $sys['overall_status'] == 'Warning' ? 'bi-exclamation-circle' : 'bi-check-circle' ?> me-1"></i> <?= $statusText ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- 4 Main System Checklist Tables -->
  <?php foreach ($systems as $sysKey => $sys): ?>
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div class="d-flex align-items-center gap-2">
        <div class="kpi-icon-box bg-light text-primary border" style="width: 32px; height: 32px; font-size: 1rem; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
          <i class="bi <?= $sys['icon'] ?>"></i>
        </div>
        <div>
          <h5 class="mb-0 fw-bold"><?= htmlspecialchars($sys['name']) ?></h5>
          <small class="text-muted">มาตรฐานอ้างอิง: <?= htmlspecialchars($sys['iso_clause']) ?> | ผู้รับผิดชอบ: <?= htmlspecialchars($sys['owner']) ?></small>
        </div>
      </div>
      <span class="badge bg-light text-dark border font-monospace"><?= count($sys['items']) ?> หัวข้อการตรวจ</span>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light text-secondary small align-middle">
            <tr>
              <th style="width: 100px;">รหัสตรวจ</th>
              <th style="min-width: 250px;">หัวข้อการตรวจสอบ (Inspection Item)</th>
              <th style="min-width: 240px;">เกณฑ์มาตรฐานที่ยอมรับได้ (Criteria)</th>
              <th style="min-width: 220px;">ค่าที่ตรวจวัดได้ปัจจุบัน (Current Value)</th>
              <th style="width: 130px;" class="text-center">สถานะ</th>
              <th style="width: 110px;" class="text-center">เวลาตรวจ</th>
              <th>บันทึกผลการตรวจสอบ / การแก้ไข</th>
            </tr>
          </thead>
          <tbody class="small">
            <?php foreach ($sys['items'] as $item): 
              $rowClass = $item['status'] == 'Warning' ? 'table-warning-subtle' : '';
            ?>
            <tr class="<?= $rowClass ?>">
              <td class="font-monospace fw-bold text-primary"><?= htmlspecialchars($item['code']) ?></td>
              <td>
                <div class="fw-bold text-dark"><?= htmlspecialchars($item['title']) ?></div>
              </td>
              <td>
                <span class="text-muted"><?= htmlspecialchars($item['criteria']) ?></span>
              </td>
              <td>
                <code class="text-dark bg-light p-1 rounded font-monospace"><?= htmlspecialchars($item['current_val']) ?></code>
              </td>
              <td class="text-center">
                <select class="form-select form-select-sm chk-status-select" onchange="updateCheckItemStatus(this)">
                  <option value="Normal" <?= $item['status'] == 'Normal' ? 'selected' : '' ?>>Normal (ปกติ)</option>
                  <option value="Warning" <?= $item['status'] == 'Warning' ? 'selected' : '' ?>>Warning (เฝ้าระวัง)</option>
                  <option value="Critical" <?= $item['status'] == 'Critical' ? 'selected' : '' ?>>Critical (วิกฤต)</option>
                </select>
              </td>
              <td class="text-center text-muted font-monospace">
                <?= htmlspecialchars($item['last_checked']) ?>
              </td>
              <td>
                <div class="d-flex align-items-center gap-1">
                  <input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars($item['note']) ?>">
                  <?php if ($item['status'] == 'Warning'): ?>
                  <button type="button" class="btn btn-sm btn-outline-danger p-1" title="เปิด Incident Ticket ไปยังระบบ GLPI" onclick="createGlpiTicketFromItem('<?= $item['code'] ?>', '<?= addslashes($item['title']) ?>')">
                    <i class="bi bi-bug-fill"></i>
                  </button>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <!-- Checklist Signature Box -->
  <div class="card border-0 shadow-sm border-top border-3 border-primary">
    <div class="card-body p-3 bg-light">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h6 class="fw-bold mb-1"><i class="bi bi-shield-check text-success me-1"></i> การรับรองผลการตรวจความพร้อมประจำวัน</h6>
          <small class="text-muted">ผู้ตรวจเช็ก: นายปิยะณัฐ โหระวงค์ (Server/Backup), นายวัฒนา สุขล้อม (CCTV), นายนฐวรรธน์ อินสวาท (Meeting Room) | ผู้สอบทาน: นายบิณฑ์ สิงห์โตศรี</small>
        </div>
        <div class="col-md-4 text-end">
          <button class="btn btn-sm btn-success" onclick="saveAllChecklistStatus()">
            <i class="bi bi-check2-all me-1"></i> ยืนยันผลการตรวจและบันทึกประวัติ (Submit ISO Log)
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function updateCheckItemStatus(selectEl) {
  const tr = selectEl.closest('tr');
  if (selectEl.value === 'Warning') {
    tr.className = 'table-warning-subtle';
  } else if (selectEl.value === 'Critical') {
    tr.className = 'table-danger-subtle';
  } else {
    tr.className = '';
  }
}

function createGlpiTicketFromItem(itemCode, itemTitle) {
  showToastNotification('สร้าง Ticket สำเร็จ', 'เปิด Incident Ticket GLPI จากหัวข้อ ' + itemCode + ' (' + itemTitle + ') และส่งต่อให้ทีม Tier 2 ดำเนินการแล้ว', 'success');
}

function triggerIncidentFromChecklist() {
  showToastNotification('เปิดเหตุฉุกเฉิน', 'สร้าง Incident Ticket: กล้องวงจรปิดสะพานชั่งท่าเรือ Offline (CAM-Dock-03) ส่งแจ้งเตือนด่วนไปยัง it@age.co.th แล้ว', 'warning');
}

function saveAllChecklistStatus() {
  showToastNotification('บันทึกสำเร็จ', 'ผลการตรวจเช็ก 4 ระบบหลักตามแบบฟอร์ม FR-IT-ISO-024 ได้รับการบันทึกเข้าสู่ Audit Trail เรียบร้อยแล้ว', 'success');
}
</script>
