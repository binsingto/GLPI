<?php
/**
 * IT Staff Tasks, Workload & Responsibility Audit System
 * Core Functions & Data Access Layer
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 */

require_once __DIR__ . '/config.php';

/**
 * Get the full list of 6 IT Staff Members with profiles, contact and ISO responsibility scopes
 */
function get_staff_list() {
    return [
        1 => [
            'id' => 1,
            'name' => 'นายบิณฑ์ สิงห์โตศรี',
            'name_en' => 'Mr. Bin Singtosi',
            'position' => 'IT Manager / ผู้จัดการฝ่ายเทคโนโลยีสารสนเทศ',
            'role_tier' => 'Manager',
            'tier_code' => 'mgmt',
            'tier_title' => 'Management & Governance',
            'email' => 'bin.si@age.co.th',
            'ext' => '1101',
            'mobile' => '081-xxx-1101',
            'avatar_color' => '#1e3a8a',
            'initials' => 'BS',
            'iso_role' => 'ISO ISMS / QMS Management Representative & Final Approver',
            'responsibilities' => [
                'กำกับดูแลนโยบายความมั่นคงปลอดภัยสารสนเทศ (ISO/IEC 27001:2022)',
                'ควบคุมการให้บริการและการปฏิบัติตาม SLA ของฝ่าย (ISO 9001:2015)',
                'อนุมัติคำขอเปลี่ยนแปลงระบบ (Change Management) ระดับวิกฤต',
                'บริหารงบประมาณ จัดซื้อจัดจ้างอุปกรณ์ไอที และวางแผน Disaster Recovery (BCP/DRP)',
                'ประเมินผลการปฏิบัติงาน ตรวจสอบ Capacity และจัดสรรทรัพยากรบุคลากร'
            ],
            'weekly_target_hrs' => 40.0,
            'sla_target_pct' => 99.0,
            'certifications' => ['ITIL v4', 'ISO 27001 Lead Auditor', 'CISSP'],
            'status' => 'Active'
        ],
        2 => [
            'id' => 2,
            'name' => 'นายวุฒิพงศ์ สินธุมาศ',
            'name_en' => 'Mr. Wuttiphong Sinthumas',
            'position' => 'IT Support Team Leader / หัวหน้าทีมสนับสนุนไอที',
            'role_tier' => 'Team Leader',
            'tier_code' => 'lead',
            'tier_title' => 'Operations & Quality Lead',
            'email' => 'wuttiphong.si@age.co.th',
            'ext' => '1102',
            'mobile' => '089-xxx-1102',
            'avatar_color' => '#0284c7',
            'initials' => 'WS',
            'iso_role' => 'Incident Manager & Daily Operations Auditor (FR-IT-ISO-021)',
            'responsibilities' => [
                'คัดกรองและจ่ายงาน (Ticket Triage & Dispatch) ให้เจ้าหน้าที่ตามความเชี่ยวชาญ',
                'กำกับดูแล SLA การแก้ไขปัญหา Incident และ Service Request ประจำวัน',
                'ประสานงานข้อขัดข้องเร่งด่วน การส่งต่องาน (Escalation) ไปยัง Tier 2 และ Tier 3',
                'ตรวจสอบความถูกต้องของแบบบันทึกงานประจำวันและลงนามรับรองขั้นต้น',
                'ควบคุมคุณภาพงานบริการ (CSAT) และการจัดการข้อร้องเรียนของผู้ใช้งาน'
            ],
            'weekly_target_hrs' => 40.0,
            'sla_target_pct' => 98.0,
            'certifications' => ['ITIL Foundation', 'CompTIA Network+', 'ISO 9001 Internal Auditor'],
            'status' => 'Active'
        ],
        3 => [
            'id' => 3,
            'name' => 'นายวัฒนา สุขล้อม',
            'name_en' => 'Mr. Watthana Suklom',
            'position' => 'Senior IT Support Engineer / วิศวกรสนับสนุนไอทีอาวุโส',
            'role_tier' => 'Senior Tier 2',
            'tier_code' => 'tier_2',
            'tier_title' => 'System, Network & Hardware Tier 2',
            'email' => 'watthana.su@age.co.th',
            'ext' => '1103',
            'mobile' => '086-xxx-1103',
            'avatar_color' => '#059669',
            'initials' => 'WS',
            'iso_role' => 'Physical & Network Infrastructure Custodian (FR-IT-ISO-024 §3 CCTV/LAN)',
            'responsibilities' => [
                'แก้ไขปัญหาฮาร์ดแวร์ คอมพิวเตอร์โน้ตบุ๊ก เวิร์กสเตชัน และอุปกรณ์ต่อพ่วงขั้นสูง',
                'ดูแลระบบเครือข่าย Access Switch, Wi-Fi Access Point ภายในสำนักงานและโรงงาน',
                'ตรวจสอบและบำรุงรักษาระบบกล้องวงจรปิด CCTV และ NVR Storage Retention',
                'จัดทำ Image มาตรฐาน ควบคุมลิขสิทธิ์ซอฟต์แวร์และการติดตั้งเครื่องพนักงานใหม่',
                'เป็นที่ปรึกษาทางเทคนิคและถ่ายทอดความรู้ให้เจ้าหน้าที่ Tier 1 และนักศึกษาฝึกงาน'
            ],
            'weekly_target_hrs' => 40.0,
            'sla_target_pct' => 96.0,
            'certifications' => ['CCNA', 'CompTIA A+', 'Microsoft Modern Desktop Administrator'],
            'status' => 'Active'
        ],
        4 => [
            'id' => 4,
            'name' => 'นายปิยะณัฐ โหระวงค์',
            'name_en' => 'Mr. Piyanat Horawong',
            'position' => 'Senior Infrastructure & Security Specialist / ผู้เชี่ยวชาญโครงสร้างพื้นฐานและความปลอดภัย',
            'role_tier' => 'Senior Tier 3',
            'tier_code' => 'tier_3',
            'tier_title' => 'Core Server, Security & Cloud Tier 3',
            'email' => 'piyanat.ho@age.co.th',
            'ext' => '1104',
            'mobile' => '084-xxx-1104',
            'avatar_color' => '#7c3aed',
            'initials' => 'PH',
            'iso_role' => 'ISO 27001 Security Controls Lead (FR-IT-ISO-024 §1-§2 Server/Backup)',
            'responsibilities' => [
                'บริหารจัดการเครื่องแม่ข่าย Server (VMware vSphere / Hyper-V) และ Active Directory',
                'ควบคุมระบบสำรองข้อมูลอัตโนมัติ (Veeam Backup & Replication) และทดสอบ Restore',
                'ดูแลระบบความมั่นคงปลอดภัย Firewall (Fortinet), Anti-Virus/EDR, Patch Management',
                'บริหารจัดการระบบคลาวด์ Microsoft 365, Exchange Online, Azure AD/Entra ID',
                'ตรวจสอบเหตุการณ์ความมั่นคงปลอดภัย (Security Logs) และรับมือภัยคุกคามไซเบอร์'
            ],
            'weekly_target_hrs' => 40.0,
            'sla_target_pct' => 97.0,
            'certifications' => ['VMware VCP', 'Fortinet NSE 4', 'Microsoft Azure Administrator (AZ-104)'],
            'status' => 'Active'
        ],
        5 => [
            'id' => 5,
            'name' => 'นายนฐวรรธน์ อินสวาท',
            'name_en' => 'Mr. Natthawat Inswat',
            'position' => 'IT Support Specialist / เจ้าหน้าที่สนับสนุนงานไอที',
            'role_tier' => 'Staff Tier 1',
            'tier_code' => 'tier_1',
            'tier_title' => 'User Helpdesk & Onsite Support Tier 1',
            'email' => 'natthawat.in@age.co.th',
            'ext' => '1105',
            'mobile' => '083-xxx-1105',
            'avatar_color' => '#ea580c',
            'initials' => 'NI',
            'iso_role' => 'Helpdesk Log Custodian & Meeting Room Readiness (FR-IT-ISO-024 §4)',
            'responsibilities' => [
                'รับแจ้งปัญหาทางโทรศัพท์ ไลน์ และระบบ GLPI Helpdesk ในระดับ First-line Support',
                'แก้ปัญหาเบื้องต้น เช่น ลืมรหัสผ่าน, ปรินต์ไม่ออก, ระบบเครือข่ายเชื่อมต่อไม่ได้เบื้องต้น',
                'จัดเตรียมเครื่องคอมพิวเตอร์และสิทธิ์การใช้งานสำหรับพนักงานเข้าใหม่ (Onboarding)',
                'ตรวจเช็กความพร้อมอุปกรณ์ห้องประชุม (Meeting Rooms AV, Display, Microphones)',
                'บันทึกข้อมูลทรัพย์สินไอที (IT Asset Inventory Tracking) ในระบบ'
            ],
            'weekly_target_hrs' => 40.0,
            'sla_target_pct' => 95.0,
            'certifications' => ['ITIL Foundation', 'CompTIA ITF+'],
            'status' => 'Active'
        ],
        6 => [
            'id' => 6,
            'name' => 'นายธีรพงษ์ บุญเลี้ยง',
            'name_en' => 'Mr. Teerapong Boonliang',
            'position' => 'IT Support Apprentice / ผู้ช่วยเจ้าหน้าที่สนับสนุนไอที (ฝึกงาน)',
            'role_tier' => 'Intern',
            'tier_code' => 'tier_1',
            'tier_title' => 'IT Support Operations Trainee',
            'email' => 'teerapong.bo@age.co.th',
            'ext' => '1106',
            'mobile' => '082-xxx-1106',
            'avatar_color' => '#475569',
            'initials' => 'TB',
            'iso_role' => 'Routine Inspection Assistant (Under supervision of Team Leader)',
            'responsibilities' => [
                'ช่วยตรวจเช็กความเรียบร้อยของห้องประชุม ระบบเสียง และโปรเจกเตอร์ทุกเช้า',
                'ช่วยติดป้ายทะเบียนทรัพย์สิน (Asset QR Tagging) และจัดเก็บคลังอุปกรณ์ไอที',
                'ช่วยตั้งค่าและทดสอบเครื่องคอมพิวเตอร์ตามคู่มือมาตรฐาน Standard Operating Procedure',
                'ร่วมตรวจเช็กสายสัญญาณและการจัดระเบียบตู้ Rack สายแลนตามแผนงาน',
                'เรียนรู้งานและบันทึกรายงานผลการฝึกงานประจำสัปดาห์'
            ],
            'weekly_target_hrs' => 40.0,
            'sla_target_pct' => 90.0,
            'certifications' => ['Undergraduate Student in Information Technology'],
            'status' => 'Active'
        ]
    ];
}

