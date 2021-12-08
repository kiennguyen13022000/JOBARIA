<?php

// ====================== PATHS ===========================
const DS = '/';
define ('ROOT_PATH'			, dirname(__FILE__));						// Định nghĩa đường dẫn đến thư mục gốc
const LIBRARY_PATH = ROOT_PATH . DS . 'libs' . DS;            // Định nghĩa đường dẫn đến thư mục thư viện
const PUBLIC_PATH = ROOT_PATH . DS . 'public' . DS;            // Định nghĩa đường dẫn đến thư mục public
const APPLICATION_PATH = ROOT_PATH . DS . 'app' . DS;        // Định nghĩa đường dẫn đến thư mục application


const TEMPLATE_PATH = PUBLIC_PATH . 'template' . DS;
const DEFAULT_MODULE = 'default';
const DEFAULT_CONTROLLER = 'index';
const DEFAULT_ACTION = 'index';

// ====================== DATABASE ===========================
const DB_HOST = 'localhost';
const DB_USER = 'admin';
const DB_PASS = 'adminspassword';
const DB_NAME = 'jobaria';
const DB_TABLE = 'users';

// ====================== DATABASE TABLE===========================

