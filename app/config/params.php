<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    'roles' => [
        'super-admin' => [
          'label' => 'Super Admin',
          'module_access' => [
              "site" => [
                  "about", 
                  "contact", 
                  "forgot-password", 
                  "index", 
                  "login", 
                  "logout", 
                  "reset-password" 
              ], 
              "user" => [
                  "create", 
                  "delete", 
                  "index", 
                  "update", 
                  "view" 
              ], 
              "role" => [
                  "create", 
                  "delete", 
                  "index", 
                  "reset-module-access", 
                  "reset-navigation", 
                  "update", 
                  "update-navigation", 
                  "view" 
              ],
              "file" => [
                  "upload", 
                  "display", 
                  "download", 
                  "create", 
                  "delete", 
                  "index", 
                  "update", 
                  "view" 
              ] 
            ],
          'role_access' => [],
          'navigations' => [
              'home' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Home',
                'url' => 'site/index',
                'actions' => [
                ],
              ],
              'site' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Site',
                'url' => 'site/index',
                'actions' => [
                  'about' => [
                      'icon' => '<i class="flaticon2-group text-white"></i>',
                      'label' => 'About',
                      'url' => 'site/about',
                      'actions' => [],
                    ],
                  'contact' => [
                      'icon' => '<i class="flaticon2-group text-white"></i>',
                      'label' => 'Contact',
                      'url' => 'site/contact',
                      'actions' => [],
                    ],
                ],
              ],
              'users' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Users',
                'url' => 'user/index',
                'actions' => [
                ],
              ],
              'file' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Files',
                'url' => 'file/index',
                'actions' => [
                ],
              ],
              'access-control' => [
                'icon' => '<i class="flaticon2-user-1 text-white"></i>',
                'label' => 'Access Control',
                'url' => 'role/index',
                'actions' => [
                ],
              ],
          ]
        ],
        'admin' => [
          'label' => 'Admin',
          'module_access' => [
              "site" => [
                  "about", 
                  "contact", 
                  "forgot-password", 
                  "index", 
                  "login", 
                  "logout", 
                  "reset-password" 
              ], 
              "user" => [
                  "create", 
                  "index", 
                  "update", 
                  "view" 
              ], 
              "role" => [
                  "create", 
                  "index", 
                  "update", 
                  "update-navigation", 
                  "view" 
              ],
              "file" => [
                  "upload", 
                  "display", 
                  "download", 
                  "index", 
                  "update", 
                  "view" 
              ] 
            ],
          'role_access' => [],
          'navigations' => [
              'home' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Home',
                'url' => 'site/index',
                'actions' => [
                ],
              ],
              'site' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Site',
                'url' => 'site/index',
                'actions' => [
                  'about' => [
                      'icon' => '<i class="flaticon2-group text-white"></i>',
                      'label' => 'About',
                      'url' => 'site/about',
                      'actions' => [],
                    ],
                  'contact' => [
                      'icon' => '<i class="flaticon2-group text-white"></i>',
                      'label' => 'Contact',
                      'url' => 'site/contact',
                      'actions' => [],
                    ],
                ],
              ],
              'users' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Users',
                'url' => 'user/index',
                'actions' => [
                ],
              ],
              'file' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Files',
                'url' => 'file/index',
                'actions' => [
                ],
              ],
              'access-control' => [
                'icon' => '<i class="flaticon2-user-1 text-white"></i>',
                'label' => 'Access Control',
                'url' => 'role/index',
                'actions' => [
                ],
              ],
          ],
        ],
        'user' => [
          'label' => 'User',
          'module_access' => [
              "site" => [
                  "about", 
                  "contact", 
                  "forgot-password", 
                  "index", 
                  "login", 
                  "logout", 
                  "reset-password" 
              ], 
              "file" => [
                  "upload", 
                  "display", 
                  "download", 
              ] 
            ],
          'role_access' => [],
          'navigations' => [
              'home' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Home',
                'url' => 'site/index',
                'actions' => [],
              ],
              'site' => [
                'icon' => '<i class="flaticon2-group text-white"></i>',
                'label' => 'Site',
                'url' => 'site/index',
                'actions' => [
                  'about' => [
                      'icon' => '<i class="flaticon2-group text-white"></i>',
                      'label' => 'About',
                      'url' => 'site/about',
                      'actions' => [],
                    ],
                  'contact' => [
                      'icon' => '<i class="flaticon2-group text-white"></i>',
                      'label' => 'Contact',
                      'url' => 'site/contact',
                      'actions' => [],
                    ],
                ],
              ],
          ],
        ],
    ]
];

 