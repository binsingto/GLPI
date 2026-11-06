<?php
/**
 * Tab 2: Daily Operations Board & Task Audit (FR-IT-ISO-021)
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */

$selected_staff = isset($_GET['staff']) ? (int)$_GET['staff'] : 0;
$selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$cards = load_json_data(PATH_CARDS_JSON, []);
$tasks = get_daily_tasks_data($selected_date, $selected_staff);
$staff_list = get_staff_list();

// Calculate total hours
$total_raw_hours = 0;
$total_weighted_hours = 0;
foreach ($tasks as $t) {
    $total_raw_hours += $t['raw_hours'];
    $total_weighted_hours += $t['weighted_hours'];
}
?>

<div class="tab-pane-content">
  <!-- Top Document Meta Banner -->
  <div class="card border-0 shadow-sm mb-4 bg-white border-start border-4 border-primary">
    <div class="card-body p-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-primary"><?= ISO_DOC_DAILY ?></span>
            <span class="badge bg-light text-dark border"><?= ISO_DOC_DAILY_REV ?></span>
            <span class="badge bg-success-subtle text-success">Control of Service Provision (ISO 9001: 8.5.1)</span>
          </div>
          <h5 class="fw-bold mb-0 text-dark">แบบบันทึกงานประจำวันและการปฏิบัติการฝ่ายไอที (Daily IT Operations & Task Log Record)</h5>
          <small class="text-muted">บันทึกภาระงานจริง คำนวณค่าน้ำหนักตามความซับซ้อน (Task Weight Multiplier) และลงนามกำกับดูแล</small>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalCardsConfig">
            <i class="bi bi-gear-fill me-1"></i> จัดการการ์ด KPI
          </button>
          <button type="button" class="btn btn-sm btn-primary" onclick="openNewTaskModal()">
            <i class="bi bi-plus-lg me-1"></i> บันทึกงานใหม่ (Log Task)
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Dynamic KPI Cards Row -->
  <div class="row g-3 mb-4">
    <?php foreach ($cards as $card): 
      if (empty($card['enabled'])) continue;
      $color = $card['color'] ?? 'primary';
      $icon = $card['icon'] ?? 'bi-bar-chart';
    ?>
    <div class="col-sm-6 col-xl-2">
      <div class="card border-0 shadow-sm h-100 kpi-stat-card border-top border-3 border-<?= $color ?>">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="badge bg-<?= $color ?>-subtle text-<?= $color ?> small"><?= htmlspecialchars($card['badge'] ?? 'KPI') ?></span>
            <div class="kpi-icon-box bg-<?= $color ?> text-white">
              <i class="bi <?= htmlspecialchars($icon) ?>"></i>
            </div>
          </div>
          <div class="kpi-value text-dark fw-bold mb-1"><?= htmlspecialchars($card['value']) ?> <small class="text-muted fw-normal fs-6"><?= htmlspecialchars($card['unit'] ?? '') ?></small></div>
          <div class="kpi-title text-muted text-truncate mb-2" title="<?= htmlspecialchars($card['title']) ?>"><?= htmlspecialchars($card['title']) ?></div>
          <div class="d-flex justify-content-between align-items-center pt-2 border-top border-light-subtle small">
            <span class="text-secondary text-truncate"><?= htmlspecialchars($card['subtext'] ?? '') ?></span>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Filter & Operation Control Bar -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3 bg-light rounded">
      <form method="GET" action="ittasks.php" class="row g-2 align-items-center">
        <input type="hidden" name="tab" value="daily">
        <div class="col-md-3">
          <label class="form-label small text-muted mb-1 fw-bold">เลือกวันที่ปฏิบัติงาน (Task Date):</label>
          <div class="input-group input-group-sm">
            <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
            <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($selected_date) ?>" onchange="this.form.submit()">
          </div>
        </div>
        <div class="col-md-4">
          <label class="form-label small text-muted mb-1 fw-bold">กรองตามเจ้าหน้าที่ (Staff Member):</label>
          <select name="staff" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="0">-- แสดงเจ้าหน้าที่ทั้งหมด (All 6 Members) --</option>
            <?php foreach ($staff_list as $st): ?>
            <option value="<?= $st['id'] ?>" <?= $selected_staff == $st['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($st['name']) ?> (<?= htmlspecialchars($st['role_tier']) ?>)
            </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label small text-muted mb-1 fw-bold">สถานะงาน (Task Status):</label>
          <select class="form-select form-select-sm" id="filterStatus" onchange="filterDailyTable()">
            <option value="ALL">สถานะทั้งหมด</option>
            <option value="Completed">เสร็จสิ้นแล้ว (Completed)</option>
            <option value="In Progress">กำลังดำเนินการ (In Progress)</option>
            <option value="Pending">รอดำเนินการ (Pending)</option>
          </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="window.location.href='ittasks.php?tab=daily'">
            <i class="bi bi-arrow-clockwise me-1"></i> ล้างตัวกรอง
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Expandable Daily Operations Data Table -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-table text-primary fs-5"></i>
        <h5 class="mb-0 fw-bold">รายการบันทึกงานประจำวัน (Daily Task Log Sheet)</h5>
        <span class="badge bg-secondary-subtle text-secondary"><?= count($tasks) ?> รายการ</span>
      </div>
      <div class="d-flex align-items-center gap-3">
        <div class="text-end small">
          <span class="text-muted">ชั่วโมงรวมปฏิบัติจริง:</span> <strong class="text-dark font-monospace"><?= number_format($total_raw_hours, 1) ?> ชม.</strong>
          <span class="mx-2 text-muted">|</span>
          <span class="text-muted">ชั่วโมงถ่วงน้ำหนัก (Weighted):</span> <strong class="text-primary font-monospace fs-6"><?= number_format($total_weighted_hours, 2) ?> ชม.</strong>
        </div>
        <button class="btn btn-sm btn-outline-primary" onclick="exportTasksTable()">
          <i class="bi bi-file-earmark-spreadsheet me-1"></i> Excel/CSV
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="dailyTasksTable">
          <thead class="table-light text-secondary small align-middle">
            <tr>
              <th style="width: 40px;" class="text-center">#</th>
              <th style="width: 130px;">รหัสงาน / Ticket</th>
              <th style="width: 180px;">เจ้าหน้าที่ผู้ปฏิบัติงาน</th>
              <th>รายละเอียดงานและขั้นตอนย่อย (Task & Sub-tasks)</th>
              <th style="width: 140px;">ประเภท / Tier</th>
              <th style="width: 100px;" class="text-center">เวลาจริง</th>
              <th style="width: 110px;" class="text-center">น้ำหนัก (Weighted)</th>
              <th style="width: 100px;" class="text-center">สถานะ</th>
              <th style="width: 70px;" class="text-center">การจัดการ</th>
            </tr>
          </thead>
          <tbody class="small">
            <?php foreach ($tasks as $i => $t): 
              $prioBadge = match($t['priority']) {
                'Critical' => 'bg-danger',
                'High' => 'bg-warning text-dark',
                'Medium' => 'bg-info text-dark',
                default => 'bg-light text-dark'
              };
              $statBadge = match($t['status']) {
                'Completed' => 'bg-success text-white',
                'In Progress' => 'bg-primary text-white',
                default => 'bg-secondary text-white'
              };
            ?>
            <tr class="task-row" data-status="<?= htmlspecialchars($t['status']) ?>">
              <td class="text-center text-muted fw-bold"><?= $i + 1 ?></td>
              <td>
                <div class="fw-bold font-monospace text-primary"><?= htmlspecialchars($t['id']) ?></div>
                <small class="badge bg-light text-secondary border font-monospace"><?= htmlspecialchars($t['ticket_no']) ?></small>
              </td>
              <td>
                <div class="fw-semibold text-dark"><?= htmlspecialchars($t['staff_name']) ?></div>
                <small class="text-muted"><?= htmlspecialchars($t['staff_role']) ?></small>
              </td>
              <td>
                <div class="d-flex align-items-center gap-2 mb-1">
                  <span class="badge <?= $prioBadge ?>"><?= htmlspecialchars($t['priority']) ?></span>
                  <span class="fw-bold text-dark"><?= htmlspecialchars($t['title']) ?></span>
                </div>
                
                <!-- Expandable Subtasks details -->
                <div class="subtasks-container mt-1 ps-2 border-start border-2 border-primary-subtle">
                  <ul class="mb-1 text-muted ps-3 small">
                    <?php foreach ($t['subtasks'] as $sub): ?>
                    <li><?= htmlspecialchars($sub) ?></li>
                    <?php endforeach; ?>
                  </ul>
                  <div class="text-muted-50" style="font-size: 0.78rem;">
                    <i class="bi bi-clock me-1"></i> ช่วงเวลา: <?= $t['time_start'] ?> - <?= $t['time_end'] ?> น.
                    <span class="mx-2">•</span>
                    <i class="bi bi-shield-check me-1"></i> ISO: <?= htmlspecialchars($t['iso_clause']) ?>
                    <?php if (!empty($t['remarks'])): ?>
                    <span class="mx-2">•</span> หมายเหตุ: <?= htmlspecialchars($t['remarks']) ?>
                    <?php endif; ?>
                  </div>
                </div>
              </td>
              <td>
                <span class="badge bg-light text-dark border"><?= htmlspecialchars($t['category_title']) ?></span>
                <div class="small text-muted mt-1">ตัวคูณ: x<?= number_format($t['multiplier'], 1) ?></div>
              </td>
              <td class="text-center font-monospace">
                <?= number_format($t['raw_hours'], 1) ?> ชม.
              </td>
              <td class="text-center font-monospace fw-bold text-primary">
                <?= number_format($t['weighted_hours'], 2) ?> ชม.
              </td>
              <td class="text-center">
                <span class="badge <?= $statBadge ?>"><?= htmlspecialchars($t['status']) ?></span>
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-link text-primary p-0" title="ดูประวัติการตรวจสอบ" onclick="viewTaskDetail('<?= $t['id'] ?>')">
                  <i class="bi bi-eye-fill fs-6"></i>
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ISO 9001 & ISO 27001 Electronic Sign-Off Box -->
  <div class="card border-0 shadow-sm border-top border-3 border-success">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-pen-fill text-success fs-5"></i>
        <h5 class="mb-0 fw-bold">การลงนามรับรองเอกสารอิเล็กทรอนิกส์ (ISO 9001 / ISO 27001 Electronic Sign-Off)</h5>
      </div>
      <span class="badge bg-success text-white">Audit Trail Compliant</span>
    </div>
    <div class="card-body p-4 bg-light">
      <div class="row g-4 align-items-center">
        <!-- Submitter Box (Team Leader) -->
        <div class="col-md-6">
          <div class="bg-white p-3 rounded border shadow-sm h-100 signoff-card">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
              <span class="text-muted small fw-bold">1. ผู้จัดทำและตรวจสอบความถูกต้อง (Submitter)</span>
              <span class="badge bg-success-subtle text-success"><i class="bi bi-check-circle me-1"></i> ลงนามเรียบร้อย</span>
            </div>
            <div class="d-flex align-items-center gap-3 my-2">
              <div class="stamp-box border border-success text-success p-2 text-center rounded">
                <div class="small fw-bold" style="font-size: 0.7rem;">DIGITALLY SIGNED</div>
                <div class="fw-bold font-monospace" style="font-size: 0.85rem;">WUTTIPHONG S.</div>
                <div style="font-size: 0.65rem;" class="text-muted"><?= $selected_date ?> 16:45:12</div>
              </div>
              <div>
                <h6 class="mb-0 fw-bold">นายวุฒิพงศ์ สินธุมาศ</h6>
                <div class="small text-muted">ตำแหน่ง: IT Support Team Leader</div>
                <div class="small text-muted">อีเมล: wuttiphong.si@age.co.th</div>
              </div>
            </div>
            <p class="small text-muted mb-0 mt-2 pt-2 border-top">
              "ข้าพเจ้าได้ตรวจสอบรายละเอียดเวลาปฏิบัติงานและค่าน้ำหนักของเจ้าหน้าที่ทุกคนตามแบบฟอร์ม <?= ISO_DOC_DAILY ?> ถูกต้องครบถ้วนตามข้อเท็จจริง"
            </p>
          </div>
        </div>

        <!-- Approver Box (IT Manager) -->
        <div class="col-md-6">
          <div class="bg-white p-3 rounded border shadow-sm h-100 signoff-card" id="approverSignoffBox">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
              <span class="text-muted small fw-bold">2. ผู้อนุมัติและผู้ตรวจรับรองระบบ (Approver)</span>
              <span class="badge bg-warning text-dark" id="approverBadge"><i class="bi bi-hourglass-split me-1"></i> รอการอนุมัติ</span>
            </div>
            <div class="d-flex align-items-center gap-3 my-2" id="approverSignatureArea">
              <div class="stamp-box border border-warning text-warning p-2 text-center rounded" id="approverStamp">
                <div class="small fw-bold" style="font-size: 0.7rem;">PENDING REVIEW</div>
                <div class="fw-bold font-monospace" style="font-size: 0.85rem;">BIN SINGTOSI</div>
                <div style="font-size: 0.65rem;" class="text-muted">Awaiting Action</div>
              </div>
              <div>
                <h6 class="mb-0 fw-bold">นายบิณฑ์ สิงห์โตศรี</h6>
                <div class="small text-muted">ตำแหน่ง: ผู้จัดการฝ่ายเทคโนโลยีสารสนเทศ (IT Manager)</div>
                <div class="small text-muted">อีเมล: bin.si@age.co.th</div>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
              <span class="small text-muted">รับรองตามมาตรฐาน ISO 9001: 9.1.3</span>
              <button type="button" class="btn btn-sm btn-success px-3" id="btnSignOffDaily" onclick="performManagerSignOff()">
                <i class="bi bi-shield-check me-1"></i> อนุมัติและลงนาม (Sign-Off)
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function filterDailyTable() {
  const status = document.getElementById('filterStatus').value;
  const rows = document.querySelectorAll('#dailyTasksTable .task-row');
  rows.forEach(row => {
    if (status === 'ALL' || row.dataset.status === status) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
}

function performManagerSignOff() {
  const stamp = document.getElementById('approverStamp');
  const badge = document.getElementById('approverBadge');
  const btn = document.getElementById('btnSignOffDaily');

  stamp.className = 'stamp-box border border-success text-success p-2 text-center rounded';
  stamp.innerHTML = `
    <div class="small fw-bold" style="font-size: 0.7rem;">DIGITALLY APPROVED</div>
    <div class="fw-bold font-monospace" style="font-size: 0.85rem;">BIN SINGTOSI</div>
    <div style="font-size: 0.65rem;" class="text-muted"><?= date('Y-m-d H:i:s') ?></div>
  `;
  badge.className = 'badge bg-success-subtle text-success';
  badge.innerHTML = '<i class="bi bi-check-circle me-1"></i> อนุมัติเรียบร้อย';
  btn.disabled = true;
  btn.className = 'btn btn-sm btn-outline-success px-3';
  btn.innerHTML = '<i class="bi bi-check2-all me-1"></i> ลงนามแล้ว';

  showToastNotification('อนุมัติเอกสารสำเร็จ', 'ผู้จัดการฝ่าย IT (นายบิณฑ์ สิงห์โตศรี) ได้ลงนามรับรองแบบฟอร์ม FR-IT-ISO-021 ประจำวันเรียบร้อยแล้ว', 'success');
}

function openNewTaskModal() {
  alert('เปิดหน้าต่างบันทึกภาระงานประจำวัน (Log Task) เชื่อมต่อ GLPI Ticket');
}

function viewTaskDetail(taskId) {
  alert('รายละเอียดงาน ' + taskId + ' บันทึก Audit Log และการดำเนินงานตามระเบียบปฏิบัติ ISO');
}

function exportTasksTable() {
  showToastNotification('ส่งออกข้อมูล', 'กำลังดาวน์โหลดไฟล์บันทึกงานประจำวัน FR-IT-ISO-021.csv', 'info');
}
</script>