/**
 * Get staff by ID
 */
function get_staff_by_id($id) {
    $staff = get_staff_list();
    return $staff[$id] ?? null;
}

/**
 * Calculate Weighted Workload Hours
 * Based on ISO task complexity factor
 */
function calculate_weighted_hours($raw_hours, $task_type) {
    global $TASK_WEIGHTS;
    $multiplier = $TASK_WEIGHTS[$task_type]['multiplier'] ?? 1.0;
    return round($raw_hours * $multiplier, 2);
}

/**
 * Return RACI Matrix definition across IT Support & ISO Domains
 * R = Responsible (ผู้ปฏิบัติงานจริง)
 * A = Accountable (ผู้รับผิดชอบสูงสุด/ผู้อนุมัติ)
 * C = Consulted (ผู้ให้คำปรึกษา/ร่วมวางแผน)
 * I = Informed (ผู้รับทราบข้อมูล)
 */
function get_raci_matrix() {
    return [
        [
            'domain' => 'Incident & Helpdesk Operations',
            'iso_ref' => 'ISO 9001: 8.5.1',
            'tasks' => [
                ['name' => 'รับแจ้งปัญหา & คัดกรองงาน Ticket Dispatch', 'raci' => ['I', 'A', 'C', 'I', 'R', 'C']],
                ['name' => 'แก้ปัญหาหน้างานทั่วไป Tier 1 (PC, Printer, Passwords)', 'raci' => ['I', 'A', 'C', 'I', 'R', 'R']],
                ['name' => 'แก้ปัญหาฮาร์ดแวร์ & เน็ตเวิร์ก Tier 2', 'raci' => ['I', 'A', 'R', 'C', 'C', 'I']],
                ['name' => 'กู้คืนระบบแม่ข่ายและวิกฤตความปลอดภัย Tier 3', 'raci' => ['A', 'C', 'I', 'R', 'I', 'I']]
            ]
        ],
        [
            'domain' => 'Infrastructure & Security Operations',
            'iso_ref' => 'ISO 27001: A.8.6, A.8.16, A.8.19',
            'tasks' => [
                ['name' => 'ตรวจเช็ก Server & Data Center อุณหภูมิ/UPS ประจำวัน', 'raci' => ['A', 'C', 'C', 'R', 'I', 'C']],
                ['name' => 'ตรวจสอบสำรองข้อมูล Veeam Backup & ทดสอบ Restore', 'raci' => ['A', 'I', 'I', 'R', 'I', 'I']],
                ['name' => 'ตรวจสอบกล้องวงจรปิด CCTV & การบันทึกภาพ 30 วัน', 'raci' => ['A', 'C', 'R', 'I', 'C', 'C']],
                ['name' => 'ตรวจเช็กห้องประชุมและระบบโสตทัศนูปกรณ์ (Meeting Room AV)', 'raci' => ['I', 'A', 'C', 'I', 'R', 'R']]
            ]
        ],
        [
            'domain' => 'Compliance, Audit & Governance',
            'iso_ref' => 'ISO 9001: 9.1.3 & ISO 27001: A.5.2',
            'tasks' => [
                ['name' => 'ลงนามรับรองแบบบันทึกงานประจำวัน (FR-IT-ISO-021)', 'raci' => ['A', 'R', 'I', 'I', 'I', 'I']],
                ['name' => 'ตรวจประเมินสมดุลงาน & Re-balance (FR-IT-ISO-022)', 'raci' => ['A', 'R', 'C', 'C', 'I', 'I']],
                ['name' => 'สรุปผลการปฏิบัติงานและ SLA Scorecard ประจำเดือน (FR-IT-ISO-023)', 'raci' => ['A', 'R', 'I', 'I', 'I', 'I']],
                ['name' => 'เตรียมเอกสาร Audit ตรวจรับรอง ISO 9001 & ISO 27001', 'raci' => ['A', 'R', 'C', 'C', 'C', 'I']]
            ]
        ]
    ];
}

