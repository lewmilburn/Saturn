<?php
    function checkInput($mode, $data) {
        global $conn;

        if(SECURITY_ACTIVE == true) {
            $data = mysqli_real_escape_string($conn, $data);
            if ($mode == 'DEFAULT') {
                $data = htmlspecialchars($data);
            } else if ($mode == 'HTML') {
                if (strpos($data, '<script') !== false) { log_security_blocked('JavaScript');
                    if(SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<script", "&lt;script");
                    } else if (SECURITY_MODE == 'stop') {header('Location: '.CONFIG_INSTALL_URL.'/panel/system/error/?err=security');exit;}
                }
                if (strpos($data, '<style') !== false) { log_security_blocked('CSS');
                    if(SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<style", "&ltstyle");
                    } else if (SECURITY_MODE == 'stop') {header('Location: '.CONFIG_INSTALL_URL.'/panel/system/error/?err=security');exit;}
                }
                if (strpos($data, 'style =') !== false) { log_security_blocked('CSS');
                    if(SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "style =", "saturn_blocked_data =");
                    } else if (SECURITY_MODE == 'stop') {header('Location: '.CONFIG_INSTALL_URL.'/panel/system/error/?err=security');exit;}
                }
                if (strpos($data, 'style=') !== false) { log_security_blocked('CSS');
                    if(SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "style=", "saturn_blocked_data=");
                    } else if (SECURITY_MODE == 'stop') {header('Location: '.CONFIG_INSTALL_URL.'/panel/system/error/?err=security');exit;}
                }
                if (strpos($data, '<link') !== false) { log_security_blocked('External CSS');
                    if(SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<link", "&lt;link");
                    } else if (SECURITY_MODE == 'stop') {header('Location: '.CONFIG_INSTALL_URL.'/panel/system/error/?err=security');exit;}
                }
                if (strpos($data, '<?') !== false) { log_security_blocked('PHP');
                    if(SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<?", "&lt;?");
                    } else if (SECURITY_MODE == 'stop') {header('Location: '.CONFIG_INSTALL_URL.'/panel/system/error/?err=security');exit;}
                }
            } else if ($mode = 'TAGCSS') {
                if (strpos($data, '<script') !== false) {
                    log_security_blocked('JavaScript');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<script", "&lt;script");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<style') !== false) {
                    log_security_blocked('CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<style", "&lt;style");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<link') !== false) {
                    log_security_blocked('External CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<link", "&lt;link");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<?') !== false) {
                    log_security_blocked('PHP');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<?", "&lt;?");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
            } else if ($mode == 'CSS') {
                if (strpos($data, '<script') !== false) {
                    log_security_blocked('JavaScript');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<script", "&lt;script");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<link') !== false) {
                    log_security_blocked('External CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<link", "&lt;link");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<?') !== false) {
                    log_security_blocked('PHP');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<?", "&lt;?");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
            } else if ($mode == 'JS') {
                if (strpos($data, '<style') !== false) {
                    log_security_blocked('CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<style", "&lt;style");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<link') !== false) {
                    log_security_blocked('External CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<link", "&lt;link");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, 'style =') !== false) {
                    log_security_blocked('CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "style =", "blocked =");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, 'style=') !== false) {
                    log_security_blocked('CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "style=", "blocked=");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<script src=') !== false) {
                    log_security_blocked('External JavaScript');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<script src=", "&lt;script src=");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<script src =') !== false) {
                    log_security_blocked('External JavaScript');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<script src =", "&lt;script src =");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<?') !== false) {
                    log_security_blocked('PHP');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<?", "&lt;?");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
            } else if ($mode == 'ALL') {
                if (strpos($data, '<script src=') !== false) {
                    log_security_blocked('External JavaScript');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<script src=", "&lt;script src=");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<link') !== false) {
                    log_security_blocked('External CSS');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<link", "&lt;link");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
                if (strpos($data, '<?') !== false) {
                    log_security_blocked('PHP');
                    if (SECURITY_MODE == 'clean') {
                        $data = str_ireplace($data, "<?", "&lt;?");
                    } else if (SECURITY_MODE == 'stop') {
                        header('Location: ' . CONFIG_INSTALL_URL . '/panel/system/error/?err=security');
                        exit;
                    }
                }
            }
        }
        return $data;
    }