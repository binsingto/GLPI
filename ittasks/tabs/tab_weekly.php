<?php
/**
 * Tab 3: Weekly Workload & Capacity Audit (FR-IT-ISO-022)
 * Smart Re-balance Engine & Stacked Bar Chart
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */

$weekly_data = get_weekly_workload_breakdown();
$rebalance_suggestions = get_smart_rebalance_suggestions();
?>

<div class="tab-pane-content">
  <!-- ISO Banner -->
  <div class="card border-0 shadow-sm mb-4 bg-white border-start border-4 border-info">
    <div class="card-body p-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-info text-dark"><?= ISO_DOC_WEEKLY ?></span>
            <span class="badge bg-light text-dark border"><?= ISO_DOC_WEEKLY_REV ?></span>
            <span class="badge bg-purple-subtle text-purple">Capacity Management (ISO/IEC 27001: A.8.6)</span>
          </div>
          <h5 class="fw-bold mb-0 text-dark">แบบตรวจประเมินภาระงานและสมดุลงานประจำสัปดาห์ (Weekly Workload & Capacity Audit Form)</h5>
          <small class="text-muted">วิเคราะห์สัดส่วนภาระงานตาม Tier 1-3 และจำลองการจัดสรรงานใหม่อัจฉริยะ (Smart Re-balance)</small>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button class="btn btn-sm btn-outline-primary" onclick="simulateAllRebalance()">
            <i class="bi bi-magic me-1"></i> ปรับสมดุลทั้งหมดอัตโนมัติ (Auto-Rebalance)
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Weekly Capacity Summary Cards -->
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="card border-0 shadow-sm bg-light">
        <div class="card-body p-3">
          <div class="text-muted small">เกณฑ์ชั่วโมงมาตรฐานรายสัปดาห์</div>
          <div class="fs-4 fw-bold text-dark font-monospace">40.0 ชม./คน</div>
          <small class="text-muted">รวม 6 ท่าน = 240.0 ชม./สัปดาห์</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm bg-light">
        <div class="card-body p-3">
          <div class="text-muted small">ชั่วโมงปฏิบัติงานจริงรวมสัปดาห์นี้</div>
          <div class="fs-4 fw-bold text-primary font-monospace">214.5 ชม.</div>
          <small class="text-success"><i class="bi bi-check-circle me-1"></i>อัตราใช้งานเฉลี่ย 89.4% (Optimal)</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm bg-light">
        <div class="card-body p-3">
          <div class="text-muted small">เจ้าหน้าที่ที่ภาระงานเกินเกณฑ์ (> 110%)</div>
          <div class="fs-4 fw-bold text-danger font-monospace">2 ท่าน</div>
          <small class="text-danger">วัฒนา (115%), ปิยะณัฐ (120%)</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0 shadow-sm bg-light">
        <div class="card-body p-3">
          <div class="text-muted small">ศักยภาพคงเหลือพร้อมรับงาน (Available)</div>
          <div class="fs-4 fw-bold text-info font-monospace">25.5 ชม.</div>
          <small class="text-muted">นฐวรรธน์ (5 ชม.), ธีรพงษ์ (12 ชม.)</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Chart & Breakdown Section -->
  <div class="row g-4 mb-4">
    <!-- Stacked Bar Chart -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center gap-2">
            <i class="bi bi-bar-chart-fill text-primary fs-5"></i>
            <h5 class="mb-0 fw-bold">กราฟเปรียบเทียบภาระงานรายบุคคล (Stacked Workload Distribution)</h5>
          </div>
          <span class="badge bg-light text-dark border">ISO 27001 A.8.6</span>
        </div>
        <div class="card-body p-3">
          <div style="position: relative; height: 340px; width: 100%;">
            <canvas id="weeklyStackedChart"></canvas>
          </div>
          <div class="d-flex flex-wrap justify-content-center gap-3 mt-3 pt-2 border-top small">
            <span><i class="bi bi-square-fill text-primary me-1"></i> Tier 1 (x1.0)</span>
            <span><i class="bi bi-square-fill text-success me-1"></i> Tier 2 (x1.5)</span>
            <span><i class="bi bi-square-fill text-warning me-1"></i> Tier 3 (x2.5)</span>
            <span><i class="bi bi-square-fill text-purple me-1" style="color: #8b5cf6;"></i> Project/ISO (x3.0)</span>
            <span><i class="bi bi-square-fill text-secondary me-1"></i> Routine/Admin (x1.0)</span>
            <span class="ms-3 text-danger"><i class="bi bi-dash-lg fw-bold me-1"></i> เส้นขีดจำกัด 40 ชม. (Standard Cap)</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Capacity Gauge & Workload Status Cards -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-white py-3 border-bottom">
          <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
            <i class="bi bi-speedometer2 text-primary"></i>
            สถานะการกระจายงาน (Capacity Status)
          </h5>
        </div>
        <div class="card-body p-3">
          <ul class="list-group list-group-flush">
            <?php foreach ($weekly_data as $w): 
              $barColor = match($w['badge_color']) {
                'danger' => 'bg-danger',
                'info' => 'bg-info',
                default => 'bg-success'
              };
            ?>
            <li class="list-group-item px-0 py-2 border-bottom">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <div>
                  <span class="fw-bold text-dark"><?= htmlspecialchars($w['name']) ?></span>
                  <small class="text-muted d-block"><?= htmlspecialchars($w['role']) ?></small>
                </div>
                <div class="text-end">
                  <span class="badge bg-<?= $w['badge_color'] ?>-subtle text-<?= $w['badge_color'] ?> fw-bold font-monospace">
                    <?= number_format($w['capacity_pct'], 1) ?>%
                  </span>
                  <div class="small text-muted font-monospace"><?= $w['total_raw'] ?> / 40 ชม.</div>
                </div>
              </div>
              <div class="progress" style="height: 6px;">
                <div class="progress-bar <?= $barColor ?>" role="progressbar" style="width: <?= min($w['capacity_pct'], 100) ?>%"></div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Smart Re-balance Engine Section -->
  <div class="card border-0 shadow-sm border-top border-3 border-warning">
    <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-cpu-fill text-warning fs-5"></i>
        <div>
          <h5 class="mb-0 fw-bold">ระบบจัดสรรและปรับสมดุลงานอัจฉริยะ (Smart Re-balance System)</h5>
          <small class="text-muted">คำนวณตามอัลกอริทึม ISO 27001 Control A.8.6 เพื่อป้องกันภาวะหมดไฟ (Burnout) และรักษาคุณภาพ SLA</small>
        </div>
      </div>
      <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2">
        <i class="bi bi-lightbulb-fill me-1"></i> พบ 3 คำแนะนำเพื่อความสมดุลสูงสุด
      </span>
    </div>
    <div class="card-body p-4 bg-light">
      <div class="row g-3">
        <?php foreach ($rebalance_suggestions as $idx => $sug): ?>
        <div class="col-md-4" id="sugCard_<?= $sug['id'] ?>">
          <div class="card border-0 shadow-sm h-100 rebalance-card">
            <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center border-bottom">
              <span class="badge bg-secondary"><?= $sug['id'] ?></span>
              <span class="badge bg-primary-subtle text-primary fw-bold font-monospace"><?= $sug['hours'] ?> ชั่วโมง</span>
            </div>
            <div class="card-body p-3">
              <div class="transfer-flow mb-2 p-2 bg-light rounded text-center small">
                <div class="text-danger fw-bold text-truncate" title="<?= htmlspecialchars($sug['from_staff']) ?>">
                  <i class="bi bi-box-arrow-up-right me-1"></i> จาก: <?= htmlspecialchars($sug['from_staff']) ?>
                </div>
                <div class="my-1 text-muted"><i class="bi bi-arrow-down fs-6"></i> โอนย้ายภาระงาน</div>
                <div class="text-success fw-bold text-truncate" title="<?= htmlspecialchars($sug['to_staff']) ?>">
                  <i class="bi bi-box-arrow-in-down-left me-1"></i> ไปยัง: <?= htmlspecialchars($sug['to_staff']) ?>
                </div>
              </div>

              <h6 class="fw-bold text-dark mb-2"><?= htmlspecialchars($sug['task_title']) ?></h6>
              <p class="small text-muted mb-3"><?= htmlspecialchars($sug['reason']) ?></p>

              <div class="p-2 border rounded bg-white small mb-3">
                <div class="d-flex justify-content-between">
                  <span class="text-muted">ผลกระทบผู้ส่งมอบ:</span>
                  <strong class="text-success"><?= $sug['impact_from'] ?></strong>
                </div>
                <div class="d-flex justify-content-between mt-1">
                  <span class="text-muted">ผลกระทบผู้รับมอบ:</span>
                  <strong class="text-info"><?= $sug['impact_to'] ?></strong>
                </div>
              </div>

              <button type="button" class="btn btn-sm btn-outline-success w-100 btn-apply-rebalance" onclick="applySingleRebalance('<?= $sug['id'] ?>', '<?= addslashes($sug['task_title']) ?>')">
                <i class="bi bi-check2-circle me-1"></i> ยืนยันปรับสมดุลงาน (Apply)
              </button>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  initWeeklyStackedChart();
});

