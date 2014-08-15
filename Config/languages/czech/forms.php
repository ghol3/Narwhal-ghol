<?php

    #
    # ARTICLE FORM TRANSLATION
    #
    
    # ARTICLE TITLE                     | TEXT INPUT
    define('ART_TITLE_LABEL'            , 'Titulek:'                                            );
    define('ART_TITLE_REQ'              , 'Zadejte prosím titulek článku, toto pole je povinné.');
    define('ART_TITLE_RULE_MIN_LENGTH'  , 'Titulek článku musí obsahovat minimálně 5 znaků.'    );
    define('ART_TITLE_RULE_MAX_LENGTH'  , 'Titulek článku musí obsahovat maximálně 50 znaků.'   );
    # ARTICLE URL ADDRESS               | TEXT INPUT
    define('ART_LINK_LABEL'             , 'Url adresa:'                                         );
    define('ART_LINK_REQ'               , 'Zadejte prosím url adresu článku, pole je povinné.'  );
    define('ART_LINK_RULE_MIN_LENGTH'   , 'URL adresa musí obsahovat minimálně 5 znaků.'        );
    define('ART_LINK_RULE_MAX_LENGTH'   , 'URL adresa musí obsahovat maximálně 50 znaků'        );
    # ARTICLE CATEGORIES                | SELECT ( COMBO BOX )
    define('ART_CATEGORY_LABEL'         , 'Kategorie:'                                          );
    # ARTICLE DESCRIPTION TEXT          | TEXT AREA
    define('ART_DESCRIPTION_LABEL'      , 'Krátký popisek tohoto článku:'                       );
    # ARTICLE CONTENT TEXT              | TEXT AREA
    define('ART_CONTENT_LABEL'          , 'Obsah tohoto článku:'                                );
    # ARTICLE IMAGE                     | UPLOAD BUTTON
    define('ART_IMAGE_LABEL'            , 'Obrázek článku:'                                     );
    define('ART_IMAGE_RULE_IMAGE'       , 'Můžete nahrát pouze obrázek (JPEG, PNG nebo GIF).'   );
    define('ART_IMAGE_RULE_SIZE'        , 'Maximalní velikost obrázku pro článek je 500 kB.'    );
    # ARTICLE ENABLE SCORE?             | CHECK BOX
    define('ART_ENABLE_SCORE_LABEL'     , 'Povolit hodnocení?'                                  );
    # ARTICLE ENABLE VIEWS?             | CHECK BOX
    define('ART_ENABLE_VIEWS_LABEL'     , 'Povolit počitání shlédnutí?'                         );
    # ARTICLE ENABLE COMMENTS?          | CHECK BOX
    define('ART_ENABLE_COMMENTS_LABEL'  , 'Povolit komentáře?'                                  );
    # ARTICLE VISIBLE?                  | CHECK BOX
    define('ART_VISIBLE_LABEL'          , 'Publikovat?'                                         );
    # ARTICLE CONFIRM                   | INPUT SUBMIT
    define('ART_SUBMIT_VALUE_ADD'       , 'Přidat článek!'                                      );
    define('ART_SUBMIT_VALUE_EDIT'      , 'Editovat článek!'                                    );
    
    #
    # CATEGORY FORM TRANSLATION
    #
    
    # CATEGORY NAME                     | TEXT INPUT
    define('CTG_NAME_LABEL'             , 'Název kategorie:'                                    );
    define('CTG_NAME_REQ'               , 'Zadejte prosím název kategorie, je to povinné.'      );
    define('CTG_NAME_MIN_LENGTH'        , 'Název musí obsahovat minimálně 5 znaků.'             );
    define('CTG_NAME_MAX_LENGTH'        , 'Název musí obsahovat maximálně 50 znaků.'            );
    # CATEGORY DESCRIPTION              | TEXT AREA
    define('CTG_DESCRIPTION_LABEL'      , 'Krátký popis kategorie:'                             );
    # CATEGORY VISIBILITY               | CHECK BOX
    define('CTG_VISIBLE_LABEL'          , 'Aktivní'                                             );
    # CATEGORY SEND BUTTON              | INPUT SUBMIT
    define('CTG_SUBMIT_VALUE_ADD'       , 'Vytvořit kategorii!'                                 );
    define('CTG_SUBMIT_VALUE_EDIT'      , 'Editovat kategorii!'                                 );
    
    #
    # COMMENT FORM TRANSLATION
    #
    
    # COMMENT CONTENT                   | TEXT AREA
    define('CMNT_CONTENT_LABEL'         , 'Obsah komentáře:'                                    );
    define('CMNT_CONTENT_REQ'           , 'Nemůžete odeslat prázdnou zprávu.'                   );
    # COMMENT SEND BUTTON               | INPUT SUBMIT
    define('CMNT_SUBMIT_VALUE_ADD'      , 'Odeslat komentář!'                                   );
    define('CMNT_SUBMIT_VALUE_EDIT'     , 'Upravit komentář'                                    );
    
    #
    # MENU FORM TRANSLATION
    #
    
    # MENU NAME                         | TEXT INPUT
    define('MENU_NAME_LABEL'            , 'Název menu:'                                         );
    define('MENU_NAME_REQ'              , 'Název menu musí být vyplněn, učiňte tak prosím.'     );
    define('MENU_NAME_MIN_LENGTH'       , 'Název musí obsahovat minimálně 4 znaky.'             );
    define('MENU_NAME_MAX_LENGTH'       , 'Název musí obsahovat maximálně 40 znaků'             );
    # MENU URL ADDRESS                  | TEXT INPUT
    define('MENU_URL_LABEL'             , 'Url adresa:'                                         );
    define('MENU_URL_REQ'               , 'Url adresa musí být vyplněna. Prosím doplňte ji.'    );
    define('MENU_URL_MIN_LENGTH'        , 'Url adresa musí obsahovat minimálně 4 znaky.'        );
    define('MENU_URL_MAX_LENGTH'        , 'Url adresa musí obsahovat maximálně 40 znaků.'       );
    # MENU DESCRIPTION                  | TEXT AREA
    define('MENU_DESCRIPTION_LABEL'     , 'Krátký popisek menu:'                                );
    # MENU IMAGE                        | UPLOAD BUTTON
    define('MENU_IMAGE_LABEL'           , 'Obrázek:'                                            );
    define('MENU_IMAGE_RULE_IMAGE'      , 'Obrázek musí být ve formátu (JPEG, PNG nebo GIF).'   );
    define('MENU_IMAGE_RULE_SIZE'       , 'Velikost obrázku musí být maximálně 80kB.'           );
    # MENU VISIBILITY                   | CHECK BOX
    define('MENU_VISIBILITY_LABEL'      , 'Zobrazovat menu'                                     );
    # MENU PARENT                       | SELECT
    define('MENU_PARENT_LABEL'          , 'Otec:'                                               );
    define('MENU_NO_PARENT'             , 'Žádný'                                               );
    # MENU SEND BUTTON                  | INPUT SUBMIT
    define('MENU_SUBMIT_VALUE_ADD'      , 'Přidat menu'                                         );
    define('MENU_SUBMIT_VALUE_EDIT'     , 'Upravit menu'                                        );
    
    #
    # PAGE FORM TRANSLATION
    #
    
    # PAGE TITLE                        | TEXT INPUT
    define('PAGE_TITLE_LABEL'           , 'Titulek stránky:'                                     );
    define('PAGE_TITLE_REQ'             , 'Titulek stránky musí být vyplněn.'                    );
    define('PAGE_TITLE_MIN_LENGTH'      , 'Titulek musí obsahovat minimálně 4 znaky.'            );
    define('PAGE_TITLE_MAX_LENGTH'      , 'Titulek musí obsahovat maximálně 50 znaků.'           );
    # PAGE URL ADDRESS                  | TEXT INPUT
    define('PAGE_URL_LABEL'             , 'Url:');
    define('PAGE_URL_REQ'               , 'Url adresa musí být vyplněna.'                        );
    define('PAGE_URL_MIN_LENGTH'        , 'Adresa musí obsahovat minimálně 4 znaky.'             );
    define('PAGE_URL_MAX_LENGTH'        , 'Adresa musí obsahovat maximálně 50 znaků.'            );
    # PAGE CATEGORY                     | SELECT
    define('PAGE_CATEGORY_LABEL'        , 'Kategorie:'                                           );
    # PAGE DESCRIPTION                  | TEXT AREA
    define('PAGE_DESCRIPTION_LABEL'     , 'Krátký popis stránky:'                                );
    # PAGE CONTENT                      | TEXT AREA
    define('PAGE_CONTENT_LABEL'         , 'Obsah stránky:'                                       );
    # PAGE VISIBILITY                   | CHECK BOX
    define('PAGE_VISIBILITY_LABEL'      , 'Publikovat stránku'                                   );
    # PAGE ENABLE VIEW CALCULATING?     | CHECK BOX
    define('PAGE_ENABLE_VIEWS_LABEL'    , 'Povolit počitání shlédnutí na stránce.'               );
    # PAGE ENABLE SCORE CALCULATING?    | CHECK BOX
    define('PAGE_ENABLE_SCORE_LABEL'    , 'Povolit hodnocení na stránce.'                        );
    # PAGE ENABLE COMMENTS?             | CHECK BOX
    define('PAGE_ENABLE_COMMENTS_LABEL' , 'Povolit komentáře na stránce.'                        );
    # PAGE SEND BUTTON                  | INPUT SUBMIT
    define('PAGE_SUBMIT_VALUE_ADD'      , 'Přidat stránku!'                                      );
    define('PAGE_SUBMIT_VALUE_EDIT'     , 'Uložit změny!'                                        );
    
    #
    # USER FORMS TRANSLATION
    #
    
    # ACCOUNT                           | TEXT INPUT
    define('USER_ACC_LABEL'             , 'Uživatelské jméno:'                                   );
    define('USER_ACC_REQ'               , 'Prosím vyplňte uživatelské jméno.'                    );
    define('USER_ACC_MIN_LENGTH'        , 'Délka účtu musí obsahovat minimálně 6 znaků.'         );
    define('USER_ACC_MAX_LENGTH'        , 'Délka účtu musí obsahovat maximálně 30 znaků.'        );
    # ACCOUNT LOGIN
    define('USER_ACC_LOGIN_LABEL'       , 'Učet:'                                                );
    define('USER_PASS_LOGIN_LABEL'      , 'Heslo:'                                               );
    # PASSWORD 1                        | PASSWORD TEXT INPUT
    define('USER_PASS1_LABEL'           , 'Zvolte si heslo:'                                     );
    define('USER_PASS1_REQ'             , 'Prosím, vyplňte heslo.'                               );
    define('USER_PASS1_MIN_LENGTH'      , 'Heslo musí obsahovat minimálně 6 znaků.'              );
    define('USER_PASS1_MAX_LENGTH'      , 'Heslo musí obsahovat maximálně 30 znakl.'             );
    # PASSWORD 2                        | PASSWORD TEXT INPUT
    define('USER_PASS2_LABEL'           , 'Znovu heslo pro kontrolu:'                            );
    define('USER_PASS2_REQ'             , 'Prosím, vyplňte heslo pro kontrolu.'                  );
    define('USER_PASS2_MIN_LENGTH'      , 'Heslo musí obsahovat minimálně 6 znaků.'              );
    define('USER_PASS2_MAX_LENGTH'      , 'Heslo musí obsahovat maximálně 30 znaků.'             );
    # EMAIL                             | TEXT INPUT
    define('USER_EMAIL_LABEL'           , 'Vaše e-mailová adresa:'                               );
    define('USER_EMAIL_REQ'             , 'Prosím, vyplňte e-mailovou adresu.'                   );
    # USERNAME                          | TEXT INPUT
    define('USER_USERNAME_LABEL'        , 'Jméno:'                                               );
    define('USER_USERNAME_REQ'          , 'Políčko se jménem musí být vyplněné.'                 );
    define('USER_USERNAME_MIN_LENGTH'   , 'Minimální velikost jména musí být alespoň 2 znaky.'   );
    define('USER_USERNAME_MAX_LENGTH'   , 'Jméno musí být menší než-li 40 znaků.'                );
    # SURNAME                           | TEXT INPUT
    define('USER_SURNAME_LABEL'         , 'Příjmení:'                                            );
    define('USER_SURNAME_REQ'           , 'Políčko s příjmením musí být vyplněné.'               );
    define('USER_SURNAME_MIN_LENGTH'    , 'Minimální velikost příjmení musí být alespoň 2 znaky.');
    define('USER_SURNAME_MAX_LENGTH'    , 'Jméno musí být menší než-li 40 znaků.'                );
    # BIRTHDAY                          | TEXT INPUT
    define('USER_BIRTHDAY_LABEL'        , 'Datum narození:'                                      );
    define('USER_BIRTHDAY_REQ'          , 'Datum narození musí být vyplněn.'                     );
    # FACEBOOK                          | TEXT INPUT
    define('USER_FACEBOOK_LABEL'        , 'Účet na facebooku:'                                   );
    # SKYPE
    define('USER_SKYPE_LABEL'           , 'Účet na skype:'                                       );
    # USER SEND BUTTON                  | INPUT SUBMIT
    define('USER_REGISTRATION_SUBMIT'   , 'Registrovat!'                                         );
    define('USER_LOGIN_SUBMIT'          , 'Přihlásit se!'                                        );
    define('USER_PROFILE_SUBMIT'        , 'Uložit změny'                                         );
    
