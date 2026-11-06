<?php
/**
 * Tab 4: Monthly Capacity Gauge & Staff Scorecard (FR-IT-ISO-023)
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */

$scorecard = get_monthly_scorecard_data();
$staff_list = get_staff_list();
$scores = $scorecard['staff_scores'];
?>

<div class="tab-pane-content">
  <!-- Top Document Meta Banner -->
  <div class="card border-0 shadow-sm mb-4 bg-white border-start border-4 border-warning">
    <div class="card-body p-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-warning text-dark"><?= ISO_DOC_MONTHLY ?></span>
            <span class="badge bg-light text-dark border"><?= ISO_DOC_MONTHLY_REV ?></span>
            <span class="badge bg-primary-subtle text-primary">Performance Evaluation (ISO 9001: 9.1.3)</span>
          </div>
          <h5 class="fw-bold mb-0 text-dark">หน้าปัดวัดอัตราศักยภาพรวม และแบบประเมินผลงานรายบุคคล (Staff Scorecard)</h5>
          <small class="text-muted">ประเมินผลตัวชี้วัด SLA, ความพึงพอใจผู้ใช้งาน (CSAT), ความมั่นคงปลอดภัย และการใช้ขีดความสามารถ</small>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span class="badge bg-light text-dark border px-3 py-2 font-monospace fs-6">
            <i class="bi bi-calendar-event me-1"></i> <?= htmlspecialchars($scorecard['period']) ?>
          </span>
          <button class="btn btn-sm btn-outline-primary" onclick="window.print()">
            <i class="bi bi-printer me-1"></i> พิมพ์ Scorecard ทั้งหมด
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Overall Gauges & High-Level KPIs Row -->
  <div class="row g-4 mb-4">
    <!-- Semi-circle Gauge: Team Capacity -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 text-center p-3">
        <h6 class="fw-bold text-secondary mb-1">อัตราการใช้ศักยภาพทีมโดยรวม (Team Capacity Gauge)</h6>
        <small class="text-muted mb-3">เป้าหมายที่เหมาะสม (Optimal Zone: 80% - 95%)</small>
        
        <div class="gauge-container mx-auto position-relative" style="width: 220px; height: 120px;">
          <svg viewBox="0 0 200 100" class="gauge-svg w-100 h-100">
            <!-- Background Arc -->
            <path d="M 20 100 A 80 80 0 0 1 180 100" fill="none" stroke="#e2e8f0" stroke-width="22" stroke-linecap="round"/>
            <!-- Optimal Zone Marker -->
            <path d="M 35 70 A 80 80 0 0 1 165 70" fill="none" stroke="#dcfce7" stroke-width="12"/>
            <!-- Active Fill Arc for 89.4% -->
            <path d="M 20 100 A 80 80 0 0 1 163 46" fill="none" stroke="#0284c7" stroke-width="22" stroke-linecap="round"/>
          </svg>
          <div class="gauge-center-text position-absolute w-100 text-center" style="bottom: 0;">
            <div class="fs-2 fw-bold text-dark font-monospace"><?= $scorecard['overall_team_capacity'] ?>%</div>
            <span class="badge bg-success-subtle text-success">สถานะ: สมดุลดีเยี่ยม (Optimal)</span>
          </div>
        </div>
        <div class="mt-3 text-muted small border-top pt-2">
          รวมชั่วโมงทำงาน 956 / 1,070 ชม. (เทียบเคียง 6 อัตรากำลัง)
        </div>
      </div>
    </div>

    <!-- Gauge: SLA Compliance -->
    <div class="col-md-6 col-lg-4">
      <div class="card border-0 shadow-sm h-100 text-center p-3">
        <h6 class="fw-bold text-secondary mb-1">การบรรลุข้อตกลงระดับการบริการ (SLA Compliance)</h6>
        <small class="text-muted mb-3">เกณฑ์มาตรฐาน ISO 9001:2015 (เป้าหมายองค์กร ≥ 95.0%)</small>
        
        <div class="gauge-container mx-auto position-relative" style="width: 220px; height: 120px;">
          <svg viewBox="0 0 200 100" class="gauge-svg w-100 h-100">
            <!-- Background Arc -->
            <path d="M 20 100 A 80 80 0 0 1 180 100" fill="none" stroke="#e2e8f0" stroke-width="22" stroke-linecap="round"/>
            <!-- Active Fill Arc for 98.8% -->
            <path d="M 20 100 A 80 80 0 0 1 178 90" fill="none" stroke="#10b981" stroke-width="22" stroke-linecap="round"/>
          </svg>
          <div class="gauge-center-text position-absolute w-100 text-center" style="bottom: 0;">
            <div class="fs-2 fw-bold text-success font-monospace"><?= $scorecard['overall_sla_compliance'] ?>%</div>
            <span class="badge bg-success text-white">ยอดเยี่ยม (Exceed Target)</span>
          </div>
        </div>
        <div class="mt-3 text-muted small border-top pt-2">
          ปิดงานสำเร็จตามกำหนด 476 จาก 482 Tickets
        </div>
      </div>
    </div>

    <!-- CSAT & Operations Snapshot -->
    <div class="col-md-12 col-lg-4">
      <div class="card border-0 shadow-sm h-100 p-3 bg-light">
        <h6 class="fw-bold text-secondary mb-3">สรุปผลการบริการรวม (Service Highlights)</h6>
        <div class="d-flex align-items-center justify-content-between mb-2 p-2 bg-white rounded border">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-star-fill text-warning fs-4"></i>
            <div>
              <div class="small text-muted">ความพึงพอใจเฉลี่ย (CSAT)</div>
              <div class="fw-bold text-dark font-monospace"><?= $scorecard['overall_csat_score'] ?> / 5.00</div>
            </div>
          </div>
          <span class="badge bg-warning text-dark">ระดับดีเลิศ</span>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-2 p-2 bg-white rounded border">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-ticket-detailed-fill text-primary fs-4"></i>
            <div>
              <div class="small text-muted">จำนวนคำขอและ Ticket ทั้งหมด</div>
              <div class="fw-bold text-dark font-monospace"><?= $scorecard['total_tickets_handled'] ?> รายการ</div>
            </div>
          </div>
          <span class="badge bg-primary text-white">ปิดแล้ว 98.8%</span>
        </div>

        <div class="d-flex align-items-center justify-content-between p-2 bg-white rounded border">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-shield-lock-fill text-success fs-4"></i>
            <div>
              <div class="small text-muted">ISO 27001 Security Score</div>
              <div class="fw-bold text-success font-monospace">100% Audit Ready</div>
            </div>
          </div>
          <span class="badge bg-success text-white">Zero Non-conformity</span>
        </div>
      </div>
    </div>
  </div>

  <!-- 6 Staff Scorecards Grid -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-person-badge-fill text-primary fs-5"></i>
        <h5 class="mb-0 fw-bold">แบบประเมินผลการปฏิบัติงานรายบุคคล (Staff Scorecard 6 ท่าน)</h5>
      </div>
      <span class="text-muted small">อิงตามข้อกำหนด ISO 9001: 7.1.2 & ISO 27001: A.5.2</span>
    </div>
    <div class="card-body p-4 bg-light">
      <div class="row g-4">
        <?php foreach ($staff_list as $id => $st): 
          $sc = $scores[$id] ?? null;
          if (!$sc) continue;
          $gradeBadge = match($sc['grade']) {
            'A+' => 'bg-danger text-white',
            'A' => 'bg-success text-white',
            'B+' => 'bg-primary text-white',
            default => 'bg-secondary text-white'
          };
        ?>
        <div class="col-md-6 col-xl-4">
          <div class="card border-0 shadow-sm h-100 staff-scorecard-card bg-white position-relative overflow-hidden">
            <!-- Grade Badge Top Corner -->
            <div class="grade-corner-ribbon <?= $gradeBadge ?>">
              เกรด <?= $sc['grade'] ?>
            </div>

            <div class="card-body p-4">
              <div class="d-flex align-items-center gap-3 mb-3">
                <div class="node-avatar text-white fw-bold shadow-sm" style="background-color: <?= $st['avatar_color'] ?>; width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                  <?= $st['initials'] ?>
                </div>
                <div>
                  <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($st['name']) ?></h6>
                  <div class="small text-muted"><?= htmlspecialchars($st['position']) ?></div>
                  <span class="badge bg-light text-secondary border mt-1 font-monospace" style="font-size: 0.7rem;">Ext. <?= $st['ext'] ?></span>
                </div>
              </div>

              <!-- Metrics Matrix -->
              <div class="score-metrics-grid bg-light p-3 rounded mb-3">
                <div class="row g-2 text-center">
                  <div class="col-4 border-end">
                    <small class="text-muted d-block" style="font-size: 0.72rem;">SLA Score</small>
                    <strong class="text-success font-monospace"><?= $sc['sla_score'] ?>%</strong>
                  </div>
                  <div class="col-4 border-end">
                    <small class="text-muted d-block" style="font-size: 0.72rem;">CSAT (คะแนน)</small>
                    <strong class="text-primary font-monospace"><?= $sc['csat'] ?> / 5</strong>
                  </div>
                  <div class="col-4">
                    <small class="text-muted d-block" style="font-size: 0.72rem;">ปิด Ticket</small>
                    <strong class="text-dark font-monospace"><?= $sc['tickets_resolved'] ?> เคส</strong>
                  </div>
                  <div class="col-4 border-end mt-2 pt-2 border-top">
                    <small class="text-muted d-block" style="font-size: 0.72rem;">เวลาเฉลี่ย (MTTR)</small>
                    <strong class="text-secondary font-monospace"><?= $sc['avg_resolution_hrs'] ?> ชม.</strong>
                  </div>
                  <div class="col-4 border-end mt-2 pt-2 border-top">
                    <small class="text-muted d-block" style="font-size: 0.72rem;">Capacity Load</small>
                    <strong class="text-dark font-monospace"><?= $sc['capacity_utilization'] ?>%</strong>
                  </div>
                  <div class="col-4 mt-2 pt-2 border-top">
                    <small class="text-muted d-block" style="font-size: 0.72rem;">ISO Audit</small>
                    <strong class="text-purple font-monospace"><?= $sc['iso_audit_score'] ?>%</strong>
                  </div>
                </div>
              </div>

              <!-- Achievement Highlight -->
              <div class="mb-3">
                <small class="text-muted fw-bold d-block mb-1">
                  <i class="bi bi-award-fill text-warning me-1"></i> ผลงานโดดเด่นประจำเดือน:
                </small>
                <div class="p-2 rounded bg-light border-start border-3 border-primary small text-secondary">
                  <?= htmlspecialchars($sc['key_achievement']) ?>
                </div>
              </div>

              <!-- Action button -->
              <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                <span class="small text-muted">สถานะ: ปฏิบัติงานปกติ</span>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printIndividualScorecard(<?= $id ?>, '<?= addslashes($st['name']) ?>')">
                  <i class="bi bi-file-earmark-pdf me-1"></i> พิมพ์ Scorecard
                </button>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<script>
function printIndividualScorecard(staffId, staffName) {
  showToastNotification('พิมพ์ใบคะแนน', 'กำลังสร้างแบบฟอร์มประเมินผลรายบุคคล FR-IT-ISO-023 สำหรับ ' + staffName, 'info');
  window.print();
}
</script>
