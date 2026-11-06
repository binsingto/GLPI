<?php
/**
 * Tab 6: IT Operations Meeting Summary & Built-in Slide Deck
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */

$meeting_data = get_meeting_agenda_and_actions();
$meta = $meeting_data['meeting_meta'];
$agendas = $meeting_data['agenda_topics'];
$actions = $meeting_data['action_items'];
?>

<div class="tab-pane-content">
  <!-- Top Document Meta Banner -->
  <div class="card border-0 shadow-sm mb-4 bg-white border-start border-4 border-purple">
    <div class="card-body p-3">
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-purple text-white">ISO 9001: 9.1.3 Review</span>
            <span class="badge bg-light text-dark border font-monospace"><?= htmlspecialchars($meta['meeting_no']) ?></span>
            <span class="badge bg-success-subtle text-success">Management Review Meeting</span>
          </div>
          <h5 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($meta['title']) ?></h5>
          <small class="text-muted">บันทึกข้อสรุปการประชุมประจำสัปดาห์ และ Built-in Slide Deck สำหรับการนำเสนอผู้บริหาร</small>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button class="btn btn-sm btn-primary" onclick="openSlideDeckMode()">
            <i class="bi bi-play-circle-fill me-1"></i> เข้าสู่โหมดนำเสนอ (Presentation Mode)
          </button>
          <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
            <i class="bi bi-printer me-1"></i> พิมพ์รายงานประชุม
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Interactive Built-in Slide Deck Presentation Area -->
  <div class="card border-0 shadow-sm mb-4 bg-dark text-white slide-deck-container position-relative overflow-hidden" id="slideDeckBox" style="min-height: 440px; border-radius: 12px;">
    <!-- Presentation Header Bar -->
    <div class="p-3 bg-black bg-opacity-50 d-flex justify-content-between align-items-center border-bottom border-secondary">
      <div class="d-flex align-items-center gap-2">
        <i class="bi bi-easel2-fill text-warning fs-5"></i>
        <span class="fw-bold text-white">Executive Slide Deck: Weekly IT Operations Review</span>
      </div>
      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-secondary font-monospace" id="slideDeckCounter">Slide 1 / 5</span>
        <button class="btn btn-sm btn-outline-light py-0 px-2" onclick="toggleFullScreenDeck()" title="สลับโหมดเต็มจอ">
          <i class="bi bi-arrows-fullscreen"></i>
        </button>
      </div>
    </div>

    <!-- Slide Content Wrapper -->
    <div class="slide-body-viewport p-4 p-md-5 d-flex align-items-center justify-content-center" style="min-height: 340px;">
      <!-- Slide 1: Cover & Attendees -->
      <div class="slide-page text-center w-100" id="slide_1">
        <span class="badge bg-primary px-3 py-2 mb-3">ASIA GREEN ENERGY PCL</span>
        <h2 class="fw-bold mb-2 text-warning">การประชุมติดตามงานฝ่ายไอทีประจำสัปดาห์</h2>
        <h5 class="text-white-50 mb-4">Weekly IT Operations, Capacity Audit & ISO Readiness Review</h5>
        <div class="row justify-content-center g-3 text-start mt-3">
          <div class="col-md-5 bg-white bg-opacity-10 p-3 rounded">
            <small class="text-white-50 d-block mb-1"><i class="bi bi-calendar3 me-1"></i> วันที่ประชุม:</small>
            <div class="fw-bold"><?= $meta['date'] ?></div>
            <small class="text-white-50 d-block mt-2 mb-1"><i class="bi bi-geo-alt me-1"></i> สถานที่:</small>
            <div><?= $meta['room'] ?></div>
          </div>
          <div class="col-md-5 bg-white bg-opacity-10 p-3 rounded">
            <small class="text-white-50 d-block mb-1"><i class="bi bi-people me-1"></i> ผู้เข้าร่วมประชุม (6 ท่าน):</small>
            <div class="small text-light">
              • นายบิณฑ์ สิงห์โตศรี (IT Manager)<br>
              • นายวุฒิพงศ์ สินธุมาศ (Team Leader)<br>
              • นายวัฒนา สุขล้อม (Senior Tier 2)<br>
              • นายปิยะณัฐ โหระวงค์ (Senior Tier 3)<br>
              • นายนฐวรรธน์ อินสวาท (Staff Tier 1)<br>
              • นายธีรพงษ์ บุญเลี้ยง (Intern)
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2: Operations & SLA Highlights -->
      <div class="slide-page w-100 d-none" id="slide_2">
        <span class="badge bg-success px-3 py-2 mb-2">OPERATIONS & QUALITY METRICS</span>
        <h3 class="fw-bold text-white mb-3">สรุปผลการปฏิบัติการและ SLA ประจำสัปดาห์ (ISO 9001: 8.5.1)</h3>
        <div class="row g-3 text-center my-3">
          <div class="col-md-3">
            <div class="p-3 bg-white bg-opacity-10 rounded">
              <div class="text-white-50 small">Tickets ทั้งหมด</div>
              <div class="display-6 fw-bold text-warning font-monospace">94</div>
              <small class="text-light">งานในสัปดาห์นี้</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="p-3 bg-white bg-opacity-10 rounded">
              <div class="text-white-50 small">ปิดงานสำเร็จ (Closed)</div>
              <div class="display-6 fw-bold text-success font-monospace">91</div>
              <small class="text-success">96.8% Success Rate</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="p-3 bg-white bg-opacity-10 rounded">
              <div class="text-white-50 small">ความพึงพอใจ CSAT</div>
              <div class="display-6 fw-bold text-info font-monospace">4.88</div>
              <small class="text-light">เต็ม 5.00 คะแนน</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="p-3 bg-white bg-opacity-10 rounded">
              <div class="text-white-50 small">SLA Violation</div>
              <div class="display-6 fw-bold text-danger font-monospace">0</div>
              <small class="text-success">ไม่มีเคสหลุดเกณฑ์</small>
            </div>
          </div>
        </div>
        <div class="p-3 bg-primary bg-opacity-25 rounded border border-primary small text-start">
          <i class="bi bi-check-circle-fill text-success me-2"></i> ข้อสังเกต: ทีม Tier 1 ตอบสนองคำขอรวดเร็ว ค่าเฉลี่ย First Response อยู่ที่ 12 นาที
        </div>
      </div>

      <!-- Slide 3: Critical Infrastructure & Security -->
      <div class="slide-page w-100 d-none" id="slide_3">
        <span class="badge bg-purple px-3 py-2 mb-2">INFRASTRUCTURE & ISMS</span>
        <h3 class="fw-bold text-white mb-3">สถานะความมั่นคงปลอดภัยและการสำรองข้อมูล (ISO 27001)</h3>
        <div class="row g-3 text-start my-2">
          <div class="col-md-6">
            <div class="p-3 bg-white bg-opacity-10 rounded h-100">
              <h6 class="text-warning fw-bold"><i class="bi bi-hdd-rack me-1"></i> VMware ESXi & Core Servers</h6>
              <p class="small text-light mb-1">• Host 01 & 02 ติดตั้ง Security Patch เดือน พ.ย. สำเร็จ</p>
              <p class="small text-light mb-1">• Active Directory ทำงานปกติ Replication Error = 0</p>
              <p class="small text-light mb-0">• Data Center Temp ควบคุมที่ 21.8°C สภาพปกติ</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 bg-white bg-opacity-10 rounded h-100">
              <h6 class="text-success fw-bold"><i class="bi bi-cloud-check me-1"></i> Veeam Backup & DR Readiness</h6>
              <p class="small text-light mb-1">• สำรองข้อมูล Core ERP & DB 1.42 TB สำเร็จ 100%</p>
              <p class="small text-light mb-1">• Immutable Cloud Copy ล็อก WORM 14 วันป้องกัน Ransomware</p>
              <p class="small text-light mb-0">• Instant VM Recovery ทดสอบผ่านเกณฑ์ RTO < 15 นาที</p>
            </div>
          </div>
        </div>
        <div class="p-2 bg-warning bg-opacity-20 rounded border border-warning small text-start mt-3">
          <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> จุดเฝ้าระวัง: กล้อง CCTV สะพานชั่งท่าเรือ (CAM-Dock-03) ออฟไลน์ รออะไหล่เปลี่ยนช่วงบ่าย
        </div>
      </div>

      <!-- Slide 4: Workload Capacity & Re-balance -->
      <div class="slide-page w-100 d-none" id="slide_4">
        <span class="badge bg-info text-dark px-3 py-2 mb-2">CAPACITY MANAGEMENT</span>
        <h3 class="fw-bold text-white mb-3">การจัดสรรภาระงานและปรับสมดุล (Smart Re-balance)</h3>
        <p class="text-white-50 small">ตามข้อกำหนด ISO/IEC 27001:2022 Control A.8.6 (Capacity Management)</p>
        <div class="row g-3 text-start my-2">
          <div class="col-md-6">
            <div class="p-3 bg-danger bg-opacity-20 rounded border border-danger">
              <div class="fw-bold text-warning mb-1">กลุ่มวิศวกรที่มีภาระงานสูง (Overloaded):</div>
              <div class="small text-light">• นายวัฒนา สุขล้อม (Senior Tier 2): 46 ชม. (115%)</div>
              <div class="small text-light">• นายปิยะณัฐ โหระวงค์ (Senior Tier 3): 48 ชม. (120%)</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 bg-success bg-opacity-20 rounded border border-success">
              <div class="fw-bold text-info mb-1">กลุ่มที่มีศักยภาพคงเหลือพร้อมรับงาน (Available):</div>
              <div class="small text-light">• นายนฐวรรธน์ อินสวาท (Staff Tier 1): 35 ชม. (87.5%)</div>
              <div class="small text-light">• นายธีรพงษ์ บุญเลี้ยง (Intern): 28 ชม. (70%)</div>
            </div>
          </div>
        </div>
        <div class="p-3 bg-white bg-opacity-10 rounded text-start mt-2">
          <h6 class="fw-bold text-warning mb-1"><i class="bi bi-lightning-charge me-1"></i> มติที่ประชุม:</h6>
          <div class="small text-light">อนุมัติโอนย้ายงาน Routine เช็ก Log และเตรียมเครื่องพนักงานใหม่ ไปยัง Tier 1 และ Intern ทันที</div>
        </div>
      </div>

      <!-- Slide 5: Action Items & Decisions -->
      <div class="slide-page w-100 d-none" id="slide_5">
        <span class="badge bg-warning text-dark px-3 py-2 mb-2">DECISIONS & NEXT STEPS</span>
        <h3 class="fw-bold text-white mb-3">มติที่ประชุมและภารกิจเร่งด่วน (Action Items)</h3>
        <div class="table-responsive text-start">
          <table class="table table-dark table-sm table-bordered align-middle mb-0">
            <thead>
              <tr class="text-warning">
                <th>#</th>
                <th>งานที่ต้องดำเนินการ</th>
                <th>ผู้รับผิดชอบ</th>
                <th>กำหนดส่ง</th>
              </tr>
            </thead>
            <tbody class="small">
              <tr>
                <td>1</td>
                <td>ซ่อมแซมและเปลี่ยนโมดูลกล้อง CCTV สะพานชั่ง</td>
                <td>วัฒนา / ธีรพงษ์</td>
                <td>07 พ.ย. 12:00 น.</td>
              </tr>
              <tr>
                <td>2</td>
                <td>นำผล Re-balance ไปปรับตารางมอบหมายสัปดาห์หน้า</td>
                <td>วุฒิพงศ์</td>
                <td>09 พ.ย.</td>
              </tr>
              <tr>
                <td>3</td>
                <td>จัดเตรียม Risk Assessment Matrix ส่งทีมตรวจ ISO</td>
                <td>บิณฑ์ / ปิยะณัฐ</td>
                <td>14 พ.ย.</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="text-center mt-4">
          <span class="badge bg-success px-4 py-2 fs-6">
            <i class="bi bi-check2-circle me-1"></i> พร้อมรับการตรวจประเมิน ISO 9001 & ISO 27001 (Audit Ready)
          </span>
        </div>
      </div>
    </div>

    <!-- Presentation Navigation Footer -->
    <div class="p-3 bg-black bg-opacity-50 d-flex justify-content-between align-items-center border-top border-secondary">
      <button class="btn btn-sm btn-outline-light px-3" onclick="prevSlideDeck()">
        <i class="bi bi-chevron-left me-1"></i> ก่อนหน้า (Previous)
      </button>
      <div class="d-flex gap-2">
        <button class="btn btn-sm btn-light py-0 px-2" onclick="setSlideIndex(1)">1</button>
        <button class="btn btn-sm btn-light py-0 px-2" onclick="setSlideIndex(2)">2</button>
        <button class="btn btn-sm btn-light py-0 px-2" onclick="setSlideIndex(3)">3</button>
        <button class="btn btn-sm btn-light py-0 px-2" onclick="setSlideIndex(4)">4</button>
        <button class="btn btn-sm btn-light py-0 px-2" onclick="setSlideIndex(5)">5</button>
      </div>
      <button class="btn btn-sm btn-warning px-3" onclick="nextSlideDeck()">
        ถัดไป (Next) <i class="bi bi-chevron-right ms-1"></i>
      </button>
    </div>
  </div>

  <!-- Agenda Topics & Discussions Section -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
      <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-journal-text text-primary"></i>
        วาระการประชุมและการอภิปราย (Meeting Agenda & Discussions)
      </h5>
      <span class="badge bg-light text-dark border">4 วาระการประชุม</span>
    </div>
    <div class="card-body p-4">
      <div class="accordion" id="agendaAccordion">
        <?php foreach ($agendas as $idx => $ag): ?>
        <div class="accordion-item border mb-2 rounded overflow-hidden">
          <h2 class="accordion-header" id="heading_<?= $idx ?>">
            <button class="accordion-button <?= $idx > 0 ? 'collapsed' : '' ?> bg-light py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?= $idx ?>">
              <span class="badge bg-primary me-2 font-monospace">วาระที่ <?= $ag['no'] ?></span>
              <strong class="text-dark me-2"><?= htmlspecialchars($ag['topic']) ?></strong>
              <small class="text-muted ms-auto pe-3 d-none d-md-inline"><i class="bi bi-person me-1"></i><?= htmlspecialchars($ag['presenter']) ?></small>
            </button>
          </h2>
          <div id="collapse_<?= $idx ?>" class="accordion-collapse collapse <?= $idx === 0 ? 'show' : '' ?>" data-bs-parent="#agendaAccordion">
            <div class="accordion-body bg-white p-3">
              <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                <span class="text-muted small">ผู้นำเสนอ: <strong class="text-dark"><?= htmlspecialchars($ag['presenter']) ?></strong></span>
                <span class="badge bg-success-subtle text-success">มติ: รับทราบและเห็นชอบ</span>
              </div>
              <p class="mb-0 text-secondary"><?= htmlspecialchars($ag['summary']) ?></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Action Items Table -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
      <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
        <i class="bi bi-list-task text-primary"></i>
        รายการสิ่งที่ต้องปฏิบัติ (Action Items Tracker)
      </h5>
      <span class="badge bg-secondary-subtle text-secondary"><?= count($actions) ?> งาน</span>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light text-secondary small align-middle">
            <tr>
              <th style="width: 100px;">รหัส</th>
              <th>ภารกิจที่ได้รับมอบหมาย (Action Item)</th>
              <th style="width: 220px;">ผู้รับผิดชอบ (Assignee)</th>
              <th style="width: 150px;">กำหนดส่ง (Due Date)</th>
              <th style="width: 110px;" class="text-center">ความสำคัญ</th>
              <th style="width: 120px;" class="text-center">สถานะ</th>
            </tr>
          </thead>
          <tbody class="small">
            <?php foreach ($actions as $act): 
              $prioBadge = match($act['priority']) {
                'High' => 'bg-danger text-white',
                'Medium' => 'bg-warning text-dark',
                default => 'bg-info text-dark'
              };
              $statBadge = match($act['status']) {
                'Completed' => 'bg-success text-white',
                'In Progress' => 'bg-primary text-white',
                default => 'bg-secondary text-white'
              };
            ?>
            <tr>
              <td class="font-monospace fw-bold text-primary"><?= htmlspecialchars($act['id']) ?></td>
              <td class="fw-semibold text-dark"><?= htmlspecialchars($act['task']) ?></td>
              <td><?= htmlspecialchars($act['assignee']) ?></td>
              <td class="font-monospace text-muted"><?= htmlspecialchars($act['deadline']) ?></td>
              <td class="text-center"><span class="badge <?= $prioBadge ?>"><?= htmlspecialchars($act['priority']) ?></span></td>
              <td class="text-center"><span class="badge <?= $statBadge ?>"><?= htmlspecialchars($act['status']) ?></span></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