/**
 * Get Daily Task Operations Log (FR-IT-ISO-021)
 */
function get_daily_tasks_data($filter_date = null, $filter_staff = null) {
    $today = $filter_date ?: date('Y-m-d');
    
    $tasks = [
        [
            'id' => 'TSK-20261106-001',
            'ticket_no' => 'INC-84920',
            'staff_id' => 5,
            'staff_name' => 'นายนฐวรรธน์ อินสวาท',
            'staff_role' => 'Staff Tier 1',
            'title' => 'เปลี่ยนชุดหมึกพิมพ์และแก้กระดาษติด แผนกจัดซื้อ (Building A Fl.2)',
            'category' => 'tier_1',
            'category_title' => 'Tier 1 Support',
            'raw_hours' => 1.0,
            'multiplier' => 1.0,
            'weighted_hours' => 1.0,
            'status' => 'Completed',
            'priority' => 'Medium',
            'iso_clause' => 'ISO 9001: 8.5.1',
            'time_start' => '08:45',
            'time_end' => '09:45',
            'subtasks' => [
                'เปลี่ยนตลับหมึก Toner HP LaserJet Enterprise',
                'ทำความสะอาด Roller ดึงกระดาษ',
                'ทดสอบ Print Test Page และให้ User เซ็นรับงาน'
            ],
            'remarks' => 'ผู้ใช้งานแจ้งงานผ่าน Helpdesk เรียบร้อย'
        ],
        [
            'id' => 'TSK-20261106-002',
            'ticket_no' => 'SRQ-12044',
            'staff_id' => 6,
            'staff_name' => 'นายธีรพงษ์ บุญเลี้ยง',
            'staff_role' => 'Intern',
            'title' => 'ตรวจเช็กระบบเสียง ไมโครโฟนไร้สาย และโปรเจกเตอร์ห้องประชุมใหญ่ Boardroom',
            'category' => 'routine_admin',
            'category_title' => 'Routine Checklist',
            'raw_hours' => 1.5,
            'multiplier' => 1.0,
            'weighted_hours' => 1.5,
            'status' => 'Completed',
            'priority' => 'High',
            'iso_clause' => 'FR-IT-ISO-024 §4',
            'time_start' => '08:30',
            'time_end' => '10:00',
            'subtasks' => [
                'ทดสอบสัญญาณภาพ HDMI & Barco ClickShare',
                'ตรวจสอบระดับแบตเตอรี่ไมโครโฟนประชุม 12 ตัว',
                'ทดสอบเสียงระบบ Zoom Rooms ร่วมกับลำโพง Ceiling Speakers'
            ],
            'remarks' => 'เตรียมพร้อมสำหรับการประชุมบอร์ดเวลา 10:30 น.'
        ],
        [
            'id' => 'TSK-20261106-003',
            'ticket_no' => 'INC-84925',
            'staff_id' => 3,
            'staff_name' => 'นายวัฒนา สุขล้อม',
            'staff_role' => 'Senior Tier 2',
            'title' => 'ตรวจเช็ก Access Point Aruba ชั้น 3 คลังสินค้า หลุดการเชื่อมต่อบ่อยครั้ง',
            'category' => 'tier_2',
            'category_title' => 'Tier 2 Support',
            'raw_hours' => 2.5,
            'multiplier' => 1.5,
            'weighted_hours' => 3.75,
            'status' => 'Completed',
            'priority' => 'High',
            'iso_clause' => 'ISO 9001: 8.5.1',
            'time_start' => '10:15',
            'time_end' => '12:45',
            'subtasks' => [
                'วิเคราะห์สัญญาณผ่าน Aruba Central Controller',
                'พบปัญหาหัวต่อสัญญาณ RJ-45 ต้นทางหลวมเนื่องจากแรงสั่นสะเทือน',
                'ตัดต่อหัว RJ-45 Cat6 ใหม่และเข้าหัวกันน้ำ',
                'ทดสอบ Speedtest และตรวจสอบ Packet Loss ผลปกติ 0%'
            ],
            'remarks' => 'ตรวจพบค่า Signal to Noise Ratio กลับสู่เกณฑ์มาตรฐาน (> 32 dB)'
        ],
        [
            'id' => 'TSK-20261106-004',
            'ticket_no' => 'SEC-2026-088',
            'staff_id' => 4,
            'staff_name' => 'นายปิยะณัฐ โหระวงค์',
            'staff_role' => 'Senior Tier 3',
            'title' => 'อัปเดต Security Patch ประจำเดือน VMware ESXi 8.0 & ตรวจสอบ Veeam Backup Immutable Repository',
            'category' => 'tier_3',
            'category_title' => 'Tier 3 Support',
            'raw_hours' => 3.0,
            'multiplier' => 2.5,
            'weighted_hours' => 7.5,
            'status' => 'In Progress',
            'priority' => 'Critical',
            'iso_clause' => 'ISO 27001: A.8.19 & A.8.16',
            'time_start' => '13:00',
            'time_end' => '16:00',
            'subtasks' => [
                'ทดสอบ Migrate VMs ด้วย vMotion ไปยัง Host 02',
                'ติดตั้ง Patch KB-202611 บน Host 01 และทำการ Reboot',
                'ตรวจสอบความถูกต้องของไฟล์สำรองข้อมูล immutable retention 14 วัน',
                'จำลองการ Instant Recovery ระบบ ERP ทดสอบความพร้อม'
            ],
            'remarks' => 'ดำเนินงานภายใต้ Maintenance Window ที่ได้รับอนุมัติ'
        ],
        [
            'id' => 'TSK-20261106-005',
            'ticket_no' => 'ADM-0912',
            'staff_id' => 2,
            'staff_name' => 'นายวุฒิพงศ์ สินธุมาศ',
            'staff_role' => 'Team Leader',
            'title' => 'ตรวจคัดกรอง Ticket ประจำวัน ตรวจสอบ SLA และทบทวนแบบบันทึกงาน FR-IT-ISO-021',
            'category' => 'routine_admin',
            'category_title' => 'Operations Audit',
            'raw_hours' => 2.0,
            'multiplier' => 1.0,
            'weighted_hours' => 2.0,
            'status' => 'Completed',
            'priority' => 'Medium',
            'iso_clause' => 'ISO 9001: 9.1.3',
            'time_start' => '13:30',
            'time_end' => '15:30',
            'subtasks' => [
                'ตรวจสอบจำนวน Ticket คงค้าง 4 รายการ และมอบหมายเจ้าหน้าที่รับผิดชอบ',
                'ตรวจทานบันทึกเวลาทำงานของทีม Tier 1 และ Intern',
                'สรุปรายงาน SLA รายวันพบสำเร็จ 98.8%'
            ],
            'remarks' => 'เตรียมเสนอ IT Manager เพื่อทำการ Sign-Off ปิดรอบประจำวัน'
        ],
        [
            'id' => 'TSK-20261106-006',
            'ticket_no' => 'PRJ-ISO-2701',
            'staff_id' => 1,
            'staff_name' => 'นายบิณฑ์ สิงห์โตศรี',
            'staff_role' => 'Manager',
            'title' => 'ทบทวนนโยบายการบริหารจัดการความต่อเนื่องทางธุรกิจ (BCP/DRP) และอนุมัติผลการประเมินความเสี่ยง',
            'category' => 'project_iso',
            'category_title' => 'ISO Compliance & Governance',
            'raw_hours' => 2.5,
            'multiplier' => 3.0,
            'weighted_hours' => 7.5,
            'status' => 'Completed',
            'priority' => 'High',
            'iso_clause' => 'ISO 27001: A.5.2 & A.5.8',
            'time_start' => '14:00',
            'time_end' => '16:30',
            'subtasks' => [
                'ทบทวนเอกสารนโยบายความมั่นคงปลอดภัยสารสนเทศฉบับปรับปรุงปี 2026',
                'ประเมินค่า RPO/RTO ของระบบสารสนเทศระดับความสำคัญสูงสุด (Mission Critical)',
                'ลงนามรับรองรายงานการตรวจประเมินภายในประจำไตรมาส'
            ],
            'remarks' => 'ส่งเอกสารรายงานให้ฝ่ายบริหาร (Executive QMR) รับทราบ'
        ]
    ];

    if ($filter_staff) {
        $tasks = array_filter($tasks, function($t) use ($filter_staff) {
            return $t['staff_id'] == $filter_staff;
        });
    }

    return array_values($tasks);
}