let weeklyChartInstance = null;

function initWeeklyStackedChart() {
  const ctx = document.getElementById('weeklyStackedChart');
  if (!ctx) return;

  const labels = ['บิณฑ์ (Mgr)', 'วุฒิพงศ์ (Lead)', 'วัฒนา (Tier2)', 'ปิยะณัฐ (Tier3)', 'นฐวรรธน์ (Tier1)', 'ธีรพงษ์ (Intern)'];
  
  weeklyChartInstance = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Tier 1 Support (x1.0)',
          data: [0, 4, 6, 2, 22, 14],
          backgroundColor: '#3b82f6'
        },
        {
          label: 'Tier 2 Support (x1.5)',
          data: [2, 12, 26, 8, 6, 2],
          backgroundColor: '#10b981'
        },
        {
          label: 'Tier 3 Support (x2.5)',
          data: [8, 6, 4, 22, 0, 0],
          backgroundColor: '#f59e0b'
        },
        {
          label: 'Project & ISO (x3.0)',
          data: [22, 8, 4, 12, 2, 0],
          backgroundColor: '#8b5cf6'
        },
        {
          label: 'Routine & Admin (x1.0)',
          data: [6, 10, 6, 4, 5, 12],
          backgroundColor: '#64748b'
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          stacked: true,
          grid: { display: false }
        },
        y: {
          stacked: true,
          beginAtZero: true,
          max: 55,
          title: {
            display: true,
            text: 'ชั่วโมงปฏิบัติงานต่อสัปดาห์ (Hours)'
          }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            afterBody: function(context) {
              let total = 0;
              context.forEach(item => total += item.raw);
              return 'ชั่วโมงรวมจริง: ' + total + ' ชม. (ขีดจำกัด 40 ชม.)';
            }
          }
        }
      }
    }
  });
}

function applySingleRebalance(id, title) {
  const card = document.getElementById('sugCard_' + id);
  if (!card) return;

  const btn = card.querySelector('.btn-apply-rebalance');
  btn.disabled = true;
  btn.className = 'btn btn-sm btn-success w-100';
  btn.innerHTML = '<i class="bi bi-check-all me-1"></i> ปรับสมดุลสำเร็จแล้ว';

  showToastNotification('ปรับสมดุลสำเร็จ', 'โอนย้ายงาน "' + title + '" เข้าสู่แผนงานสัปดาห์หน้าเรียบร้อยแล้ว (ISO 27001 A.8.6 Logged)', 'success');
}

function simulateAllRebalance() {
  const buttons = document.querySelectorAll('.btn-apply-rebalance');
  buttons.forEach(btn => btn.click());
  showToastNotification('Auto-Rebalance สมบูรณ์', 'ระบบจัดสรรภาระงานของทีมให้อยู่ในกรอบ 80% - 100% ครบทุกท่านแล้ว', 'success');
}
</script>