let currentSlide = 1;
const totalSlides = 5;

function showSlide(index) {
  for (let i = 1; i <= totalSlides; i++) {
    const el = document.getElementById('slide_' + i);
    if (el) {
      if (i === index) {
        el.classList.remove('d-none');
      } else {
        el.classList.add('d-none');
      }
    }
  }
  document.getElementById('slideDeckCounter').innerText = 'Slide ' + index + ' / ' + totalSlides;
  currentSlide = index;
}

function nextSlideDeck() {
  if (currentSlide < totalSlides) {
    showSlide(currentSlide + 1);
  } else {
    showSlide(1);
  }
}

function prevSlideDeck() {
  if (currentSlide > 1) {
    showSlide(currentSlide - 1);
  } else {
    showSlide(totalSlides);
  }
}

function setSlideIndex(idx) {
  showSlide(idx);
}

function openSlideDeckMode() {
  const deck = document.getElementById('slideDeckBox');
  deck.scrollIntoView({ behavior: 'smooth' });
  showToastNotification('Presentation Ready', 'เข้าสู่โหมดนำเสนอ Slide Deck สำหรับการประชุมผู้บริหาร', 'info');
}

function toggleFullScreenDeck() {
  const elem = document.getElementById('slideDeckBox');
  if (!document.fullscreenElement) {
    elem.requestFullscreen().catch(err => {
      alert(`Error attempting to enable fullscreen: ${err.message}`);
    });
  } else {
    document.exitFullscreen();
  }
}
</script>