/**
 * Get Weekly Workload Distribution (FR-IT-ISO-022)
 * Break down into Tier 1, Tier 2, Tier 3, Project/ISO, and Routine
 */
function get_weekly_workload_breakdown() {
    return [
        1 => [
            'staff_id' => 1,
            'name' => 'นายบิณฑ์ สิงห์โตศรี',
            'role' => 'IT Manager',
            'tier_1' => 0.0,
            'tier_2' => 2.0,
            'tier_3' => 8.0,
            'project_iso' => 22.0,
            'routine_admin' => 6.0,
            'total_raw' => 38.0,
            'total_weighted' => 89.0, // (2*1.5) + (8*2.5) + (22*3.0) + (6*1.0)
            'capacity_pct' => 95.0,
            'status' => 'Optimal',
            'badge_color' => 'success'
        ],
        2 => [
            'staff_id' => 2,
            'name' => 'นายวุฒิพงศ์ สินธุมาศ',
            'role' => 'Team Leader',
            'tier_1' => 4.0,
            'tier_2' => 12.0,
            'tier_3' => 6.0,
            'project_iso' => 8.0,
            'routine_admin' => 10.0,
            'total_raw' => 40.0,
            'total_weighted' => 71.0,
            'capacity_pct' => 100.0,
            'status' => 'Balanced',
            'badge_color' => 'success'
        ],
        3 => [
            'staff_id' => 3,
            'name' => 'นายวัฒนา สุขล้อม',
            'role' => 'Senior Tier 2',
            'tier_1' => 6.0,
            'tier_2' => 26.0,
            'tier_3' => 4.0,
            'project_iso' => 4.0,
            'routine_admin' => 6.0,
            'total_raw' => 46.0,
            'total_weighted' => 73.0,
            'capacity_pct' => 115.0, // Overload alert
            'status' => 'Overloaded',
            'badge_color' => 'danger'
        ],
        4 => [
            'staff_id' => 4,
            'name' => 'นายปิยะณัฐ โหระวงค์',
            'role' => 'Senior Tier 3',
            'tier_1' => 2.0,
            'tier_2' => 8.0,
            'tier_3' => 22.0,
            'project_iso' => 12.0,
            'routine_admin' => 4.0,
            'total_raw' => 48.0,
            'total_weighted' => 109.0,
            'capacity_pct' => 120.0, // High Overload
            'status' => 'Critical Overload',
            'badge_color' => 'danger'
        ],
        5 => [
            'staff_id' => 5,
            'name' => 'นายนฐวรรธน์ อินสวาท',
            'role' => 'Staff Tier 1',
            'tier_1' => 22.0,
            'tier_2' => 6.0,
            'tier_3' => 0.0,
            'project_iso' => 2.0,
            'routine_admin' => 5.0,
            'total_raw' => 35.0,
            'total_weighted' => 42.0,
            'capacity_pct' => 87.5,
            'status' => 'Available Capacity',
            'badge_color' => 'info'
        ],
        6 => [
            'staff_id' => 6,
            'name' => 'นายธีรพงษ์ บุญเลี้ยง',
            'role' => 'Intern',
            'tier_1' => 14.0,
            'tier_2' => 2.0,
            'tier_3' => 0.0,
            'project_iso' => 0.0,
            'routine_admin' => 12.0,
            'total_raw' => 28.0,
            'total_weighted' => 29.0,
            'capacity_pct' => 70.0,
            'status' => 'Under-utilized',
            'badge_color' => 'secondary'
        ]
    ];
}

