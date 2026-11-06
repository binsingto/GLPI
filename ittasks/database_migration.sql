-- ============================================================================
-- Enterprise Database Migration: IT Staff Tasks, Workload & Responsibility Audit System
-- บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
-- Standards Compliance: ISO 9001:2015 & ISO/IEC 27001:2022
-- Target Engines: MySQL 5.7+ / MariaDB 10.3+ / SQLite Compatible
-- ============================================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Table: it_staff (บุคลากรฝ่ายเทคโนโลยีสารสนเทศ 6 ท่าน)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_staff` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(150) NOT NULL COMMENT 'ชื่อ-นามสกุล ภาษาไทย',
  `name_en` VARCHAR(150) NOT NULL COMMENT 'Full Name in English',
  `position` VARCHAR(150) NOT NULL COMMENT 'ตำแหน่งงานทางการ',
  `role_tier` VARCHAR(50) NOT NULL COMMENT 'Manager, Team Leader, Senior Tier 2/3, Staff, Intern',
  `tier_code` VARCHAR(20) NOT NULL COMMENT 'mgmt, lead, tier_1, tier_2, tier_3',
  `email` VARCHAR(120) NOT NULL UNIQUE,
  `ext` VARCHAR(10) DEFAULT NULL COMMENT 'เบอร์ต่อภายใน',
  `mobile` VARCHAR(20) DEFAULT NULL,
  `avatar_color` VARCHAR(20) DEFAULT '#1e3a8a',
  `initials` VARCHAR(5) NOT NULL,
  `iso_role` VARCHAR(255) NOT NULL COMMENT 'บทบาทหน้าที่ตามมาตรฐาน ISO 9001 / ISO 27001',
  `weekly_target_hrs` DECIMAL(5,2) DEFAULT 40.00,
  `sla_target_pct` DECIMAL(5,2) DEFAULT 95.00,
  `status` ENUM('Active', 'Inactive', 'OnLeave') DEFAULT 'Active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table: it_task_weights (ค่าน้ำหนักงานตามระดับความซับซ้อนและความเสี่ยง ISO)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_task_weights` (
  `tier_code` VARCHAR(30) PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `multiplier` DECIMAL(3,2) NOT NULL DEFAULT 1.00,
  `description` TEXT,
  `sla_target_hrs` DECIMAL(5,2) DEFAULT 4.00,
  `color_code` VARCHAR(20) DEFAULT '#3b82f6',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table: it_tasks (แบบบันทึกงานประจำวัน FR-IT-ISO-021)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_tasks` (
  `id` VARCHAR(30) PRIMARY KEY COMMENT 'รหัสงาน TSK-YYYYMMDD-XXX',
  `ticket_no` VARCHAR(50) DEFAULT NULL COMMENT 'เลขที่ Ticket จาก GLPI เช่น INC-84920',
  `staff_id` INT UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL COMMENT 'รายละเอียดงาน',
  `category` VARCHAR(30) NOT NULL COMMENT 'tier_1, tier_2, tier_3, project_iso, routine_admin',
  `raw_hours` DECIMAL(5,2) NOT NULL DEFAULT 1.00 COMMENT 'ชั่วโมงปฏิบัติงานจริง',
  `multiplier` DECIMAL(3,2) NOT NULL DEFAULT 1.00,
  `weighted_hours` DECIMAL(5,2) NOT NULL DEFAULT 1.00 COMMENT 'ชั่วโมงถ่วงน้ำหนักตาม ISO',
  `status` ENUM('Pending', 'In Progress', 'Completed', 'Cancelled') DEFAULT 'Completed',
  `priority` ENUM('Low', 'Medium', 'High', 'Critical') DEFAULT 'Medium',
  `iso_clause` VARCHAR(100) DEFAULT 'ISO 9001: 8.5.1',
  `time_start` TIME DEFAULT NULL,
  `time_end` TIME DEFAULT NULL,
  `subtasks_json` TEXT COMMENT 'รายการขั้นตอนการทำงานย่อย (JSON Array)',
  `remarks` TEXT,
  `task_date` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_task_staff (`staff_id`),
  INDEX idx_task_date (`task_date`),
  CONSTRAINT `fk_tasks_staff` FOREIGN KEY (`staff_id`) REFERENCES `it_staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table: it_signoffs (การลงนามรับรองเอกสารอิเล็กทรอนิกส์ ISO Audit Trail)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_signoffs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `form_code` VARCHAR(30) NOT NULL COMMENT 'FR-IT-ISO-021, FR-IT-ISO-022, FR-IT-ISO-023, FR-IT-ISO-024',
  `report_date` DATE NOT NULL,
  `submitter_id` INT UNSIGNED NOT NULL COMMENT 'ผู้ส่งรายงาน (Team Leader หรือ ผู้รับผิดชอบ)',
  `submitter_signed_at` DATETIME DEFAULT NULL,
  `approver_id` INT UNSIGNED NOT NULL COMMENT 'ผู้อนุมัติ (IT Manager)',
  `approver_signed_at` DATETIME DEFAULT NULL,
  `status` ENUM('Draft', 'Submitted', 'Approved', 'Rejected') DEFAULT 'Submitted',
  `remarks` TEXT,
  `iso_verified` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_signoff_date (`report_date`, `form_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table: it_checklists (ตรวจเช็ก 4 ระบบหลัก FR-IT-ISO-024)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_checklists` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `form_code` VARCHAR(30) DEFAULT 'FR-IT-ISO-024',
  `check_date` DATE NOT NULL,
  `system_code` VARCHAR(20) NOT NULL COMMENT 'server, backup, cctv, meeting',
  `system_name` VARCHAR(150) NOT NULL,
  `item_code` VARCHAR(20) NOT NULL,
  `item_title` VARCHAR(255) NOT NULL,
  `criteria` TEXT NOT NULL,
  `status` ENUM('Normal', 'Warning', 'Critical', 'NA') DEFAULT 'Normal',
  `current_value` VARCHAR(255) DEFAULT NULL,
  `note` TEXT,
  `checked_by_id` INT UNSIGNED NOT NULL,
  `checked_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_chk_date (`check_date`),
  INDEX idx_chk_sys (`system_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table: it_kpi_cards (การ์ด KPI แบบ Dynamic)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_kpi_cards` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `card_key` VARCHAR(50) NOT NULL UNIQUE,
  `title` VARCHAR(150) NOT NULL,
  `title_en` VARCHAR(150) DEFAULT NULL,
  `value` VARCHAR(50) NOT NULL,
  `unit` VARCHAR(20) DEFAULT NULL,
  `subtext` VARCHAR(255) DEFAULT NULL,
  `icon` VARCHAR(50) DEFAULT 'bi-graph-up',
  `color` VARCHAR(20) DEFAULT 'primary',
  `badge` VARCHAR(50) DEFAULT NULL,
  `trend` VARCHAR(100) DEFAULT NULL,
  `trend_type` VARCHAR(20) DEFAULT 'success',
  `iso_ref` VARCHAR(50) DEFAULT NULL,
  `is_enabled` TINYINT(1) DEFAULT 1,
  `sort_order` INT DEFAULT 0,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table: it_rebalance_logs (บันทึกประวัติการปรับสมดุลภาระงาน FR-IT-ISO-022)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_rebalance_logs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `suggestion_id` VARCHAR(30) DEFAULT NULL,
  `from_staff_id` INT UNSIGNED NOT NULL,
  `to_staff_id` INT UNSIGNED NOT NULL,
  `task_title` VARCHAR(255) NOT NULL,
  `hours` DECIMAL(5,2) NOT NULL,
  `task_type` VARCHAR(30) NOT NULL,
  `reason` TEXT NOT NULL,
  `impact_from` VARCHAR(50) DEFAULT NULL,
  `impact_to` VARCHAR(50) DEFAULT NULL,
  `applied_by_id` INT UNSIGNED NOT NULL,
  `applied_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------------------------------------------------------
-- Table: it_audit_logs (ประวัติความมั่นคงปลอดภัย ISO 27001 A.8.16)
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `it_audit_logs` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `event_type` VARCHAR(50) NOT NULL,
  `iso_standard` VARCHAR(50) NOT NULL,
  `description` TEXT NOT NULL,
  `user_email` VARCHAR(120) NOT NULL,
  `ip_address` VARCHAR(45) DEFAULT '127.0.0.1',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- SEED INITIAL DATA
-- ============================================================================

-- 1. Insert 6 Staff Members
INSERT INTO `it_staff` (`id`, `name`, `name_en`, `position`, `role_tier`, `tier_code`, `email`, `ext`, `mobile`, `avatar_color`, `initials`, `iso_role`, `weekly_target_hrs`, `sla_target_pct`, `status`)
VALUES
(1, 'นายบิณฑ์ สิงห์โตศรี', 'Mr. Bin Singtosi', 'IT Manager / ผู้จัดการฝ่ายเทคโนโลยีสารสนเทศ', 'Manager', 'mgmt', 'bin.si@age.co.th', '1101', '081-xxx-1101', '#1e3a8a', 'BS', 'ISO ISMS / QMS Management Representative & Final Approver', 40.00, 99.00, 'Active'),
(2, 'นายวุฒิพงศ์ สินธุมาศ', 'Mr. Wuttiphong Sinthumas', 'IT Support Team Leader / หัวหน้าทีมสนับสนุนไอที', 'Team Leader', 'lead', 'wuttiphong.si@age.co.th', '1102', '089-xxx-1102', '#0284c7', 'WS', 'Incident Manager & Daily Operations Auditor (FR-IT-ISO-021)', 40.00, 98.00, 'Active'),
(3, 'นายวัฒนา สุขล้อม', 'Mr. Watthana Suklom', 'Senior IT Support Engineer / วิศวกรสนับสนุนไอทีอาวุโส', 'Senior Tier 2', 'tier_2', 'watthana.su@age.co.th', '1103', '086-xxx-1103', '#059669', 'WS', 'Physical & Network Infrastructure Custodian (FR-IT-ISO-024 §3)', 40.00, 96.00, 'Active'),
(4, 'นายปิยะณัฐ โหระวงค์', 'Mr. Piyanat Horawong', 'Senior Infrastructure & Security Specialist / ผู้เชี่ยวชาญโครงสร้างพื้นฐานและความปลอดภัย', 'Senior Tier 3', 'tier_3', 'piyanat.ho@age.co.th', '1104', '084-xxx-1104', '#7c3aed', 'PH', 'ISO 27001 Security Controls Lead (FR-IT-ISO-024 §1-§2)', 40.00, 97.00, 'Active'),
(5, 'นายนฐวรรธน์ อินสวาท', 'Mr. Natthawat Inswat', 'IT Support Specialist / เจ้าหน้าที่สนับสนุนงานไอที', 'Staff Tier 1', 'tier_1', 'natthawat.in@age.co.th', '1105', '083-xxx-1105', '#ea580c', 'NI', 'Helpdesk Log Custodian & Meeting Room Readiness (FR-IT-ISO-024 §4)', 40.00, 95.00, 'Active'),
(6, 'นายธีรพงษ์ บุญเลี้ยง', 'Mr. Teerapong Boonliang', 'IT Support Apprentice / ผู้ช่วยเจ้าหน้าที่สนับสนุนไอที (ฝึกงาน)', 'Intern', 'tier_1', 'teerapong.bo@age.co.th', '1106', '082-xxx-1106', '#475569', 'TB', 'Routine Inspection Assistant (Under supervision of Team Leader)', 40.00, 90.00, 'Active')
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `position`=VALUES(`position`), `email`=VALUES(`email`);

-- 2. Insert Task Weights
INSERT INTO `it_task_weights` (`tier_code`, `name`, `multiplier`, `description`, `sla_target_hrs`, `color_code`)
VALUES
('tier_1', 'Tier 1: General & End-User Support', 1.00, 'Helpdesk, Password reset, Printer, Basic software, Equipment dispatch', 2.00, '#3b82f6'),
('tier_2', 'Tier 2: System, Network & Hardware', 1.50, 'LAN/Wi-Fi troubleshooting, OS recovery, CCTV maintenance, Hardware replacement', 4.00, '#10b981'),
('tier_3', 'Tier 3: Core Server, Security & Cloud', 2.50, 'VMware/Hyper-V, Active Directory, Firewall, Cyber incident, Database/ERP', 8.00, '#f59e0b'),
('project_iso', 'Project & ISO Compliance Audit', 3.00, 'ISO 9001/27001 Internal Audit, DR Drill, Infrastructure upgrade, Policy review', 24.00, '#8b5cf6'),
('routine_admin', 'Routine Checklist & Preventive Ops', 1.00, 'Morning server check, Backup log audit, Meeting room readiness, Documentation', 1.00, '#64748b')
ON DUPLICATE KEY UPDATE `multiplier`=VALUES(`multiplier`);

-- 3. Insert Dynamic KPI Cards
INSERT INTO `it_kpi_cards` (`card_key`, `title`, `title_en`, `value`, `unit`, `subtext`, `icon`, `color`, `badge`, `trend`, `trend_type`, `iso_ref`, `is_enabled`, `sort_order`)
VALUES
('card_active_tasks', 'งานที่กำลังดำเนินการ (Active Tasks)', 'Active Operations', '24', 'งาน', 'เสร็จสิ้นแล้ว 18 งาน (75%)', 'bi-list-check', 'primary', 'Daily Ops', '+4 จากเมื่อวาน', 'info', 'FR-IT-ISO-021', 1, 1),
('card_sla_rate', 'อัตราการแก้ไขตาม SLA (SLA Compliance)', 'SLA Resolution Rate', '98.8%', '', 'เป้าหมายองค์กร ≥ 95.0%', 'bi-shield-check', 'success', 'ISO 9001: 8.5.1', '+0.6% สูงกว่าเกณฑ์', 'success', 'QMS-SLA-01', 1, 2),
('card_team_capacity', 'อัตราการใช้ศักยภาพทีม (Team Capacity)', 'Team Capacity Utilization', '89.4%', '', '214.5 / 240 ชม. (สมดุลดี)', 'bi-speedometer2', 'info', 'ISO 27001: A.8.6', 'อยู่ในเกณฑ์ Optimal (80-95%)', 'info', 'FR-IT-ISO-022', 1, 3),
('card_critical_infra', 'ความพร้อมระบบหลัก (Core Uptime)', 'Infrastructure Availability', '99.98%', '', 'Server, Backup, CCTV, Network', 'bi-hdd-rack', 'success', 'High Availability', '0 Incident ใน 30 วัน', 'success', 'FR-IT-ISO-024', 1, 4),
('card_security_compliance', 'การปฏิบัติตามความปลอดภัย (Security Audit)', 'Security Controls Check', '100%', '', 'Veeam Backup & Access Log ตรวจครบ', 'bi-file-earmark-lock2', 'purple', 'ISO 27001: A.8.16', 'ผ่านการรับรอง Audit Ready', 'success', 'ISMS-SEC-04', 1, 5),
('card_pending_signoff', 'รออนุมัติ / ลงนาม (Pending Sign-Off)', 'Sign-Off Pending', '1', 'รายการ', 'รอบบ่ายวันที่ 06/11/2026', 'bi-pen', 'warning', 'ISO Audit Trail', 'รอ Manager Sign-off', 'warning', 'FR-IT-ISO-021 §4', 1, 6)
ON DUPLICATE KEY UPDATE `value`=VALUES(`value`);

-- 4. Initial Audit Log
INSERT INTO `it_audit_logs` (`event_type`, `iso_standard`, `description`, `user_email`)
VALUES
('SYSTEM_INITIALIZE', 'ISO 9001:2015 & ISO 27001:2022', 'ระบบ IT Staff Tasks, Workload & Responsibility Audit System ได้รับการติดตั้งและเชื่อมโยงฐานข้อมูลสำเร็จ', 'bin.si@age.co.th');

SET FOREIGN_KEY_CHECKS = 1;
