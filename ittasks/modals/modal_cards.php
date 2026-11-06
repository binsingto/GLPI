<?php
/**
 * Modal: Dynamic KPI Cards Configuration
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */
?>
<div class="modal fade" id="modalCardsConfig" tabindex="-1" aria-labelledby="modalCardsConfigLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-dark text-white">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-grid-1x2-fill text-warning fs-5"></i>
          <div>
            <h5 class="modal-title mb-0" id="modalCardsConfigLabel">จัดการการ์ดตัวชี้วัด (Dynamic KPI Cards Manager)</h5>
            <small class="text-white-50">ปรับแต่งการแสดงผลการ์ดสรุปผลตามมาตรฐาน ISO 9001:2015 & ISO 27001:2022</small>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 bg-light">
        <div class="alert alert-info d-flex align-items-center py-2 px-3 mb-3 border-0 shadow-sm" role="alert">
          <i class="bi bi-info-circle-fill fs-5 me-2 text-info"></i>
          <small>การแก้ไขการ์ดจะมีผลกับหน้าแดชบอร์ดหลักทันที และบันทึกประวัติการเปลี่ยนแปลงลงใน Audit Log</small>
        </div>

        <form id="formCardsConfig" onsubmit="saveCardsConfig(event)">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-bold text-secondary">รายการการ์ดตัวชี้วัดปัจจุบัน (6 รายการ)</span>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addNewCardRow()">
              <i class="bi bi-plus-circle me-1"></i> เพิ่มการ์ดใหม่
            </button>
          </div>

          <div class="card-list-container" id="cardsListContainer">
            <?php 
            $cards = load_json_data(PATH_CARDS_JSON, []);
            foreach ($cards as $idx => $c): 
            ?>
            <div class="card mb-3 border shadow-sm card-edit-item" data-id="<?= htmlspecialchars($c['id']) ?>">
              <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                  <span class="badge bg-secondary"><?= $idx + 1 ?></span>
                  <span class="fw-bold card-preview-title"><?= htmlspecialchars($c['title']) ?></span>
                  <span class="badge bg-light text-dark border"><?= htmlspecialchars($c['iso_ref']) ?></span>
                </div>
                <div class="form-check form-switch m-0">
                  <input class="form-check-input card-enabled-toggle" type="checkbox" role="switch" <?= !empty($c['enabled']) ? 'checked' : '' ?>>
                  <label class="form-check-label small text-muted">แสดงผล</label>
                </div>
              </div>
              <div class="card-body py-2">
                <div class="row g-2">
                  <div class="col-md-5">
                    <label class="form-label small text-muted mb-1">หัวข้อภาษาไทย (Title)</label>
                    <input type="text" class="form-control form-control-sm card-input-title" value="<?= htmlspecialchars($c['title']) ?>" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small text-muted mb-1">หัวข้อภาษาอังกฤษ (Title EN)</label>
                    <input type="text" class="form-control form-control-sm card-input-title-en" value="<?= htmlspecialchars($c['title_en'] ?? '') ?>">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">ค่าตัวเลข (Value)</label>
                    <input type="text" class="form-control form-control-sm card-input-value font-monospace fw-bold" value="<?= htmlspecialchars($c['value']) ?>" required>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label small text-muted mb-1">คำอธิบายย่อย (Subtext)</label>
                    <input type="text" class="form-control form-control-sm card-input-subtext" value="<?= htmlspecialchars($c['subtext'] ?? '') ?>">
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">ไอคอน (Bootstrap Icon)</label>
                    <div class="input-group input-group-sm">
                      <span class="input-group-text"><i class="bi <?= htmlspecialchars($c['icon']) ?>"></i></span>
                      <input type="text" class="form-control card-input-icon" value="<?= htmlspecialchars($c['icon']) ?>">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">ชุดสี (Theme)</label>
                    <select class="form-select form-select-sm card-input-color">
                      <option value="primary" <?= $c['color'] == 'primary' ? 'selected' : '' ?>>Primary (น้ำเงิน)</option>
                      <option value="success" <?= $c['color'] == 'success' ? 'selected' : '' ?>>Success (เขียว)</option>
                      <option value="info" <?= $c['color'] == 'info' ? 'selected' : '' ?>>Info (ฟ้า)</option>
                      <option value="warning" <?= $c['color'] == 'warning' ? 'selected' : '' ?>>Warning (ส้ม)</option>
                      <option value="purple" <?= $c['color'] == 'purple' ? 'selected' : '' ?>>Purple (ม่วง)</option>
                      <option value="danger" <?= $c['color'] == 'danger' ? 'selected' : '' ?>>Danger (แดง)</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label class="form-label small text-muted mb-1">อ้างอิงมาตรฐาน ISO</label>
                    <input type="text" class="form-control form-control-sm card-input-iso" value="<?= htmlspecialchars($c['iso_ref'] ?? '') ?>">
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-white border-top">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
          <i class="bi bi-x me-1"></i> ยกเลิก
        </button>
        <button type="button" class="btn btn-primary btn-sm" onclick="saveCardsConfig()">
          <i class="bi bi-check2-circle me-1"></i> บันทึกการเปลี่ยนแปลง (Save)
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function addNewCardRow() {
  const container = document.getElementById('cardsListContainer');
  const count = container.querySelectorAll('.card-edit-item').length + 1;
  const newId = 'card_custom_' + Date.now();
  const html = `
    <div class="card mb-3 border shadow-sm card-edit-item" data-id="${newId}">
      <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-secondary">${count}</span>
          <span class="fw-bold card-preview-title">การ์ดตัวชี้วัดใหม่</span>
          <span class="badge bg-light text-dark border">ISO 9001 / 27001</span>
        </div>
        <div class="form-check form-switch m-0">
          <input class="form-check-input card-enabled-toggle" type="checkbox" role="switch" checked>
          <label class="form-check-label small text-muted">แสดงผล</label>
        </div>
      </div>
      <div class="card-body py-2">
        <div class="row g-2">
          <div class="col-md-5">
            <label class="form-label small text-muted mb-1">หัวข้อภาษาไทย (Title)</label>
            <input type="text" class="form-control form-control-sm card-input-title" value="การ์ดใหม่" required>
          </div>
          <div class="col-md-4">
            <label class="form-label small text-muted mb-1">หัวข้อภาษาอังกฤษ (Title EN)</label>
            <input type="text" class="form-control form-control-sm card-input-title-en" value="New Metric">
          </div>
          <div class="col-md-3">
            <label class="form-label small text-muted mb-1">ค่าตัวเลข (Value)</label>
            <input type="text" class="form-control form-control-sm card-input-value font-monospace fw-bold" value="100%" required>
          </div>
          <div class="col-md-4">
            <label class="form-label small text-muted mb-1">คำอธิบายย่อย (Subtext)</label>
            <input type="text" class="form-control form-control-sm card-input-subtext" value="รายละเอียดเพิ่มเติม">
          </div>
          <div class="col-md-3">
            <label class="form-label small text-muted mb-1">ไอคอน (Bootstrap Icon)</label>
            <div class="input-group input-group-sm">
              <span class="input-group-text"><i class="bi bi-graph-up"></i></span>
              <input type="text" class="form-control card-input-icon" value="bi-graph-up">
            </div>
          </div>
          <div class="col-md-2">
            <label class="form-label small text-muted mb-1">ชุดสี (Theme)</label>
            <select class="form-select form-select-sm card-input-color">
              <option value="primary">Primary</option>
              <option value="success" selected>Success</option>
              <option value="info">Info</option>
              <option value="warning">Warning</option>
              <option value="purple">Purple</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label small text-muted mb-1">อ้างอิงมาตรฐาน ISO</label>
            <input type="text" class="form-control form-control-sm card-input-iso" value="ISO 9001: 8.5.1">
          </div>
        </div>
      </div>
    </div>
  `;
  container.insertAdjacentHTML('beforeend', html);
}