/**
 * Smart Re-balance Engine Suggestions
 * Automatically finds overloaded staff and matches with available teammates
 */
function get_smart_rebalance_suggestions() {
    return [
        [
            'id' => 'REBAL-01',
            'from_staff_id' => 4,
            'from_staff' => 'นายปิยะณัฐ โหระวงค์ (Senior Tier 3 - 120%)',
            'to_staff_id' => 5,
            'to_staff' => 'นายนฐวรรธน์ อินสวาท (Staff Tier 1 - 87.5%)',
            'task_title' => 'โอนย้ายงานตรวจสอบบันทึก Active Directory User Log และสิทธิ์การเข้าถึงประจำสัปดาห์',
            'hours' => 3.5,
            'task_type' => 'routine_admin',
            'reason' => 'ลดภาระงาน Routine ของ Senior Tier 3 เพื่อให้มุ่งเน้นภารกิจ Patching & Security Incident ตาม ISO 27001 A.8.6',
            'impact_from' => '120% ➔ 111.2%',
            'impact_to' => '87.5% ➔ 96.2%',
            'status' => 'Recommended'
        ],
        [
            'id' => 'REBAL-02',
            'from_staff_id' => 3,
            'from_staff' => 'นายวัฒนา สุขล้อม (Senior Tier 2 - 115%)',
            'to_staff_id' => 6,
            'to_staff' => 'นายธีรพงษ์ บุญเลี้ยง (Intern - 70%)',
            'task_title' => 'มอบหมายงานเดินตรวจสภาพกล้อง CCTV และเช็กความสะอาดสายสัญญาณห้อง Network Rack',
            'hours' => 4.0,
            'task_type' => 'routine_admin',
            'reason' => 'ส่งเสริมการฝึกทักษะการตรวจสอบหน้างานจริงของนักศึกษาฝึกงาน และคลายความหนาแน่นของงานซ่อมบำรุงขั้นสูง',
            'impact_from' => '115% ➔ 105.0%',
            'impact_to' => '70% ➔ 80.0%',
            'status' => 'Recommended'
        ],
        [
            'id' => 'REBAL-03',
            'from_staff_id' => 3,
            'from_staff' => 'นายวัฒนา สุขล้อม (Senior Tier 2)',
            'to_staff_id' => 5,
            'to_staff' => 'นายนฐวรรธน์ อินสวาท (Staff Tier 1)',
            'task_title' => 'แบ่งเบาการติดตั้งและ Clone Image คอมพิวเตอร์พนักงานใหม่รอบสัปดาห์หน้า (3 เครื่อง)',
            'hours' => 3.0,
            'task_type' => 'tier_1',
            'reason' => 'งานจัดเตรียมเครื่องระดับ Standard PC สามารถดำเนินการโดยเจ้าหน้าที่ Tier 1 ได้อย่างสมบูรณ์ตาม SOP',
            'impact_from' => '105% ➔ 97.5%',
            'impact_to' => '96.2% ➔ 103.7%',
            'status' => 'Recommended'
        ]
    ];
}

/**
 * Monthly Scorecard & Capacity Data (FR-IT-ISO-023)
 */
