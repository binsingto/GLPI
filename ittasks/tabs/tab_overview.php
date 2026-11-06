<?php
/**
 * Tab 1: Organization Chart & RACI Matrix
 * ISO 9001:2015 Clause 7.1.2 & ISO/IEC 27001:2022 Control 5.2
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */

$staff_list = get_staff_list();
$raci_data = get_raci_matrix();
?>

<div class="tab-pane-content">
  <!-- ISO Compliance Header Banner -->
  <div class="card border-0 shadow-sm mb-4 bg-gradient-navy text-white rounded-3">
    <div class="card-body p-4">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-warning text-dark fw-bold">ISO 9001: 7.1.2 People</span>
            <span class="badge bg-info text-dark fw-bold">ISO/IEC 27001: A.5.2 Roles & Responsibilities</span>
            <span class="badge bg-light text-dark">Audit Approved</span>
          </div>
          <h4 class="fw-bold mb-1">ผังโครงสร้างบุคลากรฝ่ายไอที และเมทริกซ์ความรับผิดชอบ (IT Org Chart & RACI Matrix)</h4>
          <p class="mb-0 text-white-50 small">
            การกำหนดบทบาท หน้าที่ความรับผิดชอบ และสายการบังคับบัญชา 6 ระดับ เพื่อความโปร่งใสและตรวจสอบย้อนกลับได้ (Audit Trail)
          </p>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-light shadow-sm" onclick="window.print()">
            <i class="bi bi-printer me-1"></i> พิมพ์เอกสาร (Print)
          </button>
          <button class="btn btn-sm btn-outline-light" onclick="exportOverviewData()">
            <i class="bi bi-download me-1"></i> ส่งออกข้อมูล (Export)
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Interactive Organization Hierarchy Tree -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-diagram-3-fill text-primary fs-5"></i>
        <h5 class="mb-0 fw-bold">ผังการบังคับบัญชาและสายงานสนับสนุน (Hierarchical Structure)</h5>
      </div>
      <span class="text-muted small">
        <i class="bi bi-info-circle me-1"></i> เลื่อนเมาส์ชี้การ์ดเพื่อดูบทบาท ISO และรายละเอียดการติดต่อ
      </span>
    </div>
    <div class="card-body bg-light p-4 overflow-auto">
      <div class="org-tree-wrapper text-center">
        <!-- Level 1: IT Manager -->
        <div class="org-level mb-4">
          <div class="d-inline-block">
            <div class="org-node-card shadow-sm hover-pop" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-title="<?= htmlspecialchars($staff_list[1]['name']) ?>" data-bs-content="<b>ตำแหน่ง:</b> <?= htmlspecialchars($staff_list[1]['position']) ?><br><b>อีเมล:</b> <?= $staff_list[1]['email'] ?><br><b>เบอร์ต่อ:</b> Ext. <?= $staff_list[1]['ext'] ?><br><b>ISO Role:</b> <?= htmlspecialchars($staff_list[1]['iso_role']) ?>">
              <div class="node-badge bg-primary text-white">Tier: Management</div>
              <div class="node-avatar bg-navy text-white mx-auto my-2">BS</div>
              <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($staff_list[1]['name']) ?></h6>
              <div class="small text-muted fw-semibold"><?= htmlspecialchars($staff_list[1]['position']) ?></div>
              <div class="node-meta mt-2 pt-2 border-top small text-start">
                <div class="d-flex justify-content-between text-muted">
                  <span><i class="bi bi-envelope me-1"></i><?= $staff_list[1]['email'] ?></span>
                  <span><i class="bi bi-telephone me-1"></i>Ext. <?= $staff_list[1]['ext'] ?></span>
                </div>
                <div class="badge bg-primary-subtle text-primary mt-2 w-100 text-truncate">
                  <?= htmlspecialchars($staff_list[1]['iso_role']) ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tree-line-vertical"></div>

        <!-- Level 2: Team Leader -->
        <div class="org-level mb-4">
          <div class="d-inline-block">
            <div class="org-node-card shadow-sm hover-pop" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-title="<?= htmlspecialchars($staff_list[2]['name']) ?>" data-bs-content="<b>ตำแหน่ง:</b> <?= htmlspecialchars($staff_list[2]['position']) ?><br><b>อีเมล:</b> <?= $staff_list[2]['email'] ?><br><b>เบอร์ต่อ:</b> Ext. <?= $staff_list[2]['ext'] ?><br><b>ISO Role:</b> <?= htmlspecialchars($staff_list[2]['iso_role']) ?>">
              <div class="node-badge bg-info text-white">Tier: Operations Lead</div>
              <div class="node-avatar bg-sky text-white mx-auto my-2">WS</div>
              <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($staff_list[2]['name']) ?></h6>
              <div class="small text-muted fw-semibold"><?= htmlspecialchars($staff_list[2]['position']) ?></div>
              <div class="node-meta mt-2 pt-2 border-top small text-start">
                <div class="d-flex justify-content-between text-muted">
                  <span><i class="bi bi-envelope me-1"></i><?= $staff_list[2]['email'] ?></span>
                  <span><i class="bi bi-telephone me-1"></i>Ext. <?= $staff_list[2]['ext'] ?></span>
                </div>
                <div class="badge bg-info-subtle text-info mt-2 w-100 text-truncate">
                  <?= htmlspecialchars($staff_list[2]['iso_role']) ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tree-line-vertical"></div>

        <!-- Level 3: Senior Engineers (Tier 2 & Tier 3) -->
        <div class="org-level mb-4">
          <div class="row justify-content-center g-4">
            <!-- Senior Tier 2 -->
            <div class="col-md-5 col-lg-4">
              <div class="org-node-card shadow-sm hover-pop w-100" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-title="<?= htmlspecialchars($staff_list[3]['name']) ?>" data-bs-content="<b>ตำแหน่ง:</b> <?= htmlspecialchars($staff_list[3]['position']) ?><br><b>อีเมล:</b> <?= $staff_list[3]['email'] ?><br><b>เบอร์ต่อ:</b> Ext. <?= $staff_list[3]['ext'] ?><br><b>ISO Role:</b> <?= htmlspecialchars($staff_list[3]['iso_role']) ?>">
                <div class="node-badge bg-success text-white">Tier 2: System & Network</div>
                <div class="node-avatar bg-emerald text-white mx-auto my-2">WS</div>
                <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($staff_list[3]['name']) ?></h6>
                <div class="small text-muted fw-semibold"><?= htmlspecialchars($staff_list[3]['position']) ?></div>
                <div class="node-meta mt-2 pt-2 border-top small text-start">
                  <div class="d-flex justify-content-between text-muted">
                    <span><i class="bi bi-envelope me-1"></i><?= $staff_list[3]['email'] ?></span>
                    <span><i class="bi bi-telephone me-1"></i>Ext. <?= $staff_list[3]['ext'] ?></span>
                  </div>
                  <div class="badge bg-success-subtle text-success mt-2 w-100 text-truncate">
                    <?= htmlspecialchars($staff_list[3]['iso_role']) ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Senior Tier 3 -->
            <div class="col-md-5 col-lg-4">
              <div class="org-node-card shadow-sm hover-pop w-100" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-title="<?= htmlspecialchars($staff_list[4]['name']) ?>" data-bs-content="<b>ตำแหน่ง:</b> <?= htmlspecialchars($staff_list[4]['position']) ?><br><b>อีเมล:</b> <?= $staff_list[4]['email'] ?><br><b>เบอร์ต่อ:</b> Ext. <?= $staff_list[4]['ext'] ?><br><b>ISO Role:</b> <?= htmlspecialchars($staff_list[4]['iso_role']) ?>">
                <div class="node-badge bg-purple text-white">Tier 3: Core Infrastructure & Security</div>
                <div class="node-avatar bg-purple text-white mx-auto my-2">PH</div>
                <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($staff_list[4]['name']) ?></h6>
                <div class="small text-muted fw-semibold"><?= htmlspecialchars($staff_list[4]['position']) ?></div>
                <div class="node-meta mt-2 pt-2 border-top small text-start">
                  <div class="d-flex justify-content-between text-muted">
                    <span><i class="bi bi-envelope me-1"></i><?= $staff_list[4]['email'] ?></span>
                    <span><i class="bi bi-telephone me-1"></i>Ext. <?= $staff_list[4]['ext'] ?></span>
                  </div>
                  <div class="badge bg-purple-subtle text-purple mt-2 w-100 text-truncate">
                    <?= htmlspecialchars($staff_list[4]['iso_role']) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tree-line-vertical"></div>

        <!-- Level 4: Operations Staff & Intern (Tier 1 & Intern) -->
        <div class="org-level">
          <div class="row justify-content-center g-4">
            <!-- Staff Tier 1 -->
            <div class="col-md-5 col-lg-4">
              <div class="org-node-card shadow-sm hover-pop w-100" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-title="<?= htmlspecialchars($staff_list[5]['name']) ?>" data-bs-content="<b>ตำแหน่ง:</b> <?= htmlspecialchars($staff_list[5]['position']) ?><br><b>อีเมล:</b> <?= $staff_list[5]['email'] ?><br><b>เบอร์ต่อ:</b> Ext. <?= $staff_list[5]['ext'] ?><br><b>ISO Role:</b> <?= htmlspecialchars($staff_list[5]['iso_role']) ?>">
                <div class="node-badge bg-orange text-white">Tier 1: User Helpdesk</div>
                <div class="node-avatar bg-orange text-white mx-auto my-2">NI</div>
                <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($staff_list[5]['name']) ?></h6>
                <div class="small text-muted fw-semibold"><?= htmlspecialchars($staff_list[5]['position']) ?></div>
                <div class="node-meta mt-2 pt-2 border-top small text-start">
                  <div class="d-flex justify-content-between text-muted">
                    <span><i class="bi bi-envelope me-1"></i><?= $staff_list[5]['email'] ?></span>
                    <span><i class="bi bi-telephone me-1"></i>Ext. <?= $staff_list[5]['ext'] ?></span>
                  </div>
                  <div class="badge bg-warning-subtle text-warning-emphasis mt-2 w-100 text-truncate">
                    <?= htmlspecialchars($staff_list[5]['iso_role']) ?>
                  </div>
                </div>
              </div>
            </div>

            <!-- Intern -->
            <div class="col-md-5 col-lg-4">
              <div class="org-node-card shadow-sm hover-pop w-100" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-title="<?= htmlspecialchars($staff_list[6]['name']) ?>" data-bs-content="<b>ตำแหน่ง:</b> <?= htmlspecialchars($staff_list[6]['position']) ?><br><b>อีเมล:</b> <?= $staff_list[6]['email'] ?><br><b>เบอร์ต่อ:</b> Ext. <?= $staff_list[6]['ext'] ?><br><b>ISO Role:</b> <?= htmlspecialchars($staff_list[6]['iso_role']) ?>">
                <div class="node-badge bg-secondary text-white">Apprentice: Operations Trainee</div>
                <div class="node-avatar bg-slate text-white mx-auto my-2">TB</div>
                <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($staff_list[6]['name']) ?></h6>
                <div class="small text-muted fw-semibold"><?= htmlspecialchars($staff_list[6]['position']) ?></div>
                <div class="node-meta mt-2 pt-2 border-top small text-start">
                  <div class="d-flex justify-content-between text-muted">
                    <span><i class="bi bi-envelope me-1"></i><?= $staff_list[6]['email'] ?></span>
                    <span><i class="bi bi-telephone me-1"></i>Ext. <?= $staff_list[6]['ext'] ?></span>
                  </div>
                  <div class="badge bg-secondary-subtle text-secondary mt-2 w-100 text-truncate">
                    <?= htmlspecialchars($staff_list[6]['iso_role']) ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- RACI Responsibility Matrix Table -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div>
        <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
          <i class="bi bi-grid-3x3-gap-fill text-primary"></i>
          เมทริกซ์ความรับผิดชอบงานไอที (RACI Responsibility Assignment Matrix)
        </h5>
        <small class="text-muted">กำหนดบทบาทตามมาตรฐาน ISO 9001 Clause 8.5.1 และ ISO/IEC 27001 Control A.5.2</small>
      </div>
      <div class="d-flex align-items-center gap-3">
        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1"><b>R</b> = Responsible (ผู้ปฏิบัติงาน)</span>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1"><b>A</b> = Accountable (ผู้อนุมัติ/รับผิดชอบสูงสุด)</span>
        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1"><b>C</b> = Consulted (ผู้ให้คำปรึกษา)</span>
        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1"><b>I</b> = Informed (ผู้รับทราบ)</span>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle mb-0 text-center raci-table">
          <thead class="table-light text-secondary small align-middle">
            <tr>
              <th rowspan="2" class="text-start ps-3" style="min-width: 280px;">ขอบเขตงาน & การปฏิบัติการ (Scope of Work)</th>
              <th rowspan="2" style="width: 130px;">มาตรฐาน ISO</th>
              <th colspan="6" class="border-bottom">บทบาทหน้าที่บุคลากรฝ่ายไอที (6 ท่าน)</th>
            </tr>
            <tr class="small">
              <th style="width: 90px;" class="bg-primary text-white">บิณฑ์<br><small class="fw-normal">Manager</small></th>
              <th style="width: 90px;" class="bg-info text-white">วุฒิพงศ์<br><small class="fw-normal">Team Lead</small></th>
              <th style="width: 90px;" class="bg-success text-white">วัฒนา<br><small class="fw-normal">Tier 2</small></th>
              <th style="width: 90px;" class="bg-purple text-white">ปิยะณัฐ<br><small class="fw-normal">Tier 3</small></th>
              <th style="width: 90px;" class="bg-orange text-white">นฐวรรธน์<br><small class="fw-normal">Tier 1</small></th>
              <th style="width: 90px;" class="bg-secondary text-white">ธีรพงษ์<br><small class="fw-normal">Intern</small></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($raci_data as $section): ?>
            <tr class="table-secondary text-start fw-bold">
              <td colspan="8" class="ps-3 py-2 text-dark">
                <i class="bi bi-chevron-right me-1 text-primary"></i> <?= htmlspecialchars($section['domain']) ?>
                <span class="badge bg-white text-dark ms-2 border"><?= htmlspecialchars($section['iso_ref']) ?></span>
              </td>
            </tr>
            <?php foreach ($section['tasks'] as $t): ?>
            <tr>
              <td class="text-start ps-4 fw-semibold text-dark"><?= htmlspecialchars($t['name']) ?></td>
              <td class="small text-muted"><?= htmlspecialchars($section['iso_ref']) ?></td>
              <?php foreach ($t['raci'] as $rVal): 
                $badgeClass = match($rVal) {
                  'R' => 'badge-raci-r',
                  'A' => 'badge-raci-a',
                  'C' => 'badge-raci-c',
                  'I' => 'badge-raci-i',
                  default => 'badge-light'
                };
              ?>
              <td><span class="raci-badge <?= $badgeClass ?>"><?= $rVal ?></span></td>
              <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer bg-light py-2 text-muted small d-flex justify-content-between align-items-center">
      <span><i class="bi bi-check2-circle text-success me-1"></i> ข้อมูลสอดคล้องตามแผนผังการประเมินทักษะและความสามารถ (Skill Competency Matrix)</span>
      <span>ควบคุมเอกสารโดย: ฝ่าย IT Support บมจ. เอเชีย กรีน เอนเนอจี</span>
    </div>
  </div>