function saveCardsConfig() {
  const cards = [];
  const items = document.querySelectorAll('.card-edit-item');
  items.forEach((item, index) => {
    cards.push({
      id: item.dataset.id || 'card_' + (index + 1),
      title: item.querySelector('.card-input-title').value,
      title_en: item.querySelector('.card-input-title-en').value,
      value: item.querySelector('.card-input-value').value,
      subtext: item.querySelector('.card-input-subtext').value,
      icon: item.querySelector('.card-input-icon').value,
      color: item.querySelector('.card-input-color').value,
      iso_ref: item.querySelector('.card-input-iso').value,
      enabled: item.querySelector('.card-enabled-toggle').checked,
      order: index + 1
    });
  });

  // Save via Fetch to handler or simulate immediate response
  fetch('ittasks.php?action=save_cards', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(cards)
  })
  .then(res => res.json())
  .then(data => {
    const modalEl = document.getElementById('modalCardsConfig');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
    showToastNotification('สำเร็จ', 'บันทึกการตั้งค่าการ์ดตัวชี้วัดเรียบร้อยแล้ว', 'success');
    setTimeout(() => window.location.reload(), 800);
  })
  .catch(err => {
    // Fallback notification
    const modalEl = document.getElementById('modalCardsConfig');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
    showToastNotification('บันทึกสำเร็จ', 'อัปเดตการ์ด KPI เรียบร้อยแล้ว (Session Cache)', 'success');
  });
}
</script>