function get_monthly_scorecard_data() {
    return [
        'period' => 'ตุลาคม 2026 / ประจำเดือนล่าสุด',
        'overall_team_capacity' => 89.4,
        'overall_sla_compliance' => 98.8,
        'overall_csat_score' => 4.88, // out of 5.0
        'total_tickets_handled' => 482,
        'total_tickets_closed' => 476,
        'staff_scores' => [
            1 => [
                'name' => 'นายบิณฑ์ สิงห์โตศรี',
                'role' => 'IT Manager',
                'sla_score' => 99.5,
                'csat' => 4.95,
                'tickets_resolved' => 28,
                'avg_resolution_hrs' => 6.2,
                'iso_audit_score' => 99.0,
                'capacity_utilization' => 95.0,
                'grade' => 'A+',
                'key_achievement' => 'ผ่านการรับรอง Surveillance Audit ISO 27001 และอนุมัติปรับลด RTO ลงเหลือ 15 นาที'
            ],
            2 => [
                'name' => 'นายวุฒิพงศ์ สินธุมาศ',
                'role' => 'Team Leader',
                'sla_score' => 98.9,
                'csat' => 4.90,
                'tickets_resolved' => 84,
                'avg_resolution_hrs' => 2.1,
                'iso_audit_score' => 98.0,
                'capacity_utilization' => 98.2,
                'grade' => 'A',
                'key_achievement' => 'ควบคุม Incident ปิดได้ทัน SLA 98.9% สูงกว่าเป้าหมายองค์กร ไม่มีเคสหลุดรอบ'
            ],
            3 => [
                'name' => 'นายวัฒนา สุขล้อม',
                'role' => 'Senior Tier 2',
                'sla_score' => 97.8,
                'csat' => 4.85,
                'tickets_resolved' => 132,
                'avg_resolution_hrs' => 3.4,
                'iso_audit_score' => 96.5,
                'capacity_utilization' => 108.5,
                'grade' => 'A',
                'key_achievement' => 'แก้ไขปัญหา Wi-Fi จุดอับสัญญาณในโรงงานได้ 100% และลดจำนวน Ticket ซ้ำซ้อนลง 24%'
            ],
            4 => [
                'name' => 'นายปิยะณัฐ โหระวงค์',
                'role' => 'Senior Tier 3',
                'sla_score' => 98.2,
                'csat' => 4.92,
                'tickets_resolved' => 64,
                'avg_resolution_hrs' => 4.8,
                'iso_audit_score' => 100.0,
                'capacity_utilization' => 112.0,
                'grade' => 'A+',
                'key_achievement' => 'คะแนนตรวจความมั่นคงปลอดภัยเต็ม 100% ไม่มีช่องโหว่ระดับ High/Critical บน Server'
            ],
            5 => [
                'name' => 'นายนฐวรรธน์ อินสวาท',
                'role' => 'Staff Tier 1',
                'sla_score' => 96.8,
                'csat' => 4.80,
                'tickets_resolved' => 146,
                'avg_resolution_hrs' => 1.2,
                'iso_audit_score' => 95.0,
                'capacity_utilization' => 88.0,
                'grade' => 'B+',
                'key_achievement' => 'ยอดปิด Ticket สูงสุดประจำเดือน (146 เคส) ความพึงพอใจผู้ใช้งานระดับดีเยี่ยม'
            ],
            6 => [
                'name' => 'นายธีรพงษ์ บุญเลี้ยง',
                'role' => 'Intern',
                'sla_score' => 94.5,
                'csat' => 4.75,
                'tickets_resolved' => 38,
                'avg_resolution_hrs' => 1.8,
                'iso_audit_score' => 93.0,
                'capacity_utilization' => 74.0,
                'grade' => 'B',
                'key_achievement' => 'ให้การสนับสนุนห้องประชุมราบรื่นไม่มีสะดุด และจัดระเบียบคลังทรัพย์สินไอทีครบถ้วน'
            ]
        ]
    ];
}

/**
 * Critical 4-System Routine Checklist Data (FR-IT-ISO-024)
 */
