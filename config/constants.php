<?php
return [
    'STATUS' => [
        "PENDING" => 'อยู่ระหว่างตรวจสอบเอกสาร',
        "ACTIVE" => 'ใช้งาน',
        "BLOCK" => 'บล็อก',
        "REJECT" => 'ปฏิเสธเอกสาร',
        "APPROVED" => 'ได้รับการอนุมัติ',
    ],
    'GLOBAL_PERMISSIONS' => [ //permission is = permission=>label of permission
        'USERS' => [
            'create users' => 'create',
            'read users' => 'read',
            'update users' => 'update',
            'delete users' => 'delete',
            'user manage permission' => 'permission management',
        ],
        'TAGS' => [
            'create tags' => 'create',
            'read tags' => 'read',
            'update tags' => 'update',
            'delete tags' => 'delete',
        ],
        'DOCUMENTS' => [
            'create documents' => 'create',
            'read documents' => 'read',
            'update documents' => 'update',
            'delete documents' => 'delete',
            'verify documents' => 'verify',
        ]
    ],
    'TAG_LEVEL_PERMISSIONS' => [
        'read documents in tag ' => 'read (อ่าน)',
        'create documents in tag ' => 'create (สร้าง)',
        'update documents in tag ' => 'update (อัปเดท)',
        'delete documents in tag ' => 'delete (ลบ)',
        'verify documents in tag ' => 'verify (อนุมัติ)',
    ],
    'DOCUMENT_LEVEL_PERMISSIONS' => [
        'read document ' => 'read (อ่าน)',
        'update document ' => 'update (อัปเดท)',
        'delete document ' => 'delete (ลบ)',
        'verify document ' => 'verify (อนุมัติ)',
    ]
];
