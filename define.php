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
const DOMAIN_NAME = 'jobaria.local';
const PAGE_NAME = 'Jobaria';
const EMAIL_TEMPLATE_SUBSCRIBE = 1;
const EMAIL_TEMPLATE_ORDER_SUCCESS = 2;
const EMAIL_TEMPLATE_CONFIRM_ORDER_SUCCESSFULL = 3;

// ====================== DATABASE ===========================
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'jobaria';
const DB_TABLE = 'users';

// ====================== DATABASE TABLE===========================