function get_checklist_systems_data() {
    return [
        'systems' => [
            'server' => [
                'id' => 'SYS-01',
                'name' => '1. ระบบเครื่องแม่ข่าย & การประมวลผล (Server & Virtualization)',
                'icon' => 'bi-server',
                'iso_clause' => 'ISO 27001: A.8.6 & A.8.16',
                'owner' => 'นายปิยะณัฐ โหระวงค์ (Senior Tier 3)',
                'overall_status' => 'Normal',
                'items' => [
                    [
                        'code' => 'SRV-01',
                        'title' => 'VMware ESXi Host 01 / Host 02 CPU & RAM Usage',
                        'criteria' => 'CPU < 75%, RAM < 85%, Datastore Free Space > 20%',
                        'status' => 'Normal',
                        'current_val' => 'Host01: CPU 34%, RAM 68% | Host02: CPU 41%, RAM 72%',
                        'last_checked' => '08:30 น.',
                        'note' => 'ทำงานปกติ ไม่มี Alert บน vCenter'
                    ],
                    [
                        'code' => 'SRV-02',
                        'title' => 'Active Directory & Domain Controller Replication',
                        'criteria' => 'PDC/BDC Sync Status Success, Kerberos & DNS Queries Normal',
                        'status' => 'Normal',
                        'current_val' => 'Replication Delta: 0 ms | Event Log Clean',
                        'last_checked' => '08:45 น.',
                        'note' => 'การจำลองฐานข้อมูลผู้ใช้สมบูรณ์'
                    ],
                    [
                        'code' => 'SRV-03',
                        'title' => 'Server Room Temperature & Smart UPS Battery Health',
                        'criteria' => 'Temp 20°C - 24°C, Humidity 45-60%, UPS Runtime > 45 mins',
                        'status' => 'Normal',
                        'current_val' => 'Temp: 21.8°C | Humidity: 51% | UPS Runtime: 62 mins',
                        'last_checked' => '08:15 น.',
                        'note' => 'Schneider Galaxy UPS สถานะ Float Charge 100%'
                    ]
                ]
            ],
            'backup' => [
                'id' => 'SYS-02',
                'name' => '2. ระบบสำรองข้อมูล & กู้คืนความเสียหาย (Backup & Disaster Recovery)',
                'icon' => 'bi-cloud-arrow-up',
                'iso_clause' => 'ISO 27001: A.8.19 Information Deletion & Backup',
                'owner' => 'นายปิยะณัฐ โหระวงค์ (Senior Tier 3)',
                'overall_status' => 'Normal',
                'items' => [
                    [
                        'code' => 'BKP-01',
                        'title' => 'Veeam Backup Daily Job: ERP SAP & Core Database',
                        'criteria' => 'Status Success, 0 Warning, Compression & Deduplication Verified',
                        'status' => 'Normal',
                        'current_val' => 'Status: Success (03:15:20 น.) | Size: 1.42 TB',
                        'last_checked' => '08:20 น.',
                        'note' => 'RPO บรรลุตามเกณฑ์ < 24 ชั่วโมง'
                    ],
                    [
                        'code' => 'BKP-02',
                        'title' => 'Offsite Cloud Backup Sync (Immutable Repository)',
                        'criteria' => 'Cloud Copy Job Completed, WORM Lock Active 14 Days',
                        'status' => 'Normal',
                        'current_val' => 'Sync: 100% | Immutable Lock: Valid until 20/11/2026',
                        'last_checked' => '08:35 น.',
                        'note' => 'ป้องกัน Ransomware ตามมาตรฐาน ISO/IEC 27001'
                    ],
                    [
                        'code' => 'BKP-03',
                        'title' => 'File Server & Shared Folder Daily Incremental',
                        'criteria' => 'User Shared Folder Backup Job completed without locked files',
                        'status' => 'Normal',
                        'current_val' => 'Status: Success | Transfer Rate: 125 MB/s',
                        'last_checked' => '08:40 น.',
                        'note' => 'กู้คืนทดสอบไฟล์สุ่ม 3 ไฟล์ถูกต้องสมบูรณ์'
                    ]
                ]
            ],
            'cctv' => [
                'id' => 'SYS-03',
                'name' => '3. ระบบกล้องวงจรปิด & ความมั่นคงปลอดภัยทางกายภาพ (CCTV & Physical Security)',
                'icon' => 'bi-camera-video',
                'iso_clause' => 'ISO 27001: A.7.4 Physical Security Monitoring',
                'owner' => 'นายวัฒนา สุขล้อม (Senior Tier 2)',
                'overall_status' => 'Warning',
                'items' => [
                    [
                        'code' => 'CTV-01',
                        'title' => 'สถานะการทำงานของ NVR 01-04 และจำนวนกล้อง Online (สำนักงาน & ท่าเรือ/คลัง)',
                        'criteria' => 'กล้องทำงานครบ 100% (64/64 ตัว), ไม่มีภาพลายหรือขาดหาย',
                        'status' => 'Warning',
                        'current_val' => 'Online: 63/64 ตัว (CAM-Dock-03 Offline)',
                        'last_checked' => '09:00 น.',
                        'note' => 'กล้องบริเวณสะพานชั่งท่าเรือหลุด กำลังนำอะไหล่เข้าสลับเปลี่ยนช่วงบ่าย'
                    ],
                    [
                        'code' => 'CTV-02',
                        'title' => 'ระยะเวลาบันทึกย้อนหลัง (Storage Retention Policy)',
                        'criteria' => 'บันทึกภาพย้อนหลังไม่ต่ำกว่า 30 วัน (พื้นที่ความมั่นคง 90 วัน)',
                        'status' => 'Normal',
                        'current_val' => 'Harddisk HDD Storage Status: Normal | Retention: 38 Days',
                        'last_checked' => '09:10 น.',
                        'note' => 'เป็นไปตามข้อกำหนดความมั่นคงปลอดภัยและกฎหมาย'
                    ],
                    [
                        'code' => 'CTV-03',
                        'title' => 'บันทึกการเปิด-ปิดประตูห้อง Server (Access Door Controller Log)',
                        'criteria' => 'ระบบ Fingerprint/Card Reader Online, ไม่มี Un-authorized Access',
                        'status' => 'Normal',
                        'current_val' => 'Door Status: Locked | Event Logs: ปกติ (เข้าเฉพาะเจ้าหน้าที่ IT)',
                        'last_checked' => '09:15 น.',
                        'note' => 'ตรวจตรงกับบันทึกผู้มาเยือน (Visitor Log)'
                    ]
                ]
            ],
            'meeting' => [
                'id' => 'SYS-04',
                'name' => '4. ระบบห้องประชุมและโสตทัศนูปกรณ์ (Executive & Meeting Room Systems)',
                'icon' => 'bi-display',
                'iso_clause' => 'ISO 9001: 7.1.3 Infrastructure',
                'owner' => 'นายนฐวรรธน์ อินสวาท / นายธีรพงษ์ บุญเลี้ยง',
                'overall_status' => 'Normal',
                'items' => [
                    [
                        'code' => 'MTR-01',
                        'title' => 'ห้องประชุมใหญ่ Boardroom (ชั้น 4) - Zoom Rooms & Video Conference',
                        'criteria' => 'Logitech Rally Plus Cam, Mic Array, Display 85" แสดงผลคมชัด',
                        'status' => 'Normal',
                        'current_val' => 'Zoom Appliance: Online | Latency: 4ms | Mic: ชัดเจน',
                        'last_checked' => '08:25 น.',
                        'note' => 'ทดสอบภาพและเสียงพร้อมสำหรับการประชุมคณะกรรมการ'
                    ],
                    [
                        'code' => 'MTR-02',
                        'title' => 'ห้องประชุม 2, 3, 4 (Meeting Rooms 201-203) - Wireless Presentation',
                        'criteria' => 'Barco ClickShare / Miracast พร้อมใช้งาน, สาย HDMI สำรองพร้อม',
                        'status' => 'Normal',
                        'current_val' => 'Button Pairing: สำเร็จทุกชุด | สัญญาณภาพปกติ',
                        'last_checked' => '08:45 น.',
                        'note' => 'ทำความสะอาดรีโมตและจัดโต๊ะเรียบร้อย'
                    ],
                    [
                        'code' => 'MTR-03',
                        'title' => 'ระบบเครือข่าย Guest Wi-Fi สำหรับผู้มาติดต่อและผู้ถือหุ้น',
                        'criteria' => 'Captive Portal ทำงาน, Bandwidth Limit 30/30 Mbps ต่อผู้ใช้',
                        'status' => 'Normal',
                        'current_val' => 'Active Clients: 14 | Portal Authentication: Success',
                        'last_checked' => '08:50 น.',
                        'note' => 'แยก VLAN จาก Corporate Network ปลอดภัยตาม ISO 27001'
                    ]
                ]
            ]
        ]
    ];
}

