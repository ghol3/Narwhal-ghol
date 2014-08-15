<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 06.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Model\String
 */
    
namespace
    Blacklist\Model\String;
    
/**
 * This class just defined the config strings.
 * 
 * @author Томас Петр <www.beepix.com>
 */  
class TableString
{
    CONST
        MENU            = 'prefix_menus',
        SUBMENU         = 'prefix_submenus',
        ARTICLE         = 'prefix_articles',
        PAGE            = 'prefix_pages',
        COMMENT         = 'prefix_comments',
        CATEGORY        = 'prefix_categories',
        USER            = 'prefix_users',
        USERINFO        = 'prefix_userinfos',
        FORMKEYS        = 'prefix_security_admin_keys',
        BASIC_SETTINGS	= 'prefix_settings',
        PANEL           = 'prefix_panels',
        SUB_CATEGORY	= 'prefix_subcategories',
        MODULES         = 'prefix_modules',
        PRODUCTS        = 'prefix_product',
        TASKS           = 'prefix_tasks',
        PRODUCT_IMG     = 'prefix_productimg',
        LINKS           = 'prefix_links',
        PRODUCT_TYPES   = 'prefix_product_types',
        PRODUCT_ADDS    = 'prefix_product_additionals',
        ORDERS          = 'prefix_orders',
        ORDER_PRODUCTS  = 'prefix_order_products',
        DEALERS         = 'prefix_dealers',
        ORDER_EMAILS    = 'prefix_orders_emails',
        ORDER_LANGUAGES = 'prefix_order_language',
        WAREHOUSE_LOG   = 'prefix_warehouse_log',
        WAREHOUSE       = 'prefix_warehouse',
        WIDGETS         = 'prefix_widgets',
        LOGS            = 'prefix_log',
        PRODUCT_TAB     = 'prefix_product_tab',
        FORUM_POSTS     = 'prefix_forum_posts',
        FORUM_TOPIC     = 'prefix_forum_topic',
        SCORE           = 'prefix_score',
        TURNOVER        = 'turnover';
    
    
    CONST
        ADMIN_SALT      = '2bf60545b8971c98db78e824d14c2837',
        HASH_TYPE       = 'sha512';
}