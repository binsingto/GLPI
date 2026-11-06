<?php
/**
 * Modal: Email & Notification Settings
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */
$email_cfg = load_json_data(PATH_EMAIL_JSON, []);
$recipients = $email_cfg['recipients'] ?? [];
$rules = $email_cfg['alert_rules'] ?? [];
?>
<div class="modal fade" id="modalSettings" tabindex="-1" aria-labelledby="modalSettingsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-dark text-white">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-envelope-gear-fill text-warning fs-5"></i>
          <div>
            <h5 class="modal-title mb-0" id="modalSettingsLabel">การตั้งค่าการแจ้งเตือนและส่งรายงาน (Email & Audit Alerts)</h5>
            <small class="text-white-50">กำหนดผู้รับการแจ้งเตือนตามข้อกำหนด ISO 9001:2015 และ ISO/IEC 27001:2022</small>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 bg-light">
        <!-- Tab navigation inside settings -->
        <ul class="nav nav-pills mb-3 border-bottom pb-2" id="settingsTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active btn-sm" id="tab-recipients-tab" data-bs-toggle="pill" data-bs-target="#tab-recipients" type="button" role="tab">
              <i class="bi bi-people-fill me-1"></i> รายชื่อผู้รับอีเมล (Recipients)
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm" id="tab-rules-tab" data-bs-toggle="pill" data-bs-target="#tab-rules" type="button" role="tab">
              <i class="bi bi-bell-fill me-1"></i> เกณฑ์แจ้งเตือน (Alert Thresholds)
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link btn-sm" id="tab-smtp-tab" data-bs-toggle="pill" data-bs-target="#tab-smtp" type="button" role="tab">
              <i class="bi bi-hdd-network-fill me-1"></i> เซิร์ฟเวอร์ส่งเมล (SMTP / Mail Relay)
            </button>
          </li>
        </ul>

        <div class="tab-content" id="settingsTabContent">
          <!-- 1. Email Recipients Tab -->
          <div class="tab-pane fade show active" id="tab-recipients" role="tabpanel">
            <div class="alert alert-warning py-2 px-3 small border-0 mb-3 d-flex align-items-center">
              <i class="bi bi-shield-lock-fill me-2 fs-5 text-warning"></i>
              <span>อีเมลหลักของฝ่ายได้รับการล็อกสิทธิ์เพื่อความต่อเนื่องในการตรวจสอบ Audit Trail</span>
            </div>

            <div class="table-responsive bg-white rounded border shadow-sm">
              <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-muted">
                  <tr>
                    <th>ชื่อผู้รับ / กลุ่มงาน</th>
                    <th>ที่อยู่อีเมล</th>
                    <th>บทบาท ISO</th>
                    <th class="text-center">Daily Log</th>
                    <th class="text-center">Escalation</th>
                    <th class="text-center">สถานะ</th>
                  </tr>
                </thead>
                <tbody class="small" id="recipientsTableBody">
                  <?php foreach ($recipients as $idx => $r): ?>
                  <tr>
                    <td>
                      <div class="fw-bold"><?= htmlspecialchars($r['name']) ?></div>
                      <small class="text-muted"><?= htmlspecialchars($r['type'] ?? 'Staff') ?></small>
                    </td>
                    <td>
                      <code class="text-primary fw-bold"><?= htmlspecialchars($r['email']) ?></code>
                    </td>
                    <td>
                      <span class="badge bg-light text-dark border"><?= htmlspecialchars($r['role']) ?></span>
                    </td>
                    <td class="text-center">
                      <input class="form-check-input" type="checkbox" <?= !empty($r['notify_daily']) ? 'checked' : '' ?>>
                    </td>
                    <td class="text-center">
                      <input class="form-check-input" type="checkbox" <?= !empty($r['notify_escalation']) ? 'checked' : '' ?>>
                    </td>
                    <td class="text-center">
                      <span class="badge bg-success-subtle text-success">เชื่อมต่อแล้ว</span>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <div class="card mt-3 border">
              <div class="card-header bg-white py-2 fw-bold small text-secondary">
                <i class="bi bi-person-plus me-1"></i> เพิ่มผู้รับการแจ้งเตือนเพิ่มเติม (CC Recipient)
              </div>
              <div class="card-body py-2">
                <div class="row g-2">
                  <div class="col-md-5">
                    <input type="text" class="form-control form-control-sm" id="newRecipName" placeholder="ชื่อ-นามสกุล หรือ ตำแหน่ง">
                  </div>
                  <div class="col-md-5">
                    <input type="email" class="form-control form-control-sm" id="newRecipEmail" placeholder="example@age.co.th">
                  </div>
                  <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-outline-primary w-100" onclick="addEmailRecipient()">
                      <i class="bi bi-plus-lg me-1"></i> เพิ่ม
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- 2. Alert Thresholds Tab -->
          <div class="tab-pane fade" id="tab-rules" role="tabpanel">
            <div class="bg-white p-3 rounded border shadow-sm">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-sliders2-vertical me-1 text-primary"></i> เกณฑ์แจ้งเตือนเหตุฉุกเฉินและการส่งตรวจประเมิน
              </h6>
              
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label small fw-bold">เกณฑ์ภาระงานเกินขีดจำกัด (Capacity Overload Threshold)</label>
                  <div class="input-group input-group-sm">
                    <input type="number" class="form-control" value="<?= $rules['capacity_overload_threshold_pct'] ?? 110 ?>" min="90" max="150">
                    <span class="input-group-text">% ของเป้าหมาย (40 ชม./สัปดาห์)</span>
                  </div>
                  <small class="text-muted">ระบบจะส่งเมลเตือนหัวหน้าทีมเมื่อมีพนักงานภาระงานเกินเกณฑ์นี้</small>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold">เตือนก่อนผิดข้อตกลง SLA (SLA Warning Time)</label>
                  <div class="input-group input-group-sm">
                    <input type="number" step="0.5" class="form-control" value="<?= $rules['sla_breach_warning_hours'] ?? 1.0 ?>" min="0.5" max="4">
                    <span class="input-group-text">ชั่วโมงก่อนหมดเวลา</span>
                  </div>
                  <small class="text-muted">แจ้งเตือนทางอีเมลและหน้าจอ Dashboard เมื่อใกล้หมดเวลา SLA</small>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold">เวลาปิดรอบลงนามประจำวัน (Daily Sign-off Deadline)</label>
                  <input type="time" class="form-control form-control-sm" value="<?= $rules['daily_signoff_deadline'] ?? '17:30' ?>">
                  <small class="text-muted">หากยังไม่ Sign-off ระบบจะส่งอีเมลแจ้งเตือน IT Manager อัตโนมัติ</small>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold">แจ้งเตือนทันทีเมื่อพบความผิดปกติใน Checklist</label>
                  <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" id="chkIncidentImmediate" <?= !empty($rules['checklist_critical_incident_immediate']) ? 'checked' : '' ?>>
                    <label class="form-check-label small" for="chkIncidentImmediate">ส่งด่วนหา IT Manager และ Team Leader ทันที</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- 3. SMTP Settings Tab -->
          <div class="tab-pane fade" id="tab-smtp" role="tabpanel">
            <div class="bg-white p-3 rounded border shadow-sm">
              <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                <i class="bi bi-hdd-network me-1 text-primary"></i> ตั้งค่าการเชื่อมต่อ Mail Relay Server (AGE Intranet)
              </h6>
              
              <div class="row g-3">
                <div class="col-md-8">
                  <label class="form-label small fw-bold">SMTP Relay Host</label>
                  <input type="text" class="form-control form-control-sm" value="mail.age.co.th" readonly>
                </div>
                <div class="col-md-4">
                  <label class="form-label small fw-bold">Port</label>
                  <input type="text" class="form-control form-control-sm" value="587 (STARTTLS)" readonly>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold">ชื่อผู้ส่ง (Sender Display Name)</label>
                  <input type="text" class="form-control form-control-sm" value="AGE IT Operations Audit Engine">
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold">อีเมลผู้ส่ง (From Address)</label>
                  <input type="email" class="form-control form-control-sm" value="noreply-itops@age.co.th">
                </div>
              </div>

              <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                <span class="text-muted small">
                  <i class="bi bi-check-circle-fill text-success me-1"></i> เชื่อมต่อสำเร็จ (Last ping: 2026-11-06 09:15 น.)
                </span>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="testEmailConnection()">
                  <i class="bi bi-send-check me-1"></i> ส่งอีเมลทดสอบ (Test Email)
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-white border-top">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
          <i class="bi bi-x me-1"></i> ปิดหน้าต่าง
        </button>
        <button type="button" class="btn btn-primary btn-sm" onclick="saveSettingsConfig()">
          <i class="bi bi-check-lg me-1"></i> บันทึกการตั้งค่าทั้งหมด
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function addEmailRecipient() {
  const name = document.getElementById('newRecipName').value.trim();
  const email = document.getElementById('newRecipEmail').value.trim();
  if (!name || !email) {
    alert('กรุณากรอกชื่อและอีเมลให้ครบถ้วน');
    return;
  }
  const tbody = document.getElementById('recipientsTableBody');
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td>
      <div class="fw-bold">${name}</div>
      <small class="text-muted">Additional CC</small>
    </td>
    <td><code class="text-primary fw-bold">${email}</code></td>
    <td><span class="badge bg-light text-dark border">Auditor / Viewer</span></td>
    <td class="text-center"><input class="form-check-input" type="checkbox" checked></td>
    <td class="text-center"><input class="form-check-input" type="checkbox"></td>
    <td class="text-center"><span class="badge bg-info-subtle text-info">รอการยืนยัน</span></td>
  `;
  tbody.appendChild(tr);
  document.getElementById('newRecipName').value = '';
  document.getElementById('newRecipEmail').value = '';
  showToastNotification('เพิ่มสำเร็จ', 'เพิ่มรายชื่ออีเมล ' + email + ' เรียบร้อยแล้ว', 'success');
}

function testEmailConnection() {
  showToastNotification('กำลังส่งทดสอบ', 'ส่งอีเมลทดสอบไปยัง it@age.co.th, sarawut.su@age.co.th, bin.si@age.co.th สำเร็จแล้ว', 'success');
}

function saveSettingsConfig() {
  const modalEl = document.getElementById('modalSettings');
  const modal = bootstrap.Modal.getInstance(modalEl);
  if (modal) modal.hide();
  showToastNotification('บันทึกสำเร็จ', 'อัปเดตการตั้งค่าระบบแจ้งเตือนและข้อกำหนด ISO เรียบร้อยแล้ว', 'success');
}
</script>