</div>

<script>
function exportOverviewData() {
  showToastNotification('ส่งออกข้อมูล', 'กำลังดาวน์โหลดไฟล์ RACI_Matrix_AGE_IT_2026.csv', 'info');
  const csvContent = "data:text/csv;charset=utf-8,\uFEFF" 
    + "Scope,Task,Bin (Manager),Wuttiphong (Lead),Watthana (Tier2),Piyanat (Tier3),Natthawat (Tier1),Teerapong (Intern)\n"
    + "Helpdesk,Ticket Dispatch,I,A,C,I,R,C\n"
    + "Helpdesk,Tier 1 PC Support,I,A,C,I,R,R\n"
    + "Helpdesk,Tier 2 Network/HW,I,A,R,C,C,I\n"
    + "Helpdesk,Tier 3 Server/Security,A,C,I,R,I,I\n"
    + "Infrastructure,Server DC Routine,A,C,C,R,I,C\n"
    + "Infrastructure,Veeam Backup & Restore,A,I,I,R,I,I\n"
    + "Infrastructure,CCTV 30-Day Retention,A,C,R,I,C,C\n"
    + "Infrastructure,Meeting Room AV Readiness,I,A,C,I,R,R\n"
    + "Governance,Sign-off FR-IT-ISO-021,A,R,I,I,I,I\n"
    + "Governance,Workload Rebalance FR-IT-ISO-022,A,R,C,C,I,I\n"
    + "Governance,Monthly Scorecard FR-IT-ISO-023,A,R,I,I,I,I\n";
  const encodedUri = encodeURI(csvContent);
  const link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", "RACI_Matrix_AGE_IT_2026.csv");
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
</script>
