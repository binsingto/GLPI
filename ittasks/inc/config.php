<?php
/**
 * IT Staff Tasks, Workload & Responsibility Audit System
 * Enterprise Reports - IT Support Department
 * บมจ. เอเชีย กรีน เอนเนอจี (Asia Green Energy PCL - AGE)
 * 
 * Standards Compliance:
 * - ISO 9001:2015 (Clause 7.1.2 People, 7.1.6 Organizational Knowledge, 8.5.1 Service Provision, 9.1.3 Analysis)
 * - ISO/IEC 27001:2022 (Control 5.2 Roles & Responsibilities, 8.6 Capacity Management, 8.16 Monitoring)
 */

if (!defined('AGE_IT_SYSTEM')) {
    define('AGE_IT_SYSTEM', true);
}

// System Metadata
define('SYS_NAME', 'IT Staff Tasks, Workload & Responsibility Audit System');
define('SYS_NAME_TH', 'ระบบตรวจสอบภาระงาน บทบาทหน้าที่ และวิเคราะห์ศักยภาพทีม IT Support');
define('SYS_VERSION', '2.5.0-Enterprise');
define('COMPANY_NAME_TH', 'บริษัท เอเชีย กรีน เอนเนอจี จำกัด (มหาชน)');
define('COMPANY_NAME_EN', 'Asia Green Energy Public Company Limited (AGE)');
define('DEPARTMENT_NAME', 'ฝ่ายเทคโนโลยีสารสนเทศและสนับสนุนระบบงาน (IT Support & Infrastructure)');

// ISO Controlled Form Numbers & Revisions
define('ISO_DOC_DAILY', 'FR-IT-ISO-021');
define('ISO_DOC_DAILY_REV', 'Rev. 04 (01/01/2026)');
define('ISO_DOC_WEEKLY', 'FR-IT-ISO-022');
define('ISO_DOC_WEEKLY_REV', 'Rev. 03 (01/01/2026)');
define('ISO_DOC_MONTHLY', 'FR-IT-ISO-023');
define('ISO_DOC_MONTHLY_REV', 'Rev. 05 (01/01/2026)');
define('ISO_DOC_CHECKLIST', 'FR-IT-ISO-024');
define('ISO_DOC_CHECKLIST_REV', 'Rev. 04 (01/01/2026)');

// Standard Working Capacity (Hours)
define('WORK_HOURS_PER_DAY', 8.0);
define('WORK_DAYS_PER_WEEK', 5);
define('WORK_HOURS_PER_WEEK', 40.0);
define('WORK_HOURS_PER_MONTH', 160.0);

// Capacity Thresholds (Percentage)
define('THRESHOLD_OVERLOAD', 110.0);    // Red alert: > 110%
define('THRESHOLD_HIGH', 95.0);          // Warning: 95% - 110%
define('THRESHOLD_OPTIMAL_MIN', 80.0);   // Target: 80% - 94%
define('THRESHOLD_UNDER', 70.0);         // Available: < 70%

// Task Weight Multipliers (Complexity and Risk Factor for ISO 27001 & 9001)
$TASK_WEIGHTS = [
    'tier_1' => [
        'name' => 'Tier 1: General & End-User Support',
        'multiplier' => 1.0,
        'description' => 'Helpdesk, Password reset, Printer, Basic software, Equipment dispatch',
        'sla_target_hrs' => 2.0,
        'color' => '#3b82f6'
    ],
    'tier_2' => [
        'name' => 'Tier 2: System, Network & Hardware',
        'multiplier' => 1.5,
        'description' => 'LAN/Wi-Fi troubleshooting, OS recovery, CCTV maintenance, Hardware replacement',
        'sla_target_hrs' => 4.0,
        'color' => '#10b981'
    ],
    'tier_3' => [
        'name' => 'Tier 3: Core Server, Security & Cloud',
        'multiplier' => 2.5,
        'description' => 'VMware/Hyper-V, Active Directory, Firewall, Cyber incident, Database/ERP',
        'sla_target_hrs' => 8.0,
        'color' => '#f59e0b'
    ],
    'project_iso' => [
        'name' => 'Project & ISO Compliance Audit',
        'multiplier' => 3.0,
        'description' => 'ISO 9001/27001 Internal Audit, DR Drill, Infrastructure upgrade, Policy review',
        'sla_target_hrs' => 24.0,
        'color' => '#8b5cf6'
    ],
    'routine_admin' => [
        'name' => 'Routine Checklist & Preventive Ops',
        'multiplier' => 1.0,
        'description' => 'Morning server check, Backup log audit, Meeting room readiness, Documentation',
        'sla_target_hrs' => 1.0,
        'color' => '#64748b'
    ]
];

// ISO Standards Clauses Definition
$ISO_STANDARDS = [
    'ISO_9001_2015' => [
        'title' => 'ISO 9001:2015 Quality Management System (QMS)',
        'clauses' => [
            '7.1.2' => 'People - Competence & allocation of personnel',
            '7.1.6' => 'Organizational Knowledge',
            '8.5.1' => 'Control of Production & Service Provision (SLA)',
            '9.1.3' => 'Analysis & Evaluation of IT Performance'
        ]
    ],
    'ISO_27001_2022' => [
        'title' => 'ISO/IEC 27001:2022 Information Security Management System (ISMS)',
        'controls' => [
            'A.5.2' => 'Information security roles and responsibilities',
            'A.5.8' => 'Information security in project management',
            'A.8.6' => 'Capacity management & resource allocation',
            'A.8.16' => 'Monitoring activities & log review',
            'A.8.19' => 'Information deletion and backup verification'
        ]
    ]
];

// File paths
define('PATH_INC', __DIR__ . '/');
define('PATH_CARDS_JSON', __DIR__ . '/cards_config.json');
define('PATH_EMAIL_JSON', __DIR__ . '/email_config.json');
define('PATH_TITLES_JSON', __DIR__ . '/report_titles.json');
define('PATH_DB_FILE', __DIR__ . '/ittasks.sqlite');