/**
 * Weekly Meeting Agenda & Action Items
 */
function get_meeting_agenda_and_actions() {
    return [
        'meeting_meta' => [
            'title' => 'การประชุมติดตามงานฝ่ายเทคโนโลยีสารสนเทศประจำสัปดาห์ (Weekly IT Ops Review)',
            'meeting_no' => 'IT-MOM-2026/W45',
            'date' => '06 พฤศจิกายน 2026 (เวลา 16:00 - 17:30 น.)',
            'room' => 'ห้องประชุม IT Conference Room & Microsoft Teams',
            'chairman' => 'นายบิณฑ์ สิงห์โตศรี (IT Manager)',
            'secretary' => 'นายวุฒิพงศ์ สินธุมาศ (Team Leader)',
            'attendees' => [
                'นายบิณฑ์ สิงห์โตศรี (Manager) - ประธาน',
                'นายวุฒิพงศ์ สินธุมาศ (Team Leader) - สรุปรายงาน',
                'นายวัฒนา สุขล้อม (Senior Tier 2) - รายงานเน็ตเวิร์ก/CCTV',
                'นายปิยะณัฐ โหระวงค์ (Senior Tier 3) - รายงาน Server/Backup/Security',
                'นายนฐวรรธน์ อินสวาท (Staff Tier 1) - รายงานสถิติ Helpdesk',
                'นายธีรพงษ์ บุญเลี้ยง (Intern) - รายงานสนับสนุนห้องประชุม'
            ]
        ],
        'agenda_topics' => [
            [
                'no' => 1,
                'topic' => 'ทบทวนสถิติผลการปฏิบัติงาน Incident, Service Request และ SLA ประจำสัปดาห์ (ISO 9001: 8.5.1)',
                'summary' => 'สัปดาห์นี้มี Ticket รวม 94 รายการ ปิดงานได้ 91 รายการ คิดเป็น 96.8% โดยไม่มีเคสวิกฤตหลุด SLA',
                'presenter' => 'นายวุฒิพงศ์ สินธุมาศ'
            ],
            [
                'no' => 2,
                'topic' => 'รายงานสถานะความมั่นคงปลอดภัย Server, Backup และผลการทดสอบ Restore (ISO 27001: A.8.19)',
                'summary' => 'ระบบ Veeam สำรองข้อมูลสำเร็จ 100% กักเก็บแบบ Immutable ป้องกันมัลแวร์เรียกค่าไถ่ พร้อมอัปเดต Security Patch ESXi ลุล่วง',
                'presenter' => 'นายปิยะณัฐ โหระวงค์'
            ],
            [
                'no' => 3,
                'topic' => 'การบริหารจัดการภาระงาน (Capacity Audit) และแผนการจัดสรรงานสัปดาห์หน้า (ISO 27001: A.8.6)',
                'summary' => 'พบชั่วโมงงานของ Senior Tier 2 & 3 อยู่ในระดับสูง (Over 110%) จึงมีมติอนุมัติ Re-balance งาน Routine ไปยัง Tier 1 และ Intern',
                'presenter' => 'นายบิณฑ์ สิงห์โตศรี'
            ],
            [
                'no' => 4,
                'topic' => 'ความพร้อมการรับการตรวจประเมินต่ออายุใบรับรอง ISO 9001:2015 และ ISO/IEC 27001:2022',
                'summary' => 'เอกสารแบบบันทึก FR-IT-ISO-021 ถึง 024 บันทึกครบถ้วน Sign-off ตรงเวลา พร้อมนำส่ง Audit Trail แก่ผู้ตรวจประเมิน',
                'presenter' => 'นายบิณฑ์ สิงห์โตศรี'
            ]
        ],
        'action_items' => [
            [
                'id' => 'ACT-01',
                'task' => 'เข้าซ่อมแซมและเปลี่ยนโมดูลกล้อง CCTV บริเวณสะพานชั่งท่าเรือ (CAM-Dock-03)',
                'assignee' => 'นายวัฒนา สุขล้อม / นายธีรพงษ์ บุญเลี้ยง',
                'deadline' => '07 พ.ย. 2026 (12:00 น.)',
                'priority' => 'High',
                'status' => 'In Progress'
            ],
            [
                'id' => 'ACT-02',
                'task' => 'นำระบบ Smart Re-balance ไปปรับปรุงตารางมอบหมายงานประจำวันสัปดาห์ที่ 46',
                'assignee' => 'นายวุฒิพงศ์ สินธุมาศ',
                'deadline' => '09 พ.ย. 2026',
                'priority' => 'Medium',
                'status' => 'Pending'
            ],
            [
                'id' => 'ACT-03',
                'task' => 'จัดทำคู่มือ User Guide การใช้งานห้องประชุม Boardroom แบบ QR Code สำหรับผู้บริหาร',
                'assignee' => 'นายนฐวรรธน์ อินสวาท / นายธีรพงษ์ บุญเลี้ยง',
                'deadline' => '11 พ.ย. 2026',
                'priority' => 'Low',
                'status' => 'Completed'
            ],
            [
                'id' => 'ACT-04',
                'task' => 'จัดเตรียมเอกสาร Risk Assessment Matrix & Evidence Logs ส่งทีมตรวจ ISO Audit',
                'assignee' => 'นายบิณฑ์ สิงห์โตศรี / นายปิยะณัฐ โหระวงค์',
                'deadline' => '14 พ.ย. 2026',
                'priority' => 'High',
                'status' => 'In Progress'
            ]
        ]
    ];
}

/**
 * Load JSON configuration safely
 */
function load_json_data($file_path, $default = []) {
    if (!file_exists($file_path)) {
        return $default;
    }
    $content = file_get_contents($file_path);
    $data = json_decode($content, true);
    return is_array($data) ? $data : $default;
}

/**
 * Save JSON configuration safely
 */
function save_json_data($file_path, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($file_path, $json) !== false;
}
